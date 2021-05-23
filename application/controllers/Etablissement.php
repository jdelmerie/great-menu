<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Etablissement extends CI_Controller
{
    public $data = [];
    public $etab_id;
    public $app_name = 'Votre carte';
    public $title;
    public $maintenance;

    public function __construct()
    {
        parent::__construct();
        $this->etab_id = $this->session->userdata('etab_id');
        $this->title = $this->app_name . ' - ' . ucfirst($this->router->class);
        $this->load->model('Establishments_model', 'establishments');

        require 'application/libraries/phpqrcode/qrlib.php';

        if ($this->session->userdata('logged_in') != true) {
            $this->session->set_flashdata('error', "Vous n'avez pas le droit d'accéder à cette page.");
            redirect('welcome');
        }

        $this->maintenance = $this->template->get_maintenance($this->etab_id) == 1 ?  1 :  0;
    }

    public function index()
    {
        $data['title'] = $this->title;
        $data['title_view'] = ucfirst($this->router->class);
        $data['etab'] = $this->establishments->find($this->etab_id);

        $url = base_url('/carte/'). $data['etab']->url;
        $folder = 'assets/img/qrcodes';
        $qrfile = "qrcode_" . $this->etab_id.".png";

        $data['link'] = "$folder/$qrfile";
        $data['QRcode'] = QRcode::png($url, $data['link']);
        $data['maintenance'] = $this->maintenance;

        $this->template->load('Layout_back', 'back/etab', $data);
    }

    public function edit()
    {
        $nom = $this->input->post('nom');
        $url = $this->input->post('url');
        $adresse = $this->input->post('adresse');
        $code_postale = $this->input->post('code_postale');
        $telephone = $this->input->post('telephone');
        $ville = $this->input->post('ville');
        $site = $this->input->post('site');

        if ($this->form_validation->run() == true) {
            $data = [
                'name' => $nom,
                'url' => $url,
                'adress' => $adresse,
                'postal_code' => $code_postale,
                'phone' => $telephone,
                'city' => $ville,
                'web_site' => $site,
            ];

            $this->establishments->update($this->etab_id, $data);
            $this->session->set_flashdata('success', 'Mis à jour de votre établissement');
        }
        $this->index();
    }
}
