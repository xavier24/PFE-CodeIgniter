<?php

class Annonce extends CI_Controller {
        
        function __construct(){
            parent::__construct();
            $this->load->model('M_Annonce');
        }
        
        public function voir(){
            $idAnnonce = $this->uri->segment(3);
            $dataAnnonce['annonce'] = $this->M_Annonce->voir($idAnnonce);
            $dataLayout['vue'] = $this->load->view('voir',$dataAnnonce,true);
            $dataLayout['titre'] = "Annonce  ".$dataAnnonce['annonce']->depart."-".$dataAnnonce['annonce']->arrivee;

            $this->load->view('layout',$dataLayout);
        }
}