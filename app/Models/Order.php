<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['customer_id', 'total', 'status'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
                        
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
