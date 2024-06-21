<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shopping extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'delivery_date', 'status'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class)->withPivot('price', 'discount', 'quantity');
    }
}