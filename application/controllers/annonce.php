<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Annonce extends CI_Controller {

	
	public function index(){
            $this->lister();
 	}
        
        public function lister(){
            $this->load->model('M_Annonce');
            $dataList['page'] = 'Accueil';
            $dataList['titre'] = 'liste des annonces';
            $dataList['annonces'] = $this->M_Annonce->lister();
            $data['vue'] = $this->load->view('lister',$dataList,true);
            $this->load->view('layout',$data);
        }
        
        public function voir(){
            $idAnnonce = $this->uri->segment(3);
            $this->load->model('M_Annonce');
            $dataAnnonce['annonce'] = $this->M_Annonce->voir($idAnnonce);
            $dataLayout['vue'] = $this->load->view('voir',$dataAnnonce,true);
            $dataLayout['titre'] = "Annonce  ".$dataAnnonce['annonce']->depart."-".$dataAnnonce['annonce']->arrivee;
            
            $this->load->view('layout',$dataLayout);
        }
        
        public function user(){
           $idUser = $this->uri->segment(3);
           $this->load->model('M_Annonce');
           $dataUser['page'] = 'Profil';
           $dataUser['titre'] = 'liste des annonces de l\'utilisateur';
           $dataUser['annonces'] = $this->M_Annonce->user($idUser);
           $dataLayout['vue'] = $this->load->view('user',$dataUser,true);
           $this->load->view('layout',$dataLayout);
        }
       
}
