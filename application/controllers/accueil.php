<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accueil extends CI_Controller {
    
	function __construct(){
            parent::__construct();
            $this->load->model('M_Accueil');
            $this->load->model('M_Ajax');
            
            if( $this->session->userdata('lang') ){
                $this->lang->is_loaded = array();
                $this->lang->language = array();
                $this->lang->load('trad',$this->session->userdata('lang'));
            }
            var_dump($this->session->userdata('lang'));
        }
        
	public function index(){
         
            $dataList['user_data'] = $this->session->userdata('logged_in');
            
            //$dataList['annonces'] = $this->M_Accueil->lister();
            $this->load->model('M_Ajax');
            $dataList['villes'] = $this->M_Ajax->lister();
            
            if($this->session->userdata('lang')){ 
                $dataList['lang'] = $this->session->userdata('lang');
            }
            else{
                $dataList['lang'] = 'fr';
            }
            
            $dataList['page'] = 'Accueil';
            $dataList['titre'] = 'Accueil';
            $data['vue'] = $this->load->view('accueil',$dataList,true);
            $this->load->view('layout',$data);
	}
        
        public function recherche(){
            $dataList['user_data'] = $this->session->userdata('logged_in');
            //$dataList['villes'] = $this->M_Ajax->lister();
            
        //infos requises
            $error = false;
            $champRequis = array('departID','arriveeID','depart_lat','depart_lng','arrivee_lat','arrivee_lng','conducteur','flexibilite','retour','regulier');
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
                        $data_error[$champRequis[$i]]= "Une erreur est survenue dans votre demande";
                    }
                }
            }
            //calcul les dates flexibilité
            if($this->input->post('input_date') != ""){
                $req['date'] = $this->input->post('input_date');
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
            
            if($error){
                var_dump($req);
                var_dump($data_error);
                //redirect("accueil");
            }
            else{
            //REQUETTE RAYON     
                $resultat['annonces'] = $this->M_Accueil->recherche($req);
                //TRI RESULTAT REQUETTE
                $dataList['annonces'] = array();
                $dataList['rayons'] = array();
                $id_annonce = array();
                foreach($resultat['annonces'] as $annonce){
                    if( (($annonce->d_lat == $req['depart_lat']) && ($annonce->d_lng == $req['depart_lng'])) && (($annonce->a_lat == $req['arrivee_lat']) && ($annonce->a_lng == $req['arrivee_lng'])) ){
                        array_push($dataList['annonces'],$annonce);
                    }
                    else{
                        array_push($dataList['rayons'],$annonce);
                    }
                    array_push($id_annonce, $annonce->id);
                }
            //REQUETTE PARCOURS
                $resultat['parcours'] = $this->M_Accueil->parcours($req);
                //TRI RESULTAT REQUETTE
                $dataList['parcours'] = array();

                foreach($resultat['parcours'] as $annonce){
                    if(!in_array($annonce->id, $id_annonce)){
                        array_push($dataList['parcours'], $annonce);
                    }
                }

                //var_dump($resultat['parcours']);
            
            
                foreach($dataList['annonces'] as $key => $annonce){
                    $annonce->note = 0;
                    $param_verif = array('depart'=>'100','arrivee'=>'80','date'=>'70');
                    foreach($param_verif as $key_array => $value){
                        // if($annonce->$key_array == $recherche[$key_array]){
                            // $annonce->note += $value;
                        // }
                    }
                };

                if($this->session->userdata('lang')){ 
                    $dataList['lang'] = $this->session->userdata('lang');
                }
                else{
                    $dataList['lang'] = 'fr';
                }


                $dataList['ville_depart_lang'] = "d_".$dataList['lang'];
                $dataList['ville_arrivee_lang'] = "a_".$dataList['lang'];

                //var_dump($dataList['annonces']);
                $dataList['page'] = 'Accueil';
                $dataList['titre'] = 'Résultat des recherches';
                $data['vue'] = $this->load->view('recherche',$dataList,true);
                $this->load->view('layout',$data);
            }
        }
}
