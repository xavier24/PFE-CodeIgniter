<?php

    class M_Annonce extends CI_Model
    {
        public function lister()
	{
            $this->db->select('*');
            $this->db->from('annonces');
            $this->db->join('users','users.user_id = annonces.user_id');
            
           
            $query = $this->db->get();
            return $query->result();
                    
	}
        
        public function voir($idAnnonce)
        {
            $this->db->select('*');
            $this->db->from('annonces');
            $this->db->join('users','users.user_id = annonces.user_id');
            $this->db->where('annonces.id',$idAnnonce);
            
            $query = $this->db->get();
            return $query->row();
        }
        
        public function user($idUser){
            $this->db->select('*');
            $this->db->from('annonces');
            $this->db->join('users','users.user_id = annonces.user_id');
            $this->db->where('annonces.user_id',$idUser);
            
            $query = $this->db->get();
            return $query->result();
            
        }
    }