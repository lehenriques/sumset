<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome'            => 'required|string|min:3',
            'price'           => 'required',
            'stock_quantity'  => 'required|integer',
        ];
    }

    /**
     * Persist to Database
     *
     * @return boolean
     */
    public function persist($product)
    {
        $product = Product::whereId($product->id)->first();
        $product->name = $this->nome;
        $product->description = $this->description;
        $product->price = $this->price;
        $product->stock_quantity = $this->stock_quantity;
        $product->brand_id = $this->brand;
        $product->category_id = $this->category;
        $product->diameter_id = $this->diameter;
        $product->tall_id = $this->tall;
        $product->wide_id = $this->wide;
        $product->save();

        return $product;
    }
}
