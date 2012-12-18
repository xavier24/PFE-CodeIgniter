<?php

class inscription extends CI_Controller {
    
    public function index(){
        $data['message']['error_email'] = $this->session->flashdata('error_email');
        $data['message']['error_exist'] = $this->session->flashdata('error_exist');
        $data['message']['error_mdp'] = $this->session->flashdata('error_mdp');
        $data['message']['error_mdp2'] = $this->session->flashdata('error_mdp2');
        $data['main_title'] = 'inscription';
        $data['vue'] = $this->load->view('inscription',$data,TRUE);
        $this->load->view('layout',$data);
    }
    
    public function inscrire(){
        $this->load->library('form_validation');
        $this->load->model('M_Inscription');
        $data['email'] = $this->input->post('email');
        $data['mdp'] = $this->input->post('mdp');
        $data['mdp2'] = $this->input->post('mdp2');
       
        $this->form_validation->set_rules('email', 'Entrez votre adresse email', 'required|valid_email');
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error_email','Veuillez entrer une mail valide !');
            //redirect('inscription');
        }        
        if($this->M_Inscription->verifier($data)){
            $this->session->set_flashdata('error_exist','L\'adresse Email "'.$data['email'].'" est déjà associée à un compte !');
            //redirect('inscription');
        }
        //elseif(strlen($data['pseudo'])<2){
            //$this->session->set_flashdata('item','Veuillez entrer un nom d\'au moins 2 caractères !');
            //redirect('inscription');
        //}
        if( strlen($data['mdp'])<5 ){
            $this->session->set_flashdata('error_mdp','Veuillez choisir un mot de passe d\'au moins 5 caractères !');
            //redirect('inscription');
        }
        if($data['mdp']===$data['mdp2']){
            $this->M_Inscription->inscrire($data);
            $info_membre = $this->M_Inscription->getIdMembre($data['email']);
            $this->session->set_userdata('logged_in',$info_membre);
            redirect(site_url());
        }
        else{
            $this->session->set_flashdata('error_mdp2', 'Veuillez entrer le même mot de passe !');
            redirect('inscription');
        }
    }
}


