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
            
            $id_facebook = end($this->uri->segments);
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
        
    //DATE DERNIERE CONNEXION
        public function lastConnex($user_data){
            $this->load->model('M_User');
            date_default_timezone_set("Europe/Paris");
            $data['connected_at'] = date("Y-m-d H:i:s");
            $this->M_User->modifier($data,$user_data->user_id);
        }
}
