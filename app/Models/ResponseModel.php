<?php

namespace App\Models;

use CodeIgniter\Model;

class ResponseModel extends Model
{
    protected $table = 'user_responses';
    protected $primaryKey = 'id';
    protected $allowedFields = ['validation_id', 'user_id', 'response', 'created_at'];
}
