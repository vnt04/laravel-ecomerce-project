<?php
namespace App\Repositories\Implementations;

use App\Models\Order;
use App\Repositories\IOrderRepository;

/**
 * OrderRepositoryImpl
 */
class OrderRepositoryImpl implements IOrderRepository {

    public function getAllOrders()
    {
        // return Order::all()->load(['items','products']);
        return Order::all();
    }

    public function getById($id) {
        // return Order::find($id)->load(['items','products']);
        return Order::find($id);
    }

    public function getAllOrdersByCustomerId($customerId) {
        // return Order::where('customer_id', $customerId)->get()->load(['items','products']);
        return Order::where('customer_id', $customerId)->get();
    }
    
    public function create(array $newOrder) {
        $order = Order::create($newOrder);
        foreach ($newOrder['products'] as $product) {
            $order->products()->attach($product['id'], [
                'quantity' => $product['quantity'],
                'price' => $product['price'],
            ]);
        }
        return $order;
    }

    public function isExist($id) {
        return Order::where('id',$id)->exists();
    }

    public function updateStatusOrder($id,$newStatus) {
        $order = Order::find($id);
        $order['status'] = $newStatus;
        $order->save();
        return $order;
    }

    public function updateOrder($id, $newData) {
        $order = Order::find($id);

        // detach all products
        $order->products()->detach();

        // attach new products
        foreach ($newData['products'] as $product) {
            $order->products()->attach($product['id'], [
                'quantity' => $product['quantity'],
                'price' => $product['price'],
            ]);
        }

        // recalculate total amount
        $order['total'] = collect($newData['products'])->sum(function($product) {
            return $product['price'] * $product['quantity'];
        });

        $order->save();
        return $order;
        
    }
}
