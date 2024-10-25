<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buvette_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function getProduits() {
        return $this->db->get('produits')->result_array();
    }

    public function addProduit($data) {
        return $this->db->insert('produits', $data);
    }

    public function deleteProduit($id) {
        return $this->db->delete('produits', ['id' => $id]);
    }
    
    public function updateProduit($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('produits', $data);
    }
}
