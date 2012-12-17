<?php

class Inscription extends CI_Controller {
    
        public function index(){
            $dataList['page'] = 'Accueil';
            $dataList['titre'] = 'liste des annonces';
            $data['vue'] = $this->load->view('inscription',$dataList,true);
            $this->load->view('layout',$data);
        }
}
