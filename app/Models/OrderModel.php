<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders'; 
    protected $primaryKey = 'id'; 

    protected $allowedFields = [
        'user_id',       
        'product_ids',  
        'total_price',  
        'order_date'    
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
