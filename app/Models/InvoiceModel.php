<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
    protected $table = 'invoices';
    protected $primaryKey = 'id';
    protected $allowedFields = ['customer_id', 'total_amount', 'discount', 'tax', 'final_amount', 'payment_method', 'created_at'];
}
