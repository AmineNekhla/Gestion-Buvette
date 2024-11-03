<?php

namespace App\Controllers;

use App\Models\CommentModel;

class CommentController extends BaseController
{
    public function index()
    {
        $model = new CommentModel();
        $data['comments'] = $model->getCommentsWithUsers();
        return view('comments/index', $data);
    }

    public function store()
    {
        $model = new CommentModel();

        $data = [
            'user_id' => session()->get('id'), 
            'content' => $this->request->getPost('content'),
        ];

        $model->save($data);
        return redirect()->to('/comments')->with('success', 'Comment added successfully.');
    }
}
