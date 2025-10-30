<?php
namespace App\Services\Implementations;

use App\Repositories\IProductRepository;
use App\Services\IProductService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductServiceImpl implements IProductService {
    protected IProductRepository $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts()
    {
        return $this->productRepository->getAllProducts();
    }

    public function createProduct(array $newProductData) {
        return $this->productRepository->createProduct($newProductData);
    }

    public function getProductById($id) {
        return $this->productRepository->getProductById($id);
    }

    public function updateProduct($id, array $updateData) {
        if(!$this->productRepository->isExist($id)) {
            throw new NotFoundHttpException("Product with ID {$id} not found.");
        }
        return $this->productRepository->updateProduct($id, $updateData);
    }

    public function deleteProduct($id) {
        if(!$this->productRepository->isExist($id)) {
            throw new NotFoundHttpException("Product with ID {$id} not found.");
        }
        return $this->productRepository->deleteProduct($id);
    }
}
