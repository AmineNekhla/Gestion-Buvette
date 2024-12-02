<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'content', 'rating']; // Added rating here
    protected $useTimestamps = true;

    public function getCommentsWithUsers()
    {
        return $this->select('comments.*, users.username')
                    ->join('users', 'users.id = comments.user_id')
                    ->findAll();
    }
}
