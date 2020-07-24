<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

use Modules\Cart\Entities\Cart;


class Product extends Model
{
    protected $guarded = [];

	public $timestamps = false;

	public function carts() {

        return $this->belongsToMany(Cart::class);
    }


}
