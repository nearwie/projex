<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		if (!$this->session->userdata('email')) {
			redirect('auth');
		}
		
	}



	public function index ()
	{
		$data['title'] = 'Home';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
		

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/index', $data);
		$this->load->view('templates/footer', $data);
	}


	public function profile ()
	{
		$data['title'] = 'My Profile';
		$this->load->library('form_validation');
		
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();

		// // QUERY NAMA
		// $data['name'] = $this->db->get('user') -> result_array();

		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		if ($this->form_validation->run() == false ) {
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/profile', $data);
		$this->load->view('templates/footer', $data);
		} else {
			$name = $this->input->post('name');
			$email = $this->input->post('email');

				
				// cek jk ada gambar
				$upload_image = $_FILES['image']['name'];

				if ($upload_image) {
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']     = '2048';
					$config['upload_path'] = './assets/img/profile/';

					$this->load->library('upload', $config);
					// $this->load->initialize($config);

					if ($this->upload->do_upload('image')) {
						$old_image = $data['user']['image'];
						if ($old_image != 'default.jpg') {
							unlink(FCPATH. 'assets/img/profile/'. $old_image);
						}
						$new_image = $this->upload->data('file_name');
						$this->db->set('image', $new_image);
					} else {
						echo $this->upload->display_errors();

					}
				}
			$this->db->set('name', $name);
			$this->db->where('email', $email);

			$this->db->update('user') ;
			$this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert">Berhasil memperbarui profile</div>');
	 				redirect('user/profile');

		}
	}


	public function hslkonsul ()
	{
		$data['title'] = 'Hasil Konsultasi';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
		

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/hslkonsul', $data);
		$this->load->view('templates/footer', $data);
	}



	public function home ()
	{
		$data['title'] = 'Home';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
		

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/home', $data);
		$this->load->view('templates/footer', $data);
	}


	public function Info ()
	{
		$data['title'] = 'Informasi';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
		

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/info', $data);
		$this->load->view('templates/footer', $data);
	}


	public function petunjuk ()
	{
		$data['title'] = 'Petunjuk Penggunaan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
		

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/petunjuk', $data);
		$this->load->view('templates/footer', $data);
	}



}