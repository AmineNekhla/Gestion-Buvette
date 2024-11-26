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
        // Fetch all responses for the user
        $responses = $this->select('user_responses.validation_id, user_responses.response, user_responses.created_at, o.product_ids')
                          ->join('orders o', 'user_responses.validation_id = o.id', 'left')
                          ->where('user_responses.user_id', $userId)
                          ->orderBy('user_responses.created_at', 'DESC')
                          ->findAll();
    
        // Process each response
        foreach ($responses as &$response) {
            $productIds = [];
    
            // Check if product_ids are in JSON format or a comma-separated string
            if (strpos($response['product_ids'], '[') !== false) {
                // It's a JSON array
                $productIds = json_decode($response['product_ids'], true);
            } else {
                // It's a comma-separated string
                $productIds = explode(',', $response['product_ids']);
            }
    
            // Clean and validate product IDs
            $productIds = array_filter($productIds, function ($id) {
                return is_numeric($id);
            });
    
            // Fetch product names based on IDs
            if (!empty($productIds)) {
                $productModel = new \App\Models\ProductModel();
                $products = $productModel->whereIn('id', $productIds)->findAll();
                $productNames = array_column($products, 'name');
                $response['product_names'] = implode(', ', $productNames);
            } else {
                $response['product_names'] = 'No products found';
            }
        }
    
        return $responses;
    }
    
    
}
