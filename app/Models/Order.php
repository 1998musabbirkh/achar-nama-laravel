<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_name', 'phone', 'address', 'total_price', 'payment_method', 'status',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
