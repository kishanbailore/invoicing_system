<?php
// app/Controllers/CartController.php
namespace App\Controllers;

use App\Models\CartModel;
use App\Models\CustomerModel;
use App\Models\ProductModel;

class CartController extends BaseController
{
    protected $productModel;
    protected $cartModel;
    protected $customerModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->cartModel = new CartModel();
        $this->customerModel = new CustomerModel();
    }
    public function add($productId)
    {
        $product = $this->productModel->find($productId);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }
        return view('cart/add', ['product' => $product]);
    }

    public function index()
    {
        // Fetch all customers who have products in their cart
        $customersWithCart = $this->cartModel->select('customer_id')->groupBy('customer_id')->findAll();
       
        $customers = [];
        foreach ($customersWithCart as $cart) {
            $customers[] = $this->customerModel->find($cart['customer_id']);
        }

        // Load the view and pass customer data
        return view('cart/index', [
            'customers' => $customers
        ]);
       
    }

    public function addToCart()
    {
        // Load validation service
        $validation = \Config\Services::validation();


        // Define customer validation rules
        $validation->setRules([
            'name' => 'required|min_length[3]|max_length[255]',
            'email' => 'required|valid_email',
            'contact_number' => 'required|numeric|min_length[10]|max_length[15]',
            'address' => 'required',
            'product_id' => 'required|is_natural_no_zero', // Product ID must be valid
            'quantity' => 'required|is_natural_no_zero',   // Quantity must be valid
        ]);

        // Validate the customer and product form
        if (!$this->validate($validation->getRules())) {
            // Validation failed, return errors to the form
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $productId = $this->request->getPost('product_id');
        $quantity = $this->request->getPost('quantity');
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $address = $this->request->getPost('address');
        $contact_number = $this->request->getPost('contact_number');

        // Check product availability
        $product = $this->productModel->find($productId);
        if (!$product || $quantity > $product['quantity']) {
            return redirect()->back()->with('error', 'Not enough stock for this product.');
        }

        // Check if customer exists
        $customer = $this->customerModel->where('email', $email)->orWhere('contact_number', $contact_number)->first();
        if (!$customer) {
            $customerId = $this->customerModel->insert([
                'name' => $name,
                'email' => $email,
                'address' => $address,
                'contact_number' => $contact_number
            ]);
        } else {
            $customerId = $customer['id'];
        }

        // Deduct quantity from product
        $this->productModel->update($productId, ['quantity' => $product['quantity'] - $quantity]);

         // Add/update cart item
        $existingCartItem = $this->cartModel->where(['customer_id' => $customerId, 'product_id' => $productId])->first();
        if ($existingCartItem) {
             $newQuantity = $existingCartItem['quantity'] + $quantity;
             $this->cartModel->update($existingCartItem['id'], ['quantity' => $newQuantity]);
        } else {
            $this->cartModel->insert([
                'customer_id' => $customerId,
                'product_id' => $productId,
                'quantity' => $quantity
            ]);
        }
        return redirect()->to("/cart/view/$customerId")->with('message', 'Product added to cart.');
    }

    protected function calculateTotal($customer_id)
    {
        
        $cartItems = $this->cartModel->where('customer_id', $customer_id)->findAll();
        $total = 0;
        
        foreach ($cartItems as $item) {
            // Fetch product details based on product_id
            $product = $this->productModel->find($item['product_id']);
            
            if (isset($product) ) {
                // Calculate item total (price * quantity)
                $itemTotal = $product['price'] * $item['quantity'];
                $total += $itemTotal;
                
            } else {
                
                // Optionally log an error or handle missing products
                log_message('error', 'Product not found for ID: ' . $item['product_id']);
            }
        }
        return $total;
    }

    public function view($customerId)
    {
        // Retrieve cart items associated with the customer
        $cartItems = $this->cartModel->where('customer_id', $customerId)->findAll();
        $cartWithProductDetails = [];

        foreach ($cartItems as $item) {
            // Fetch product details based on product_id
            $product = $this->productModel->find($item['product_id']);
    
            if ($product) {
                // Merge product details with the cart item
                $cartWithProductDetails[] = array_merge($item, [
                    'product_name' => $product['name'],
                    'price' => $product['price']
                ]);
            }
        }
        // Retrieve customer information
        $customer = $this->customerModel->find($customerId);
        
        // Calculate the total amount
        $totalAmount = $this->calculateTotal($customerId);
        
        // Pass cart items and customer data to the view
       // echo "<pre>"; print_r($cartItems); print_r($customer); print_r($totalAmount); die;
        return view('/cart/view', ['cartItems' => $cartWithProductDetails, 'customer' => $customer, 'totalAmount' => $totalAmount]);
    }

    public function remove($productId)
    {
        $customerId = $this->request->getPost('customer_id');
        $this->cartModel->removeItem($customerId, $productId);
        return redirect()->to('/cart')->with('message', 'Product removed from cart.');
    }

    public function clear($customerId)
    {
        $this->cartModel->clearCart($customerId);
        return redirect()->to('/cart')->with('message', 'Cart cleared.');
    }
}
