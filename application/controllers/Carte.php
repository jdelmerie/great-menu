<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Carte extends CI_Controller
{
    public $data = [];
    public $etab_url;
    public $data_url;
    public $stab;
    public $title;

    public function __construct()
    {
        parent::__construct();
        $this->data_url = explode('/', uri_string());
        $this->etab_url = $this->data_url[1];
        $this->load->model('Establishments_model', 'establishments');
        $this->etab = $this->establishments->findUrl($this->etab_url);
    }

    public function index()
    {

        if ($this->etab->maintenance == 0) {
            echo "<br>VOTRE CARTE</br>";
        } else {
            $this->load->view('partials/maintenance');
        }

        // echo "<pre>";
        // print_r($this->etab);
        // echo "</pre>";

        // if ($data['etab']) {
        //     $etab_id = $data['etab']->id;
        // }

        // $this->display($etab_id);
    }
}
