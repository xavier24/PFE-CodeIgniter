<?php

    class M_Accueil extends CI_Model{
        
        public function lister(){
            $this->db->select('*');
            $this->db->from('annonces');
            $this->db->join('users','users.user_id = annonces.user_id');
            $this->db->limit(10, 20);
            
           
            $query = $this->db->get();
            return $query->result();
        }
        
        public function voir($idAnnonce){
            $this->db->select('*');
            $this->db->from('annonces');
            $this->db->join('users','users.user_id = annonces.user_id');
            $this->db->where('annonces.id',$idAnnonce);
            
            $query = $this->db->get();
            return $query->row();
        }
        
        public function villes(){
			$this->db->select('*');
            $this->db->from('villes');
            
            $query = $this->db->get();
            return $query->result();
		}
    }