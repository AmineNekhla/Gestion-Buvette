<?php

namespace App\Controllers;

use App\Models\ResponseModel;


class ResponseController extends BaseController
{
    public function index()
    {
        $session = session();
        $currentUserId = $session->get('id'); // Fetch logged-in user's ID
    
        if (!$currentUserId) {
            return redirect()->to('/login')->with('error', 'Please log in to view your responses.');
        }
    
        $responseModel = new ResponseModel();
        $responses = $responseModel->getResponsesWithProductName($currentUserId);

        // Automatically passes 'itemCount' via BaseController
        return $this->render('responses/index', ['responses' => $responses]);
    }
    
}
