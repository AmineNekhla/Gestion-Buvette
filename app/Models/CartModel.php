<?php
namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'id';
    protected $allowedFields = ['product_id', 'client_id', 'quantity'];

    public function countItemsInCart($clientId)
    {
        return $this->where('client_id', $clientId)->selectSum('quantity')->first()['quantity'] ?? 0;
    }
}
