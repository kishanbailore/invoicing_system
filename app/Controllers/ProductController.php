<?php
namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;

class ProductController extends BaseController
{
    protected $productModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $products = $this->productModel->findAll();
        $category = $this->categoryModel->findAll();
        return view('products/index', ['products' => $products, 'categories'=>$category]);
    }

    public function create()
    {
        $category = $this->categoryModel->findAll();
        return view('products/form', ['categories'=>$category]);
    }

    public function store()
    {
        $data = $this->request->getPost();

        if (!$this->validate($this->productModel->validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->productModel->insert($data);
        return redirect()->to('/products/index');
    }

    public function edit($id)
    {
        $product = $this->productModel->find($id);
        $category = $this->categoryModel->findAll();
        return view('products/form', ['product' => $product,'categories'=>$category]);
    }

    public function update($id)
    {
        $data = $this->request->getPost();

        if (!$this->validate($this->productModel->validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->productModel->update($id, $data);
        return redirect()->to('/products/index');
    }

    public function delete($id)
    {
        $this->productModel->delete($id);
        return redirect()->to('/products/index');
    }
}
