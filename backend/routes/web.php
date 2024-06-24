<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $product = \App\Models\Product::with(['brand' , 'category:id,name', 'diameter:id,name', 'tall:id,name', 'wide:id,name'])->whereId(1)->first();

    dd($product->brand->select);
    // return view('welcome');
});
