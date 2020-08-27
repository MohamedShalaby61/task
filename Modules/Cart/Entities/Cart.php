<?php

namespace Modules\Cart\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Customer\Entities\Customer;
use Modules\Product\Entities\Product;

class Cart extends Model
{
    protected $guarded = [];

    public $timestamps = false ;

    public function customer(){

    	return $this->belongsTo(Customer::class);
    }

    public function products() {

        return $this->belongsToMany(Product::class)->withPivot('product_quantity');

    }


}
