<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductDetail;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('product_details')->with('product_images')->paginate(15);

        return response()->json($products, 200);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Product::with('product_details')->with('product_images')->findOrFail($id);
        return response()->json($products, 200);
    }

    public function search(Request $request)
    {
        $result = Product::with('product_details')->with('product_images')->with('product_category');

        if (!empty($request->search_string)) {
            $result = $result->where('name', 'like', '%' . $request->search_string . '%');
        }

        if (!empty($request->category)) {
            $category = $request->category;
            $result = $result->whereHas('product_category', function ($q) use ($category) {
                $q->where('id', $category);
            });
        }

        if (!empty($request->min_price) && !empty($request->max_price)) {
            $result = $result->whereBetween('price', [$request->min_price, $request->max_price]);
        }

        if (!empty($request->size)) {
            $itemDetail = ProductDetail::where('size', $request->size)->get()->map(function ($item) {
                return $item->product_id;
            })->toArray();
            $result = $result->where(function ($query) use ($itemDetail) {
                $query->whereIn('id', $itemDetail);
            });
        }

        $result = $result->get();

        return response()->json($result, 200);
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
