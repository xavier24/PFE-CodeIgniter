<?php

class M_Annonce extends CI_Model{
    

        public function lister($recherche){
            $this->db->select('*');
            $this->db->from('annonces');
            $this->db->join('users','users.user_id = annonces.user_id');
            $this->db->where('depart',$recherche['depart']);
            $this->db->where('places >',$recherche['places']-1);
            $this->db->or_where('arrivee',$recherche['arrivee']);
            
            $this->db->order_by('date','asc');
            $this->db->order_by('depart','asc');
            
            
           
            $query = $this->db->get();
            $nombre = $this->db->count_all_results();
            $resultat = $query->result();
            return $resultat;
        }
        public function voir($idAnnonce){
            $this->db->select('*');
            $this->db->from('annonces');
            $this->db->join('users','users.user_id = annonces.user_id');
            $this->db->where('annonces.id',$idAnnonce);
            
            $query = $this->db->get();
            return $query->row();
        }
}
