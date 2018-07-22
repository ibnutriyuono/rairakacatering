<?php
	class User_model extends CI_Model{
		public function register($enc_password){
			// User data array
			$data = array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
				'password' => $enc_password,
				'alamat' => $this->input->post('address')
			);

			// Insert user
			return $this->db->insert('users', $data);
		}

		// Log user in
		public function login($username, $password){
			// Validate
			$this->db->where('username', $username);
			$this->db->where('password', $password);

			$result = $this->db->get('users');

			if($result->num_rows() == 1){
				return $result->row(0)->user_id;
			} else {
				return false;
			}
		}

		// Check username exists
		public function check_username_exists($username){
			$query = $this->db->get_where('users', array('username' => $username));
			if(empty($query->row_array())){
				return true;
			} else {
				return false;
			}
		}

		// Check email exists
		public function check_email_exists($email){
			$query = $this->db->get_where('users', array('email' => $email));
			if(empty($query->row_array())){
				return true;
			} else {
				return false;
			}
		}

		public function get_user($username){
			$query = $this->db->get_where('user', ['name' => $username]);
			return $query->row();
		}

		public function load_user($username){
			$query = $this->db->query("SELECT order.user_id,username,id_order,posts.id,title,kirim,bayar,NAME,email,subtotal,alamat,kirim,bayar,
			DAY(register_date) AS 'Hari',MONTH(register_date) AS 'Bulan',YEAR(register_date) AS 'Tahun',qty
			FROM db_sbd.Order
			INNER JOIN users ON db_sbd.`order`.`user_id`=users.`user_id`
			INNER JOIN posts ON db_sbd.`order`.`id`=posts.`id`
			WHERE users.`username` ='$username';");

			return $query->result_array();
		}

		public function update_bayar($id){
			$this->db->set('bayar', '1', FALSE);
			$this->db->where('order.id_order', $id);
			$this->db->update('db_sbd.order'); 
			// UPDATE db_sbd.order SET kirim = 1 WHERE user_id = 1
		}
	}