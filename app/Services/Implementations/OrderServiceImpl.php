<?php
namespace App\Services\Implementations;

use Exception;
use App\Services\IOrderService;
use App\Helpers\CheckUserTypeHelper;
use Illuminate\Support\Facades\Auth;
use App\Repositories\IOrderRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class OrderServiceImpl implements IOrderService {
    protected IOrderRepository $orderRepository;

    public function __construct(IOrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;    
    }

    public function getAllOrders() {
        $user = Auth::user();

        if(CheckUserTypeHelper::isUser($user)) {
            return $this->orderRepository->getAllOrders();
        } 

        if(CheckUserTypeHelper::isCustomer($user)){
            return $this->orderRepository->getAllOrdersByCustomerId($user->id);
        } 

        throw new Exception("Unknown User Type.");
        
    }

    public function getById($id)
    {
        $user = Auth::user();

        $order = $this->orderRepository->getById($id);

        if (!$order) {
            throw new NotFoundHttpException("Order with ID {$id} not found");
        }

        if (CheckUserTypeHelper::isUser($user)) {
            return $order;
        }

        if (CheckUserTypeHelper::isCustomer($user)) {
            if ($order->customer_id !== $user->id) {
                throw new AuthorizationException("You do not have access to this order.");
            }
            return $order;
        }

        throw new Exception("Unknown User Type.");
    }


    public function create(array $newOrder) {
        // get customer_id 
        $customer_id = Auth::user()->id;
        $newOrder['customer_id'] = $customer_id;

        // default status is 'pending'
        $newOrder['status'] = 'pending';

        // accumulate total amount
        $newOrder['total'] = collect($newOrder['products'])->sum(function($product) {
            return $product['price'] * $product['quantity'];
        });

        return $this->orderRepository->create($newOrder);
    }

    public function updateStatusOrder($id, $from, $to)
    {
        $order = $this->orderRepository->getById($id);

        if (!$order) {
            throw new NotFoundHttpException("Order with ID {$id} not found");
        }

        if($order['status'] !== $from) {
            throw new BadRequestHttpException("Order does't has status {$from}.");
        }

        return $this->orderRepository->updateStatusOrder($id, $to);
    }

    public function updateOrder($id, array $newData)
    {
        $order = $this->orderRepository->getById($id);

        if (!$order) {
            throw new NotFoundHttpException("Order with ID {$id} not found");
        }

        if($order['status'] !== 'pending') {
            throw new BadRequestHttpException("You only update order in status pending.");
        }

        // check stock to ensure enough products for order.

        return $this->orderRepository->updateOrder($id, $newData);

    }
}
