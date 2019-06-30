<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gejala extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		//$this->permission->is_logged_in();
		//load model
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('Gejala_model');
		//$this->load->model('leave_model');
	}



	public function index ()
	{
		$data['title'] = 'Data Gejala';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
		$this->load->library('session');
	
		$this->load->library('form_validation');
		 $this->load->database();

		 
		 $this->load->model('Gejala_model');
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        if(!is_numeric($page)){$page = 0;}
            
        // Load pagination library
        $this->load->library('pagination');   
        $config = array();
        $config["base_url"] = site_url().'/gejala/index/';
        $config["total_rows"] = $this->gejala_model->countTotalRecord();
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
        $data['gejalas'] = $this->gejala_model->getUserRecords($config["per_page"], $page);
		// $data['gejalas'] = $this->db->get('gejala') -> result_array();
		$this->form_validation->set_rules('kode_gejala', 'Kode', 'required', [
			'required' => 'Kolom kode wajib diisi'
		]);
		$this->form_validation->set_rules('nama_gejala', 'Gejala', 'required', [
			'required' => 'Kolom gejala wajib diisi'
		]);
		

		if ($this->form_validation->run() == false ) {
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/gejala', $data);
		$this->load->view('templates/footer', $data);
		} else{
			$data = [
				'kode_gejala' => $this->input->post('kode_gejala'),
				'nama_gejala' => $this->input->post('nama_gejala'),
				
			];

			$this->db->insert('gejala', $data);
			$this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert">Berhasil menambahkan data gejala baru</div>');
			redirect('gejala');
		}

	}
		

	public function edit()
    {
        $id = $this->uri->segment(3);
        
        if (empty($id))
        {
            redirect('gejala');
        }
        
        $this->load->helper('url');
      
        
        $data['title'] = 'Edit Gejala';        
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
        
		$data['gejalas'] = $this->db->get('gejala')->result_array();
		$this->load->model('Gejala_model');
        
        $data['g'] = $this->gejala_model->get_gejala_by_id($id);

       $this->form_validation->set_rules('kode_gejala', 'Kode', 'required', [
			'required' => 'Kolom kode wajib diisi'
		]);
		$this->form_validation->set_rules('nama_gejala', 'Gejala', 'required', [
			'required' => 'Kolom gejala wajib diisi'
		]);
    
 
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/editgejala', $data);
			$this->load->view('templates/footer', $data);
 
        }
        else
        {
            $this->gejala_model->set_gejala($id);
            $this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert">Berhasil edit gejala</div>');
            //$this->load->view('news/success');
            redirect( base_url() . 'gejala');
        }
    }



    
    public function delete()
    {	$this->load->model('Gejala_model');
        $id = $this->uri->segment(3);
        
        if (empty($id))
        {
            $this->session->set_flashdata('message',  '<div class="alert alert-danger" role="alert">Gagal hapus gejala </div>');
        redirect( base_url() . 'gejala'); 
        }
                
        $g = $this->gejala_model->get_gejala_by_id($id);
        
        $this->gejala_model->delete_gejala($id);   
             $this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert">Berhasil hapus gejala </div>');
        redirect( base_url() . 'gejala');        
    }


}