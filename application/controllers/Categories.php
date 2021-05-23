<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Categories extends CI_Controller
{
    public $data = [];
    public $etab_id;
    public $app_name = 'Votre carte';
    public $title;
    public $title_view;
    public $icons;
    public $maintenance;

    public function __construct()
    {
        parent::__construct();
        $this->etab_id = $this->session->userdata('etab_id');
        $this->title_view = "Catégories de produits";
        $this->title = $this->app_name . ' - ' . $this->title_view;
        $this->icons = ['1-cocktail.png', '2-entree.png', '3-hotfood.png', '4-plate.png', '5-pizza.png', '6-hamburger.png', '7-meat.png', '8-pastas.png', '9-crustacean.png', '10-fish.png', '11-cake.png', '12-ice.png', '13-drink.png', '14-beer.png', '15-wine.png', '16-cafe.png', '17-digestif.png', '18-cheese.png', '19-salad.png', '20-soup.png', '21-shooters.png'];
        $this->load->model('Categories_model', 'categories');
        $this->load->model('Products_model', 'products');
        $this->load->model('Quantity_model', 'quantity');
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
        $data['categories'] = $this->categories->findAll($this->etab_id);
        $data['quantities'] = $this->quantity->find_cat_by_qty($this->etab_id);
        $data['maintenance'] = $this->maintenance;

        // echo "<pre>";
        // print_r($this->categories->count_prod_by_cat($this->etab_id));
        // exit();

        if (count($data['categories']) > 0) {
            $this->template->load('Layout_back', 'back/cat', $data);
        } else {
            redirect('categories/nouveau');
        }
    }

    public function nouveau()
    {
        $data['title'] = $this->title;
        $data['title_view'] = 'Ajouter une catégorie de produits';
        $data['icons'] = $this->icons;
        $data['maintenance'] = $this->maintenance;
        $this->template->load('Layout_back', 'forms/add_cat', $data);
    }

    public function add()
    {
        $nom = $this->input->post('nom');
        $description = $this->input->post('description');
        $image = $this->input->post('image');

        if ($this->form_validation->run() == true) {
            $data = ['name' => $nom, 'description' => $description, 'est_id' => $this->etab_id, 'image' => $image];
            $this->categories->add($data);
            $this->session->set_flashdata('success', 'Nouvelle catégorie ajoutée');
            redirect("categories");
        }
        $this->nouveau();
    }

    public function edit($id)
    {
        $data['category'] = $this->categories->find($id);
        $data['title'] = $this->title;
        $data['title_view'] = $this->title_view . ' > ' . ucfirst($data['category']->name);
        $data['icons'] = $this->icons;
        $data['maintenance'] = $this->maintenance;

        if (!empty($data['category']) && $data['category']->est_id == $this->etab_id) {
            $this->template->load('Layout_back', 'forms/edit_cat', $data);
        } else {
            $this->session->set_flashdata('error', 'Vous ne pouvez pas accéder à cette page.');
            redirect('categories');
        }

    }

    public function update()
    {
        $id = $this->input->post('id');
        $nom = $this->input->post('nom');
        $description = $this->input->post('description');
        $image = $this->input->post('image');

        if ($this->form_validation->run() == true) {
            $data = ['name' => $nom, 'description' => $description, 'image' => $image];
            $this->categories->update($id, $this->etab_id, $data);
            $this->session->set_flashdata('success', 'Catégorie mise à jour');
            redirect("categories");
        }
        $this->edit($id);
    }

    public function delete($cat_id)
    {
        if ($this->categories->delete($cat_id)) {
            $this->session->set_flashdata('error', '<strong>Impossible de supprimer.</strong><br>Un ou plusieurs produits sont associés à cette catégorie. Vous devez les supprimer avant de pouvoir supprimer cette catégorie.');
            redirect("categories");
        } else {
            $this->session->set_flashdata('success', 'Catégorie supprimée');
            redirect("categories");
        }
    }
}
