<?php

namespace HarryBooks;

use Illuminate\Database\Eloquent\Model;

class LibroVenta extends Model
{
    public function resumen_venta(){
		return $this->belongsTo('HarryBooks\ResumenVenta', 'id_resumen_venta', 'id');		
	}

	public function libro(){
		return $this->belongsTo('HarryBooks\Libro', 'id_libro', 'id');		
	}
}
