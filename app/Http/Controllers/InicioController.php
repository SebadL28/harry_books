<?php

namespace HarryBooks\Http\Controllers;

use HarryBooks\Libro;
use Illuminate\Http\Request;

class InicioController extends Controller
{

	function __construct(){
		if(!is_array(session("libros_cart"))){
			session(['libros_cart' => []]);
		}
	}

	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/

    public function index(){
        $libros = Libro::all();
        return view('index', compact('libros'));
    }
}
