<?php

use App\Models\Tall;
use App\Models\Wide;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Diameter;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\v1\ShoppingController;

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function ($router) {

    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('logout', [AuthController::class, 'logout'])->middleware('jwt.verify')->name('auth.logout');
    Route::post('refresh', [AuthController::class, 'refresh'])->middleware('jwt.verify')->name('auth.refresh');
    Route::post('profile', [AuthController::class, 'profile'])->middleware('jwt.verify')->name('auth.profile');

    Route::get('attributes', function () {
        $response = [
            'brand' => Brand::all('id as value', 'name as label'),
            'category' => Category::all('id as value', 'name as label'),
            'diameter' => Diameter::all('id as value', 'name as label'),
            'tall' => Tall::all('id as value', 'name as label'),
            'wide' => Wide::all('id as value', 'name as label'),
        ];
        return response()->json($response, 200);
    })->name('attributes');

    Route::get('produtos', [\App\Http\Controllers\API\ProdutoController::class, 'index'])->name('produtos.index');
    Route::get('produtos/{product}/show', [\App\Http\Controllers\API\ProdutoController::class, 'show'])->name('produtos.show');
});

Route::middleware(['api', 'jwt.verify'])->name('v1.')->namespace('V1')->prefix('v1')->group(function () {
    Route::get('products', [\App\Http\Controllers\API\v1\ProductController::class, 'index'])->name('products.index');
    Route::get('products/{product}', [\App\Http\Controllers\API\v1\ProductController::class, 'show'])->name('products.show');
    Route::post('products', [\App\Http\Controllers\API\v1\ProductController::class, 'store'])->middleware('checkRole')->name('products.store');
    Route::put('products/{product}', [\App\Http\Controllers\API\v1\ProductController::class, 'update'])->middleware('checkRole')->name('products.update');
    Route::delete('products/{product}', [\App\Http\Controllers\API\v1\ProductController::class, 'destroy'])->middleware('checkRole')->name('products.destroy');

    Route::get('shoppings', [ShoppingController::class, 'index'])->name('shoppings.index');
    Route::get('shopping/{id}', [ShoppingController::class, 'show'])->name('shopping.show');
    Route::post('shopping', [ShoppingController::class, 'store'])->name('shopping.store');
    Route::put('shopping/{id}', [ShoppingController::class, 'update'])->name('shopping.update');
    Route::delete('shopping/{id}', [ShoppingController::class, 'destroy'])->name('shopping.destroy');
    Route::get('shopping/{id}/add/{product}/qtd/{qtd}', [ShoppingController::class, 'add'])->name('shopping.add');
    Route::get('shopping/{id}/remove/{product}', [ShoppingController::class, 'remove'])->name('shopping.remove');
});

