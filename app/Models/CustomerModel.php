<?php
namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'address', 'contact_number'];
    
    protected $validationRules = [
        'name' => 'required|min_length[3]',
        'email' => 'required|valid_email',
        'address' => 'required',
        'contact_number' => 'required|min_length[10]|max_length[15]'
    ];
}
