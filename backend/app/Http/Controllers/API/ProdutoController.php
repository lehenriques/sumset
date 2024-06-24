<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ResponseService;
use App\Http\Controllers\API\BaseController;

class ProdutoController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $product = Product::with(['brand', 'category', 'diameter', 'tall', 'wide'])->orderby('id', 'desc')->paginate(12);
        } catch (\Throwable | \Exception $e) {
            return ResponseService::exception('login', null, $e);
        }


        return  $this->sendResponse($product, '');
    }

    /**
     * Display a listing of the resource.
     */
    public function show(Product $product)
    {
        try {
            $product = Product::with(['brand', 'category', 'diameter', 'tall', 'wide'])->whereId($product->id)->first();
        } catch (\Throwable | \Exception $e) {
            return ResponseService::exception('login', null, $e);
        }


        return  $this->sendResponse($product, '');
    }
}
