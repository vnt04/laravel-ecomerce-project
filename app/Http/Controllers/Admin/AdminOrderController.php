<?php

namespace App\Http\Controllers\Admin;

use App\Services\IOrderService;
use App\Services\IProductService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use Throwable;

// use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    protected IOrderService $orderService;
    protected IProductService $productService;

    public function __construct(IOrderService $orderService, IProductService $productService)
    {
        $this->orderService = $orderService;
        $this->productService = $productService;   
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
        DB::beginTransaction();

        try {
            $order = $this->orderService->updateStatusOrder($id, 'pending','confirmed');
            foreach($order->items as $item) {
                $this->productService->updateStock($item->product_id,$item->quantity);
            }
            DB::commit();
            return $order;
        }catch(Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }
        
    }

    public function cancel($id) {
        return $this->orderService->updateStatusOrder($id, 'pending', 'canceled');
    }

}
