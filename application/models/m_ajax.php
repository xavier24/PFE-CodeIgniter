<?php

class M_ajax extends CI_Model{
    
        public function lister(){
            $this->db->select('*');
            $this->db->from('villes');

            $query = $this->db->get();
            return $query->result();
        }
      
}