<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wide extends Model
{
    use HasFactory;

    protected $appends = ['select'];

    public function getSelectAttribute()
    {
        return ['value' => $this->id, 'label' => $this->name];
    }
}
