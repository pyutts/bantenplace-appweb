<?php

namespace App\Controllers;

use App\Models\ProductsModel;
use App\Models\CategoryModel;

class ShopController extends BaseController
{
    protected $productModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->productModel = new ProductsModel();
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $search = $this->request->getGet('search');
        $categoryId = $this->request->getGet('category');
        $sortOrder = $this->request->getGet('sort') ?? 'asc';
        $perPage = 12;

        $productQuery = $this->productModel;
        
        if ($categoryId) {
            $productQuery->where('category_id', $categoryId);
        }
        
        // Search products
        if ($search) {
            $search = trim($search);
            $productQuery->groupStart()
                        ->like('name_products', $search)
                        ->orLike('description', $search)
                        ->groupEnd();
        }

        // Filter dan sort lainnya tetap sama
        if ($categoryId) {
            $productQuery->where('category_id', $categoryId);
        }

        if ($sortOrder == 'asc') {
            $productQuery->orderBy('price', 'ASC');
        } else if ($sortOrder == 'desc') {
            $productQuery->orderBy('price', 'DESC');
        }

        $data = [
            'products' => $productQuery->paginate($perPage),
            'pager' => $productQuery->pager,
            'categories' => $this->categoryModel->findAll(),
            'currentCategory' => $categoryId,
            'currentSort' => $sortOrder,
            'searchTerm' => $search
        ];

        return view('homepages/shop', $data);
    }

    public function detail($id)
    {
        $product = $this->productModel->find($id);
        
        if (!$product) {
            return redirect()->to('/shop')->with('error', 'Produk tidak ditemukan');
        }

        return view('homepages/product_detail', [
            'product' => $product
        ]);
    }
}