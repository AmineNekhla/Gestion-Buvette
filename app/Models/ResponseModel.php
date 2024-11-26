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
        $responseModel = $this->db->table('user_responses');
        $responses = $responseModel->select('user_responses.validation_id, user_responses.response, user_responses.created_at, o.product_ids')
                                    ->join('orders o', 'user_responses.validation_id = o.id', 'left')
                                    ->where('user_responses.user_id', $userId)
                                    ->orderBy('user_responses.created_at', 'DESC')
                                    ->get()
                                    ->getResultArray();
    
        $productModel = new \App\Models\ProductModel();
    
        foreach ($responses as &$response) {
            $productIds = [];
            // Handle product_ids format (JSON or comma-separated)
            if (strpos($response['product_ids'], '[') !== false) {
                $productIds = json_decode($response['product_ids']);
            } else {
                $productIds = explode(',', $response['product_ids']);
            }
    
            // Fetch product names
            $productNames = [];
            foreach ($productIds as $productId) {
                $product = $productModel->find($productId);
                if ($product) {
                    $productNames[] = $product['name'];
                }
            }
    
            // Add product names to the response
            $response['product_names'] = empty($productNames) ? 'No products found' : implode(', ', $productNames);
        }
    
        return $responses;
    }
    
    
}
