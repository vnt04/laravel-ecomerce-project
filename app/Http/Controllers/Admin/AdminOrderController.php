<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\IOrderService;
// use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    protected IOrderService $orderService;

    public function __construct(IOrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index() {
        $orders = $this->orderService->getAllOrders();
        return response()->json([
            'message' => "Get all orders successfully.",
            'total' => count($orders),
            'orders' => $orders,
        ]);
    }

    public function getById($id) {
        return $this->orderService->getById($id);
    }

    public function confirm($id) {
        return $this->orderService->updateStatusOrder($id, 'pending','confirmed');
    }

    public function cancel($id) {
        return $this->orderService->updateStatusOrder($id, 'pending', 'canceled');
    }

}
