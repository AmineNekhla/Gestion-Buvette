<?php

namespace App\Models;

use CodeIgniter\Model;

class ResponseModel extends Model
{
    protected $table = 'user_responses'; // Your table name
    protected $primaryKey = 'id';
    protected $allowedFields = ['validation_id', 'user_id', 'response', 'created_at'];

    public function getResponsesWithProductName($userId)
    {
        return $this->select('user_responses.validation_id, user_responses.response, user_responses.created_at, products.name AS product_name')
                    ->join('products', 'user_responses.validation_id = products.id', 'left')
                    ->where('user_responses.user_id', $userId)
                    ->orderBy('user_responses.created_at', 'DESC') // Optional: Order by the most recent response
                    ->findAll();
    }
    
}
