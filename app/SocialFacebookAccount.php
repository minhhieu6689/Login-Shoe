<?php

namespace App;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class SocialFacebookAccount extends Model
{
    protected $fillable = ['customer_id', 'provider_user_id', 'provider'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
