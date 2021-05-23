<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inscription extends CI_Controller
{
    public $data = [];
    public $asso_id;
    public $app_name = 'GREAT MENU';
    public $title;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model', 'users');
    }

    public function index()
    {
        $data['title'] = $this->app_name . ' - ' . ucfirst($this->router->class);
        $this->template->load('Layout_front', 'authen/signin', $data);
    }

    public function register()
    {
        $email = $this->input->post("email");
        $password = $this->input->post("password");
        $now = date('Y-m-d H:i:s');
        $hash = password_hash(rand(0, 1000), PASSWORD_DEFAULT);

        if ($this->form_validation->run() == true) {
            $data = [
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'creation' => $now,
                'active' => 0,
                'activation_hash' => $hash,
            ];

            $this->users->add($data);
            $user_id = $this->db->insert_id();

            $lien_validation = "<a href=" . base_url("/inscription/validation?id=$user_id&activation=$hash") . ">ICI</a>";
            $objet = 'Création de compte pour ' . $this->app_name;
            $message = "Pour valider votre compte, cliquez sur le lien : $lien_validation";

            $this->email->from(SMTP_USER, 'No Reply');
            $this->email->to($email);
            $this->email->subject($objet);
            $this->email->message($message);
            $this->email->send();

            $this->session->set_flashdata('success', "Votre compte a bien été créé. Vous allez recevoir un email de validation.");
            redirect('connexion');
        } else {
            $this->index();
        }
    }

    public function validation()
    {
        $user_id = $this->input->get('id', true);
        $user = $this->users->findId($user_id);

        if ($user->id == $user_id) {
            $data = ['active' => 1];
            $this->users->update($user_id, $data);
            $this->session->set_flashdata('success', "Votre compte a été activé.<br>Vous pouvez vous connecter.");
            redirect('connexion');
        }
    }
}
