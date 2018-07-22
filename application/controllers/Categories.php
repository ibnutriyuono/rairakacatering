<?php
	class Categories extends CI_Controller{
		public function index(){
			$data['title'] = 'Categories';
			
			$this->load->model('category_model');
			$data['categories'] = $this->category_model->get_categories();

			$this->load->view('templates/header');
			$this->load->view('pages/kategori', $data);
			$this->load->view('templates/footer');
		}

		public function create(){
			// Check login
			if(!$this->session->userdata('admin_logged_in')){
				redirect('users/login');
			}
			
			$data['title'] = 'Tambah Kategori';

			$this->form_validation->set_rules('name', 'Name', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('admin/header');
				$this->load->view('categories/create', $data);
				$this->load->view('admin/footer');
			} else {
				$this->load->model('category_model');
				$this->category_model->create_category();

				// Set message
				$this->session->set_flashdata('category_created', 'Your category has been created');

				redirect('categories');
			}
		}

		public function posts($id){
			$this->load->model('category_model');
			$this->load->model('post_model');
			$data['title'] = $this->category_model->get_category($id)->name;

			$data['posts'] = $this->post_model->get_posts_by_category($id);

			$this->load->view('templates/header');
			$this->load->view('pages/pesan', $data);
			$this->load->view('templates/footer');
		}

		public function delete($id){
			// Check login
			if(!$this->session->userdata('logged_in')){
				redirect('users/login');
			}

			$this->category_model->delete_category($id);

			// Set message
			$this->session->set_flashdata('category_deleted', 'Your category has been deleted');

			redirect('categories');
		}
	}