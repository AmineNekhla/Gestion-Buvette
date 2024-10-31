<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\CartModel;

abstract class BaseController extends Controller
{
    protected $request;
    protected $helpers = [];
    protected $cartModel;
    protected $viewData = []; // Initialize viewData to hold shared data

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload the cart model
        $this->cartModel = new CartModel();

        // Set cart item count as a shared variable
        $this->setSharedVariables();
    }

    protected function setSharedVariables()
    {
        if (session()->get('isLoggedIn')) {
            $clientId = session()->get('id');
    
            // Get all cart items for the client
            $cartItems = $this->cartModel->where('client_id', $clientId)->findAll();
            $itemCount = 0;
    
            // Sum the quantities for all items
            foreach ($cartItems as $item) {
                $itemCount += $item['quantity'];
            }
    
            $this->viewData['itemCount'] = $itemCount; // Set item count
        } else {
            $this->viewData['itemCount'] = 0; // Default to 0 if not logged in
        }
    }
    

    protected function render($view, $data = [])
    {
        // Merge the shared data with the view-specific data
        $data = array_merge($this->viewData, $data);
        return view($view, $data);
    }
}
