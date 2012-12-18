<?php

    class M_Inscription extends CI_Model
    {
        public function inscrire($data)
	{
            $this->db->insert('users',array('email'=>$data['email'],'password'=>$data['mdp']));
        }
        public function verifier($data){
            $query = $this->db->get_where('users',array('email'=>$data['email']));
            return $query->num_rows(); 
        }
        public function getIdMembre($data)
        {
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('email',$data);
            $query = $this->db->get();
            return $query->row();
        }
        
    }