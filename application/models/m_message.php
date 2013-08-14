<?php
	class M_Message extends CI_Model
	{
		public function voir($data){
			//$sql = "SELECT conversation.*, message.*, users.user_id, users.username, users.nom FROM conversation INNER JOIN message ON (conversation.id_convers = message.id_convers) INNER JOIN users ON message.id_exp = users.user_id WHERE (conversation.id_dest = ? AND conversation.id_exp = ? ) OR (conversation.id_exp = ? AND conversation.id_dest = ? )  ORDER BY date DESC LIMIT 10"; 
                        //return $this->db->query($sql, array($data['contact'],$data['membre'],$data['contact'],$data['membre']))->result();
			
                    
                        $this->db->select('conversation.*, message.*, users.user_id, users.username, users.nom');
			$this->db->from('conversation');
			$this->db->join('message','conversation.id_convers = message.id_convers');
			$this->db->join('users','message.id_exp = users.user_id');
			//$this->db->where('conversation.id_dest',$data['contact']);
			//$this->db->where('conversation.id_exp',$data['membre']);
                        //$this->db->or_where('conversation.id_exp',$data['contact']);
			//$this->db->where('conversation.id_dest',$data['membre']);
                        
                        $this->db->where('conversation.id_dest = '.$data['contact'].' AND conversation.id_exp = '.$data['membre']);
                        $this->db->or_where('conversation.id_exp ='.$data['contact'].' AND conversation.id_dest = '.$data['membre']);
			
                        $query = $this->db->get();
                        return $query->result();
		}

		public function lister($id){
			//SELECT * , CASE id_dest WHEN 1 THEN id_exp ELSE id_dest END AS id_membre FROM `message` WHERE date IN (SELECT max(date) FROM message  WHERE  (id_exp = 1 OR id_dest = 1) GROUP BY id_convers
			//SELECT * FROM message WHERE date IN (SELECT max(date) FROM message WHERE  (id_exp = 1 OR id_dest = 1) GROUP BY id_convers)
			$this->db->select_max('date');
			$this->db->from('message');
			$this->db->join('conversation','message.id_convers = conversation.id_convers');
			$this->db->where('conversation.id_exp',$id);
			$this->db->or_where('conversation.id_dest',$id);
			$this->db->group_by('message.id_convers');
			$data = $this->db->get()->result();
			if($data){
				$info = array();
				foreach ($data as $value) {
					array_push($info,$value->date);
				}
				$this->db->select('*');
				$this->db->from('message');
				$this->db->join('conversation','message.id_convers = conversation.id_convers');
				$this->db->where_in('date',$info);
				$this->db->order_by('date','desc');

				return $this->db->get()->result();
			}
			else{
				return '';
			}
			
		}
		public function correspondant($id){
			$query = $this->db->select('user_id,username,nom,photo')->from('users')->where('user_id',$id)->get();
			return $query->row();
		}

		public function insert($data){
			$data = array(
               'id_convers' => $data->id_convers ,
               'login_exp' => $data->login ,
               'message' => $data->message,
               'date' => $data->date
            );

			return $this->db->insert('message', $data);
		}
	}
?>