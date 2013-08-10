<?php

class Ajax extends CI_Controller {
        
        function __construct(){
            parent::__construct();
            $this->load->model('M_Ajax');
            
            if($this->session->userdata('lang')){
                $this->lang->is_loaded = array();
                $this->lang->language = array();
                $this->lang->load('trad',$this->session->userdata('lang'));
            }
        }
    //CHANGER LANGUE    
        public function lang(){
            
            $lang= end($this->uri->segments);
            $this->session->set_userdata('lang',$lang);
                        
            echo($lang);
        }
    //RECUPERER VILLES    
        function villes(){
            $villes = $this->M_Ajax->lister();
                        
            echo $villes;
        }
    //RECUPERER SI CONNECTE    
        function dataSession(){
            if(get_cookie('logged_in')){
                $dataCookie = get_cookie('logged_in');
                $dataSession = json_decode($dataCookie);
            }
            else{
                $dataSession = $this->session->userdata('logged_in');
            }
            
            
            echo json_encode($dataSession);
        }
        
        function facebook_login(){
            $this->load->model('M_User');
            
            //$id_facebook = end($this->uri->segments);
            $email_facebook = $_POST[ "email" ];
            
            if(!get_cookie('logged_in') && !$this->session->userdata('logged_in')){
                if($this->M_Ajax->verifier_facebook($email_facebook)){

                    $user_data = $this->M_User->getUserInfo('email',$email_facebook);
                    $user_data->facebook = true;
                    $this->M_Ajax->set_cookie_session_data('logged_in',$user_data);
                    $this->lastConnex($user_data);
                    echo true;
                }
                else{
                    echo 0;
                }
            }
            else{
                echo 0;
            }
        }
        
        function facebook_logout(){
            $user_data = $this->M_Ajax->get_cookie_session_data();
        
            if($user_data){
                delete_cookie('logged_in');
                $this->session->unset_userdata('logged_in');
            
                $this->lastConnex($user_data);
                echo true;
            }
            else{
                echo 0;
            }
        }
        
        function facebook_register(){
            $this->load->model('M_User');
            $this->load->model('M_Email');
            $error = "";
            
            $data['email_facebook'] = $_POST[ "email" ];
            $data['id_facebook'] = $_POST[ "id" ];
            $data['username']= $_POST["prenom"];
            $data['nom']= $_POST["nom"];
            $data['sexe']= $_POST["sexe"];
            $data['naissance']= $_POST["naissance"];
            
            if($data['sexe']=="male"){
                $data['sexe'] = 0 ;
            }
            else{
                $data['sexe'] = 1;
            }
                        
            if($data['naissance']){
                $date = $data['naissance'];
                list($month, $day, $year) = preg_split('/[-\.\/ ]/', $date);
                $data['naissance'] = $year.'-'.$month.'-'.$day;                
            }
            
            $data['mdp'] = $this->M_Ajax->genererMDP();
            
            //date de creation profil
            date_default_timezone_set("Europe/Paris");
            $data['registerDate'] = date("Y-m-d H:i:s");
            
            if(!get_cookie('logged_in') && !$this->session->userdata('logged_in')){
                if(!$this->M_Ajax->verifier_facebook($data['email_facebook'])){
                    $this->M_Ajax->inscrire($data);
                    
                    $user_data = $this->M_Ajax->getIdMembre($data['email_facebook']);
                    $user_data->facebook = true;
                    $this->M_Ajax->set_cookie_session_data('logged_in',$user_data);
                    
                    echo $user_data->user_id;
                    return;
                }
                else{
                    $error = "Vous étes déjà inscrit sous cet email. Connectez vous.";
                }
            }
            else{
                $error = "Vous étes déjà connecté.";
            }
            
            if($error != ""){
                $this->session->set_flashdata('error_facebook_register',$error);
            }
            
            $dataEmail['titre'] = 'Bienvenue '.$data['username'];
            $dataEmail['type'] = 'register';
            $dataEmail['email'] = $data['email_facebook'];
            $dataEmail['username'] = $data['username'];
            $dataEmail['mdp'] = $data['mdp'];
            
            $this->M_Email->sendEmail($dataEmail);
            
            echo false;
            
        }
        
        
    //DATE DERNIERE CONNEXION
        public function lastConnex($user_data){
            $this->load->model('M_User');
            date_default_timezone_set("Europe/Paris");
            $data['connected_at'] = date("Y-m-d H:i:s");
            $this->M_User->modifier($data,$user_data->user_id);
        }
}
