<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Services\IOrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected IOrderService $orderService;

    public function __construct(IOrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function create(Request $request) {
        $validated = $request->validate([
            'products'    => 'required|array|min:1',       
            'products.*.id'       => 'required|exists:products,id',  
            'products.*.quantity' => 'required|integer|min:1',       
            'products.*.price'    => 'required|numeric|min:0',       
        ]);


        $newOrderCreated = $this->orderService->create($validated);

        return response()->json([
            'message' => "Created Order Successfully.",
            'order' => $newOrderCreated,
        ], 201);
    }

    public function myOrders() {
        $orders = $this->orderService->getAllOrders();
        return response()->json([
            'message' => "Get my orders successfully.",
            'total' => count($orders),
            'orders' => $orders,
        ]);
    }

    public function getById($id) {
        return $this->orderService->getById($id);
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'products'    => 'required|array|min:1',       
            'products.*.id'       => 'required|exists:products,id',  
            'products.*.quantity' => 'required|integer|min:1',       
            'products.*.price'    => 'required|numeric|min:0',       
        ]);

        $updatedOrder = $this->orderService->updateOrder($id, $validated);

        return response()->json([
            'message' => "Updated Order Successfully.",
            'order' => $updatedOrder,
        ], 201);
    }
    
}
