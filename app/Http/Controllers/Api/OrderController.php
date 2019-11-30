<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ProductDetail;
use App\Models\OrderItem;
use App\Models\Cart;
use Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function storeFromCart(Request $request)
    {
        $customer = auth('api')->user();
        $idCustomer = $customer->id;

        $carts = Cart::where('customer_id', $idCustomer)->get();

        if (count($carts) == 0) {
            return response()->json(['success' => false, 'message' => 'Fail to order, cart is empty'], 500);
        }

        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

        if ($validation->fails()) {
            $messages = [];
            $errors = $validation->errors()->getMessages();

            foreach ($errors as $error => $value) {
                $messages = array_merge($messages, $value);
            }
            return response()->json(['success' => false, 'message' => 'cant order', 'errors' => $messages], 500);
        }

        try {
            $order = Order::create([
                'id' => time() . rand(1, 10),
                'customer_id' => $idCustomer,
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'payment_type' => $request->payment_type ?? 'cod',
                'status' => $request->status ?? 'waitting_payment',
                'sub_total' => $request->total_price,
                'discount' => $request->discount ?? 0,
                'shipping_fee' => $request->shipping_fee,
                'voucher_id' => $request->voucher_id,
                'total' =>  $request->total,
            ]);

            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                ]);

                $product = ProductDetail::where('id',$cart->product_id)->first();

                if($product != null){
                    $remainItem = $product->quantity - $cart->quantity;
                    if($remainItem < 0){
                        return response()->json(['success' => false, 'message' => 'Fail to order. Out of stock '], 500);
                    }
                    $product->quantity = $remainItem;
                    $product->save();
                }
                else{
                    return response()->json(['success' => false, 'message' => 'Fail to order. Out of stock '], 500);
                }
                
            }

            Cart::where('customer_id', $idCustomer)->delete();

            return response()->json(['success' => true, 'message' => 'successful', 'order' => $order], 200);
        } catch (\Exception $ex) {
            return response()->json(['success' => false, 'message' => 'Fail to order. ' . $ex->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
