<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aturan extends CI_Controller
{  

	public function __construct()
	{
		parent::__construct();
		//$this->permission->is_logged_in();
		//load model
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('Aturan_model');
		//$this->load->model('leave_model');
	}





	public function index ()
	{
		$data['title'] = 'Data Aturan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
		$this->load->library('session');
	
		$this->load->library('form_validation');
		 $this->load->database();

		 
		 $this->load->model('Aturan_model');
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        if(!is_numeric($page)){$page = 0;}
            
        // Load pagination library
        $this->load->library('pagination');   
        $config = array();
        $config["base_url"] = site_url().'/aturan/index/';
        $config["total_rows"] = $this->aturan_model->countTotalRecord();
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
        $data['subGejala'] = $this->aturan_model->getSubGejala($config["per_page"], $page);
        $data['gjls'] = $this->db->get('gejala')->result_array();
        $data['krskns'] = $this->db->get('kerusakan')->result_array();
        $data['kondisi'] = $this->db->get('kondisi')->result_array();
	$this->form_validation->set_rules('kode_rule', 'Kode', 'required', [
			'required' => 'Kolom kode wajib diisi'
		]);
		$this->form_validation->set_rules('gejala_id', 'Gejala', 'required', [
			'required' => 'Kolom gejala wajib diisi'
		]);
		$this->form_validation->set_rules('kerusakan_id', 'Kerusakan', 'required', [
			'required' => 'Kolom kerusakan wajib diisi'
		]);
		$this->form_validation->set_rules('mb', 'Mb', 'required|numeric', [
			'required' => 'Kolom mb wajib diisi'
		]);
		$this->form_validation->set_rules('md', 'Md', 'required|numeric', [
			'required' => 'Kolom md wajib diisi'
		]);
		

		if ($this->form_validation->run() == false ) {
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/aturan', $data);
		$this->load->view('templates/footer', $data);
		} else{
			$data = [
				'kode_rule' => $this->input->post('kode_rule'),
				'gejala_id' => $this->input->post('gejala_id'),
				'kerusakan_id' => $this->input->post('kerusakan_id'),
				'mb' => $this->input->post('mb'),
				'md' => $this->input->post('md'),
				
			];

			$this->db->insert('aturan', $data);
			$this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert">Berhasil menambahkan data aturan baru</div>');
			redirect('aturan');
		}

	
	}

	


	public function edit()
    {
        $id = $this->uri->segment(3);
        
        if (empty($id))
        {
            redirect('aturan');
        }
        
        $this->load->helper('url');
      
        
        $data['title'] = 'Edit Aturan';        
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
        
		// $data['aturans'] = $this->db->get('aturan')->result_array();
		$this->load->model('Aturan_model');
        
        $data['ru'] = $this->aturan_model->get_aturan_by_id($id);

      	$this->form_validation->set_rules('kode_rule', 'Kode', 'required', [
			'required' => 'Kolom kode wajib diisi'
		]);
		$this->form_validation->set_rules('gejala_id', 'Gejala', 'required', [
			'required' => 'Kolom gejala wajib diisi'
		]);
		$this->form_validation->set_rules('kerusakan_id', 'Kerusakan', 'required', [
			'required' => 'Kolom kerusakan wajib diisi'
		]);
		$this->form_validation->set_rules('mb', 'Mb', 'required', [
			'required' => 'Kolom mb wajib diisi'
		]);
		$this->form_validation->set_rules('md', 'Md', 'required', [
			'required' => 'Kolom md wajib diisi'
		]);
    
 
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/editaturan', $data);
			$this->load->view('templates/footer', $data);
 
        }
        else{

        	$data = [
				'kode_rule' => $this->input->post('kode_rule'),
				'gejala_id' => $this->input->post('gejala_id'),
				'kerusakan_id' => $this->input->post('kerusakan_id'),
				'mb' => $this->input->post('mb'),
				'md' => $this->input->post('md'),
			];

            $this->aturan_model->set_aturan($id);
            $this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert">Berhasil edit aturan</div>');
            //$this->load->view('news/success');
            redirect( base_url() . 'aturan');
        }
    }



    
    public function delete()
    {	$this->load->model('Aturan_model');
        $id = $this->uri->segment(3);
        
        if (empty($id))
        {
            $this->session->set_flashdata('message',  '<div class="alert alert-danger" role="alert">Gagal hapus aturan </div>');
        redirect( base_url() . 'aturan'); 
        }
                
        $ru = $this->aturan_model->get_aturan_by_id($id);
        
        $this->aturan_model->delete_aturan($id);   
             $this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert">Berhasil hapus aturan</div>');
        redirect( base_url() . 'aturan');        
    }







}








