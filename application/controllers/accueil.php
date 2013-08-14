<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accueil extends CI_Controller {
    
	function __construct(){
            parent::__construct();
            $this->load->model('M_Accueil');
            $this->load->model('M_Ajax');
            $this->load->model('M_Date');
            $this->load->helper('date');
            
            if( $this->session->userdata('lang') ){
                $this->lang->is_loaded = array();
                $this->lang->language = array();
                $this->lang->load('trad',$this->session->userdata('lang'));
            }
        }
        
	public function index(){
            
            $dataList['message']['error_search'] = $this->session->flashdata('error_search');
            $dataList['donnee'] = $this->session->flashdata('donnee_search');
            
            //var_dump($dataList['donnee']);
            $dataList['user_data'] = $this->M_Ajax->get_cookie_session_data();
            $dataList['message']['error_login'] = $this->session->flashdata('error_login');
            
            $this->load->model('M_Ajax');
            $dataList['villes'] = $this->M_Ajax->lister();
            
            $today = date("Y-m-d");
            $dataList['annonces'] = $this->M_Accueil->lister($today);
        
            $annonces_lenght = count($dataList['annonces']);
            for($i=0;$i<$annonces_lenght;$i++){
                //APPEL FUNCTION dateLongue: convertir date AA/MM/JJ (ANNONCES) -> Jour date mois année  
                $dataList['annonces'][$i]->date = $this->M_Date->dateLongue($dataList['annonces'][$i]->date,'no','no');
                
                $numero = $i%2;
                if ($numero == 0){
	            $dataList['annonces'][$i]->parite = 0;
	        } else {
	            $dataList['annonces'][$i]->parite = 1;
                }  
                
                
                if($dataList['annonces'][$i]->prix > $dataList['annonces'][$i]->prix_conseil){
                    $dataList['annonces'][$i]->bestprice = 1;
                }
                else{
                    $dataList['annonces'][$i]->bestprice = 0;
                }
            }
            
            //var_dump($dataList['annonces']);
            
            if($this->session->userdata('lang')){ 
                $dataList['lang'] = $this->session->userdata('lang');
            }
            else{
                $dataList['lang'] = 'fr';
            }
            $dataList['ville_depart_lang'] = "d_".$dataList['lang'];
            $dataList['ville_arrivee_lang'] = "a_".$dataList['lang'];
                
            $dataList['page'] = 'Accueil';
            $dataList['body'] = 'accueil';
            $dataList['titre'] = 'Rechercher une annonce';
            $data['vue'] = $this->load->view('accueil',$dataList,true);
            $this->load->view('layout',$data);
	}
        
        public function recherche(){
            
        //infos requises
            $error = false;
            $champRequis = array('departID','arriveeID','depart','arrivee','depart_lat','depart_lng','arrivee_lat','arrivee_lng','conducteur','flexibilite');
            $champRequis_erreur = array('le départ','l\'arrivée');
            for($i=0;$i<count($champRequis);$i++){
                if($this->input->post('input_'.$champRequis[$i]) != ""){
                    $req[$champRequis[$i]] = $this->input->post('input_'.$champRequis[$i]);
                }
                else{
                    $error = true;
                    if($i<2){
                        $data_error[$champRequis[$i]]= $champRequis_erreur[$i];
                    }
                    else{
                        $data_error['other']= "Une erreur est survenue dans votre demande";
                    }
                }
            }
        //autres infos
            $champ = array('retour','regulier');
            for($i=0;$i<count($champ);$i++){
                if($this->input->post('input_'.$champ[$i])!= 0){
                    $req[$champ[$i]] = $this->input->post('input_'.$champ[$i]);
                }
            }
            if($this->input->post('input_date')!= ""){
                $req['date'] = $this->input->post('input_date');
            }
        
        //SUITE   
            if($error){
                var_dump($req);
                var_dump($data_error);
                $this->session->set_flashdata('error_search',$data_error);
                $this->session->set_flashdata('donnee_search',$req);
                redirect("accueil");
            }
            else{
                $redirect = '?depart='.$req['depart'].'&dID='.$req['departID'].'&arrivee='.$req['arrivee'].'&aID='.$req['arriveeID'].'&c='.$req['conducteur'];
                
                if(isset($req['date'])){
                    $redirect.='&date='.$req['date'].'&f='.$req['flexibilite'];
                }
                if(isset($req['retour'])){
                    $redirect.='&r='.$req['retour'];
                }
                if(isset($req['regulier'])){
                    $redirect.='&rg='.$req['regulier'];
                }
                
                var_dump($req);
                var_dump($redirect);
                redirect('accueil/resultat'.$redirect);
            }
        }
        
        public function resultat(){
            $this->load->library('pagination');
            
            $dataList['user_data'] = $this->M_Ajax->get_cookie_session_data();
            
            $this->load->model('M_Ajax');
            $dataList['villes'] = $this->M_Ajax->lister();
            
        //recuperation donnée url GET
            $getChamp = array('dID','aID','c','f','date','r','rg');
            $donneeChamp = array('departID','arriveeID','conducteur','flexibilite','date','retour','regulier');
            for($i=0;$i<count($getChamp);$i++){
                if(isset($_GET[$getChamp[$i]])){
                    $req[$donneeChamp[$i]] = $_GET[$getChamp[$i]];
                }
            }
            //valeur pagination
            $pagination = 1;
            $page = $page_annonces = $page_rayons = $page_parcours = 1;
            if(isset($_GET['page'])){
                $page = $_GET['page'];
            }
            if(isset($_GET['a_page'])){
                $page_annonces = $_GET['a_page'];
            }
            if(isset($_GET['r_page'])){
                $page_rayons = $_GET['r_page'];
            }
            if(isset($_GET['p_page'])){
                $page_parcours = $_GET['p_page'];
            }
            
        //recup coordonnée depuis ID ville    
            $depart = json_decode($this->M_Ajax->lister($req['departID']));
            $arrivee = json_decode($this->M_Ajax->lister($req['arriveeID']));
            
            $req['depart_lat'] = $depart[0]->lat;
            $req['depart_lng'] = $depart[0]->lng;
            $req['arrivee_lat'] = $arrivee[0]->lat;
            $req['arrivee_lng'] = $arrivee[0]->lng;
            
        //calcul les dates flexibilité
             if(isset($req['date'])){
                $flex = $req['flexibilite'];
                $date = str_replace("/", "-", $req['date']);
                $time_date = strtotime($date);
                $date_min = date("d-m-Y",$time_date-($flex*24*3600));
                $date_max = date("d-m-Y",$time_date+($flex*24*3600));
                
                $date_min = explode("-", $date_min);
                $date_max = explode("-", $date_max);
                
                $req['date_min'] = $date_min[2].'-'.$date_min[1].'-'.$date_min[0];
                $req['date_max'] = $date_max[2].'-'.$date_max[1].'-'.$date_max[0];
            }
            
    //REQUETTE RAYON 
            $today = date("Y-m-d");
            $resultat['annonces'] = $this->M_Accueil->recherche($req,$today);
            //var_dump(count($resultat['annonces']));
        //PARTAGE RESULTAT REQUETTE
            $tri_annonces = array();
            $tri_rayons = array();
            $dataList['annonces'] = array();
            $dataList['rayons'] = array();
            $triParcours = array();
            $dataList['parcours'] = array();
            $id_annonce = array();
            //var_dump($resultat['annonces']);
            
            for($i=0 ;$i < count($resultat['annonces']) ;$i++){
                $annonce = $resultat['annonces'][$i];
                if( (($annonce->d_lat == $req['depart_lat']) && ($annonce->d_lng == $req['depart_lng'])) && (($annonce->a_lat == $req['arrivee_lat']) && ($annonce->a_lng == $req['arrivee_lng'])) ){
                    array_push($tri_annonces,$annonce);
                }
                else{
                    array_push($tri_rayons,$annonce);
                }
                array_push($id_annonce, $annonce->id);
            }    
       
    //REQUETTE PARCOURS
            $resultat['parcours'] = $this->M_Accueil->parcours($req,$today);
            //var_dump(count($resultat['parcours']));
            
    //RECUPERATION NOMBRE POUR PAGINATION      
        //ANNONCES        
            for($i=0 ;$i < count($tri_annonces) ;$i++){
                
                if($i >= ($pagination*($page-1)-1+$pagination) && $i <($pagination*$page)-1+$pagination){
                    $annonce = $tri_annonces[$i];
                    
                    if($annonce->prix > $annonce->prix_conseil){
                        $annonce->bestprice = 1;
                    }
                    else{
                        $annonce->bestprice = 0;
                    }
                    $annonce->date = $this->M_Date->dateLongue($annonce->date,'no','no');
                    array_push($dataList['annonces'],$annonce);
                }
            }
       //RAYONS
            for($i=0 ;$i < count($tri_rayons) ;$i++){
                
                if( $i >= ($pagination*($page-1)-1+$pagination) && $i <($pagination*$page)-1+$pagination){
                    $annonce = $tri_rayons[$i];
                    
                    if($annonce->prix > $annonce->prix_conseil){
                        $annonce->bestprice = 1;
                    }
                    else{
                        $annonce->bestprice = 0;
                    }
                    $annonce->date = $this->M_Date->dateLongue($annonce->date,'no','no');
                    array_push($dataList['rayons'],$annonce);
                }
            }     
            
        //PARCOURS
            foreach($resultat['parcours']as $annonce){
                if(!in_array($annonce->id, $id_annonce)){
                   array_push($triParcours,$annonce); 
                }
            }
            
            for($i=0 ;$i < count($triParcours) ;$i++){
                if($i >= ($pagination*($page-1)-1+$pagination) && $i <($pagination*$page)-1+$pagination){
                    $annonce = $triParcours[$i];
               
                    if(!in_array($annonce->id, $id_annonce)){
                        if($annonce->prix > $annonce->prix_conseil){
                            $annonce->bestprice = 1;
                        }
                        else{
                            $annonce->bestprice = 0;
                        }
                        $annonce->date = $this->M_Date->dateLongue($annonce->date,'no','no');

                        array_push($dataList['parcours'], $annonce);
                    }
                }
            }
            //var_dump($dataList['parcours']);      
    
    //PAGINATION
            $count_annonces = count($tri_annonces);
            $count_rayons = count($tri_rayons);
            $count_parcours = count($resultat['parcours'])-$count_annonces-$count_rayons;
            $count_max = max($count_annonces,$count_rayons,$count_parcours); 
        
            if($count_max>$pagination){
                $current_url = preg_replace('/&page=\d/','',urldecode($_SERVER['QUERY_STRING']));
                $config['base_url'] = current_url()."?".$current_url;
                $config['num_links'] = '10';
                $config ['page_query_string'] = true;
                $config ['query_string_segment'] = 'page';
                $config['first_url']=current_url()."?".$current_url.'&page=1';
                $config['use_page_numbers'] = true;
                $config['total_rows'] = $count_max;
                $config['per_page'] = $pagination;
                $this->pagination->initialize($config);

                $dataList['pagination'] = $this->pagination->create_links();
            }
            
            
            
        /*
        //PAGINATION ANNONCES
            $count_annonces = count($tri_annonces);
            if($count_annonces>$pagination){
                $current_url = preg_replace('/&a_page=\d/','',urldecode($_SERVER['QUERY_STRING']));
                $config['base_url'] = current_url()."?".$current_url;
                $config['num_links'] = '10';
                $config ['page_query_string'] = true;
                $config ['query_string_segment'] = 'a_page';
                $config['first_url']=current_url()."?".$current_url.'&a_page=1';
                $config['use_page_numbers'] = true;
                $config['total_rows'] = $count_annonces;
                $config['per_page'] = $pagination;
                $this->pagination->initialize($config);

                $dataList['pagination']['annonces'] = $this->pagination->create_links();
            }
            
    
        
        //PAGINATION RAYON
            $count_rayons = count($tri_rayons);
            if($count_rayons>$pagination){
                $current_url = preg_replace('/&r_page=\d/','',urldecode($_SERVER['QUERY_STRING']));
                $config['base_url'] = current_url()."?".$current_url;
                $config['num_links'] = '10';
                $config ['page_query_string'] = true;
                $config ['query_string_segment'] = 'r_page';
                $config['first_url']=current_url()."?".$current_url.'&r_page=1';
                $config['use_page_numbers'] = true;
                $config['total_rows'] = $count_rayons;
                $config['per_page'] = $pagination;
                $this->pagination->initialize($config);

                $dataList['pagination']['rayons'] = $this->pagination->create_links();
            }
            
    
        //PAGINATION PARCOURS
            $count_parcours = count($this->M_Accueil->parcours($req,$today))-$count_rayons-$count_annonces;
            //var_dump($count_parcours);
            $config= array();
            
            if($count_parcours>$pagination){
                $current_url = preg_replace('/&p_page=\d/','',urldecode($_SERVER['QUERY_STRING']));
                $config['base_url'] = current_url()."?".$current_url;
                $config['num_links'] = '10';
                $config ['page_query_string'] = true;
                $config['first_url']=current_url()."?".$current_url.'&p_page=1';
                $config ['query_string_segment'] = 'p_page';
                $config['use_page_numbers'] = true;
                $config['total_rows'] = $count_parcours;
                $config['per_page'] = $pagination;
                $this->pagination->initialize($config);

                $dataList['pagination']['parcours'] = $this->pagination->create_links();       
            }*/
            
        //LANGUES    
            if($this->session->userdata('lang')){ 
                $dataList['lang'] = $this->session->userdata('lang');
            }
            else{
                $dataList['lang'] = 'fr';
            }
            if($dataList['lang'] == 'fr'){
                $req['depart'] = $depart[0]->label;
                $req['arrivee'] = $arrivee[0]->label;
            }
            else{
                $req['depart'] = $depart[1]->label;
                $req['arrivee'] = $arrivee[1]->label;
            }
            $dataList['ville_depart_lang'] = "d_".$dataList['lang'];
            $dataList['ville_arrivee_lang'] = "a_".$dataList['lang'];
            
            //var_dump($dataList['annonces']);
            $dataList['page'] = 'Accueil';
            $dataList['body'] = 'resultat';
            $dataList['titre'] = 'Résultat des recherches';
            $dataList['total_annonce'] = $count_annonces + $count_rayons + $count_parcours;
            $dataList['soustitre'] = $req['depart'].' - '.$req['arrivee'];
            $data['vue'] = $this->load->view('recherche',$dataList,true);
            $this->load->view('layout',$data);
            
        }
}
