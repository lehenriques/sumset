<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ResponseService;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\StoreProduct;
use App\Http\Requests\UpdateProduct;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $product = Product::with(['brand', 'category', 'diameter', 'tall', 'wide'])->orderby('id', 'desc')->get();
        } catch (\Throwable | \Exception $e) {
            return ResponseService::exception('login', null, $e);
        }


        return  $this->sendResponse($product, '');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProduct $request)
    {
        try {
            $product =  $request->persist();
        } catch (\Throwable | \Exception $e) {
            return ResponseService::exception('login', null, $e);
        }

        return  $this->sendResponse($product, 'Produto Cadastrado com sucesso', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        try {
            $product = Product::with(['brand:id,name' , 'category:id,name', 'diameter:id,name', 'tall:id,name', 'wide:id,name'])->whereId($product->id)->first();
        } catch (\Throwable | \Exception $e) {
            return ResponseService::exception('login', null, $e);
        }

        return  $this->sendResponse($product, '');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProduct $request, Product $product)
    {
        try {
            $product =  $request->persist($product);
        } catch (\Throwable | \Exception $e) {
            return ResponseService::exception('login', null, $e);
        }
        return  $this->sendResponse($product, 'Produto alterdo com sucesso');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
        } catch (\Throwable | \Exception $e) {
            return ResponseService::exception('login', null, $e);
        }

        return  $this->sendResponse('', 'Produto deletado com sucesso');
    }
}
