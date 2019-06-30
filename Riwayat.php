<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('email')) {
			redirect('auth');
		}

	}



	public function index()
	{
		// $data['content'] = 'admin/riwayat/list'; 
		$data['title'] = 'Daftar Riwayat';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
		$user = $this->session->userdata('email');
		$this->load->library('session');
	
		$this->load->library('form_validation');
		 $this->load->database();
		 $this->load->model(array('Riwayat_model','Riwayath_model'));

		// // $data['dataRiwayat'] = $this->Riwayat_model->daftarRiwayat();
		$data['dataHasil'] = $this->Riwayat_model->daftarHasil();

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        if(!is_numeric($page)){$page = 0;}
            
        // Load pagination library
        $this->load->library('pagination');   
        $config = array();
        $config["base_url"] = site_url().'/riwayat/index/';
        $config["total_rows"] = $this->Riwayat_model->countTotalRecord();
        $config["per_page"] = 7;
        $config['uri_segment'] = 3;
        
        // Pagination tags start.
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        
        $config['full_tag_open'] = '<ul class="pagination">';        
		$config['full_tag_close'] = '</ul>';  
		$config['attributes'] = array('class' => 'page-link');   
		$config['first_link'] = 'First';        
		$config['last_link'] = 'Last';   
		$config['first_tag_open'] = '<li>';        
		$config['first_tag_close'] = '</li>';        
		$config['prev_link'] = '&laquo';        
		$config['prev_tag_open'] = '<li class="prev">';        
		$config['prev_tag_close'] = '</li>';        
		$config['next_link'] = '&raquo';        
		$config['next_tag_open'] = '<li>';        
		$config['next_tag_close'] = '</li>';        
		$config['last_tag_open'] = '<li>';        
		$config['last_tag_close'] = '</li>';        
		$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';        
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';        
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
        
        $this->pagination->initialize($config);
        $data['pagging_link'] = $this->pagination->create_links();
        $data['dataRiwayat'] = $this->Riwayat_model->getDataRiwayat($config["per_page"], $page);


     





		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/listriwayat', $data);
		$this->load->view('templates/footer', $data);
	}


}