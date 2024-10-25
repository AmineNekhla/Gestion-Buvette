<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buvette extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Buvette_model');
    }

    public function index() {
        $data['produits'] = $this->Buvette_model->getProduits();
        $this->load->view('buvette/index', $data);
    }

    public function ajouter() {
        $data = [
            'nom' => $this->input->post('nom'),
            'prix' => $this->input->post('prix')
        ];
        $this->Buvette_model->addProduit($data);
        redirect('buvette');
    }

    public function supprimer($id) {
        $this->Buvette_model->deleteProduit($id);
        redirect('buvette');
    }

    public function modifier($id) {
        $data = [
            'nom' => $this->input->post('nom'),
            'prix' => $this->input->post('prix')
        ];
        $this->Buvette_model->updateProduit($id, $data);
        redirect('buvette');
    }
}
