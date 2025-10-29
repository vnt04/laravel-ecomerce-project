<?php
namespace App\Repositories;


interface ProductRepositoryInterface {
    function getAllProduct();
    function createProduct(array $data);
}