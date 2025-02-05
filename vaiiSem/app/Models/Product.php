<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'price',
        'rating',
    ];
    public function reviews()
{
    return $this->hasMany(Review::class);
}

protected static function boot() {
    parent::boot();

    static::deleting(function ($product) {
        $product->reviews()->delete();
    });
}

public function categories()
{
    return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
}

    

}
