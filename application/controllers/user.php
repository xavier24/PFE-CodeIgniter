<?php

class User extends CI_Controller {
    
    public function index(){
        //$this->profil();
        
    }
    
    public function __construct(){
        parent::__construct();
        $this->lang->load('fr', 'francais');
    }


    public function profil(){
           
           $idUser = $this->uri->segment(3,0);
           $this->load->model('M_User');
           $dataUser['page'] = 'Profil';
           $dataUser['titre'] = 'liste des annonces de l\'utilisateur';
           $dataUser['info_profil'] = $this->M_User->user($idUser);
           $dataUser['annonces'] = $this->M_User->trajet($idUser);
           $dataLayout['vue'] = $this->load->view('profil',$dataUser,true);
           
           $this->load->view('layout',$dataLayout);
    }
    public function lister(){
        $this->load->model('M_User');
        $dataList['page'] = 'Profil';
        $dataList['titre'] = 'liste des annonces de l\'utilisateur';
        //$dataList['annonces'] = $this->M_Annonce->lister();
        $data['vue'] = $this->load->view('user',$dataList,true);
        $this->load->view('layout',$data);
    }
}