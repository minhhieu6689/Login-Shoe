<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
		'name',
		'address',
		'phone',
        'payment_type',
        'status',
		'sub_total',
		'discount',
        'shipping_fee',
        'total',
		'voucher_id',
		'customer_id',
    ];
    
    public function order_products()
	{
		return $this->hasMany(\App\Models\ProductDetail::class);
    }

    public function voucher()
	{
		return $this->belongsTo(\App\Models\Voucher::class, 'voucher_id');
    }

    public function customer()
	{
		return $this->belongsTo(\App\Models\Customer::class, 'customer_id');
    }
}
