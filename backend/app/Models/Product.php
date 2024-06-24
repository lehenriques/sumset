<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ramsey\Uuid\Type\Decimal;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock_quantity',
        'brand_id',
        'category_id',
        'diameter_id',
        'tall_id',
        'wide_id'
    ];
    protected $appends = ['dolar', 'real'];


    public function getDolarAttribute()
    {
        return number_format((float)$this->price / 7.470, 2, ',', '.');
    }

    public function getRealAttribute()
    {
        return number_format((float)$this->price / 1.400, 2, ',', '.');
    }

    /**
     * Interact with the product price.
     */
    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn (float $value) => number_format($value, 2, ',', '.'),
            set: fn (float $value) => str_replace(',', '.', str_replace('.', '', $value)),
        );
    }

    /**
     * Get the brand associated with the product.
     */
    public function brand(): HasOne
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    /**
     * Get the category associated with the product.
     */
    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    /**
     * Get the diameter associated with the product.
     */
    public function diameter(): HasOne
    {
        return $this->hasOne(Diameter::class, 'id', 'diameter_id');
    }

    /**
     * Get the tall associated with the product.
     */
    public function tall(): HasOne
    {
        return $this->hasOne(Tall::class, 'id', 'tall_id');
    }

    /**
     * Get the wide associated with the product.
     */
    public function wide(): HasOne
    {
        return $this->hasOne(Wide::class, 'id', 'wide_id');
    }
}
