<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Classes\ProductRepository;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        return $this->productRepository->getAllProducts();
    }

    public function show($id)
    {
        return $this->productRepository->getProductById($id);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        return $this->productRepository->createProduct($data);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric',
        ]);

        return $this->productRepository->updateProduct($id, $data);
    }

    public function destroy($id)
    {
        return $this->productRepository->deleteProduct($id);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        return $this->productRepository->searchProducts($query);
    }
}