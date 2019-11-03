<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = [
		'image',
        'product_id',
        'color',
        'is_avatar'

    ];

    public function product()
	{
		return $this->belongsTo(\App\Models\Product::class, 'product_id');
	}
}
