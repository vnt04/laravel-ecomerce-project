<?php
namespace App\Repositories;

interface ProductRepository {
    public function getAllProduct();
    public function createProduct(array $data);
}