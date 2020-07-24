<?php

namespace Modules\Customer\Entities;

use Illuminate\Database\Eloquent\Model;

use Modules\Cart\Entities\Cart;

class Customer extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function cart{

    	return $this->hasOne(Cart::class);
    }
}
