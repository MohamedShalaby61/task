<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Product;
use Validator;

class ProductController extends Controller
{
    
    public function store(Request $request)
    {
           $validator = Validator::make($request->all(), [

            'title' => 'required|max:255',

            'price' => 'required',

        ]);

        if ($validator->fails()) {

            return response()->json(['message' => $validator->errors()->first()]);

        }else{

            if($request->discount && $request->discount > 0){

                $final_price = $request->price - $request->discount;


            }else{

                $final_price = $request->price;

            }

            $product = Product::create([

                            'title' => $request->title ,

                            'price' => $request->price , 

                            'discount' => $request->discount,

                            'final_price' => $final_price

                        ]);

            return response()->json(['message' => $product]);
        }
    }

    

}
