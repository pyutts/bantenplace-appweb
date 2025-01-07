<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductsModel;
use App\Models\CategoryModel;

class ShopController extends BaseController
{
    protected $productsModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->productsModel = new ProductsModel();
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $hash = $this->request->getGet('hash');
        parse_str($hash, $params);

        $categoryId = $params['category'] ?? null;
        $searchTerm = $params['xptdk'] ?? null;
        $sortOrder = $this->request->getGet('sort_order') ?? 'asc';
        
        $perPage = 9;

        $products = $this->productsModel->select('products.*, categories.name as category_name')
                                        ->join('categories', 'categories.id = products.category_id', 'left');
        
        if ($categoryId) {
            $products->where('category_id', $categoryId);
        }

        if ($searchTerm) {
            $products->like('products.name_products', $searchTerm)
                     ->orLike('products.description', $searchTerm);
        }
        
        $products = $products->orderBy('price', $sortOrder)
                            ->paginate($perPage);

        $categories = $this->categoryModel->findAll();

        return view('homepages/shop', [
            'products' => $products,
            'categories' => $categories,
            'pager' => $this->productsModel->pager,
            'sortOrder' => $sortOrder,
            'searchTerm' => $searchTerm,
            'categoryId' => $categoryId
        ]);
    }
}