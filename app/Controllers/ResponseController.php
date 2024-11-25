<?php

namespace App\Controllers;

use App\Models\ValidationModel;
use App\Models\ResponseModel;

class ResponseController extends BaseController
{
    public function index()
    {
        $session = session();
        $currentUserId = $session->get('id'); // Use the correct session key for the logged-in user ID

        if (!$currentUserId) {
            return redirect()->to('/login')->with('error', 'Please log in to view responses.');
        }

        $responseModel = new ResponseModel();
        $responses = $responseModel->where('user_id', $currentUserId)->findAll();

        return view('responses/index', ['responses' => $responses]);
    }

    public function createResponse($validationId)
    {
        $responseModel = new ResponseModel();

        // Fetch validation entry
        $validationModel = new ValidationModel();
        $validation = $validationModel->find($validationId);

        if ($validation) {
            // Create a new response
            $responseModel->insert([
                'validation_id' => $validationId,
                'user_id' => $validation['user_id'],
                'response' => $validation['description']
            ]);

            return $this->response->setJSON(['message' => 'Response saved successfully!']);
        } else {
            return $this->response->setJSON(['error' => 'Validation record not found.']);
        }
    }
    public function migrateResponses()
{
    $validationModel = new ValidationModel();
    $responseModel = new ResponseModel();

    // Fetch all validation entries with a description
    $validations = $validationModel->where('description IS NOT NULL', null, false)->findAll();

    foreach ($validations as $validation) {
        $responseModel->insert([
            'validation_id' => $validation['id'],
            'user_id' => $validation['user_id'],
            'response' => $validation['description']
        ]);
    }

    return $this->response->setJSON(['message' => 'Responses migrated successfully!']);
}

}
