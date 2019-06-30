<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kerusakan_model extends CI_Model
{
	public function __construct()
    {
        $this->load->database();
    }



    var $table = 'kerusakan';
    
     function getUserRecords($limit, $start)
     {
          $this->db->limit($limit, $start);
          $query = $this->db->get($this->table);
          return $query->result_array();
     }



     function countTotalRecord()
     {
         return $this->db->count_all($this->table);
     }


   

	public function get_kerusakan_by_id($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->get('kerusakan');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('kerusakan', array('id' => $id));
        return $query->row_array();
    }



    public function set_kerusakan($id = 0)
    {
        $this->load->helper('url');
        $id = $this->input->post('id');
		$kode_kerusakan = $this->input->post('kode_kerusakan');
        $nama_kerusakan = $this->input->post('nama_kerusakan');
        $keterangan = $this->input->post('keterangan');
		
		
 
        $data = array(
            		'id'=>$id,
					'kode_kerusakan'=>$kode_kerusakan,
					'nama_kerusakan'=>$nama_kerusakan,
                    'keterangan'=>$keterangan,
					
        );
        
        if ($id == 0) {
            return $this->db->insert('kerusakan', $data);
        } else {
            $this->db->where('id', $id);
            return $this->db->update('kerusakan', $data);
        }
    }

    public function delete_kerusakan($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('kerusakan');
    }


}

