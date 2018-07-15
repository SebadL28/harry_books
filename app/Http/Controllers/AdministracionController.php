<?php

namespace HarryBooks\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use HarryBooks\ResumenVenta;

class AdministracionController extends Controller
{
	function __construct(){
		$this->middleware(function ($request, $next) {
            if (!Auth::check()) {
	            return redirect(route('inicio'));
	        }
	        if(Auth::user()->rol == 0){
            	return redirect(route('inicio'));
            }

            return $next($request);
        });
	}
	
	public function index(){
		$informes = ResumenVenta::all();
        return view('administracion.inicio', compact("informes"));
	}

	public function informe($id){
		$informe = ResumenVenta::find($id);
        return view('administracion.informe', compact("informe"));
	}
}
