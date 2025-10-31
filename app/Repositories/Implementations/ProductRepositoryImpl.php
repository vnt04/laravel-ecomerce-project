<?php
namespace App\Repositories\Implementations;

use App\Models\Product;
use App\Repositories\IProductRepository;

class ProductRepositoryImpl implements IProductRepository {
    public function getAllProducts() {
        return Product::all();
    }

    public function createProduct(array $data) {
        return Product::create($data);
    }

    public function isExist($id) {
        return Product::where('id',$id)->exists();
    }

    public function getProductById($id) {
        return Product::find($id);
    }

    public function updateProduct($id, array $updateData) {
        return Product::where('id', $id)->update($updateData);
    }

    public function deleteProduct($id) {
        return Product::destroy($id);
    }

    public function getProductStockById($id) {
        return Product::where('id', $id)->value('stock');
    }

}
