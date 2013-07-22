<?php

class M_Annonce extends CI_Model{
    

        public function lister($recherche){
            /*$this->db->select('*');
            $this->db->from('annonces');
            $this->db->join('users','users.user_id = annonces.user_id');
            $this->db->join('users','users.user_id = annonces.user_id');
            $this->db->where('departID',$recherche['depart']);
            // $this->db->where('places >',$recherche['places']-1);
            // $this->db->or_where('arriveeID',$recherche['arrivee']);
            
            $this->db->order_by('date','asc');
            $this->db->order_by('depart','asc');
            */
            $this->db->select('annonces.*, users.*,
                depart.id AS d_ID, depart.fr_FR AS d_fr_FR, depart.nl_NL AS d_nl_NL, 
                depart.code_postal AS d_code_postal, depart.province AS d_province,
                depart.latitude AS d_lat, depart.longitude AS d_long,			
                arrivee.id AS a_ID, arrivee.fr_FR AS a_fr_FR, arrivee.nl_NL AS a_nl_NL, 
                arrivee.code_postal AS a_code_postal, arrivee.province AS a_province,
                arrivee.latitude AS a_lat, arrivee.longitude AS a_long');
            $this->db->from('annonces');
            $this->db->join('villes AS depart','depart.id = annonces.departID');
            $this->db->join('villes AS arrivee','arrivee.id = annonces.arriveeID');
            $this->db->join('users','users.user_id = annonces.user_id');
            $this->db->where('depart.id',$recherche['depart']);
            /*
            SELECT annonces.*, 
            depart.id AS d_ID, depart.fr_FR AS d_fr_FR, depart.nl_NL AS d_nl_NL, 
            depart.CodePostal AS d_codePostal, depart.Province AS d_province,
            depart.Latitude AS d_lat, depart.Longitude AS d_long,

            arrivee.id AS a_ID, arrivee.fr_FR AS a_fr_FR, arrivee.nl_NL AS a_nl_NL, 
            arrivee.CodePostal AS a_codePostal, arrivee.Province AS a_province,
            arrivee.Latitude AS a_lat, arrivee.Longitude AS a_long

            FROM annonces
            INNER JOIN villes AS depart
            ON annonces.departID = depart.id
            INNER JOIN villes AS arrivee
            ON annonces.arriveeID = arrivee.id
            */
            
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
        
        public function ajouter($data){
            $this->db->insert('annonces',$data);
        }
        
        public function villes(){
            $this->db->select('*');
            $this->db->from('villes');

            $query = $this->db->get();
            return $query->result();
        }
}
