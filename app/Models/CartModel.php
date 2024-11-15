<?php
// app/Models/CartModel.php
namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'cart';
    protected $allowedFields = ['customer_id', 'product_id', 'quantity'];

    // Add or update product in cart
    public function addToCart($customerId, $productId, $quantity)
    {
        $existingItem = $this->where('customer_id', $customerId)
                             ->where('product_id', $productId)
                             ->first();

        if ($existingItem) {
            // Update quantity if the item already exists in the cart
            return $this->update($existingItem['id'], [
                'quantity' => $existingItem['quantity'] + $quantity,
            ]);
        } else {
            // Insert new item if it doesn't exist in the cart
            return $this->insert([
                'customer_id' => $customerId,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }
    }

    // Get all cart items for a specific customer
    public function getCartItems($customerId)
    {
        return $this->where('customer_id', $customerId)
                    ->join('products', 'products.id = cart.product_id')
                    ->select('cart.*, products.name, products.price')
                    ->findAll();
    }

    // Remove item from cart
    public function removeItem($customerId, $productId)
    {
        return $this->where('customer_id', $customerId)
                    ->where('product_id', $productId)
                    ->delete();
    }

    // Clear all items from cart for a specific customer
    public function clearCart($customerId)
    {
        return $this->where('customer_id', $customerId)->delete();
    }
}
