<?php

namespace App\Controllers;

use App\Models\ProductFormModel;

class ProductFormController extends BaseController
{

public function index(){
    $productModel = new ProductFormModel();
    $products = $productModel->findAll();

    $totalQuantity = array_sum(array_column($products, 'quantity'));
    $generalState = $this->etatStock($totalQuantity);

    return view('formProducts', [
        'products' => $products,
        'totalQuantity' => $totalQuantity,
        'generalState' => $generalState,
    ]);
}


public function add(){
    $productModel = new ProductFormModel();

    $data = [
        'name' => $this->request->getPost('name'),
        'quantity' => $this->request->getPost('quantity'),
        'price' => $this->request->getPost('price'),
    ];

    $productModel->insert($data);
    return redirect()->to('/productsForm');

}

private function etatStock($totalQuantity){
    if ($totalQuantity > 100) {
        return 'Excellent stock';
    } elseif ($totalQuantity >= 50) {
        return 'Bon stock';
    } else {
        return 'Faible de stock';
    }
}


}