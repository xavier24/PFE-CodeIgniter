<?php

class M_email extends CI_Model{

    public function sendEmail($data){
        
        $this->load->library('email');
        $config['charset'] = 'utf_8';
        $config['mailtype']  = 'html';
        
        $this->email->set_newline("\r\n");
        $this->email->initialize($config);
        $this->email->from('noreply@car-people.be', 'Car People');
        $this->email->to($data['email']);

        $this->email->subject($data['titre']);
        $this->email->message($this->load->view('email/'.$data['type'].'-html', $data, TRUE));
        //$this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));


        $this->email->send();
    }

    public function confirm($str, $id){
        $query = $this->db->get_where('users',array('confirm'=>$str,'user_id'=>$id));
        return $query->num_rows();
    }
    
    public function valid($id){
        $data = array('verifier'=>1);
        $this->db->where('user_id',$id);		
        $this->db->update('users',$data);
    }
}