<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gejala_model extends CI_Model
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


     function get_list_data(){
        $this->db->select('*');
        $this->db->from('gejala');
        return $this->db->get();
    }


	public function get_gejala_by_id($id=0)
    {
        if ($id === 0)
        {
            $query = $this->db->get('gejala');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('gejala', array('id' => $id));
        return $query->row_array();
    }




    public function get_gejalaa_by_id($kode_gejala=0)
    {
        
        $this->db->select('*');
        $this->db->from('gejala');
         $this->db->where('kode_gejala',$kode_gejala);
        return $this->db->get();
    
    }





  public function get_list_by_id($id){
         $sql = "select id,kode_gejala,nama_gejala from gejala where id in (".$id.")";
        return $this->db->query($sql);
         
     }





    public function set_gejala($id = 0)
    {
        $this->load->helper('url');
        $id = $this->input->post('id');
		    $kode_gejala = $this->input->post('kode_gejala');
        $nama_gejala = $this->input->post('nama_gejala');
		
		
 
        $data = array(
            		'id'=>$id,
					'kode_gejala'=>$kode_gejala,
					'nama_gejala'=>$nama_gejala,
					
        );
        
        if ($id == 0) {
            return $this->db->insert('gejala', $data);
        } else {
            $this->db->where('id', $id);
            return $this->db->update('gejala', $data);
        }
    }

    public function delete_gejala($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('gejala');
    }


}

