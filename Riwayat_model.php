<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat_model extends CI_Model
{
	 public $table  = 'history';
	public function __construct()
    {
        $this->load->database();
    }


    public function getDataRiwayat($limit, $start=0)
  {
        $this->db->select('history.*, gejala.nama_gejala as nama_gejala, user.name as name');
        
        $this->db->join('gejala','gejala.id = history.gejala_id', 'left');
        $this->db->join('user','user.id = history.user_id', 'left');
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result_array();
    }
	

	public function daftarRiwayat()
    {
	
		$this->db->select('history.*, gejala.nama_gejala as nama_gejala, user.name as name');
		$this->db->join('gejala','gejala.id = history.gejala_id', 'left');
        $this->db->join('user','user.id = history.user_id', 'left');
        
        return $this->db->get($this->table)->result_array();
		
	}

	public function jumlah()
	{
		return $this->db->get('hasil_konsul');
	}


	public function countTotalRecord()
     {
         return $this->db->count_all($this->table);
     }
	
	public function daftarHasil(){
		
		$this->db->select('hasil_konsul.*, user.name as name');
		
        $this->db->join('user','user.id = hasil_konsul.user_id', 'left');
        
        return $this->db->get('hasil_konsul')->result_array();
	}
	
	public function getById($id){
		return $query = $this->db->query("SELECT * FROM kerusakan WHERE id='$id' ")->row_array();
	}
}
