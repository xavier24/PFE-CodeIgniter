<?php

class Annonce extends CI_Controller {
        
        function __construct(){
            parent::__construct();
            $this->load->model('M_Annonce');
            $this->load->model('M_Accueil');
        }
        
        public function lister(){
            $dataList['user_data'] = $this->session->userdata('logged_in');
            $dataList['page'] = 'Accueil';
            $dataList['titre'] = 'liste des resultats';
            
            $recherche['passager'] = $this->input->post('passager');
            $recherche['conducteur'] = $this->input->post('conducteur');
            $recherche['depart'] = $this->input->post('departId');
            $recherche['arrivee'] = $this->input->post('arriveeId');
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
                      
            $dataList['villes'] = $this->M_Annonce->villes();
            $dataList['user_data'] = $this->session->userdata('logged_in');
            $dataList['page'] = 'Accueil';
            $dataList['titre'] = 'Publier une annonce';
                       
            $data['vue'] = $this->load->view('ajouter',$dataList,true);
            $this->load->view('layout',$data);			
        }
        
        public function poster(){
            
            if(!$this->session->userdata('logged_in')){
                $error['connecte'] = 'Veuillez vous connecter';
                var_dump($error);
            }
            else{
                $user_data = $this->session->userdata('logged_in');
                $data['user_id'] = $user_data->user_id;

                $champ = array(
                            'conducteur',
                            'departID',
                            'arriveeID',
                            'description_depart',
                            'description_arrivee',
                            'date',
                            'heure',
                            'flexibilite',
                            'places'
                        );
                $champ_erreur = array(
                                    'si vous êtes chauffeur ou passager lors',
                                    'le départ',
                                    'l\'arrivée',
                                    'les infos sur le lieu de rendez-vous',
                                    'les infos sur le lieu d\'arrivée',
                                    'la date',
                                    'l\'heure',
                                    '',''
                                );
                for($i=0;$i<count($champ);$i++){
                    if($this->input->post('input_'.$champ[$i]) != ""){
                        $data[$champ[$i]] = $this->input->post('input_'.$champ[$i]);
                    }
                    else{
                        //$error = true;
                        $error[$champ[$i]] = 'Veuillez préciser '.$champ_erreur[$i].' du voyage';
                    }
                }
                if($data['date']){
                    list($day, $month, $year) = preg_split('/[-\.\/ ]/', $data['date']);
                    $data['date'] = $year.'-'.$month.'-'.$day;
                }
                if($this->input->post('input_commentaire')){
                    $data['commentaire'] = $this->input->post('input_commentaire');
                }

                if($this->input->post('input_regulier')){
                    $data['regulier'] = $this->input->post('input_regulier');
                }
                else{
                    $data['regulier'] = 0;
                }
                if($this->input->post('input_retour')){
                    $data['retour'] = $this->input->post('input_retour');
                }
                else{
                    $data['retour'] = 0;
                }
                if($this->input->post('input_coord')){
                    $coord = $this->input->post('input_coord');
                    $jsonCoord = json_decode($coord);
                    $dataCoord = $jsonCoord;
                }

                //var_dump($error);
                //var_dump($data);
                //var_dump($dataCoord[0]->jb);
                $this->M_Annonce->ajouter($data,$dataCoord);
            }
        }
}