<?php

namespace App\Http\Requests;

use App\Models\Shopping;
use Illuminate\Foundation\Http\FormRequest;

class StoreShopping extends FormRequest
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
            'user_id'              => 'required',
            'product_id'           => 'required',
            'delivery_date'        => 'required',
            'status'               => 'required',
        ];
    }

    /**
     * Persist to Database
     *
     * @return boolean
     */
    public function persist()
    {
        $shopping = Shopping::create($this->all());

        $shopping->product()->attach($this->product_id, [
            'price' => number_format($this->price, 2, '.', ','),
            'discount' => $this->discount,
            'quantity' => $this->quantity,
        ]);

        return response()->json(['success' => true], 201);
    }
}
