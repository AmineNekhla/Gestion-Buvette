<?php

namespace App\Models;

use CodeIgniter\Model;

class ResponseModel extends Model
{
    protected $table = 'user_responses';
    protected $primaryKey = 'id';
    protected $allowedFields = ['validation_id', 'user_id', 'response', 'created_at'];

    /**
     * Fetch responses with associated validation details.
     *
     * @param int $userId The ID of the user whose responses are being fetched.
     * @return array
     */
    public function getResponsesWithDetails($userId)
    {
        return $this->select('user_responses.response, user_responses.created_at, validation.products, validation.total_price')
                    ->join('validation', 'validation.id = user_responses.validation_id')
                    ->where('user_responses.user_id', $userId)
                    ->findAll();
    }
}
