<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\ProductModel;
use App\Models\OrderModel;


class CartController extends BaseController
{
    public function index()
    {
        // Check if the user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Vous devez être connecté pour voir votre panier.');
        }

        $clientId = session()->get('id');
        $cartModel = new CartModel();
        $productModel = new ProductModel();

        // Retrieve the user's cart items
        $cartItems = $cartModel->where('client_id', $clientId)->findAll();

        // Retrieve each product's information and calculate the total price
        $products = [];
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $product = $productModel->find($item['product_id']);
            if ($product) {
                // Adjust product price based on quantity in the cart
                $adjustedPrice = $product['price'] * $item['quantity'];
                $product['quantity'] = $item['quantity'];
                $product['price'] = $adjustedPrice;

                $totalPrice += $adjustedPrice;
                $products[] = $product;
            }
        }

        // Render the view with totalPrice and products
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
    
        $clientId = session()->get('id'); // Get the logged-in user's ID
        $cartModel = new CartModel();
        $productModel = new ProductModel();
    
        $product = $productModel->find($productId);
        if (!$product) {
            return redirect()->to('/products')->with('error', 'Produit introuvable.');
        }
    
        // Check if the product is already in the cart
        $cartItem = $cartModel->where(['client_id' => $clientId, 'product_id' => $productId])->first();
    
        if ($cartItem) {
            // If the product is already in the cart, increase the quantity
            $cartItem['quantity'] += 1; // Increment quantity by 1
            $cartModel->update($cartItem['id'], $cartItem); // Update the existing cart item
        } else {
            // If not, create a new cart item
            $data = [
                'client_id' => $clientId,
                'product_id' => $productId,
                'quantity' => 1, // Initialize quantity to 1
            ];
            $cartModel->insert($data); // Insert the new cart item
        }
    
        return redirect()->to('/products')->with('success', 'Produit ajouté au panier avec succès.');
    }


    public function order()
{
    // Vérifier si l'utilisateur est connecté
    if (!session()->get('isLoggedIn')) {
        return redirect()->to('/login')->with('error', 'Vous devez être connecté pour passer une commande.');
    }

    $clientId = session()->get('id');
    $cartModel = new CartModel();
    $productModel = new ProductModel();

    // Récupérer les produits du panier
    $cartItems = $cartModel->where('client_id', $clientId)->findAll();

    // Récupérer les informations de chaque produit
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

    // Rendre la vue avec les produits et le prix total
    return $this->render('cart/order', [
        'products' => $products,
        'totalPrice' => $totalPrice,
    ]);
}




}