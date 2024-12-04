<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\OrderModel;
use App\Models\ResponseModel;
use App\Models\ProductModel;
use App\Models\UserModel;

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
            // Decode JSON array
            $productIds = json_decode($order['product_ids']);
        } else {
            // Split comma-separated string
            $productIds = explode(',', $order['product_ids']);
        }

        // Fetch products and maintain duplicates
        $productNames = [];
        foreach ($productIds as $productId) {
            $product = $productModel->find($productId);
            if ($product) {
                $productNames[] = $product['name']; // Add product name (duplicates included)
            }
        }

        // Join product names into a string
        $order['product_names'] = empty($productNames) ? 'No products found' : implode(', ', $productNames);
    }

    return $this->render('orders/manage', ['orders' => $orders]);
}

    public function downloadReceipt($orderId)
    {
        $orderModel = new OrderModel();
        $productModel = new ProductModel();

        // Fetch order details
        $order = $orderModel->find($orderId);

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        // Decode product IDs
        $productIds = strpos($order['product_ids'], '[') !== false
            ? json_decode($order['product_ids'])
            : explode(',', $order['product_ids']);

        // Fetch product names
        $products = $productModel->whereIn('id', $productIds)->findAll();
        $productNames = implode(', ', array_column($products, 'name'));

        // Generate receipt content
        $html = "
            <h1>Reçu de Commande</h1>
            <p><strong>ID Commande:</strong> {$order['id']}</p>
            <p><strong>Produits:</strong> {$productNames}</p>
            <p><strong>Prix Total:</strong> {$order['total_price']} €</p>
            <p><strong>Status:</strong> {$order['status']}</p>
            <p><strong>Date:</strong> {$order['created_at']}</p>
            <p><strong>Thanks for visiting us, Enjoy your order.</strong></p>
        ";

        // Create a new Dompdf instance
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);

        // Load the HTML content
        $dompdf->loadHtml($html);

        // Render the PDF
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output the PDF for download
        $dompdf->stream("reçu_commande_{$orderId}.pdf", ["Attachment" => true]);
    }
}
