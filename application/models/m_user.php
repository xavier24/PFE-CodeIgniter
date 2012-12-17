<?php

    class M_User extends CI_Model{
        
        public function user($idUser){
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('user_id',$idUser);
            
            $query = $this->db->get();
            return $query->row(); 
        }
        public function trajet($idUser){
            $this->db->select('*');
            $this->db->from('annonces');
            $this->db->where('annonces.user_id',$idUser);
            
            $query = $this->db->get();
            return $query->result(); 
        }
    }