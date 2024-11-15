<?php
namespace App\Controllers;

use App\Models\CategoryModel;

class CategoryController extends BaseController
{
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $categories = $this->categoryModel->findAll();
        return view('categories/index', ['categories' => $categories]);
    }

    public function create()
    {
        return view('categories/form');
    }

    public function store()
    {
        $data = $this->request->getPost();
       
        if (!$this->validate($this->categoryModel->validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $this->categoryModel->insert($data);
        
        return redirect()->to('/categories/index');
    }

    public function edit($id)
    {
        $category = $this->categoryModel->find($id);
        return view('categories/form', ['category' => $category]);
    }

    public function update($id)
    {
        $data = $this->request->getPost();

        if (!$this->validate($this->categoryModel->validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->categoryModel->update($id, $data);
        return redirect()->to('/categories/index');
    }

    public function delete($id)
    {
        $this->categoryModel->delete($id);
        return redirect()->to('/categories/index');
    }
}
