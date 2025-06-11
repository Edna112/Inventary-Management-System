<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{
	    // Define the methods that the ProductRepository should implement
    public function getAllProducts();
    public function getProductById($id);
    public function createProduct(array $data);
    public function updateProduct($id, array $data);
    public function deleteProduct($id);
    public function searchProducts($query);
}

