<?php

    class M_Accueil extends CI_Model{
        
        public function lister(){
            $this->db->select('*');
            $this->db->from('annonces');
            $this->db->join('users','users.user_id = annonces.user_id');
            
           
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
        public function verifier($data){
           $query = $this->db->get_where('users',
                                            array('email'=>$data['email'],
                                                    'password'=>$data['mdp']));
            return $query->num_rows();      
	}
        public function getIdMembre($data){
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('email',$data);
            $query = $this->db->get();
            return $query->row();
        }
    }