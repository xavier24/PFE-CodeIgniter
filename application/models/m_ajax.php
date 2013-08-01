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
}