<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->model('M_Message');
		$this->load->model('M_User');
                $this->load->model('M_Ajax');
                
		if( $this->session->userdata('lang') ){
                    $lang = $this->session->userdata('lang');
                    $this->lang->is_loaded = array();
                    $this->lang->language = array();
                    $this->lang->load('trad',$lang);
                }
                
                $user_data = $this->M_Ajax->get_cookie_session_data();
                if(!$user_data){
                    redirect('accueil');
                }
	}
	public function index()
	{
		$this->lister();
	}

	public function lister(){
		$data['user_data'] = $this->M_Ajax->get_cookie_session_data();
		
                //$dataMenu['info'] = $this->M_Profil->voir($data['session']->login);
		$data['conversations'] = $this->M_Message->lister($data['user_data']->user_id);
		
                if($data['conversations']){
			foreach ($data['conversations'] as $value) {
				$correspondant = ($value->id_dest == $data['user_data']->user_id) ? $value->id_exp : $value->id_dest;
				$value->correspondant = $this->M_Message->correspondant($correspondant);
			}
		}
		else{
			$data['conversations'] = '';
		}
		$data['titre'] = "Messagerie";
		$data['body'] = "messagerie";
                var_dump($data['conversations']);
		$dataLayout['vue'] = $this->load->view('messages',$data,true);
		$this->load->view('layout',$dataLayout);
	}
	public function voir($login)
	{
		$data['user_data'] = $this->M_Ajax->get_cookie_session_data();
		$infos['contact'] = $login;
                //$dataMenu['info'] = $this->M_Profil->voir($data['session']->login);
		$infos['membre'] = $data['user_data']->user_id;
                var_dump($infos);
                $data['messages'] = array_reverse($this->M_Message->voir($infos));		
		$data['membres'] = $this->M_Message->correspondant($infos['contact']);
		$data['correspondant'] = $login;
		var_dump($data['messages']);
                
                $data['titre'] = "Agenda";
		$data['body'] = "messagerie";
		$dataLayout['vue'] = $this->load->view('voir_message',$data,true);
		$this->load->view('layout',$dataLayout);
	}

	public function ajouter($login){
		$data->id_convers = $this->input->post('id_convers');
		$data->login = $this->session->userdata('logged_in')->login;
		$data->message = $this->input->post('message');
		$data->date = date('Y-m-d H:i:s');
		$data->correspondant = $login;
		$this->M_Message->insert($data);
		redirect('message/'.$data->correspondant);
	}

}
?>