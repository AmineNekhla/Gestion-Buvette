<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductFormModel extends Model
{
    protected $table = 'productsform';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'quantity', 'price'];
}
