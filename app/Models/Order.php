<?php

namespace App\Models;
use App\Models\OrderItem;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'total', 'payment_type', 'status'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
