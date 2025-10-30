<?php
namespace App\Services;

interface IProductService {
    function getAllProducts();
    function createProduct(array $newProductData);
    function getProductById($id);
    function updateProduct($id, array $updateData);
    function deleteProduct($id);
}
