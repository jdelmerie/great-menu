<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Connexion extends CI_Controller
{
    public $data = [];
    public $asso_id;
    public $app_name = 'GREAT MENU';
    public $title;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model', 'users');
        $this->load->model('Establishments_model', 'establishments');
    }

    public function index()
    {
        $data['title'] = $this->app_name . ' - ' . ucfirst($this->router->class);
        $this->template->load('Layout_front', 'authen/login', $data);
    }

    public function connect()
    {
        $email = $this->input->post("email");
        $password = $this->input->post("password");

        if ($this->form_validation->run() == true) {
            $user = $this->users->findEmail($email); // select l'user grâce à son email

            if (empty($user)) {
                $this->session->set_flashdata('error', "Aucun compte n'est associé à cet email.");
            } else { // si l'user existe, vérifie le mdp et que son compte est activé

                if ($user->active == 0) {
                    $this->session->set_flashdata('error', "Veuillez activer votre compte avant de poursuivre.");
                } else if (password_verify($password, $user->password) && $user->active == 1) {
                    // définit les info de la session
                    $user_session = ['user_id' => $user->id, 'logged_in' => true];
                    $this->session->set_userdata($user_session);
                    $etab = $this->establishments->findUserEtab($user->id);

                    if (empty($etab)) {
                        echo "création";
                        redirect("connexion/nouveau");
                    } else {
                        $etab_id = ['etab_id' => $etab->id];
                        $this->session->set_userdata($etab_id);
                        redirect('dashboard');
                        echo "tableau de bord";
                    }
                } else {
                    $this->session->set_flashdata('error', "Mot de passe inccorrect");
                }
            }
        }
        $this->index();
    }

    public function nouveau()
    {
        $data['title'] = $this->app_name . " - Enregistrer votre établissement";
        $this->template->load('Layout_front', 'authen/create', $data);
    }

    public function add_etabs()
    {
        $user_id = $this->session->userdata('user_id');
        $nom = $this->input->post('nom');
        $url = $this->input->post('url');
        $adresse = $this->input->post('adresse');
        $code_postale = $this->input->post('code_postale');
        $telephone = $this->input->post('telephone');
        $ville = $this->input->post('ville');
        $site = $this->input->post('site');

        if ($this->form_validation->run() == true) {

            $data = ['name' => $nom,'url' => $url,'adress' => $adresse,'postal_code' => $code_postale,'phone' => $telephone,'city' => $ville,'web_site' => $site,'user_id' => $user_id,];

            $this->establishments->add($data);
            $id = $this->db->insert_id();
            $etab_id = ['etab_id' => $id];
            $this->session->set_userdata($etab_id);
            redirect("dashboard");
        }
        $this->nouveau();
    }

    public function forgetten_password()
    {
        $data['title'] = $this->app_name . ' - Mot de passe oublié';
        $this->template->load('Layout_front', 'authen/forgetten_password', $data);
    }

    public function forgetten_password_check()
    {
        $email = $this->input->post("email");
        $lien_new_password = "<a href=" . base_url("/connexion/new_password?email=$email") . ">ICI</a>";
        $objet = 'Réinitialisation mot de passe pour ' . $this->app_name;
        $message = "Pour réinitialiser votre mot de passe, cliquez sur ce lien : $lien_new_password";

        if ($this->form_validation->run() == true) {
            $user = $this->users->mail_exists($email);
            if ($user) {
                $this->email->from(SMTP_USER, 'No Reply');
                $this->email->to($email);
                $this->email->subject($objet);
                $this->email->message($message);
                $this->email->send();
                $this->session->set_flashdata('success', "Vous allez recevoir un email pour changer de mot de passe.");
            } else {
                $this->session->set_flashdata('error', "Une erreur s'est produite");
            }
        }
        $this->forgetten_password();
    }

    public function new_password()
    {
        $data['title'] = $this->app_name . ' - Nouveau mot de passe';
        $data['email'] = $this->input->get('email');
        $this->template->load('Layout_front', 'authen/new_password', $data);
    }

    public function update_password()
    {
        $email = $this->input->post('email');
        $password = $this->input->post("password");

        if ($this->form_validation->run() == true) {
            $new_password = password_hash($password, PASSWORD_DEFAULT);
            $data = ['password' => $new_password];
            $this->users->resetPwd($email, $data);
            $this->session->set_flashdata('success', "Votre mot de passe a été modifié, vous pouvez vous connecter.");
            redirect('connexion');
        }
        $this->new_password();
    }
}
