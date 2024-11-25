<?php

namespace App\Controllers;

use App\Models\ValidationModel;
use App\Models\ResponseModel;

class ResponseController extends BaseController
{
    public function index()
    {
        $session = session();
        $currentUserId = $session->get('id'); // Fetch the logged-in user's ID

        if (!$currentUserId) {
            return redirect()->to('/login')->with('error', 'Please log in to view responses.');
        }

        $responseModel = new ResponseModel();
        $responses = $responseModel->getResponsesWithDetails($currentUserId);

        return view('responses/index', ['responses' => $responses]);
    }   

    public function addResponse()
    {
        $validationModel = new ValidationModel();
        $responseModel = new ResponseModel();

        $data = [
            'user_id' => $this->request->getPost('user_id'),
            'products' => $this->request->getPost('products'),
            'total_price' => $this->request->getPost('total_price'),
            'description' => $this->request->getPost('description'),
        ];

        // Add response to validation table
        $validationId = $validationModel->insert($data);

        if ($validationId) {
            // Add response to user_responses table
            $responseData = [
                'validation_id' => $validationId,
                'user_id' => $data['user_id'],
                'response' => $data['description'],
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $responseModel->insert($responseData);

            return $this->response->setJSON(['message' => 'Response added successfully!']);
        }

        return $this->response->setJSON(['error' => 'Failed to add response.']);
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
    public function syncSchemas()
    {
        $db = \Config\Database::connect();
        $forge = \Config\Database::forge();
    
        // Get column details for both tables
        $validationColumns = $db->getFieldData('validation');
        $userResponseColumns = $db->getFieldData('user_responses');
    
        // Convert columns to arrays for easy comparison
        $userResponseColumnNames = array_column($userResponseColumns, 'name');
    
        foreach ($validationColumns as $column) {
            if (!in_array($column->name, $userResponseColumnNames)) {
                // Prepare the column definition
                $field = [
                    $column->name => [
                        'type' => $this->mapColumnType($column->type), // Map column type to valid MySQL type
                        'null' => ($column->nullable) ? true : false,
                    ],
                ];
    
                // Add default value if specified
                if (isset($column->default)) {
                    $field[$column->name]['default'] = $column->default;
                }
    
                // Add length for types like VARCHAR
                if (isset($column->max_length) && in_array(strtoupper($column->type), ['VARCHAR', 'CHAR', 'TEXT'])) {
                    $field[$column->name]['constraint'] = $column->max_length;
                }
    
                // Add the column dynamically
                try {
                    $forge->addColumn('user_responses', $field);
                } catch (\Exception $e) {
                    log_message('error', 'Error adding column: ' . $e->getMessage());
                    return $this->response->setJSON(['error' => 'Failed to sync schemas. Check the logs.']);
                }
            }
        }
    
        return $this->response->setJSON(['message' => 'User responses schema synced successfully!']);
    }
    
    private function mapColumnType($type)
    {
        // Map CodeIgniter column types to MySQL/MariaDB types
        $map = [
            'varchar' => 'VARCHAR',
            'char' => 'CHAR',
            'text' => 'TEXT',
            'int' => 'INT',
            'bigint' => 'BIGINT',
            'decimal' => 'DECIMAL',
            'datetime' => 'DATETIME',
            'date' => 'DATE',
            'float' => 'FLOAT',
            'double' => 'DOUBLE',
        ];
    
        return $map[strtolower($type)] ?? strtoupper($type);
    }
    public function migrateResponses()
    {
        $db = \Config\Database::connect();
        $validationModel = new ValidationModel();
        $responseModel = new ResponseModel();
    
        // Get all valid validation IDs
        $validValidationIds = array_column($validationModel->findAll(), 'id');
    
        // Fetch all rows from the validation table
        $validations = $validationModel->findAll();
    
        foreach ($validations as $validation) {
            if (!in_array($validation['id'], $validValidationIds)) {
                // Skip rows with invalid validation_id
                continue;
            }
    
            $responseData = [
                'validation_id' => $validation['id'],
                'user_id' => $validation['user_id'],
                'response' => $validation['description'],
                'created_at' => $validation['created_at'] ?? null,
            ];
    
            // Insert data into user_responses
            $responseModel->insert($responseData);
        }
    
        return $this->response->setJSON(['message' => 'Responses migrated successfully!']);
    }
        
        public function migrateAndSync()
        {
            // Sync schemas first
            $this->syncSchemas();
    
            // Then migrate the data
            $this->migrateResponses();
    
            return $this->response->setJSON(['message' => 'Migration and schema sync completed successfully!']);
        }

        public function migrateCli()
{
    $this->migrateResponses();
    echo "Responses migrated successfully!";
}

    }
    
