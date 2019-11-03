<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
		'name',
		'code',
		'discount_type',
		'discount_value'
    ];

    public function orders()
	{
		return $this->hasMany(\App\Models\Orders::class, 'voucher_id');
    }
    
}
