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
    
        // Fetch the cart items for the logged-in user
        $cartItems = $cartModel->where('client_id', $clientId)->findAll();
    
        // Calculate the number of items in the cart (for the navbar)
        $itemCount = count($cartItems);  // This will give the total number of cart items
    
        // Prepare product data and calculate the total price
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
    
        // Pass the cart item count, products, and total price to the view
        return $this->render('cart/index', [
            'products' => $products,
            'totalPrice' => $totalPrice,
            'itemCount' => $itemCount,  // Make sure to pass itemCount to the view
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

            // Ajouter l'ID du produit autant de fois que sa quantité
            for ($i = 0; $i < $item['quantity']; $i++) {
                $productIds[] = $item['product_id'];
            }
        }
    }

    // Convertir `product_ids` en JSON pour garder la structure de la liste avec quantités
    $orderData = [
        'user_id' => $clientId,
        'product_ids' => json_encode($productIds),  // Stocker en format JSON
        'total_price' => $totalPrice,
        'order_date' => date('Y-m-d H:i:s'),
    ];

    $orderModel->insert($orderData);

    // Vider le panier après validation de la commande
    $cartModel->where('client_id', $clientId)->delete();

    return redirect()->to('/cart')->with('success', 'Votre commande a été validée avec succès.');
}



public function remove($productId)
{
    if (!session()->get('isLoggedIn')) {
        return redirect()->to('/login')->with('error', 'Vous devez être connecté pour gérer votre panier.');
    }

    $clientId = session()->get('id');
    $cartModel = new CartModel();

    // Supprimer le produit spécifique du panier
    $cartModel->where(['client_id' => $clientId, 'product_id' => $productId])->delete();

    return redirect()->to('/cart')->with('success', 'Produit supprimé du panier avec succès.');
}


}
