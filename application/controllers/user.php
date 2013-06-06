<?php

class User extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('M_User');
    }
	//CONNEXION
	public function login(){
		$this->load->model('M_User');
		$this->load->library('encrypt');
		
		$data['mdp'] = $this->encrypt->sha1($this->input->post('mdp'));
		$data['email'] = $this->input->post('email');

		if($this->M_User->verifier($data)){
			$info_membre = $this->M_User->getIdMembre($data['email']);
			$this->session->set_userdata('logged_in',$info_membre);
			//redirect('prof/lister');
			redirect('accueil');
		}
		else{
			//redirect('error/mauvais_identifiant');
			var_dump("non");
		}
    }
	//DECONNEXION
	public function deconnecter(){
		$this->session->unset_userdata('logged_in');
		redirect('accueil');
		
	}
	//recupere les infos de l'utilisateur selectionné
	public function profil(){
           
           $idUser = $this->uri->segment(3,0);
           $dataUser['page'] = 'Profil';
           $dataUser['titre'] = 'liste des annonces de l\'utilisateur';
           $dataUser['info_profil'] = $this->M_User->user($idUser);
           $dataUser['annonces'] = $this->M_User->trajet($idUser);
           $dataLayout['vue'] = $this->load->view('profil',$dataUser,true);
           
           $this->load->view('layout',$dataLayout);
    }
	//recupere les annonces de l'utilisateur selectionné
    public function lister(){
        $dataList['page'] = 'Profil';
        $dataList['titre'] = 'liste des annonces de l\'utilisateur';
        //$dataList['annonces'] = $this->M_Annonce->lister();
        $data['vue'] = $this->load->view('user',$dataList,true);
        $this->load->view('layout',$data);
    }
}