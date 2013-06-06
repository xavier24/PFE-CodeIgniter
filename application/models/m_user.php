<?php

    class M_User extends CI_Model{
        
        //verifier pour la connexion
		public function verifier($data){
           $query = $this->db->get_where('users',
                                            array('email'=>$data['email'],
                                                    'password'=>$data['mdp']));
            return $query->num_rows();      
		}
		//recupere les infos de l'utilisateur connecté
		public function getIdMembre($data){
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('email',$data);
            $query = $this->db->get();
            return $query->row();
        }
		//recupere les infos de l'utilisateur selectionné
		public function user($idUser){
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('user_id',$idUser);
            
            $query = $this->db->get();
            return $query->row(); 
        }
		//recupere les annonces de l'utilisateur selectionné
        public function trajet($idUser){
            $this->db->select('*');
            $this->db->from('annonces');
            $this->db->where('annonces.user_id',$idUser);
            
            $query = $this->db->get();
            return $query->result(); 
        }
    }