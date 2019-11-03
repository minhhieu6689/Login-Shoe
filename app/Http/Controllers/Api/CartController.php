<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\ProductImage;
use App\Models\Product;

class CartController extends Controller
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
        $customer = auth('api')->user();
        if (!$customer) {
            return response()->json(['success' => false, 'message' => 'Vui lòng đăng nhập để mua hàng']);
        }
        $id = $customer->id;
        $data = $this->params($request);
        $producId = $data['product_id'];
        $data['customer_id'] = $id;
        $cart = Cart::where('customer_id', $id)->where('product_id', $producId)->first();
        if ($cart != null) {
            if ($request->type == 'update') {
                $cart->quantity = $request->quantity ?? 1;
            } else {
                $cart->quantity = $cart->quantity + ($data['quantity'] ?? 1);
            }

            if ($cart->quantity <= 0) {
                $cart->delete();
                return response()->json(['success' => true, 'message' => 'Đã xóa sản phẩm khỏi giỏ hàng thành công'], 200);
            } else {
                $cart->save();
            }
        } else {
            $cart = Cart::create($data);
        }
        $carts = Cart::where('customer_id', $id)->get();

        return response()->json(['success' => true, 'message' => 'Thay đổi giỏ hàng thành công', 'cart' => isset($carts) ? $carts : []], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { }

    public function showCurrentCart()
    {
        $customer = auth('api')->user();
        $id = $customer->id;
        $carts = Cart::with('product_detail')->where('customer_id', $id)->get();
        foreach ($carts as $cart) {
            $idProduct = $cart->product_detail->product_id;
            $product = Product::findorFail($idProduct);
            $cart->product_detail->name = $product->name;
            $cart->product_detail->sub_price = $cart->product_detail->price * $cart->quantity;
            $images = ProductImage::where('product_id', $idProduct)->get();
            foreach ($images as $image) {
                if ($image->color == $cart->product_detail->color) {

                    $cart->product_detail->image = $image->image;
                }
            }
        }
        return response()->json(['success' => true, 'message' => 'successful', 'cart' => isset($carts) ? $carts : []], 200);
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

    public function params($request)
    {

        $data = [
            'product_id' => $request->product_id ?? '',
            'customer_id' => $request->customer_id ?? '',
            'quantity' => $request->quantity ?? '',
        ];

        return $data;
    }
}
