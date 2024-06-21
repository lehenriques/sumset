<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
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
    public function persist()
    {
        $path = null;
        if ($file = $this->file('photo')) {
            $filename = 'product-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/product', $filename);
        }

        $product = Product::create([
            'name' => $this->nome,
            'description' => $this->description,
            'price' => $this->price,
            'stock_quantity' => $this->stock_quantity,
            'photo' => $path,
            'brand_id' => $this->brand,
            'category_id' => $this->category,
            'diameter_id' => $this->diameter,
            'tall_id' => $this->tall,
            'wide_id' => $this->wide,
        ]);
        
        return $product;
    }
}
