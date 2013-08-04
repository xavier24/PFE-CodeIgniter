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
}
