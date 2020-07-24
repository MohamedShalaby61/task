<?php

namespace Modules\Cart\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Validator;
use Modules\Cart\Entities\Cart;

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

            $cart = Cart::create([
                        
                        'customer_id'      => $request->customer_id ,

                        'product_id'       => $request->product_id ,

                        'product_quantity' => $request->product_quantity ,

                        'subtotal_price'   => 5

                    ]);

            dd($cart->products);

        }

        // } 





    }

}
