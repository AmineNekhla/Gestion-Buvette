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
        $orderModel = new OrderModel();

        // Fetch all orders
        $orders = $orderModel->findAll();

        return view('orders/manage', ['orders' => $orders]);
    }
}
