<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konsul extends CI_Controller
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
		$data['title'] = 'Konsultasi';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
		$user_id = $this->session->userdata('id');
		$this->load->library('session');
	
		$this->load->library('form_validation');
		 $this->load->database();
		 $this->load->model(array('Gejala_model', 'Kerusakan_model', 'Aturan_model'));

		if (!$this->input->post('gejala')) {
			$data['contentuser'] = 'user/konsul'; //nama file yang akan jadSi kontent di template
			$data['listGejala'] = $this->Gejala_model->get_gejalaa_by_id();
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/konsul', $data);
			$this->load->view('templates/footer', $data);
		}else{
			$data["contentuser"]="user/hslkonsul";

			$gejala = implode(",", $this->input->post('gejala'));
			$data["listGejala"] = $this->Gejala_model->get_list_by_id($gejala);
			//hitung
			$listKerusakan = $this->Aturan_model->get_by_gejala($gejala);
			$kerusakan = array();
			$i=0;
			foreach($listKerusakan->result() as $value){
				$listGejala = $this->Aturan_model->get_gejala_by_kerusakan($value->kerusakan_id,$gejala);
				$combineCFmb=0;
				$combineCFmd=0;
				$CFBefore=0;
				$j=0;
				foreach($listGejala->result() as $value2){
					$j++;
					if($j==3){
						$combineCFmb=$value2->mb;
						$combineCFmd=$value2->md;}
					else
					$combineCFmb =$combineCFmb + ($value2->mb * (1 - $combineCFmb));
					$combineCFmd =$combineCFmd + ($value2->md * (1 - $combineCFmd));
					$combinehasil = $combineCFmb-$combineCFmd; 
				}
				if($combinehasil)
				{
					$kerusakan[$i]=array('kode_kerusakan'=>$value->kode_kerusakan,
										'nama_kerusakan'=>$value->nama_kerusakan,
										'kepercayaan'=>$combinehasil*100,
										'keterangan'=>$value->keterangan,
										'user_id' =>$user_id);
					// $this->db->insert('hasil_diagnosa', $penyakit[$i]);
					$i++;
				}
				
				
			}
			//insert ke tabel history
			$insert_data = array();
			foreach ($this->input->post("gejala") as $g) {
				$insert_data[] = array(
								'user_id' => $user_id,
								'gejala_id' => $g
							);
			}
			$this->db->insert_batch('history', $insert_data);
			function cmp($a, $b)
			{
				return ($a["kepercayaan"] > $b["kepercayaan"]) ? -1 : 1;
			}
			usort($kerusakan, "cmp");
			$data["listKerusakan"] = $kerusakan;
			$data_hasil = array(
				'kode_kerusakan' =>$kerusakan[0]['kode_kerusakan'],
				'nama_kerusakan' =>$kerusakan[0]['nama_kerusakan'],
				'kepercayaan' =>$kerusakan[0]['kepercayaan'],
				'keterangan' =>$kerusakan[0]['keterangan'],
				'user_id' =>$kerusakan[0]['user_id'],
			);
			$this->db->insert('hasil_konsul', $data_hasil);
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/hslkonsul', $data);
			$this->load->view('templates/footer', $data);
		}
	}


	public function riwayat(){

		$data['title'] = 'Riwayat Diagnosa';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
		$user = $this->session->userdata('email');
		$this->load->library('session');

		$this->load->model(array('History_model'));


		$id = $this->session->userdata('id');
		
		$data['listHistory'] = $this->History_model->listHistory($id);
		$data['listHasil'] = $this->History_model->listHasil($id);
		

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/riwayat', $data);
		$this->load->view('templates/footer', $data);
	}

	public function createPdf(){
		
	
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')]) -> row_array();
		$user = $this->session->userdata('email');
		$this->load->library('session');

		$this->load->model(array('History_model'));


		$id = $this->session->userdata('id');
		
		$data['listHistory'] = $this->History_model->listHistory($id);
		$data['listHasil'] = $this->History_model->listHasil($id);

		$this->load->library('pdf');
        $this->pdf->load_view('report/laporankonsul',$data);

	}
	



	
}