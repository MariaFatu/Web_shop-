<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Review;
use App\Product;
use App\Cart;
use App\Word;
use App\Http\Requests;

class ReviewsController extends Controller
{
    // $id - ID de produs
    // pentru utilizatorii normali, functia returneaza viewul de Reviews, furnizand ca date reviewurile produsului a cafrui ID a fost primit ca parametru
    // pentru utilizatorii administrator si business analyst, functia returneaza void.
    public function index($id) //id-ul produsului
    {
        $reviews = DB::table('reviews')
            ->select('*')
            ->where('product_id', '=', $id)
            ->get();
		$userid = (auth()->user())->id;
		if($userid <= 2)
		{
          return view('reviews',compact('reviews'));
		}
    }


    // $request - datele transmise de forma de introducere review
    // insereaza un review in baza de date, dupa ce inlocuieste diacritice, calculeaza scor si evalueaza sentiment.
    public function store(Request $request)
    {
        //validare campuri obligatorii
        $this->validate($request, ['review' => 'required']);

        // inlocuire diacritice
        $review_txt = $this->inlocuireDiacritice($request->review);
    
        // calculare scor
        $score = $this->get_review_score($review_txt);

        // evaluare sentiment
        if($score > 0){
            $sent = 'pozitiv';
        }
        else 
            if($score < 0){
                $sent = 'negativ';
            }
            else $sent = 'neutru';
        
        // inserare review in baza de date
        DB::table('Reviews')
            ->insert(
            ['product_id' => $request->product_id,
            'user_id' => $request->user_id,
            'review' => $review_txt, 
            'scor' => $score,
            'sentiment' => $sent
            ]
        );

        // redirectare
        $product = Product::find($request->product_id);
        return view('product_details',compact('product'));

    }


    // $sir - textul care contine diacritice
    // inlocuieste diacriticele din sirul $sir cu caracterele fara sedile
    // returneaza sirul fara diacritice
    function inlocuireDiacritice($sir) {
        
        $diaritice = array('â', 'Â', 'ă', 'Ă', 'î', 'Î', 'ţ', 'Ţ', 'ş', 'Ş',);
        $faraDiacritice = array('a', 'A', 'a', 'A', 'i', 'I', 't', 'T', 's', 'S',);
        return str_replace($diaritice, $faraDiacritice, $sir);
   
        }



    
     // $text - textul care trebuie evaluat
     // calculeaza scorul unui review (a carui diacritice au fost inlocuite inainte de apel)
     // returneaza scorul rezultat in urma evaluarii
    public function get_review_score($text)
    {
        $text = strtolower(trim($text));
        $text = preg_replace('/[^a-z0-9]+/i', ' ', $text);
        $words = explode(' ', $text);
        $score = 0;
        $flag_negation = false;
        foreach ($words as $word) {
           if ($this->isNegation($word))
           {
               $flag_negation = true;
           }
           else
           {
                $word_rec = Word::find($word);
                if(is_null($word_rec)){
                    $score_word = 0;
                }
                else
                {
                    $score_word = $word_rec->score;
                    if($flag_negation == true)
                    {
                        $score_word = - $this->sign($score_word);
                        $flag_negation = false;
                    }
                }
                $score = $score + $score_word;
            }
        }
        return $score;
    }

    
    // $val - valoare numerica a carui semn va fi calculat
    // Functia calculeaza semnul valorii $val, ca si o valoare -1, 0 sau 1
    // returneaza semnul valorii $val
    public function sign($val)
    {
        $result = 0;
        if($val > 0)
            $result = 1;
        else 
            if($val < 0)
                $result = -1;
        return $result;
    }

    // $word - cuvant care ca fi comparat
    // Functia detecteaza daca cuvantul $word este negatie
    // returneaza true daca cuvantul este negatie, false daca nu este negatie
    public function isNegation($word)
    {
        $result = false; 
        if ($word == 'nu') 
            $result = true;
        return $result;
    }



    public function review_form($id)
    {
        return view('review-form',['id' => $id]);
    }



    

}
?>