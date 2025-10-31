<?php
namespace App\Repositories;


interface IProductRepository {
    function getAllProducts();
    function createProduct(array $data);
    function getProductById($id);
    function isExist($id);
    function updateProduct($id, array $updateData);
    function deleteProduct($id);
    function getProductStockById($id);
}
