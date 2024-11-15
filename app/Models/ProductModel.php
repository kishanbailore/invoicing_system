<?php
namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'price', 'quantity', 'category_id'];
    
    protected $validationRules = [
        'name' => 'required|min_length[3]',
        'description' => 'required',
        'price' => 'required|decimal|greater_than_equal_to[0]',
        'quantity' => 'required|integer|greater_than_equal_to[0]',
        'category_id' => 'required|integer',
    ];
}
