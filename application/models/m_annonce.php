<?php

    class M_Annonce extends CI_Model
    {
        public function lister()
	{
            $this->db->select('annonces.*,users.*, users.id as id_user');
            $this->db->from('annonces');
            $this->db->join('users','users.id = annonces.user_id');
            
           
            $query = $this->db->get();
            return $query->result();
                    
	}
        
        public function voir($id)
        {
            $this->db->select('profs.*, specs.nom as specialite, specs.spec_id as sspec_id');
            $this->db->from('profs');
            $this->db->join('specs','profs.spec_id = specs.spec_id');
            $this->db->where('profs.prof_id',$id);
            
            $query = $this->db->get();
            return $query->row();
        }
    }