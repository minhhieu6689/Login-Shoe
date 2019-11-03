<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
		'name',
		'description',
		'category_id',
		'is_feature'
    ];
    
	public function product_category()
	{
		return $this->belongsTo(\App\Models\ProductCategory::class, 'category_id');
    }
    
    public function product_details()
	{
		return $this->hasMany(\App\Models\ProductDetail::class, 'product_id');
    }
    
    public function product_images()
	{
		return $this->hasMany(\App\Models\ProductImage::class, 'product_id');
	}

	

}
