<?php

namespace Modules\Cart\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Validator;
use Modules\Cart\Entities\Cart;
use Modules\Product\Entities\Product;

class CartController extends Controller
{
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[

               'customer_id'      => 'required',

               'product_id'       => 'required',

               'product_quantity' => 'required|min:1',
        ]);

         
        if($validator->fails()){

             return response()->json(['message' => $validator->errors()->first()]);

        }else{


            $cart = Cart::where('customer_id',$request->customer_id)->first();

            $cart->products()->attach($request->product_id);

            return response()->json(['message' => 'successfully inserted']);

        }


    }



    public function changeQuantity(Request $request){

        $validator = Validator::make($request->all(),[

               'customer_id'      => 'required',

               'product_id'       => 'required',

               'product_quantity' => 'required'

        ]);

         if($validator->fails()){

             return response()->json(['message' => $validator->errors()->first()]);

        }else{


            $cart    = Cart::where('customer_id',$request->customer_id)->first();

            $product = Product::where('id',$request->product_id)->first();

            $data = $cart->products()->updateExistingPivot($product , ['product_quantity' => $request->product_quantity]);

            $subtotal = [];

            $count = 0;

            foreach ($cart->products as $product) {

                $subtotal[$count] = $product->final_price * $product->pivot->product_quantity;
                
                $count++;
            }

            $subtotal_sum = array_sum($subtotal);

            $tax = $subtotal_sum/10;

            $cart->update(['product_subtotal' => $subtotal_sum + $tax ]);

            return response()->json(['message' => 'successfully updated']);

        }

 

    }



    public function getSubtotal(){

    }



    public function getTotal(){


    }



    public function deleteFromCart(){

    }




}
