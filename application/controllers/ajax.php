<?php

class Ajax extends CI_Controller {
        
        function __construct(){
            parent::__construct();
            $this->load->model('M_Ajax');
        }
        
        function villes(){
            $dataList['villes'] = $this->M_Ajax->lister();
               
            $data = array();
            foreach ($dataList['villes'] as $ville) { 
                array_push($data,array("label"=>$ville->fr_FR.'('.$ville->code_postal.')',
                                    "id"=>$ville->id, 
                                    "lat"=>$ville->latitude,
                                    "lng"=>$ville->longitude
                                )
                        );
            };
            
            echo json_encode($data);
        }
        
        function dataSession(){
            $dataSession = $this->session->userdata('logged_in');
            
            echo json_encode($dataSession);
        }
}
