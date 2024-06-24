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
            'price' => (float) $this->price,
            'stock_quantity' => $this->stock_quantity,
            'photo' => $path,
            'brand_id' => is_array($this->brand) ? $this->brand['value'] : $this->brand,
            'category_id' => is_array($this->category) ? $this->category['value'] : $this->category,
            'diameter_id' => is_array($this->diameter) ? $this->diameter['value'] : $this->diameter,
            'tall_id' => is_array($this->tall) ? $this->tall['value'] : $this->tall,
            'wide_id' => is_array($this->wide) ? $this->wide['value'] : $this->wide,
        ]);
        
        return $product;
    }
}
