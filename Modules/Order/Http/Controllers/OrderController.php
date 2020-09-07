<?php

namespace Modules\Order\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Order\Entities\Order;
use Modules\Cart\Entities\Cart;
use Validator;

class OrderController extends Controller
{
    
    public function checkout(Request $request)
    {
        if($request->code =='A3000'){

                $validator = Validator::make($request->all(),[
                   'customer_id'      => 'required|integer',
                   'shipping_method'  => 'required',
                   'payment_method'   => 'required',
                ]);

                if($validator->fails()){

                   return response()->json(['message' => $validator->errors()->first()]);

                }else{


                    $cart = Cart::where('customer_id',$request->customer_id)->first();

                    $sub_total = $cart->product_subtotal;

                    

                    $code_discount = (1/10) * $sub_total ;

                    $taxes = (1/10) * $sub_total ;

                    if($request->shipping_method == 'Home Delivery' && $request->payment_method == 'Cash On Delivery'){

                       $shipping_fees = $sub_total * (5/100);

                    }elseif($request->shipping_method == 'Pickup From Store' && $request->payment_method == 'Pay At Store'){
                        
                        $shipping_fees = 0;

                    }else{

                        return response()->json(['Error' => 'something went wrong , write a correct payment method and shipping method']);

                    }

                    $final_total   = $sub_total + $taxes + $shipping_fees - $code_discount;

                    $data = Order::create([

                                'sub_total'     => $cart->product_subtotal ,
                                'code'          => $request->code ,
                                'shipping_fees' =>  $shipping_fees,
                                'status_id'     => 1 ,
                                'final_total'   => $final_total ,

                            ]);

                    return response()->json(['success' => $data]);

                }

        }else{

                $validator = Validator::make($request->all(),[
                   'customer_id'      => 'required|integer',
                   'shipping_method'  => 'required',
                   'payment_method'   => 'required',
                ]);

                if($validator->fails()){

                   return response()->json(['message' => $validator->errors()->first()]);

                }else{

                    $cart = Cart::where('customer_id',$request->customer_id)->first();

                    $sub_total = $cart->product_subtotal;

                    $taxes = (1/10) * $sub_total ;

                    if($request->shipping_method == 'Home Delivery' && $request->payment_method == 'Cash On Delivery'){

                       $shipping_fees = $sub_total * (5/100);

                    }elseif($request->shipping_method == 'Pickup From Store' && $request->payment_method == 'Pay At Store'){
                        
                        $shipping_fees = 0;

                    }else{

                        return response()->json(['Error' => 'something went wrong , write a correct payment method and shipping method']);

                    }

                    $final_total   = $sub_total + $taxes + $shipping_fees;

                    $data = Order::create([

                                'sub_total'     => $cart->product_subtotal ,
                                'code'          => $request->code ,
                                'shipping_fees' =>  $shipping_fees,
                                'status_id'     => 1 ,
                                'final_total'   => $final_total ,

                            ]);

                    return response()->json(['success' => $data]);

                }   

        }

    }


    public function changeOrderStatus(Request $request)
    {
        $validator = Validator::make($request->all(),[
                   'order_id'      => 'required|integer',
                   'status_id'      => 'required|integer',
                ]);

        if($validator->fails()){

           return response()->json(['message' => $validator->errors()->first()]);

        }else{

            $order = Order::where('id',$request->order_id)->first();

            $order->update(['status_id' => $request->status_id]);

            return response()->json(['message' => 'status updated successfully']);

        }

    }
        

    
}
