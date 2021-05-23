<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Cette classe s'occupe d'envoyer les pages d'erreurs 404
 */
class Errors extends CI_Controller
{
    /**
     * Page d'erreur 404, si connecté redirect sur le dasboard sinon page d'accueil du site
     *
     * @return void
     */
    public function error404()
    {
        $data['title'] = 'GREAT MENU - Erreur 404';
        
        if ($this->session->userdata('logged_in') != true) {
            $data['page'] = "Revenir à l'accueil";
            $data['link'] = 'welcome';
            $this->load->view('partials/error404', $data);
        } else {
            $data['page'] = 'Revenir au dashboard';
            $data['link'] = 'dashboard';
            $this->load->view('partials/error404', $data);
        }
    }
}
