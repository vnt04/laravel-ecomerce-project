<?php
namespace App\Services;

interface IOrderService {
    function getAllOrders();
    function getById($id);
    function create(array $newOrder);
    function updateStatusOrder($id, $from, $to);
    function updateOrder($id, array $newData);
}

