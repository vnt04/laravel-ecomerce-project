<?php
namespace App\Repositories;


interface IOrderRepository {
    function getAllOrders();
    function getAllOrdersByCustomerId($customerId);
    function getById($id);
    function create(array $newOrder);
    function isExist($id);
    function updateStatusOrder($id, $newStatus);
    function updateOrder($id, $newData);
}
