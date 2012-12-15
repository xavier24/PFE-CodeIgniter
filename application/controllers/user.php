<?php

class user extends CI_Controller {
    
    public function index(){
        $this->lister();
        
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