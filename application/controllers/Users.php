<?php
	class Users extends CI_Controller{
		// Register user
		public function register(){
			$data['title'] = 'Sign Up';

			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
			$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');
			$this->form_validation->set_rules('address', 'Address', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/register', $data);
				$this->load->view('templates/footer');
			} else {
				// Encrypt password
				$enc_password = md5($this->input->post('password'));

				$this->user_model->register($enc_password);

				// Set message
				$this->session->set_flashdata('user_registered', 'You are now registered and can log in');

				redirect('/');
			}
		}

		// Log in user
		public function login(){
			$data['title'] = 'Sign In';

			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('users/login', $data);
				$this->load->view('templates/footer');
			} else {
				
				// Get username
				$username = $this->input->post('username');
				// Get and encrypt the password
				$password = md5($this->input->post('password'));

                $this->load->model('user_model');
				// Login user
				$user_id = $this->user_model->login($username, $password);

				if($user_id){
					// Create session
					$user_data = array(
						'user_id' => $user_id,
						'username' => $username,
						'logged_in' => true
					);

					$this->session->set_userdata($user_data);

					// Set message
					$this->session->set_flashdata('user_loggedin', 'You are now logged in');

					redirect('/');
				} else {
					// Set message
					$this->session->set_flashdata('login_failed', 'Login is invalid');

					redirect('users/login');
				}		
			}
		}

		// Log user out
		public function logout(){
			// Unset user data
			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('username');

			// Set message
			$this->session->set_flashdata('user_loggedout', 'You are now logged out');

			redirect('users/login');
		}

		// Check if username exists
		public function check_username_exists($username){
            $this->load->model('user_model');
            $this->form_validation->set_message('check_username_exists', 'That username is taken. Please choose a different one');
			if($this->user_model->check_username_exists($username)){
				return true;
			} else {
				return false;
			}
		}

		// Check if email exists
		public function check_email_exists($email){
			$this->form_validation->set_message('check_email_exists', 'That email is taken. Please choose a different one');
			if($this->user_model->check_email_exists($email)){
				return true;
			} else {
				return false;
			}
		}

		public function profil(){
			// $this->load->model("admin_model");	
			$id_order = $this->session->userdata('username');
			// echo $id_order;
			$this->load->model('user_model');
			// $data['posts'] = $this->admin_model->edit_kirim($id);
			$data['posts'] = $this->user_model->load_user($id_order);
			$this->session->set_flashdata('berhasil', '<script>swal({
				title: "Pengiriman Berhasil",
				text: "Segera kirim paket ke alamat tersebut",
				icon: "success",
				button: "Kembali",
			  });</script>');
			$data['sessionid'] = $id_order; 
			$this->load->view('templates/header');
			$this->load->view('users/profil', $data);
			$this->load->view('templates/footer');
		}

		public function statusbayar($id){
			$this->load->model("user_model");	
			// $this->load->view('admin/header');
			$id_order = $_POST['id_order'];
			// echo $id_order;
			// $this->load->model('admin_model');
			// $data['posts'] = $this->admin_model->edit_kirim($id);
			$this->user_model->update_bayar($id_order);
			$this->session->set_flashdata('berhasilbayar', '<script>swal({
				title: "Terimakasih Telah Memproses Pembayaran",
				text: "Paket akan segera dikirim",
				icon: "success",
				button: "Kembali",
			  });</script>');
		    redirect('profil');
		}


	}