<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accueil extends CI_Controller {
    
	function __construct(){
		parent::__construct();
		$this->load->model('M_Accueil');
	}

	public function index(){
         
		$dataList['user_data'] = $this->session->userdata('logged_in');
		$dataList['page'] = 'Accueil';
		$dataList['titre'] = 'liste des annonces';
		$dataList['annonces'] = $this->M_Accueil->lister();
		$dataList['villes'] = $this->M_Accueil->villes();
		$data['vue'] = $this->load->view('lister',$dataList,true);
		$this->load->view('layout',$data);
                //var_dump($dataList['villes']);
	}
}
