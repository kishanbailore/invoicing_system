<?php

namespace App\Controllers;

use App\Models\InvoiceModel;
use App\Models\InvoiceItemModel;
use App\Models\CartModel;
use App\Models\CustomerModel;
use App\Models\ProductModel;

class InvoiceController extends BaseController
{
    protected $invoiceModel;
    protected $invoiceItemModel;
    protected $cartModel;
    protected $productModel;
    protected $customerModel;

    public function __construct()
    {
        $this->invoiceModel = new InvoiceModel();
        $this->invoiceItemModel = new InvoiceItemModel();
        $this->cartModel = new CartModel();
        $this->productModel = new ProductModel();
        $this->customerModel = new CustomerModel();
    }

    public function index()
    {
        // Fetch all invoices
        $invoices = $this->invoiceModel->select('invoices.*, customers.name AS customer_name')->join('customers', 'customers.id = invoices.customer_id')->findAll();
        // Load the view
        return view('invoice/index', ['invoices' => $invoices]);
    }


    // Display Invoice Creation Form
    public function create($customer_id)
    {
        $customer = $this->customerModel->find($customer_id);
        $cartItems = $this->cartModel->where('customer_id', $customer_id)->findAll();
        
        // Retrieve the necessary data for the invoice calculation
        $totalAmount = 0;
        foreach ($cartItems as &$item) {
            $product = $this->productModel->find($item['product_id']);
            $item['product_name'] = $product['name'];
            $item['price'] = $product['price'];
            $item['total_price'] = $item['price'] * $item['quantity'];
            $totalAmount += $item['total_price'];
        }
        
        // Calculate total after discount and taxes
        $discount = $this->request->getPost('discount') ?? 0;
        $tax = $this->request->getPost('tax') ?? 0;
        $finalAmount = $totalAmount - $discount + $tax;

       
        return view('invoice/create', ['customer' => $customer,'cartItems' => $cartItems,'totalAmount' => $totalAmount,'finalAmount' => $finalAmount,'discount' => $discount,'tax' => $tax]);
    }

    // Process the invoice and save it to the database
    public function store()
    {

        $invoiceData = [
            'customer_id' => $this->request->getPost('customer_id'),
            'total_amount' => $this->request->getPost('total_amount'),
            'discount' => number_format($this->request->getPost('discount'),2),
            'tax' => number_format($this->request->getPost('tax'),2),
            'final_amount' => $this->request->getPost('total_amount') - $this->request->getPost('discount') + $this->request->getPost('tax'),
            'payment_method' => $this->request->getPost('payment_method'),
            'created_at' => date('Y-m-d H:i:s')
        ];
       print_r($invoiceData);
                // Insert invoice into the database
        $invoiceId = $this->invoiceModel->insert($invoiceData);
        
        // Insert invoice items
        $cartItems = $this->cartModel->where('customer_id', $invoiceData['customer_id'])->findAll();
        
        foreach ($cartItems as $item) {
            $product = $this->productModel->find($item['product_id']);
            $total = $product['price'] * $item['quantity'];
            $this->invoiceItemModel->insert([
                'invoice_id' => $invoiceId,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $product['price'],
                'total' =>  $total
            ]);
        }
       

        // Clear cart after generating the invoice
        $this->cartModel->where('customer_id', $invoiceData['customer_id'])->delete();

        return redirect()->to('/invoice/view/' . $invoiceId);
    }

    // View the generated invoice
    public function view($invoiceId)
    {
        $invoice = $this->invoiceModel->find($invoiceId);
        // Fetch invoice items with product details
        $invoiceItems = $this->invoiceItemModel->select('invoice_items.*, products.name AS product_name, products.price AS product_price')->join('products', 'products.id = invoice_items.product_id')->where('invoice_items.invoice_id', $invoiceId)->findAll();
        $customer = $this->customerModel->find($invoice['customer_id']);
        return view('invoice/view', ['invoice' => $invoice,'invoiceItems' => $invoiceItems,'customer' => $customer ]);
    }
}
