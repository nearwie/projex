<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporam extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
	
	}


	 public function index()
  {
    $this->load->library('mypdf');


    $this->mypdf->generate('Laporan/dompdf', $data, 'laporan-mahasiswa', 'A4', 'landscape');
  }


}