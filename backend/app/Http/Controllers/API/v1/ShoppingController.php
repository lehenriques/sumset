<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Shopping;
use Illuminate\Http\Request;
use App\Http\Requests\StoreShopping;
use App\Http\Requests\UpdateShopping;
use App\Http\Controllers\API\BaseController as BaseController;

class ShoppingController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Shopping::with('product')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShopping $request)
    {
        return $request->persist();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\shopping  $shopping
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Shopping::with('product')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\shopping  $shopping
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShopping $request, $id)
    {
        return $request->persist($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\shopping  $shopping
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Shopping::findOrFail($id)->delete();

        return response()->json(['success' => true], 200);
    }

    /**
     * Add product to shopping.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\shopping  $shopping
     * @return \Illuminate\Http\Response
     */
    public function add($id, $product, $qtd)
    {
        $shopping = Shopping::with('product')->find($id);
        $prod = \App\Models\Product::find($product);

        $shopping->product()->detach($product);

        $shopping->product()->attach($prod->id, [
            'price' => number_format((int)$prod->price, 2, '.', ','),
            'discount' => $prod->discount ?? 0,
            'quantity' => $qtd,
        ]);

        return response()->json(['success' => true], 200);
    }

    /**
     * Remove product to shopping.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\shopping  $shopping
     * @return \Illuminate\Http\Response
     */
    public function remove($id, $product)
    {
        $shopping = Shopping::with('product')->find($id);

        $shopping->product()->detach($product);

        return response()->json(['success' => true], 200);
    }
}
