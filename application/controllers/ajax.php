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
        
        public function lang(){
            
            $lang= end($this->uri->segments);
            $this->session->set_userdata('lang',$lang);
                        
            echo($lang);
        }
        
        function villes(){
            $villes = $this->M_Ajax->lister();
            
            echo $villes;
        }
        
        function dataSession(){
            $dataSession = $this->session->userdata('logged_in');
            
            echo json_encode($dataSession);
        }
}
