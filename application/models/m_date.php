<?php

class M_Date extends CI_Model {
        
        function __construct(){
            parent::__construct();
            $this->load->helper('date');
        }
        
        //CALCULER AGE   
    public function age($date){ // donner 1987-08-17 => retourne 17/08/1987
        
        // Date d'aujourd'hui 
        $jour = date("d",time()); 
        $mois = date("m",time()); 
        $annee = date("Y",time()); 
        // Détermination de l'âge 
        $age = explode("-", $date); 
        if ($jour >= $age[2] and $mois = $age[1] or $mois > $age[1]){ 
            $age = $annee - $age[0]; 
        } 
        else { 
            $age = $annee - $age[0] - 1; 
        }
        return $age;
    }
//Convertir une date US vers une date en français affichant le jour de la semaine
    public function dateLongue($date,$annee = 'yes',$heure = 'yes'){ //donner 1987-08-17,si afficher année, si afficher heure => retourne le 17 aout,1987,l'heure
        
        // Configure le script en français
        setlocale (LC_TIME, 'fr_FR','fra');
        //Définit le décalage horaire par défaut de toutes les fonctions date/heure  
        date_default_timezone_set("Europe/Paris");
        //Definit l'encodage interne
        mb_internal_encoding("UTF-8");

        if($annee == 'yes'){
            if($heure == 'yes'){
                $strDate = mb_convert_encoding('%A %d %B %Y à %Hh%M','ISO-8859-9','UTF-8');  
            }
            else{
                $strDate = mb_convert_encoding('%A %d %B %Y','ISO-8859-9','UTF-8');    
            }
        }
        else {
            if($heure == 'yes'){
                $strDate = mb_convert_encoding('%A %d %B à %Hh%M','ISO-8859-9','UTF-8');  
            }
            else{
                $strDate = mb_convert_encoding('%A %d %B','ISO-8859-9','UTF-8');    
            }
        }
        return iconv("ISO-8859-9","UTF-8",strftime($strDate ,strtotime($date))); 
    }
}
