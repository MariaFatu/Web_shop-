<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use App\Review;
use Illuminate\Support\Facades\DB;
session_start();
class CartController extends Controller
{
    public function index()
    {

        $products = Product::all();
        return view('products', compact('products'));
    }

    public function cart()
    {
		$products = Product::orderBy('name','ASC')->paginate(5);
        $userid = (auth()->user())->id; 
        if($userid > 2)
        {
            return view('cart',compact('products'));
        }
    }

    public function show()
    {
		$products = Product::orderBy('name','ASC')->paginate(5);
		$value=1;
        $reviews = Review::all();
        $reviews_details = DB::table('reviews as r')
                ->join('products as p', 'r.product_id', '=', 'p.id')
                ->select(DB::RAW('p.id as id, min(p.name) as name, min(p.image) as img, avg(r.scor) as avg_scor'))
                ->groupBy('p.id')
                ->get();
        if (!auth()->user())
        {
            return view('products', compact('products'));
        }
        else
        {     
            $userid = (auth()->user())->id; 
            //daca userul este administratorul
            if($userid == 1)
            {
                return view('products.list',compact('products'))->with('i',$value);
            }
            //daca userul este business-analyst-ul
            else if($userid == 2)
            {
                return view('reviews.list_rev',compact('reviews_details'));
            }
            //daca userul este un client
            else 
                return view('products', compact('products'));
        }
    }
	
    //parametru: $id - id produs
    //returnează forma apelantă 
    //se adaugă la coș (în variabila $cart din sesiune) o unitate din produsul primit ca parametru
	public function addToCart($id) 
    {
        $product = Product::find($id);

        if(!$product) {

            abort(404);

        }

        // se citeste variabila $cart din sesiune
        $cart = session()->get('cart');

        // dacă cart este gol (variabila $cart nu exista in sesiune) se creaza variabila $cart si se adauga produsul in cos cu cantitatea = 1
        if(!$cart) {

            $cart = [
                    $id => [
                        "name" => $product->name,
                        "quantity" => 1,
                        "price" => $product->price,
                        "image" => $product->image
                    ]
            ];

            // se scrie variabila $cart in sesiune
            session()->put('cart', $cart);

            // redirectare
            return redirect()->back()->with('success', 'Produs adaugat cu succes in cos!');
        }

        // daca produsul exista in cos se incrementeaza cantitate
        if(isset($cart[$id])) {

            $cart[$id]['quantity']++;

            // se scrie variabila $cart in sesiune
            session()->put('cart', $cart);
            
            // redirectare
            return redirect()->back()->with('success', 'Produs adaugat cu succes in cos!');

        }

        // daca produsul nu exista in cos se adauga produsul in cos cu cantitatea = 1
        else{
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        
        // se scrie variabila $cart in sesiune
        session()->put('cart', $cart);
          
        // redirectare
        return redirect()->back()->with('success', 'Produs adaugat cu succes in cos!');
        }
    }
    
    //parametru: $request - informații corespunzătoare modelului Cart
    //modifică valoarea cantității unui produs din coș (variabila $cart din sesiune)
	public function update(Request $request)
		{
			if($request->id and $request->quantity)
			{
				$cart = session()->get('cart');

				$cart[$request->id]["quantity"] = $request->quantity;

				session()->put('cart', $cart);

				session()->flash('success', 'Coș modificat cu succes');
			}
		}

    //parametru: $request - informații corespunzătoare modelului Cart
    //șterge un produs din coș (variabila $cart din sesiune)   
    public function remove(Request $request)
    {
        if($request->id) {

            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            session()->flash('success', 'Produs sters cu succes!');
        }
    }
	
    //parametru: $request - informații corespunzătoare modelului Cart
    //completează în baza de date datele din coș (variabila $cart din sesiune) 
	public function finalize_cmd(Request $request)
	{
			// populate Cart table from database using data from 'cart' session variable
			// Cart table fields: ['id','product_id', 'user_id', 'quantity'];
			$userid = (auth()->user())->id;
			$cart = session()->get('cart');
			foreach ($cart as $id => $details)
			{
				$cartdb = new Cart;
				$cartdb->quantity = $details["quantity"];
				$cartdb->product_id = $id;
				$cartdb->user_id = $userid;
				$cartdb->save();		
			}
			
			// empty $cart 
			foreach ($cart as $id => $details)
			{
				unset($cart[$id]);		
			}
            // remove $cart from session
			session()->put('cart', $cart);

            // redirect
			return redirect()->back()->with('success', 'Comandă plasată!');
	}	
}
