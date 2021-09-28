<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;


class PagesController extends Controller
{
    public function despre(){
		//return "Pagina despre noi!";--exemplu de afisare string
		//$name="Fiscalitatea astazi";
		return view('despre')->with(['name'=>"vavrvar", 'prenume'=>"Filimon"]);
	}
	public function index(){
		return view('pages.index');
	}


}
?>