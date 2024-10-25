<?php

namespace App\Controllers;

use App\Models\ProductModel;

class BuvetteController extends BaseController
{
    public function index()
    {
        $model = new ProductModel();
        $data['products'] = $model->findAll();

        return view('buvette/index', $data);
    }
    public function store()
{
    $model = new ProductModel();
    
    // Validate input
    $validation = \Config\Services::validation();
    if (!$this->validate([
        'name' => 'required|min_length[3]',
        'price' => 'required|decimal',
        'image' => 'uploaded[image]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/gif,image/png]'
    ])) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    // Handle image upload
    $image = $this->request->getFile('image');
    if ($image->isValid() && !$image->hasMoved()) {
        $imageName = $image->getRandomName();
        $image->move('uploads', $imageName); // Assuming you have an 'uploads' directory
    }

    // Save product data
    $model->save([
        'name' => $this->request->getPost('name'),
        'price' => $this->request->getPost('price'),
        'description' => $this->request->getPost('description'),
        'image' => $imageName // Save image path
    ]);

    return redirect()->to('/products');
}

}
