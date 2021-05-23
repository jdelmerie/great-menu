<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produits extends CI_Controller
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
        $this->title_view = "Vos produits";
        $this->title = $this->app_name . ' - ' . $this->title_view;
        $this->load->model('Categories_model', 'categories');
        $this->load->model('Products_model', 'products');
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
        $data['maintenance'] = $this->maintenance;
        if (count($data['categories']) > 0) {
            // $this->template->load('Layout_back', 'back/prod', $data);
            
        } else {
            redirect('produits/nouveau');
        }
    }

    public function nouveau()
    {
        $data['title'] = $this->title;
        $data['title_view'] = 'Ajouter un produit';
        $data['categories'] = $this->allCategoriess;
        $data['maintenance'] = $this->maintenance;

        // $cat_id = $this->input->post('cat_id', true);

        // $data = $this->product_model->get_sub_category($category_id)->result();
        // echo json_encode($data);

        // $data_post =  $this->quantity->findAll($cat_id);
        // echo json_encode($data_post);

        $this->template->load('Layout_back', 'forms/add_prod', $data);
    }

    public function api()
    {
        // $this->output->set_content_type('application/json');
        // $data_post = json_decode(file_get_contents('php://input'));
        // // $cat_id = $data_post->id;
        // // $test = $this->quantity->findAll($cat_id);
        // // echo json_encode($test);

        // print_r($data_post);

        $cat_id = $this->input->post('id');
        $quantites = [];
        $quantites = $this->quantity->findAll($cat_id);
        echo json_encode($quantites);
    }

    public function add()
    {
        $nom = $this->input->post('nom');
        $description = $this->input->post('description');
        $cat_id = $this->input->post('categorie');
        $price = $this->input->post('price');

        if ($this->form_validation->run() == true) {
            $data = ['name' => $nom, 'composition' => $description, 'cat_id' => $cat_id, 'price' => $price];
            $this->products->add($data);
            $prod_id = $this->db->insert_id();
            redirect("produits/edit/$prod_id");
        }
        $this->nouveau();
    }

    public function edit($id)
    {
        $data['produit'] = $this->products->find($id);
        $data['category'] = $this->categories->find($data['produit']->cat_id);
        $data['title'] = $this->title;
        $data['title_view'] = ucfirst($data['category']->name) . ' > ' . ucfirst($data['produit']->name);
        $data['maintenance'] = $this->maintenance;
        $this->template->load('Layout_back', 'forms/edit_prod', $data);
    }

    public function update()
    {
        $prod_id = $this->input->post('prod_id');
        $nom = $this->input->post('nom');
        $description = $this->input->post('description');
        $cat_id = $this->input->post('categorie');
        $price = $this->input->post('price');
        $not_card = $this->input->post('not_card');
        $sold_out = $this->input->post('sold_out');

        $config['upload_path'] = './assets/img/uploads/products/';
        $config['allowed_types'] = 'jpg|png';
        $config['file_name'] = "product_" . $prod_id;
        $config['overwrite'] = true;
        $config['max_size'] = 8;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('image')) {
            $data['error'] = $this->upload->display_errors();
            $this->session->set_flashdata('error', $data['error']);
        } else {
            $data['image'] = $this->upload->data();
            $image = $data['image']['file_name'];
        }

        if ($this->form_validation->run() == true) {
            $data = ['name' => $nom, 'composition' => $description, 'price' => $price, 'not_in_card' => $not_card, 'sold_out' => $sold_out, 'image' => $image];

            $this->products->update($prod_id, $cat_id, $data);
            $this->session->set_flashdata('success', 'Produit mis à jour');

            $this->output->delete_cache('form/edit_prod/');
            $this->output->delete_cache('back/prod_by_cat/');

            redirect("produits/edit/$prod_id");
        }

        $this->edit($prod_id);

    }

    public function categories($id)
    {
        $data['title'] = $this->title;
        $data['categories'] = $this->allCategoriess;
        $data['produits'] = $this->products->findAll($id);
        $category = $this->categories->find($id);
        $data['title_view'] = 'Produits > ' . ucfirst($category->name);
        $data['cat_id'] = $id;
        $data['display'] = $this->load->view('back/prod_by_cat', $data, true);
        $data['maintenance'] = $this->maintenance;
        $this->template->load('Layout_back', 'back/prod', $data);
    }

    public function delete($cat_id, $prod_id)
    {
        $this->products->delete($prod_id);
        $this->session->set_flashdata('success', "Produit supprimé.");
        redirect("produits/categories/$cat_id");
    }
}
