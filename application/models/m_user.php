<?php

    class M_User extends CI_Model
    {
        public function lister()
	{
            $this->db->select('*');
            $this->db->from('annonces');
            $this->db->join('users','users.user_id = annonces.user_id');
            
           
            $query = $this->db->get();
            return $query->result();
                    
	}
    }