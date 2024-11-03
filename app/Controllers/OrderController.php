<?php

namespace App\Controllers;

use App\Models\OrderModel;

class OrderController extends BaseController
{
    public function order(){
        $session = session();
        $orderModel = new OrderModel();

        if ($this->request->getMethod() === 'post') {
            $clientName = $session->get('username'); 

            $products = $session->get('cart'); 
            $totalPrice = $this->calculateTotalPrice($products); 

            $deliveryTime = $this->request->getPost('delivery_time');

            if ($products && $clientName) {
                $productDetails = json_encode($products);

                $data = [
                    'client_name' => $clientName,
                    'products' => $productDetails,
                    'total_price' => $totalPrice,
                    'delivery_time' => $deliveryTime
                ];

                if ($orderModel->insert($data)) {
                    $session->setFlashdata('success_message', 'Commande envoyée avec succès.');
                    return redirect()->to('/cart/order');
                } else {
                    $session->setFlashdata('error_message', 'Une erreur est survenue lors de l\'envoi de la commande.');
                    return redirect()->to('/cart/order');
                }
            } else {
                $session->setFlashdata('error_message', 'Aucun produit ou utilisateur non authentifié.');
                return redirect()->to('/cart/order');
            }
        }

        $data['products'] = $session->get('cart'); 
        $data['totalPrice'] = $this->calculateTotalPrice($data['products']); 

        return view('cart/order', $data);
    }

    private function calculateTotalPrice($products)
    {
        $total = 0;
        if (!empty($products)) {
            foreach ($products as $product) {
                $total += $product['price'] * $product['quantity'];
            }
        }
        return $total;
    }
}