<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
	protected $fillable = [
		'color',
		'size',
		'price',
		'quantity',
		'product_id'
	];

	public function product()
	{
		return $this->belongsTo(\App\Models\Product::class, 'product_id');
	}

	public function carts()
	{
		return $this->hasMany(\App\Models\Cart::class, 'product_id');
	}

}
