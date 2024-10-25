<?php

namespace App\Controllers;

use App\Models\ProductModel;

class ProductController extends BaseController
{
    public function index(){
        $model = new ProductModel();
        $data['products'] = $model->findAll();
        return view('products/index', $data);
    }

    public function create(){
        return view('products/create');
    }

    public function store(){
        $model = new ProductModel();
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required|min_length[3]',
            'price' => 'required|decimal',
            'image' => 'uploaded[image]|max_size[image,2048]|is_image[image]'
        ]);
    
        if (!$this->validate($validation->getRules())) {
            return redirect()->to('products/create')->withInput()->with('errors', $this->validator->getErrors());
        }
    
        // Handle file upload
        if ($this->request->getFile('image')->isValid()){
            $image = $this->request->getFile('image');
            $imageName = $image->getRandomName(); // Generate a random name for the image
            $image->move(FCPATH . 'uploads', $imageName); // Move the file to the uploads directory within public
        }
    
        $data = [
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
            'image' => $imageName ?? null, // Save the image name to the database
        ];
    
        $model->save($data);
        return redirect()->to('/products');
    }
    
    public function edit($id){
        $model = new ProductModel();
        $data['product'] = $model->find($id);
        return view('products/edit', $data);
    }

    public function update($id){
        $model = new ProductModel();
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required|min_length[3]',
            'price' => 'required|decimal',
            'image' => 'max_size[image,2048]|is_image[image]'
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->to('products/edit/' . $id)->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
        ];

        // Handle file upload if a new image is uploaded
        if ($this->request->getFile('image')->isValid()) {
            $image = $this->request->getFile('image');
            $imageName = $image->getRandomName();
         $image->move(FCPATH . 'uploads', $imageName); // FCPATH pointe vers le dossier public
            $data['image'] = $imageName; // Update the image name in the database
        }

        $model->update($id, $data);
        return redirect()->to('/products');
    }

    


    public function delete($id) {
        $productModel = new ProductModel();
        $productModel->delete($id);
        return redirect()->to('/products');
    }
    
}
