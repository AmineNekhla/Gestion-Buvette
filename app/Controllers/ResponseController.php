<?php

namespace App\Controllers;

use App\Models\ValidationModel;
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
        $responses = $responseModel->where('user_id', $currentUserId)->findAll();

        return view('responses/index', ['responses' => $responses]);
    }
    

    public function syncSchemas()
    {
        $db = \Config\Database::connect();
        $forge = \Config\Database::forge();

        // Get column details for both tables
        $validationColumns = $db->getFieldData('validation');
        $userResponseColumns = $db->getFieldData('user_responses');

        $userResponseColumnNames = array_column($userResponseColumns, 'name');

        foreach ($validationColumns as $column) {
            if (!in_array($column->name, $userResponseColumnNames)) {
                $field = [
                    $column->name => [
                        'type' => $this->mapColumnType($column->type),
                        'null' => ($column->nullable) ? true : false,
                    ],
                ];

                if (isset($column->default)) {
                    $field[$column->name]['default'] = $column->default;
                }

                if (isset($column->max_length) && in_array(strtoupper($column->type), ['VARCHAR', 'CHAR', 'TEXT'])) {
                    $field[$column->name]['constraint'] = $column->max_length;
                }

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
        $validationModel = new ValidationModel();
        $responseModel = new ResponseModel();

        $validations = $validationModel->findAll();

        foreach ($validations as $validation) {
            $responseData = [
                'validation_id' => $validation['id'],
                'user_id' => $validation['user_id'],
                'response' => $validation['description'],
                'created_at' => $validation['created_at'] ?? null,
            ];

            $responseModel->insert($responseData);
        }

        return $this->response->setJSON(['message' => 'Responses migrated successfully!']);
    }
}
