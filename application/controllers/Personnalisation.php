<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Personnalisation extends CI_Controller
{
    public $data = [];
    public $etab_id;
    public $app_name = 'Votre carte';
    public $title;
    public $personnalisation;
    public $maintenance;

    public function __construct()
    {
        parent::__construct();
        $this->etab_id = $this->session->userdata('etab_id');
        $this->title = $this->app_name . ' - ' . ucfirst($this->router->class);
        $this->load->model('Establishments_model', 'establishments');
        $this->load->model('Customisation_model', 'customisation');
        $this->personnalisation = $this->customisation->find($this->etab_id);
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
        $data['etab_id'] = $this->etab_id;
        $data['personnalisation'] = $this->personnalisation;
        $data['etab'] = $this->establishments->find($this->etab_id);
        $data['images'] = ['bck-1.png', 'bck-2.png', 'bck-3.png'];
        $data['maintenance'] = $this->maintenance;
        $this->template->load('Layout_back', 'back/customisation', $data);
    }

    public function logo()
    {
        $config['upload_path'] = './assets/img/uploads/logos/';
        $config['allowed_types'] = 'jpg|png';
        $config['file_name'] = "logo_" . $this->etab_id;
        $config['overwrite'] = true;
        $config['max_size'] = 8;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('logo')) {
            $data['error'] = $this->upload->display_errors();
            $this->session->set_flashdata('error', $data['error']);
        } else {
            $data['logo'] = $this->upload->data();
            $logo = $data['logo']['file_name'];

            if (isset($this->personnalisation)) {
                $data = ['logo' => $logo];
                $this->customisation->update($this->etab_id, $data);
            } else {
                $data = ['est_id' => $this->etab_id, 'logo' => $logo];
                $this->customisation->add($data);
            }
            $this->session->set_flashdata('success', "Logo mis à jour");
            $this->output->delete_cache('back/customisation/');
            $this->output->delete_cache('back/dashboard/');
        }
        redirect('personnalisation');
    }

    public function presentation()
    {
        $presentation = $this->input->post('presentation');

        // if (isset($this->personnalisation)) {
        //     $data = ['logo' => $logo];
        //     $this->customisation->update($this->etab_id, $data);
        // } else {
        //     $data = ['est_id' => $this->etab_id, 'logo' => $logo];
        //     $this->customisation->add($data);
        // }

        $data = ['presentation' => $presentation];
        $this->customisation->update($this->etab_id, $data);
        $this->session->set_flashdata('success', "Présentation mise à jour");
        redirect('personnalisation');
    }

    public function background()
    {
        $this->output->set_content_type('application/json');
        $post = json_decode(file_get_contents('php://input'));
        $data = ['background_image' => $post->background_image];
        $this->customisation->update($this->etab_id, $data);
    }
}
