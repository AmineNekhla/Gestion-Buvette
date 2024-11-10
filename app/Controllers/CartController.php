<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\ProductModel;
use App\Models\OrderModel;

class CartController extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Vous devez être connecté pour voir votre panier.');
        }

        $clientId = session()->get('id');
        $cartModel = new CartModel();
        $productModel = new ProductModel();

        $cartItems = $cartModel->where('client_id', $clientId)->findAll();

        $products = [];
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $product = $productModel->find($item['product_id']);
            if ($product) {
                $adjustedPrice = $product['price'] * $item['quantity'];
                $product['quantity'] = $item['quantity'];
                $product['price'] = $adjustedPrice;

                $totalPrice += $adjustedPrice;
                $products[] = $product;
            }
        }

        return $this->render('cart/index', [
            'products' => $products,
            'totalPrice' => $totalPrice,
        ]);
    }

    public function add($productId)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Vous devez être connecté pour ajouter un produit au panier.');
        }
    
        $clientId = session()->get('id');
        $cartModel = new CartModel();
        $productModel = new ProductModel();
    
        $product = $productModel->find($productId);
        if (!$product) {
            return redirect()->to('/products')->with('error', 'Produit introuvable.');
        }
    
        $cartItem = $cartModel->where(['client_id' => $clientId, 'product_id' => $productId])->first();
    
        if ($cartItem) {
            $cartItem['quantity'] += 1;
            $cartModel->update($cartItem['id'], $cartItem);
        } else {
            $data = [
                'client_id' => $clientId,
                'product_id' => $productId,
                'quantity' => 1,
            ];
            $cartModel->insert($data);
        }
    
        return redirect()->to('/products')->with('success', 'Produit ajouté au panier avec succès.');
    }

    public function order()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Vous devez être connecté pour passer une commande.');
        }

        $clientId = session()->get('id');
        $cartModel = new CartModel();
        $productModel = new ProductModel();

        $cartItems = $cartModel->where('client_id', $clientId)->findAll();

        $products = [];
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $product = $productModel->find($item['product_id']);
            if ($product) {
                $adjustedPrice = $product['price'] * $item['quantity'];
                $product['quantity'] = $item['quantity'];
                $product['price'] = $adjustedPrice;

                $totalPrice += $adjustedPrice;
                $products[] = $product;
            }
        }

        return $this->render('cart/order', [
            'products' => $products,
            'totalPrice' => $totalPrice,
        ]);
    }

    public function validateorder()
    {
        $clientId = session()->get('id');
        if (!$clientId) {
            return redirect()->to('/login')->with('error', 'Vous devez être connecté pour valider une commande.');
        }

        $cartModel = new CartModel();
        $productModel = new ProductModel();
        $orderModel = new OrderModel();

        $cartItems = $cartModel->where('client_id', $clientId)->findAll();
        if (!$cartItems) {
            return redirect()->to('/cart')->with('error', 'Votre panier est vide.');
        }

        $totalPrice = 0;
        $productIds = [];
        foreach ($cartItems as $item) {
            $product = $productModel->find($item['product_id']);
            if ($product) {
                $totalPrice += $product['price'] * $item['quantity'];
                $productIds[] = $item['product_id'];
            }
        }

        $orderData = [
            'user_id' => $clientId,
            'product_ids' => implode(',', $productIds),
            'total_price' => $totalPrice,
            'order_date' => date('Y-m-d H:i:s'),
        ];

        $orderModel->insert($orderData);

        $cartModel->where('client_id', $clientId)->delete();

        return redirect()->to('/cart')->with('success', 'Votre commande a été validée avec succès.');
    }
}
