<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accueil extends CI_Controller {
    
        function __construct(){
            parent::__construct();
            $this->load->model('M_Accueil');
        }

	
	public function index(){
            $this->lister();
 	}
        
        public function lister(){
            $dataList['info_membre'] = $this->session->userdata('logged_in');
            $dataList['page'] = 'Accueil';
            $dataList['titre'] = 'liste des annonces';
            $dataList['annonces'] = $this->M_Accueil->lister();
            $data['vue'] = $this->load->view('lister',$dataList,true);
            $this->load->view('layout',$data);
        }
                
        public function login(){
            $this->load->model('M_User');
            $data['mdp'] = $this->input->post('mdp');
            $data['email'] = $this->input->post('email');

            if($this->M_Accueil->verifier($data)){
                $info_membre = $this->M_Accueil->getIdMembre($data['email']);
                $this->session->set_userdata('logged_in',$info_membre);
                //redirect('prof/lister');
                redirect('accueil');
            }
            else{
                //redirect('error/mauvais_identifiant');
                var_dump("non");
            }
        }

        public function deconnecter(){
            $this->session->unset_userdata('logged_in');
            redirect('accueil');
            
        }
       
}
