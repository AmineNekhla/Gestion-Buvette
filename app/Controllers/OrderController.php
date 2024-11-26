<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\ResponseModel;

class OrderController extends BaseController
{
    public function updateStatus()
    {
        $requestData = $this->request->getJSON();
        $orderId = $requestData->id ?? null;
        $status = $requestData->status ?? null;
        $reason = $requestData->reason ?? null;

        if ($orderId && $status) {
            $orderModel = new OrderModel();
            $responseModel = new ResponseModel();

            // Find the order by ID
            $order = $orderModel->find($orderId);
            if ($order) {
                // Update the order status
                $orderModel->update($orderId, ['status' => $status]);

                // Insert response into the `user_responses` table
                $responseText = ($status === 'validated') ? 'Commande validée' : 'Commande refusée - Raison: ' . $reason;
                $responseData = [
                    'validation_id' => $orderId,
                    'user_id' => $order['user_id'],
                    'response' => $responseText,
                    'created_at' => date('Y-m-d H:i:s'),
                ];
                $responseModel->insert($responseData);

                return $this->response->setJSON(['success' => true]);
            }

            return $this->response->setJSON(['success' => false, 'error' => 'Order not found.']);
        }

        return $this->response->setJSON(['success' => false, 'error' => 'Invalid data provided.']);
    }

    public function manageOrders()
{
    $orderModel = new \App\Models\OrderModel();
    $productModel = new \App\Models\ProductModel();
    $userModel = new \App\Models\UserModel();

    // Fetch all orders
    $orders = $orderModel->findAll();

    foreach ($orders as &$order) {
        // Fetch user name
        $user = $userModel->find($order['user_id']);
        $order['user_name'] = $user['username'] ?? 'Unknown User';

        // Handle product_ids format
        $productIds = [];

        // Check if the product_ids are in JSON format (e.g. '["1"]')
        if (strpos($order['product_ids'], '[') !== false) {
            // It's a JSON array
            $productIds = json_decode($order['product_ids']);
        } else {
            // It's a comma-separated string
            $productIds = explode(',', $order['product_ids']);
        }

        // Fetch products based on product IDs
        $products = $productModel->whereIn('id', $productIds)->findAll();

        // If products are found, extract names
        if (empty($products)) {
            $order['product_names'] = 'No products found';
        } else {
            $productNames = array_column($products, 'name'); // Extract product names
            $order['product_names'] = implode(', ', $productNames); // Convert to comma-separated string
        }
    }

    return view('orders/manage', ['orders' => $orders]);
    }

}
