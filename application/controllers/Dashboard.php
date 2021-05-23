<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public $data = [];
    public $etab_id;
    public $app_name = 'Votre carte';
    public $title = 'Tableau de bord';
    public $maintenance;

    public function __construct()
    {
        parent::__construct();
        $this->etab_id = $this->session->userdata('etab_id');
        $this->load->model('Establishments_model', 'establishments');
        $this->load->model('Customisation_model', 'customisation');
        $this->load->model('Categories_model', 'categories');
        $this->load->model('Products_model', 'products');
        if ($this->session->userdata('logged_in') != true) {
            $this->session->set_flashdata('error', "Vous n'avez pas le droit d'accéder à cette page.");
            redirect('welcome');
        }

        $this->maintenance = $this->template->get_maintenance($this->etab_id) == 1 ?  1 :  0;
    }

    public function index()
    {
        $data['title'] = $this->app_name . ' - ' . $this->title;
        $data['title_view'] = $this->title;
        $data['etab'] = $this->establishments->find($this->etab_id);
        $data['customisation'] = $this->customisation->find($this->etab_id);
        $data['count_cat'] = $this->categories->count($this->etab_id);
        $data['count_prod'] = $this->products->count($this->etab_id);
        $data['maintenance'] = $this->maintenance;

        $this->template->load('Layout_back', 'back/dashboard', $data);
    }

    public function maintenance()
    {
        $this->output->set_content_type('application/json');
        $data_post = json_decode(file_get_contents('php://input'));
        $data = ['maintenance' => $data_post->maintenance];
        $this->establishments->update($this->etab_id, $data);
    }
}
