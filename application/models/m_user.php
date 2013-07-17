<?php

class M_User extends CI_Model{

    //verifier pour la connexion
    public function verifier($data){
       $query = $this->db->get_where('users',array('email'=>$data['email'],
                                                'password'=>$data['mdp'])
                                                );
       return $query->num_rows();
    }
//recupere les infos de l'utilisateur connecté/selectionné
    public function getUserInfo($champ,$data){
        $this->db->select('users.*, villes.fr_FR AS ville, villes.province, villes.latitude, villes.longitude');
        $this->db->from('users');
        $this->db->join('villes','villes.id = users.villeID');
        $this->db->where($champ,$data);
        $query = $this->db->get();
        return $query->row();
    }
//recupere les annonces de l'utilisateur selectionné
    public function trajet($idUser){
        $this->db->select('annonces.*, depart.fr_FR AS ville_depart, arrivee.fr_FR AS ville_arrivee');
        $this->db->from('annonces');
        $this->db->join('villes AS depart','depart.id = annonces.departID');
        $this->db->join('villes AS arrivee','arrivee.id = annonces.arriveeID');
        $this->db->where('annonces.user_id',$idUser);
        $this->db->limit(5);
        
        $query = $this->db->get();
        return $query->result(); 
    }
    
    public function modifier($data,$id){
        $this->db->where('user_id',$id);		
        $this->db->update('users',$data);
    }
           
    public function villes(){
        $this->db->select('*');
        $this->db->from('villes');

        $query = $this->db->get();
        return $query->result();
    }
}

            /*$this->db->select('annonces.*, users.*,
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
            $this->db->where('depart.id',$recherche['depart']);*/