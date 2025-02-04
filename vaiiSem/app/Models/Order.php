<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'address', 'city', 'postal_code', 'phone_number', 'total_price', 'status'
    ];


    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
