<?php
namespace App\Controllers;

use App\Models\CartModel;
use App\Models\ProductModel;

class CartController extends BaseController
{

    public function index()
    {
    

    // Vérifiez si l'utilisateur est connecté
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Vous devez être connecté pour voir votre panier.');
        }

        $clientId = session()->get('id');
        
        $cartModel = new CartModel();
        $productModel = new ProductModel();

        // Récupérez les éléments du panier de l'utilisateur
        $cartItems = $cartModel->where('client_id', $clientId)->findAll();

        // Récupérez les informations de chaque produit
        $products = [];
        foreach ($cartItems as $item) {
            $product = $productModel->find($item['product_id']);
            if ($product) {
                $product['quantity'] = $item['quantity'];
                $products[] = $product;
            }
        }

        return view('cart/index', ['products' => $products]);
    }

    public function add($productId)
    {
        // Vérifiez si l'utilisateur est connecté
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Vous devez être connecté pour ajouter au panier.');
        }

        $cartModel = new CartModel();

        // Récupérez l'ID du client depuis la session
        $clientId = session()->get('id');

        // Vérifiez si le produit est déjà dans le panier
        $cartItem = $cartModel->where('product_id', $productId)->where('client_id', $clientId)->first();
        
        if ($cartItem) {
            // Si le produit est déjà dans le panier, augmentez la quantité
            $cartModel->update($cartItem['id'], ['quantity' => $cartItem['quantity'] + 1]);
        } else {
            // Si le produit n'est pas encore dans le panier, ajoutez-le
            $cartModel->save([
                'product_id' => $productId,
                'client_id' => $clientId,
                'quantity' => 1
            ]);
        }

        return redirect()->to('/products')->with('success', 'Produit ajouté au panier.');
    }
}
