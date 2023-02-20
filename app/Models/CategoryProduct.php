<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryProduct extends Model
{
	use HasFactory, SoftDeletes;

	protected $fillable = [
		'name',
	];

	// NOTE Esta funcion siempre se ejecuta al crear o actualizar
	public function setNameAttribute($value) //$value -> name
	{
		$this->attributes['name'] = ucfirst(strtolower($value)); // mi amigo -> Mi amigo (MI AMIGO -> Mi amigo)
	}
}
