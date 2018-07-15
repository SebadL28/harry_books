<?php

namespace HarryBooks\Http\Controllers;

use Illuminate\Http\Request;
use HarryBooks\Libro;
use HarryBooks\ResumenVenta;
use HarryBooks\LibroVenta;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

	public function index(){
		$librosSelect = $this->obtenerLibros();
		$libros = $this->obtenerLibrosSession();
        return view('cart', compact("librosSelect", "libros"));
	}

	public function obtenerLibros(){
		$libros = session("libros_cart");
		if(!is_array($libros)){
			$libros = [];
		}

		return $libros;
	}

	public function guardarLibros($libros){
		session(['libros_cart' => $libros]);
	}

	public function agregarLibro(Request $request){
		$id = $request->input("id");
		$cantidad = $request->input("cantidad");

		$libros = $this->obtenerLibros();
		$libroAct = ["id" => $id, "cantidad" => $cantidad];
		$libros[] = $libroAct;

		$this->guardarLibros($libros);
		return $libros;
	}

	public function actualizarCantidadLibro(Request $request){
		$id = $request->input("id");
		$cantidad = $request->input("cantidad");

		$libros = $this->obtenerLibros();
		$libros[$id]["cantidad"] = $cantidad;
		$this->guardarLibros($libros);
	}

	public function eliminarLibro(Request $request){
		$id = $request->input("id");
		$libros = $this->obtenerLibros();
		array_splice($libros, $id, 1);
		$this->guardarLibros($libros);
	}

	public function cancelarCompra(Request $request){
		$this->guardarLibros([]);
	}

	public function finalizarCompra(){
		$usuario = Auth::user()->id;
		$fecha = date("Y-m-d H:i:s");
		$resumenV = new ResumenVenta();

		$libros = $this->obtenerLibrosSession();
		$librosSelect = session("libros_cart");
		if(count($libros) > 0){

			$granTotal = 0;
			$librosVenta = [];
			foreach ($librosSelect as $key => $value){
				$libroAct = $libros[$value["id"]];
				$precio = $libroAct->precio;

				$cantidadSelect = $value["cantidad"];
				$total = $precio * $cantidadSelect;
				$granTotal += $total;

				$libroAct->cantidad -= $cantidadSelect;
				$libroAct->save();

				$librosVenta[] = ["id_libro" => $value["id"], "cantidad" => $value["cantidad"], "precio" => $precio];
			}


			$resumenV->usuario = $usuario;
			$resumenV->fecha = $fecha;
			$resumenV->usuario = $usuario;
			$resumenV->total = $granTotal;
			$resumenV->save();

			foreach ($librosVenta as $key => $value){
				$librosVenta[$key]["id_resumen_venta"] = $resumenV->id;
			}

			LibroVenta::insert($librosVenta);
		}
		
		$this->guardarLibros([]);
		return redirect(route('inicio'))->with('compra', 'success');
	}

	public function obtenerLibrosSession(){
		$librosSelect = $this->obtenerLibros();
		$libros = [];
		if(count($librosSelect)){
			$ids = [];
			foreach ($librosSelect as $key => $value){
				$idAct = $value["id"];
				$ids[] = $idAct;
			}

			$ids = array_unique($ids);
			$librosAct = Libro::whereIn("id", $ids)->get();
			foreach ($librosAct as $libro){
				$libros[$libro->id] = $libro;
			}
		}

		return $libros;
	}
}
