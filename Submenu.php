<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Submenu extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		//$this->permission->is_logged_in();
		//load model
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('submenu_model');
		//$this->load->model('leave_model');
	}


	public function index ()
	{
		$data['title'] = 'Submenu Manajemen';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
		$this->load->library('session');
		$this->load->library('form_validation');
		
		
		// KIRIM DATA KE manajemen.php
		// $data['subMenu'] = $this->db->get('user_sub_menu') -> result_array();
		$this->load->model('Submenu_model');
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        if(!is_numeric($page)){$page = 0;}
            
        // Load pagination library
        $this->load->library('pagination');   
        $config = array();
        $config["base_url"] = site_url().'/submenu/index/';
        $config["total_rows"] = $this->submenu_model->countTotalRecord();
        $config["per_page"] =7;
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
        $data['subMenu'] = $this->submenu_model->getSubMenu($config["per_page"], $page);
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->form_validation->set_rules('title', 'Title', 'required', [
			'required' => 'Nama submenu wajib diisi'
		]);
		$this->form_validation->set_rules('menu_id', 'Menu', 'required', [
			'required' => 'Menu submenu wajib diisi'
		]);
		$this->form_validation->set_rules('url', 'URL', 'required', [
			'required' => 'URL submenu wajib diisi'
		]);
		$this->form_validation->set_rules('icon', 'Icon', 'required', [
			'required' => 'Icon submenu wajib diisi'
		]);


		if ($this->form_validation->run() == false ) {
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('menu/submenu', $data);
		$this->load->view('templates/footer', $data);
		} else{
			$data = [
				'title' => $this->input->post('title'),
				'menu_id' => $this->input->post('menu_id'),
				'url' => $this->input->post('url'),
				'icon' => $this->input->post('icon'),
				'is_active' => $this->input->post('is_active'),
			];

			$this->db->insert('user_sub_menu', $data);
			$this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert">Berhasil menambahkan submenu baru</div>');
			redirect('submenu');
		}
	}


	public function edit()
    {
        $id = $this->uri->segment(3);
        
        if (empty($id))
        {
            redirect('submenu');
        }
        
        $this->load->helper('url');
      
        $this->load->model('Submenu_model');
        $data['title'] = 'Edit Submenu';        
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
  //       $data['subMenu'] = $this->submenu_model->getSubMenu();
		// $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['sm'] = $this->submenu_model->get_submenu_by_id($id);

        $this->form_validation->set_rules('title', 'Title', 'required', [
			'required' => 'Nama submenu wajib diisi'
		]);
		$this->form_validation->set_rules('menu_id', 'Menu', 'required', [
			'required' => 'Menu submenu wajib diisi'
		]);
		$this->form_validation->set_rules('url', 'URL', 'required', [
			'required' => 'URL submenu wajib diisi'
		]);
		$this->form_validation->set_rules('icon', 'Icon', 'required', [
			'required' => 'Icon submenu wajib diisi'
		]);
        
    
 
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu/editsmenu', $data);
			$this->load->view('templates/footer', $data);
 
        }
        else
        {
            $this->submenu_model->set_submenu($id);
            $this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert">Berhasil edit submenu</div>');
            //$this->load->view('news/success');
            redirect( base_url() . 'submenu');
        }
    }

    
    public function delete()
    {	$this->load->model('Submenu_model');
        $id = $this->uri->segment(3);
        
        if (empty($id))
        {
            $this->session->set_flashdata('message',  '<div class="alert alert-danger" role="alert">Gagal hapus submenu </div>');
        redirect( base_url() . 'submenu'); 
        }
                
        $sm = $this->submenu_model->get_submenu_by_id($id);
        
        $this->submenu_model->delete_submenu($id);   
             $this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert">Berhasil hapus submenu </div>');
        redirect( base_url() . 'submenu');        
    }


}