<?php

class Annonce extends CI_Controller {
        
        function __construct(){
            parent::__construct();
            $this->load->model('M_Annonce');
			$this->load->model('M_Accueil');
        }
        
        public function lister(){
            $dataList['villes'] = $this->M_Accueil->villes();
			
			$dataList['info_membre'] = $this->session->userdata('logged_in');
            $dataList['page'] = 'Accueil';
            $dataList['titre'] = 'liste des resultats';
            
            $recherche['passager'] = $this->input->post('passager');
            $recherche['conducteur'] = $this->input->post('conducteur');
            $recherche['depart'] = $this->input->post('depart');
            $recherche['arrivee'] = $this->input->post('arrivee');
            $recherche['date'] = $this->input->post('date');
            $recherche['flex'] = $this->input->post('flex');
            $recherche['places'] = $this->input->post('places');
            
            $dataList['annonces'] = $this->M_Annonce->lister($recherche);
            
            foreach($dataList['annonces'] as $key => $annonce){
                $annonce->note = 0;
                $param_verif = array('depart'=>'100','arrivee'=>'80','date'=>'70');
                foreach($param_verif as $key_array => $value){
                    // if($annonce->$key_array == $recherche[$key_array]){
                        // $annonce->note += $value;
                    // }
                }
            };
            var_dump($dataList['annonces']); 
            
            
            $data['vue'] = $this->load->view('lister',$dataList,true);
            $this->load->view('layout',$data);
        }
        
        public function voir(){
            $idAnnonce = $this->uri->segment(3);
            $dataAnnonce['annonce'] = $this->M_Annonce->voir($idAnnonce);
            $dataLayout['vue'] = $this->load->view('voir',$dataAnnonce,true);
            $dataLayout['titre'] = "Annonce  ".$dataAnnonce['annonce']->depart."-".$dataAnnonce['annonce']->arrivee;

            $this->load->view('layout',$dataLayout);
        }
		
		public function ajouter(){
			$dataList['info_membre'] = $this->session->userdata('logged_in');
            $dataList['page'] = 'Accueil';
            $dataList['titre'] = 'Publier une annonce';
                       
            $data['vue'] = $this->load->view('ajouter',$dataList,true);
            $this->load->view('layout',$data);			
		}
}