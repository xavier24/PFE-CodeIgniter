<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Annonce extends CI_Controller {

	
	public function index()
	{
            $data['titre'] = 'Accueil';
            $data['annonces'] = 'liste des annonces';
            $data['vue'] = $this->load->view('lister',$data,true);
            $this->load->view('layout',$data);
 	}
        
       
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */