<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'brand_id'];

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
