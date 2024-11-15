<?php
namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\CategoryModel;

class CustomerController extends BaseController
{
    protected $customerModel;
    
    
    public function __construct()
    {
        $this->customerModel = new CustomerModel();
    }

    public function index()
    {
        $customers = $this->customerModel->findAll();
        return view('customers/index', ['customers' => $customers]);
    }

    public function create()
    {
        return view('customers/form');
    }

    public function store()
    {
        $data = $this->request->getPost();

        if (!$this->validate($this->customerModel->validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->customerModel->insert($data);
        return redirect()->to('/customers/index');
    }

    public function edit($id)
    {
        $customer = $this->customerModel->find($id);
        return view('customers/form', ['customer' => $customer]);
    }

    public function update($id)
    {
        $data = $this->request->getPost();

        if (!$this->validate($this->customerModel->validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->customerModel->update($id, $data);
        return redirect()->to('/customers/index');
    }

    public function delete($id)
    {
        $this->customerModel->delete($id);
        return redirect()->to('/customers/index');
    }
}
