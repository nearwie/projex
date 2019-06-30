<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konsul_model extends CI_Model
{
	public function __construct()
    {
        $this->load->database();
    }


    var $table = 'gejala';
    
     public function getUserRecords($limit, $start)
     {
          $this->db->limit($limit, $start);
          $query = $this->db->get($this->table);
          return $query->result_array();
     }



     public function countTotalRecord()
     {
         return $this->db->count_all($this->table);
     }


	public function get_gejala_by_id($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->get('gejala');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('gejala', array('id' => $id));
        return $query->row_array();
    }
}

