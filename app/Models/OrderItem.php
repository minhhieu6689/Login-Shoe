<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
	protected $fillable = [
		'order_id',
		'product_id',
		'quantity',
	];

	public function order()
	{
		return $this->belongsTo(\App\Models\Order::class, 'order_id');
	}

	public function product_detail()
	{
		return $this->belongsTo(\App\Models\ProductDetail::class, 'product_id');
	}
}
