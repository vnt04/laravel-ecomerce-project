<?php
namespace App\Repositories;


interface IProductRepository {
    function getAllProducts();
    function createProduct(array $data);
}
