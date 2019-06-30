<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kerusakan extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		//$this->permission->is_logged_in();
		//load model
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('Kerusakan_model');
		//$this->load->model('leave_model');
	}


	public function index ()
	{
		$data['title'] = 'Data Kerusakan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->model('Kerusakan_model');
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        if(!is_numeric($page)){$page = 0;}
            
        // Load pagination library
        $this->load->library('pagination');   
        $config = array();
        $config["base_url"] = site_url().'/kerusakan/index/';
        $config["total_rows"] = $this->kerusakan_model->countTotalRecord();
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
        $data['kerusakans'] = $this->kerusakan_model->getUserRecords($config["per_page"], $page);
		// $data['gejalas'] = $this->db->get('gejala') -> result_array();
		$this->form_validation->set_rules('kode_kerusakan', 'Kode', 'required', [
			'required' => 'Kolom kode wajib diisi'
		]);
		$this->form_validation->set_rules('nama_kerusakan', 'Kerusakan', 'required', [
			'required' => 'Kolom kerusakan wajib diisi'
		]);
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required', [
			'required' => 'Kolom keterangan wajib diisi'
		]);
		

		if ($this->form_validation->run() == false ) {
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/kerusakan', $data);
		$this->load->view('templates/footer', $data);
		} else{
			$data = [
				'kode_kerusakan' => $this->input->post('kode_kerusakan'),
				'nama_kerusakan' => $this->input->post('nama_kerusakan'),
				'keterangan' => $this->input->post('keterangan'),
				
			];

			$this->db->insert('kerusakan', $data);
			$this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert">Berhasil menambahkan data kerusakan baru</div>');
			redirect('kerusakan');
		}

	}
	


	public function edit()
    {
        $id = $this->uri->segment(3);
        
        if (empty($id))
        {
            redirect('kerusakan');
        }
        
        $this->load->helper('url');
      
        
        $data['title'] = 'Edit Data Kerusakan';        
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
        
		$data['kerusakans'] = $this->db->get('kerusakan')->result_array();
		$this->load->model('Kerusakan_model');
        
        $data['k'] = $this->kerusakan_model->get_kerusakan_by_id($id);

       $this->form_validation->set_rules('kode_kerusakan', 'Kode', 'required', [
			'required' => 'Kolom kode wajib diisi'
		]);
		$this->form_validation->set_rules('nama_kerusakan', 'Kerusakan', 'required', [
			'required' => 'Kolom kerusakan wajib diisi'
		]);
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required', [
			'required' => 'Kolom keterangan wajib diisi'
		]);
    
 
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/editkerusakan', $data);
			$this->load->view('templates/footer', $data);
 
        }
        else
        {
            $this->kerusakan_model->set_kerusakan($id);
            $this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert">Berhasil ubah data kerusakan</div>');
            //$this->load->view('news/success');
            redirect( base_url() . 'kerusakan');
        }
    }



    
    public function delete()
    {	$this->load->model('Kerusakan_model');
        $id = $this->uri->segment(3);
        
        if (empty($id))
        {
            $this->session->set_flashdata('message',  '<div class="alert alert-danger" role="alert">Gagal hapus data kerusakan </div>');
        redirect( base_url() . 'kerusakan'); 
        }
                
        $k = $this->kerusakan_model->get_kerusakan_by_id($id);
        
        $this->kerusakan_model->delete_kerusakan($id);   
             $this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert">Berhasil hapus data kerusakan </div>');
        redirect( base_url() . 'kerusakan');        
    }


}