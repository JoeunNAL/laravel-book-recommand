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

    public function scopeGetBothSatisfy($query, $first_column, $first_input_name, $second_column, $second_input_name)
    {
        return $query -> where($first_column, request($first_input_name)) -> where($second_column,request($second_input_name));
    }

    public function scopeGetEitherSatisfy($query, $first_column, $first_input_name, $second_column, $second_input_name)
    {
        return $query -> where($first_column, request($first_input_name)) -> orWhere($second_column,request($second_input_name));
    }
}

