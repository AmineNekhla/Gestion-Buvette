<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\ValidationModel;

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
    
            log_message('debug', 'Product IDs for order ' . $order['id'] . ': ' . print_r($productIds, true));
    
            if (is_array($productIds)) {
                foreach ($productIds as $productId) {
                    $product = $productModel->find($productId);
    
                    log_message('debug', 'Product found: ' . print_r($product, true));
    
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
        if ($validationModel->insert($data)) {
            return redirect()->to('/orders/manage')->with('success', 'Commande validée et enregistrée avec succès!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Erreur lors de l\'enregistrement de la commande.');
        }
    }
    }
