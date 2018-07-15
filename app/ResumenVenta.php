<?php

namespace HarryBooks;

use Illuminate\Database\Eloquent\Model;

class ResumenVenta extends Model
{
	public function libro_venta(){
		return $this->hasMany('HarryBooks\LibroVenta', 'id_resumen_venta', 'id');
	}

	public function user(){
		return $this->belongsTo('HarryBooks\User', 'usuario', 'id');
	}
}
