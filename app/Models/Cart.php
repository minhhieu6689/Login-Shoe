<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
	protected $casts = [
		'product_id' => 'int',
		'customer_id' => 'int',
		'quantity' => 'int'
	];
	protected $fillable = [
		'product_id',
		'customer_id',
		'quantity',
	];

	public function customer()
	{
		return $this->belongsTo(\App\Models\Customer::class, 'customer_id');
	}

	public function product_detail()
	{
		return $this->belongsTo(\App\Models\ProductDetail::class, 'product_id');
	}
}
