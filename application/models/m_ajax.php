<?php

class M_ajax extends CI_Model{
    
        public function lister(){
            $this->db->select('*');
            $this->db->from('villes');

            $query = $this->db->get();
            $villes = $query->result();

            $data = array();
            foreach ($villes as $ville) {

                array_push($data,array("label"=>$ville->fr.'('.$ville->code_postal.')',
                                        "id"=>$ville->id, 
                                        "lat"=>$ville->latitude,
                                        "lng"=>$ville->longitude
                                    )
                        );
                
                if($ville->nl){
                    array_push($data,array("label"=>$ville->nl.'('.$ville->code_postal.')',
                                            "id"=>$ville->id, 
                                            "lat"=>$ville->latitude,
                                            "lng"=>$ville->longitude
                                        )
                    );
                }
            };
            
            return json_encode($data);
        }
        
        public function get_cookie_session_data(){
            $user_data = false;
            if(get_cookie('logged_in')){
                $dataCookie = get_cookie('logged_in');
                $user_data = json_decode($dataCookie);
            }
            else if($this->session->userdata('logged_in')){
                $user_data = $this->session->userdata('logged_in');
            }
            
            return $user_data;
        }
        
        public function set_cookie_session_data($name,$data,$cookie=false){
            
            if($cookie || get_cookie($name)){
                $cookie_data = array(
                    'name'   => $name,
                    'value'  => json_encode($data),
                    'expire' => 7*86500,//7jours 7*86500
                );
                set_cookie($cookie_data);
            }
            else{
                $this->session->set_userdata($name,$data);
            }
            
            return;
        }
        
        public function verifier_facebook($email){
            $query = $this->db->get_where('users',array('email'=>$email) );
            
            return $query->num_rows();
         }
}