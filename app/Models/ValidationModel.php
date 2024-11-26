<?php

namespace App\Models;

use CodeIgniter\Model;

class ValidationModel extends Model
{
    protected $table = 'validation';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'products', 'total_price', 'status', 'description', 'created_at'];
}
