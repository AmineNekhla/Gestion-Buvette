<?php
namespace App\Controllers;

use App\Models\CommentModel;

class CommentController extends BaseController
{
 public function index()
    {
        $model = new CommentModel();
        $data['comments'] = $model->getCommentsWithUsers();

     
        return $this->render('comments/index', $data);
    }

    public function store()
    {
        $model = new CommentModel();

        // Retrieve the content and rating from the request
        $data = [
            'user_id' => session()->get('id'),
            'content' => $this->request->getPost('content'),
            'rating' => $this->request->getPost('rating'), // Get the rating value
        ];

        $model->save($data);
        return redirect()->to('/comments')->with('success', 'Comment added successfully.');
    }
}
