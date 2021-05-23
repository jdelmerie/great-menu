<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Quantites extends CI_Controller
{
    public $data = [];
    public $etab_id;
    public $app_name = 'Votre carte';
    public $title;
    public $title_view;
    public $allCategoriess = [];
    public $maintenance;

    public function __construct()
    {
        parent::__construct();
        $this->etab_id = $this->session->userdata('etab_id');
        $this->title_view = "Quantités";
        $this->title = $this->app_name . ' - Quantités';
        $this->load->model('Categories_model', 'categories');
        $this->load->model('Quantity_model', 'quantity');
        $this->allCategoriess = $this->categories->findAll($this->etab_id);
        if ($this->session->userdata('logged_in') != true) {
            $this->session->set_flashdata('error', "Vous n'avez pas le droit d'accéder à cette page.");
            redirect('welcome');
        }

        $this->maintenance = $this->template->get_maintenance($this->etab_id) == 1 ?  1 :  0;
    }

    public function index()
    {
        $data['title'] = $this->title;
        $data['title_view'] = $this->title_view;
        $data['categories'] = $this->allCategoriess;
        $data['quantities'] = $this->quantity->find_cat_by_qty($this->etab_id);
        $data['maintenance'] = $this->maintenance;

        // $data['quantities'] = $this->quantity->test($this->etab_id);

        // echo "<pre>";
        // print_r($test);

        // exit();

        if (count($data['categories']) > 0) {
            $this->template->load('Layout_back', 'back/qty', $data);
        } else {
            redirect('categories/nouveau');
        }
    }

    public function nouveau($cat_id)
    {
        $data['title'] = $this->title;
        $data['categorie'] = $this->categories->find($cat_id);
        $data['title_view'] = $this->title_view . ' > ' . ucfirst($data['categorie']->name);
        $data['quantites'] = $this->quantity->findAll($cat_id);
        $data['maintenance'] = $this->maintenance;
        $this->template->load('Layout_back', 'forms/add_qty', $data);
    }

    public function add($cat_id)
    {
        $nom = $this->input->post('nom');

        if ($this->form_validation->run() == true) {
            $data = ['name' => $nom, 'cat_id' => $cat_id];
            $this->quantity->add($data);
            redirect("quantites/nouveau/$cat_id");
        }
        $this->nouveau($cat_id);
    }

    public function edit($qty_id)
    {
        $qtyname = $this->input->post('qtyname');
        $cat_id = $this->input->post('cat_id');

        if ($this->form_validation->run() == true) {
            $data = ['name' => $qtyname];
            $this->quantity->update($qty_id, $data);
            redirect("quantites/nouveau/$cat_id");
        }
        $this->nouveau($cat_id);
    }

    public function delete($qty_id, $cat_id)
    {
        $this->quantity->delete($qty_id);
        $this->session->set_flashdata('success', "Quantité supprimée.");
        redirect("quantites/nouveau/$cat_id");
    }


    // public function delete($cat_id, $prod_id)
    // {
    //     $this->products->delete($prod_id);
    //     $this->session->set_flashdata('success', "Produit supprimé.");
    //     redirect("produits/categories/$cat_id");
    // }
}
