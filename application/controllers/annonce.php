<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Annonce extends CI_Controller {

	
	public function index(){
            $this->load->model('M_Annonce');
            $this->lister();
 	}
        
        public function lister(){
            $dataList['page'] = 'Accueil';
            $dataList['titre'] = 'liste des annonces';
            $dataList['annonces'] = $this->M_Annonce->lister();
            $data['vue'] = $this->load->view('lister',$dataList,true);
            $this->load->view('layout',$data);
        }
        
       
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */