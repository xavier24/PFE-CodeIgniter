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
            
            
        //recuperer si il y a message d'erreur
            $champError = array('departID','arriveeID','date','heure','prix_conseil');
            for($i=0;$i<count($champError);$i++){
                $dataList['error'][$champError[$i]] = $this->session->flashdata('error_'.$champError[$i]);
            }
        
        //recuperer les données saisis pour les remettre		
            $dataList['donnee']=false;
            $dataList['error']=false;
            if($this->session->userdata('dataRecup')){
                $dataList['donnee'] = $this->session->userdata('dataRecup');
                $this->session->unset_userdata('dataRecup');
                //var_dump($dataList['donnee']);
            }
            if($this->session->userdata('dataError')){
                $error = $this->session->userdata('dataError');
                $this->session->unset_userdata('dataError');
                               
                $champError = array('departID','arriveeID','heure','prix_conseil','date');
                $dataList['error']="";
                    for($i=0;$i<count($champError);$i++){
                        if(isset($error[$champError[$i]])){
                            if($i!=0){
                                $dataList['error']=$dataList['error'].', ';
                            }
                            $dataList['error']=$dataList['error'].$error[$champError[$i]];
                        }
                    }
                //var_dump($dataList['error']);
            }
            if(isset($dataList['donnee']['calendar'])){
                $dataList['donnee']['calendar'] = json_decode($dataList['donnee']['calendar']);
            }
            
            $dataList['user_data'] = $this->session->userdata('logged_in');
            $dataList['page'] = 'Accueil';
            $dataList['titre'] = 'Publier une annonce';
            $dataList['body'] = "ajouter_annonce";           
            
            $data['vue'] = $this->load->view('ajouter',$dataList,true);
            $this->load->view('layout',$data);			
        }
        
        public function poster(){
            if(!$this->session->userdata('logged_in')){
                redirect('annonce/ajouter');
            }
            else{
                $user_data = $this->session->userdata('logged_in');
                $data['user_id'] = $user_data->user_id;
                
            //infos requises
                $champRequis = array('departID','arriveeID','heure','prix_conseil');
                $champRequis_erreur = array('le départ','l\'arrivée','l\'heure','le prix');
                for($i=0;$i<count($champRequis);$i++){
                    if($this->input->post('input_'.$champRequis[$i]) != ""){
                        $data[$champRequis[$i]] = $this->input->post('input_'.$champRequis[$i]);
                    }
                    else{
                        $error = true;
                        $data_error[$champRequis[$i]]= $champRequis_erreur[$i];
                    }
                }
                if($this->input->post('input_date')){
                    
                    $dataRecup['date'] = $this->input->post('input_date');
                    if(isset($dataRecup['date'])){
                        list($day, $month, $year) = preg_split('/[-\.\/ ]/', $dataRecup['date']);
                        $data['date'] = $year.'-'.$month.'-'.$day;
                    }
                }
                else{
                    $error = true;
                    $data_error["date"]='la date';
                }
            
            //autres infos    
                $champ = array('conducteur','description_depart','description_arrivee','flexibilite','places');
                
                for($i=0;$i<count($champ);$i++){
                    if($this->input->post('input_'.$champ[$i]) != ""){
                        $data[$champ[$i]] = $this->input->post('input_'.$champ[$i]);
                    }
                }
                
                if($this->input->post('input_commentaire')){
                    $data['commentaire'] = $this->input->post('input_commentaire');
                }

                if($this->input->post('input_regulier')){
                    $data['regulier'] = $this->input->post('input_regulier');
                    
                    for($i=0;$i<7;$i++){
                        if($this->input->post('input_allee'.$i)){
                            $allee[$i] = $this->input->post('input_allee'.$i) ;
                        }
                        else{
                            $allee[$i] = "";
                        }
                    }
                    
                    $calendar_allee = '[{"allee":{"l":"'.$allee[0].'","m":"'.$allee[1].'","me":"'.$allee[2].'","j":"'.$allee[3].'","v":"'.$allee[4].'","s":"'.$allee[5].'","d":"'.$allee[6].'"}';
                    if($this->input->post('input_retour')){
                        for($i=0;$i<7;$i++){
                            if($this->input->post('input_retour'.$i)){
                                $retour[$i] = $this->input->post('input_retour'.$i);
                            }
                            else{
                                $retour[$i] = "";
                            }
                        } 
                        $data['calendar'] = $calendar_allee.',"retour":{"l":"'.$retour[0].'","m":"'.$retour[1].'","me":"'.$retour[2].'","j":"'.$retour[3].'","v":"'.$retour[4].'","s":"'.$retour[5].'","d":"'.$retour[6].'"}}]';                
                    }
                    else{
                        $data['calendar'] = $calendar_allee.'}]';  
                    }
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
                
                if($this->input->post('input_prix')){
                    $data['prix'] = $this->input->post('input_prix');
                }
                else{
                    if(isset($data['prix_conseil'])){
                        $data['prix'] = $data['prix_conseil'];
                    }
                }
            //json parcours
                if($this->input->post('input_coord')){
                    $coord = $this->input->post('input_coord');
                    $dataCoord = json_decode($coord);
                }
                else { 
                    $dataCoord = false;
                    $error = true;
                }
            
            //etapes
                $etape=$etapes=$recupEtapes=array();
                for($i=0;$i<5;$i++){
                    if($this->input->post('input_etape_'.$i)){
                        $etape["villeID"]=intval($this->input->post('input_etapeID_'.$i));
                        $etape["stop"]=intval($this->input->post('input_stop_'.$i));
                        $etape["duree"]=intval($this->input->post('input_duree_'.$i));
                        array_push($etapes,$etape);
                        $etape['ville']= $this->input->post('input_etape_'.$i);
                        $etape['lat']= $this->input->post('input_etape_lat_'.$i);
                        $etape['lng']= $this->input->post('input_etape_lng_'.$i);
                        array_push($recupEtapes,$etape);
                        $etape=array();
                    }
                }
                
                if(count($etapes) == 0){
                    $etapes = false;
                }                
                
            //Recuperation donnée
                if(isset($error)){
                
                //infos a recup pour rechargement
                    $champRecup = array('depart','depart_lat','depart_lng','arrivee','arrivee_lat','arrivee_lng','carbu');

                    for($i=0;$i<count($champRecup);$i++){
                        if($this->input->post('input_'.$champRecup[$i]) != ""){
                            $dataRecup[$champRecup[$i]] = $this->input->post('input_'.$champRecup[$i]);
                        }
                    }
                    
                //copie des infos deja recuperer   
                    $champDonnee = array(
                        'conducteur',
                        'departID',
                        'description_depart',
                        'arriveeID',
                        'description_arrivee',
                        'flexibilite',
                        'heure',
                        'places',
                        'retour',
                        'regulier',
                        'calendar',
                        'commentaire',
                        'prix_conseil',
                        'prix'
                    );

                    for($i=0;$i<count($champDonnee);$i++){
                        if(isset($data[$champDonnee[$i]])){
                            $dataRecup[$champDonnee[$i]] = $data[$champDonnee[$i]];
                        }
                    }

                    $dataRecup['etapes'] = $recupEtapes;
                    
                    //var_dump($dataRecup);
                    $this->session->set_userdata('dataRecup',$dataRecup);
                    $this->session->set_userdata('dataError',$data_error);
                    redirect('annonce/ajouter');
                }
                else {
                    $this->M_Annonce->ajouter($data,$dataCoord,$etapes);
                    //redirect('annonce/fiche/');
                }
            }
        }
}