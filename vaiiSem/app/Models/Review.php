<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'author',
        'review',
        'rating'
    ];

    // Definovanie vzťahu "recenzia patrí produktu"
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
