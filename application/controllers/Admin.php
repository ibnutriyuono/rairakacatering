<?php
	class Admin extends CI_Controller{
		public function view($page = 'login'){
			if(!file_exists(APPPATH.'views/admin/'.$page.'.php')){
				show_404();
			}

			$data['title'] = ucfirst($page);

			$this->load->view('admin/header');
			$this->load->view('admin/'.$page, $data);
			$this->load->view('admin/footer');
        }
        
        public function login(){
			$data['title'] = 'Sign In';

			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('admin/header');
				$this->load->view('admin/login', $data);
				$this->load->view('admin/footer');
			} else {
				
				// Get username
				$username = $this->input->post('username');
				// Get and encrypt the password
				$password = md5($this->input->post('password'));

                $this->load->model('admin_model');
				// Login user
				$user_id = $this->admin_model->login($username, $password);

				if($user_id){
					// Create session
					$user_data = array(
						'user_id' => $user_id,
						'admin_username' => $username,
						'admin_logged_in' => true
					);

					$this->session->set_userdata($user_data);

					// Set message
					$this->session->set_flashdata('user_loggedin', 'You are now logged in');

					redirect('admin/dashboard');
				} else {
					// Set message
					$this->session->set_flashdata('login_failed', '<script>swal({
                        title: "Gagal Login",
                        text: "Username atau Password salah",
                        icon: "error",
                        button: "Kembali",
                      });</script>');

					redirect('admin/login');
				}		
			}
        }
        
        public function register(){
			$data['title'] = 'Sign Up';

            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('admin_name', 'Admin Name', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

			if($this->form_validation->run() === FALSE){
				$this->load->view('admin/header');
				$this->load->view('admin/register', $data);
				$this->load->view('admin/footer');
			} else {
				// Encrypt password
				$enc_password = md5($this->input->post('password'));

				$this->admin_model->register($enc_password);

				// Set message
				$this->session->set_flashdata('user_registered', 'You are now registered and can log in');

				redirect('admin');
			}
        }
        
        public function check_username_exists($username){
            $this->load->model('admin_model');
            $this->form_validation->set_message('check_username_exists', 'That username is taken. Please choose a different one');
			if($this->admin_model->check_username_exists($username)){
				return true;
			} else {
				return false;
			}
		}

		public function logout(){
			// Unset user data
			$this->session->unset_userdata('admin_logged_in');
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('admin_username');

			// Set message
			$this->session->set_flashdata('user_loggedout', 'You are now logged out');

			redirect('admin');
		}

		public function dashboard($page = 'dashboard'){
			if(!file_exists(APPPATH.'views/admin/'.$page.'.php')){
				show_404();
			}

			if($this->session->userdata('admin_username')){      
			$config['base_url'] = base_url() . 'posts/index/';
			$config['total_rows'] = $this->db->count_all('posts');
			$config['per_page'] = 10;
			$config['uri_segment'] = 10;
			$config['attributes'] = array('class' => 'pagination-link');

			// Init Pagination
			$this->pagination->initialize($config);
			$this->load->model('post_model');

			$data['title'] = 'Latest Posts';
			
			$data['posts'] = $this->post_model->get_posts(FALSE, FALSE, FALSE);

			$this->load->view('admin/header');
			$this->load->view('admin/dashboard', $data);
			$this->load->view('admin/footer');
            }else{
			   $this->session->set_flashdata('not_loggedin', '<script>swal({
				title: "Belum Login",
				text: "Silahkan Login Terlebih Dahulu",
				icon: "error",
				button: "Kembali",
			  });</script>');
               redirect('admin');
            }
			
		}
		
		public function load(){
			$this->load->model("admin_model");
			$data['posts'] = $this->admin_model->load_order();

			$this->load->view('admin/header');
			$this->load->view("admin/load",$data);
			$this->load->view('admin/footer');
		}

		public function produk(){
			$this->load->model("admin_model");
			$data['posts'] = $this->admin_model->tampilkan();

			$this->load->view('admin/header');
			$this->load->view("admin/produk",$data);
			$this->load->view('admin/footer');
		}

		public function list_user(){
			$this->load->model("admin_model");

			$this->load->database();
			$jumlah_data = $this->admin_model->jumlah_data();
			$this->load->library('pagination');
			$config['base_url'] = base_url().'admin/list_user';
			$config['total_rows'] = $jumlah_data;
			$config['per_page'] = 6;
			$config['query_string_segment'] = 'start';
 
			$config['full_tag_open'] = '<ul class="pagination" style="margin-top:10px">';
			$config['full_tag_close'] = '</ul>';
			
			$config['first_link'] = '<i class="material-icons">chevron_left</i>';
			$config['first_tag_open'] = '<li class="waves-effect">';
			$config['first_tag_close'] = '</li>';
			
			$config['last_link'] = '<i class="material-icons">chevron_right</i>';
			$config['last_tag_open'] = '<li class="waves-effect">';
			$config['last_tag_close'] = '</li>';
			
			$config['next_link'] = 'Next';
			$config['next_tag_open'] = '<li class="waves-effect">';
			$config['next_tag_close'] = '</li>';
			
			$config['prev_link'] = 'Prev';
			$config['prev_tag_open'] = '<li class="waves-effect">';
			$config['prev_tag_close'] = '</li>';
			
			$config['cur_tag_open'] = '<li class="active"><a>';
			$config['cur_tag_close'] = '</a></li>';
			
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$from = $this->uri->segment(3);
			$this->pagination->initialize($config);		
			$data['user'] = $this->admin_model->data($config['per_page'],$from);

			// $data['posts'] = $this->admin_model->tampilkan_users();

			$this->load->view('admin/header');
			$this->load->view("admin/users",$data);
			$this->load->view('admin/footer');
		}

		public function edit($id){
			$this->load->model("admin_model");
			$data['posts'] = $this->admin_model->edit_mobil($id);
			
			$this->load->view('admin/header');
			$this->load->view("admin/formedit",$data);
			$this->load->view('admin/footer');
		}

		public function statuskirim($id){
			$this->load->model("admin_model");	
			$this->load->view('admin/header');
			$id_order = $_POST['id_order'];
			// echo $id_order;
			$this->load->model('admin_model');
			// $data['posts'] = $this->admin_model->edit_kirim($id);
			$this->admin_model->update_kirim($id_order);
			$this->session->set_flashdata('berhasil', '<script>swal({
				title: "Pengiriman Berhasil",
				text: "Segera kirim paket ke alamat tersebut",
				icon: "success",
				button: "Kembali",
			  });</script>');
			   redirect('admin/load');
		}

		function cari() {
			$this->load->model('admin_model');
			$data['tampil']=$this->admin_model->caridata();
			if($data['tampil']==null) {
			//    print 'maaf data yang anda cari tidak ada atau keywordnya salah';
			//    print br(2);
			//    print anchor('welcome','kembali');
			   $this->session->set_flashdata('gagal', '<script>swal({
				title: "Pencarian Gagal",
				text: "Maaf data yang anda cari tidak ada atau keywordnya salah",
				icon: "error",
				button: "Kembali",
			  });</script>');
			   redirect('admin/list_user');
			}
			else {
			   $this->session->set_flashdata('berhasil', '<script>swal({
				title: "Pencarian Berhasil",
				text: "Data berhasil di cari",
				icon: "success",
				button: "Kembali",
			  });</script>');
			  $this->load->view('admin/header');
			  $this->load->view('admin/tampil',$data);
			  $this->load->view('admin/footer'); 
		    }
		 }
		 
		 function cariorder() {
			$this->load->model('admin_model');
			$data['tampil']=$this->admin_model->caridata_order();
			if($data['tampil']==null) {
			//    print 'maaf data yang anda cari tidak ada atau keywordnya salah';
			//    print br(2);
			//    print anchor('welcome','kembali');
			   $this->session->set_flashdata('gagal', '<script>swal({
				title: "Pencarian Gagal",
				text: "Maaf data yang anda cari tidak ada atau keywordnya salah",
				icon: "error",
				button: "Kembali",
			  });</script>');
			   redirect('admin/list_user');
			}
			else {
			   $this->session->set_flashdata('berhasil', '<script>swal({
				title: "Pencarian Berhasil",
				text: "Data berhasil di cari",
				icon: "success",
				button: "Kembali",
			  });</script>');
			  $this->load->view('admin/header');
			  $this->load->view('admin/tampilorder',$data);
			  $this->load->view('admin/footer'); 
		    }
	 	}

		public function updatemobil($id){
		// $this->validasi();

		
			$this->load->model('admin_model');
			$this->admin_model->update_mobil();

			$config['upload_path'] = './assets/img/posts';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2048';
			$config['max_width'] = '2000';
			$config['max_height'] = '2000';

			$this->load->library('upload', $config);

			if(!$this->upload->do_upload()){
				$errors = array('error' => $this->upload->display_errors());
				$post_image = 'noimage.jpg';
			} else {
				$data = array('upload_data' => $this->upload->data());
				$post_image = $_FILES['userfile']['name'];
			}

			// $this->admin_model->update_gambar($post_image);
			
			$this->session->set_flashdata('update_sukses', '<script>swal({
				title: "Data sudah dirubah",
				text: "Data Berhasil dirubah",
				icon: "success",
				button: "Kembali",
			  });</script>');
			redirect('admin/produk');
		}

		public function hapusdata($id){
		$this->load->model('admin_model');	
		$this->admin_model->hapus_data($id);
		$this->session->set_flashdata('hapus_sukses','<script>swal({
			title: "Data sudah dihapus",
			text: "Data Berhasil dihapus",
			icon: "warning",
			button: "Kembali",
		  });</script>');
		redirect('/admin/produk');
		}


		public function backup(){
			$this->load->dbutil();

			$prefs = array(     
				'format'      => 'zip',             
				'filename'    => 'db_sbd.sql'
			);


			$backup =& $this->dbutil->backup($prefs); 

			$db_name = 'backup-tanggal-'. date("Y-m-d-H-i-s") .'.zip';
			$save = 'pathtobkfolder/'.$db_name;

			$this->load->helper('file');
			write_file($save, $backup); 


			$this->load->helper('download');
			force_download($db_name, $backup);

		}

		function restore()	{
			$isi_file = file_get_contents('./database/db20110603182125.sql');
			$string_query = rtrim( $isi_file, "\n;" );
			$array_query = explode(";", $query);
			foreach($array_query as $query){
			$this->db->query($query);
			}

		}		

		function laporan(){
			$this->load->library('pdf');
			$this->load->model('admin_model');
			$this->admin_model->load_order();
			$pdf = new FPDF('l','mm','A5');
			// membuat halaman baru
			$pdf->AddPage();
			// setting jenis font yang akan digunakan
			$pdf->SetFont('Arial','B',16);
			// mencetak string 
			$pdf->Cell(190,7,'LAPORAN PENJUALAN',0,1,'C');
			$pdf->Cell(190,7,'RAIRAKA CATERING',0,1,'C');
			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(10,7,'',0,1);
			$pdf->Cell(190,7,'PENJUALAN SEBANYAK '.$this->admin_model->jumlah_order().' PESANAN',0,1,'C');
			// $pdf->Cell(190,7,'TOTAL PENJUALAN Rp.'.$this->admin_model->load_total().',-',0,1,'C');
			$pdf->Cell(10,7,'',0,1);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(14,6,'NO',1,0);
			$pdf->Cell(20,6,'ID ORDER',1,0);
			$pdf->Cell(57,6,'NAMA PELANGGAN',1,0);
			$pdf->Cell(45,6,'NAMA PESANAN',1,0);
			$pdf->Cell(25,6,'JUMLAH',1,0);
			$pdf->Cell(28,6,'SUBTOTAL',1,1);
			$pdf->SetFont('Arial','',10);
			$no=1;
			$order = $this->admin_model->load_order();
			foreach ($order as $row){
				$pdf->Cell(14,6,$no,1,0);
				$pdf->Cell(20,6,$row['id_order'],1,0);
				$pdf->Cell(57,6,$row['name'],1,0);
				$pdf->Cell(45,6,$row['title'],1,0);
				$pdf->Cell(25,6,$row['qty'],1,0);
				$pdf->Cell(28,6,$row['subtotal'],1,1); 
				$no++;
			}
			$pdf->Output();
		}

	}