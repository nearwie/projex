<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayath_model extends CI_Model
{
	 public $table  = 'hasil_konsul';
	public function __construct()
    {
        $this->load->database();
    }


    public function getDataRiwayath($limit, $start=0)
  {
        $this->db->select('hasil_konsul.*, user.name as name');
        
        $this->db->join('user','user.id = hasil_konsul.user_id', 'left');
       
        $this->db->limit($limit, $start);
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