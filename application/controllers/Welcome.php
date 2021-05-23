<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Welcome extends CI_Controller {

	public function index()
	{
		$data['title'] = "GREAT MENU"; 
		$this->template->load('Layout_front', 'front/home', $data);
	}
}
