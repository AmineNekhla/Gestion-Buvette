<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\ValidationModel;
use App\Models\ResponseModel;

class OrderController extends BaseController
{
    public function manageOrders()
{
    $orderModel = new OrderModel();
    $userModel = new UserModel();
    $productModel = new ProductModel();

    $orders = $orderModel->findAll();

    foreach ($orders as &$order) {
        $user = $userModel->find($order['user_id']);
        $order['username'] = $user['username'] ?? 'Inconnu';

        $productIds = json_decode($order['product_ids'], true);
        $order['products'] = [];

        if (is_array($productIds)) {
            foreach ($productIds as $productId) {
                $product = $productModel->find($productId);
                if ($product) {
                    $order['products'][] = $product['name'];
                } else {
                    $order['products'][] = 'Produit introuvable';
                }
            }
        } else {
            $order['products'][] = 'Aucun produit';
        }
    }

    return view('orders/manage', ['orders' => $orders]);
}

public function updateStatus()
    {
        $orderId = $this->request->getJSON()->id ?? null;
        $status = $this->request->getJSON()->status ?? null;

        if ($orderId && $status) {
            $orderModel = new OrderModel();
            $responseModel = new ResponseModel();

            // Find the order by ID
            $order = $orderModel->find($orderId);
            if ($order) {
                // Update the order status
                $orderModel->update($orderId, ['status' => $status]);

                // Insert response into the `user_responses` table
                $responseData = [
                    'validation_id' => $orderId,
                    'user_id' => $order['user_id'],
                    'response' => ($status === 'validated') ? 'Commande validée' : 'Commande annulée',
                    'created_at' => date('Y-m-d H:i:s'),
                ];
                $responseModel->insert($responseData);

                return $this->response->setJSON(['success' => true]);
            }

            return $this->response->setJSON(['success' => false, 'error' => 'Order not found.']);
        }

        return $this->response->setJSON(['success' => false, 'error' => 'Invalid data provided.']);
    }

    public function validateO($orderId)
    {
        $orderModel = new OrderModel();
        $userModel = new UserModel();
        $productModel = new ProductModel();

        $order = $orderModel->find($orderId);

        if (!$order) {
            return redirect()->to('/orders/manage')->with('error', 'Commande introuvable.');
        }

        $user = $userModel->find($order['user_id']);

        // Decode `product_ids` JSON
        $productIds = json_decode($order['product_ids'], true);
        $products = [];

        if (is_array($productIds)) {
            foreach ($productIds as $productId) {
                $product = $productModel->find($productId);
                if ($product) {
                    $products[] = $product['name'];
                }
            }
        }

        return view('orders/validate_order', [
            'order' => $order,
            'user' => $user,
            'products' => $products, // List of product names
        ]);
    }

    public function saveValidation()
    {
        $validationModel = new ValidationModel();
        $responseModel = new ResponseModel();
        $orderModel = new OrderModel(); // Add this to update the order status
    
        // Retrieve form data
        $data = [
            'user_id' => $this->request->getPost('user_id'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'products' => $this->request->getPost('products'),
            'total_price' => $this->request->getPost('total_price'),
            'description' => $this->request->getPost('description'),
        ];
    
        // Save data to the validation table
        $validationId = $validationModel->insert($data);
    
        if ($validationId) {
            // Update the order status to "pending"
            $orderId = $this->request->getPost('order_id');
            $orderModel->update($orderId, ['status' => 'pending']);
    
            // Save response data to the user_responses table
            $responseData = [
                'validation_id' => $validationId,
                'user_id' => $data['user_id'],
                'response' => $data['description'],
                'created_at' => date('Y-m-d H:i:s'),
            ];
    
            $responseModel->insert($responseData);
    
            return redirect()->to('/orders/manage')->with('success', 'Commande validée et mise en attente avec succès!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Erreur lors de l\'enregistrement de la commande.');
        }
    }
    
}
