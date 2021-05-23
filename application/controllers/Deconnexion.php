<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Cette classe gère la déconnexion
 */
class Deconnexion extends CI_Controller
{
    /**
     * Déconnexion de l'interface d'administration et redirection sur page d'accueil de l'application
     *
     * @return void
     */
    public function index()
    {
        $log = ['etab_id, user_id, logged_in'];
        $this->session->unset_userdata($log);
        $this->session->sess_destroy();
        redirect('welcome');
    }
}