<?php
	class Admin_model extends CI_Model{

		public function get(){
			return $this->db->get('user');
		}

		public function register($enc_password){
			// User data array
			$data = array(
				'admin_name' => $this->input->post('name'),
				// 'email' => $this->input->post('email'),
                'admin_username' => $this->input->post('username'),
                'admin_password' => $enc_password
			);

			// Insert user
			return $this->db->insert('admin', $data);
		}

		// Log user in
		public function login($username, $password){
			// Validate
			$this->db->where('admin_username', $username);
			$this->db->where('admin_password', $password);

			$result = $this->db->get('admin');

			if($result->num_rows() == 1){
				return $result->row(0)->admin_id;
			} else {
				return false;
			}
		}

		// Check username exists
		public function check_username_exists($username){
			$query = $this->db->get_where('admin', array('admin_username' => $username));
			if(empty($query->row_array())){
				return true;
			} else {
				return false;
			}
		}

		// Check email exists
		function caridata(){
			$c = $this->input->POST ('cari');
			$this->db->or_like('name', $c);	
			$this->db->or_like('user_id', $c);	
			$this->db->or_like('email', $c);
			$this->db->or_like('register_date', $c);
			$this->db->or_like('alamat', $c);
			$query = $this->db->get ('users');
			return $query->result(); 
		}

		function caridata_order(){
			$c = $this->input->POST('cari');
			$this->db->or_like('title', $c);	
			$this->db->or_like('order.user_id', $c);	
			$this->db->or_like('email', $c);
			$this->db->or_like('register_date', $c);
			$this->db->or_like('alamat', $c);
			$this->db->or_like('qty', $c);
			$this->db->or_like('subtotal', $c);
			$this->db->or_like('kirim', $c);
			$this->db->or_like('bayar', $c);
			$this->db->select('*');
			$this->db->from('order'); 
			$this->db->join ( 'users', 'db_sbd.`order`.`user_id`=users.`user_id`');
			$this->db->join ( 'posts', ' db_sbd.`order`.`id`=posts.`id`' );			
			// $this->db->order_by('c.track_title','asc');         
			$query = $this->db->get(); 
			// return $query->result_array();
			return $query->result(); 
		}

		public function load_order(){
			$query = $this->db->query("SELECT order.user_id,id_order,posts.id,title,kirim,bayar,name,email,subtotal,alamat,
			DAY(register_date) AS 'Hari',MONTH(register_date) AS 'Bulan',YEAR(register_date) AS 'Tahun',qty
			FROM db_sbd.Order
			INNER JOIN users ON db_sbd.`order`.`user_id`=users.`user_id`
			INNER JOIN posts ON db_sbd.`order`.`id`=posts.`id`;");

			return $query->result_array();
		}

		public function load_total(){
			$query = $this->db->query("SELECT SUM(subtotal) AS 'Total'
						FROM db_sbd.Order
						INNER JOIN users ON db_sbd.`order`.`user_id`=users.`user_id`
						INNER JOIN posts ON db_sbd.`order`.`id`=posts.`id`;");
			return $query->result_array();
			
		}

		public function jumlah_order(){
			$query = $this->db->query("SELECT order.user_id,id_order,posts.id,title,kirim,bayar,name,email,subtotal,alamat,
			DAY(register_date) AS 'Hari',MONTH(register_date) AS 'Bulan',YEAR(register_date) AS 'Tahun',qty
			FROM db_sbd.Order
			INNER JOIN users ON db_sbd.`order`.`user_id`=users.`user_id`
			INNER JOIN posts ON db_sbd.`order`.`id`=posts.`id`;");

			return $query->num_rows();
		}

		public function load_produk(){
			$query = $this->db->query("SELECT * FROM posts");
			return $query->result_array();
		}

		function tampilkan(){
         
			$query = $this->db->get('posts');
			return $query->result();    
			
		}


		function data($number,$offset){
			return $query = $this->db->get('users',$number,$offset)->result();		
		}
	 
		function jumlah_data(){
			return $this->db->get('users')->num_rows();
		}

		public function edit_produk($id){
		$query = $this->db->get_where('posts', ['id' => $id]);
		return $query->row();
		}

		public function update_produk($post_image){
		$kondisi = ['id' => $this->input->post('id')];
		
		$data = [
					'title' => $this->input->post('title'),
					'price' => $this->input->post('price'),
					'admin_id'=>$this->session->userdata('user_id'),
					'post_image' => $post_image
				];

		$this->db->update('posts', $data, $kondisi);
		}

		public function update_produk_noimg(){
			$kondisi = ['id' => $this->input->post('id')];
			
			$data = [
						'title' => $this->input->post('title'),
						'price' => $this->input->post('price'),
						'admin_id'=>$this->session->userdata('user_id')
					];
	
			$this->db->update('posts', $data, $kondisi);
		}

		public function edit_kirim($id){
			$query = $this->db->get_where('order', ['id_order' => $id]);
			return $query->row();
		}

		public function update_kirim($id){
			$this->db->set('kirim', '1', FALSE);
			$this->db->where('order.user_id', $id);
			$this->db->update('db_sbd.order'); 
			// UPDATE db_sbd.order SET kirim = 1 WHERE user_id = 1
		}

		public function update_gambar($post_image){
			$kondisi = ['id' => $this->input->post('id')];
			$data = array(
				'post_image' => $post_image
			);

			return $this->db->update('posts', $data, $kondisi);
		}

		public function hapus_data($id){
		$this->db->delete('posts', ['id' => $id]);
		}
		
	}