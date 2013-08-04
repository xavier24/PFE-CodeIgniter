<?php

class inscription extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('M_Ajax');
        if( $this->session->userdata('lang') ){
            $this->lang->is_loaded = array();
            $this->lang->language = array();
            $this->lang->load('trad',$this->session->userdata('lang'));
        }
    }
    
    public function index(){
        
        $user_data = $this->M_Ajax->get_cookie_session_data();
        if($user_data){
            redirect('accueil');
        }
        else{
            //recuperer si il y a message d'erreur
            $data['message']['error_email'] = $this->session->flashdata('error_email');
            $data['message']['error_exist'] = $this->session->flashdata('error_exist');
            $data['message']['error_mdp'] = $this->session->flashdata('error_mdp');
            $data['message']['error_mdp2'] = $this->session->flashdata('error_mdp2');
            $data['message']['error_majeur'] = $this->session->flashdata('error_majeur');
            //recuperer les données saisis pour les remettre		
            $data['donnee']['email'] = $this->session->flashdata('email');
            $data['donnee']['mdp'] = $this->session->flashdata('mdp');
            $data['donnee']['mdp2'] = $this->session->flashdata('mdp2');
            $data['donnee']['majeur'] = $this->session->flashdata('majeur');
            $data['donnee']['condition'] = $this->session->flashdata('condition');

            $data['main_title'] = 'inscription';
            $data['vue'] = $this->load->view('inscription',$data,TRUE);
            $this->load->view('layout',$data);
        }
    }
    
    public function inscrire(){
        $erreur = false;
		
        $this->load->library('form_validation');
        $this->load->model('M_Inscription');
        //recuperer les données du formulaire
        $data['email'] = $this->input->post('email');
        $data['mdp'] = $this->input->post('mdp');
        $data['mdp2'] = $this->input->post('mdp2');
        $data['majeur'] = $this->input->post('majeur');
        $data['condition'] = $this->input->post('condition');
        
        //date de creation profil
        date_default_timezone_set("Europe/Paris");
        $data['registerDate'] = date("Y-m-d H:i:s");
        
        //verification
        $this->form_validation->set_rules('email', 'Entrez votre adresse email', 'required|valid_email');
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error_email','Veuillez entrer une mail valide !');
            $erreur = True;
        }        
        if($this->M_Inscription->verifier($data)){
            $this->session->set_flashdata('error_exist','L\'adresse Email "'.$data['email'].'" est déjà associée à un compte !');
            $erreur = True;
        }
        //elseif(strlen($data['pseudo'])<2){
            //$this->session->set_flashdata('item','Veuillez entrer un nom d\'au moins 2 caractères !');
            //redirect('inscription');
        //}
        if( strlen($data['mdp'])<5 ){
            $this->session->set_flashdata('error_mdp','Veuillez choisir un mot de passe d\'au moins 5 caractères !');
            // redirect('inscription');
            $erreur = True;
        }
        if(! $data['mdp']===$data['mdp2']){
            $this->session->set_flashdata('error_mdp2', 'Veuillez entrer le même mot de passe !');
            $erreur = True;
        }
        if(!$data['majeur'] || !$data['condition']){
            $this->session->set_flashdata('error_majeur', 'Veuillez accepter !');
            $erreur = True;
        }
        //si un message erreur existe
        if($erreur){
            //mise en session des données du formulaire	
            $this->session->set_flashdata('email',$data['email']);
            $this->session->set_flashdata('mdp',$data['mdp']);
            $this->session->set_flashdata('mdp2',$data['mdp2']);
            $this->session->set_flashdata('majeur',$data['majeur']);
            $this->session->set_flashdata('condition',$data['condition']);
            redirect('inscription');
        }
        // si pas de message d'erreur -> inscription
        else{
            $this->M_Inscription->inscrire($data);
            $user_data = $this->M_Inscription->getIdMembre($data['email']);
            
            $this->M_Ajax->set_cookie_session_data('logged_in',$user_data);
            
            var_dump($user_data);
            //$this->confirmEmail();
            redirect('user/profil/'.$user_data->user_id);
        }
    }
    
    public function confirmEmail(){
        
        $this->load->library('email');

        $this->email->from('xavier24@hotmail.com', 'Your Name');
        $this->email->to('xavier24@hotmail.com');

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');

        $this->email->send();

        echo $this->email->print_debugger();
    }
}


