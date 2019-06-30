<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aturan_model extends CI_Model
{
  public $table  = 'aturan';
  public $id  = 'id';
  public $order  = 'ASC';

	public function __construct()
    {
        parent::__construct();
        $this->load->database();

    }


    public function get_by_gejala($gejala){
         $sql = "select distinct kerusakan_id,p.kode_kerusakan,p.nama_kerusakan,p.keterangan from aturan gp inner join kerusakan p on gp.kerusakan_id=p.id where gejala_id in (".$gejala.") order by kerusakan_id,gejala_id";
         return $this->db->query($sql);
     }



     public function get_gejala_by_kerusakan($id,$gejala=null){
         $sql = "select aturan.gejala_id,mb,md from aturan where kerusakan_id=".$id;
         if($gejala!=null)
            $sql=$sql." and gejala_id in (".$gejala.")";
        $sql=$sql." order by gejala_id";
         return $this->db->query($sql);
     }


    public function getSubGejala($limit, $start=0)
  {
        $this->db->select('aturan.*, gejala.kode_gejala as kode_gejala, kerusakan.kode_kerusakan as kode_kerusakan');
        $this->db->order_by($this->id,$this->order);
        $this->db->join('gejala','gejala.id = aturan.gejala_id', 'left');
        $this->db->join('kerusakan','kerusakan.id = aturan.kerusakan_id', 'left');
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result_array();
    }


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



    public function get_aturan_by_id($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->get('aturan');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('aturan', array('id' => $id));
        return $query->row_array();
    }



    public function set_aturan ($id = 0)
    {
        $this->load->helper('url');
        $id = $this->input->post('id');
		$kode_rule = $this->input->post('kode_rule');
        $gejala_id = $this->input->post('gejala_id');
		$kerusakan_id = $this->input->post('kerusakan_id');
		$mb = $this->input->post('mb');
		$md = $this->input->post('md');
		
        $data = array(
                    'id'=>$id,
            		'kode_rule'=>$kode_rule,
					'gejala_id'=>$gejala_id,
					'kerusakan_id'=>$kerusakan_id,
					'mb'=>$mb,
					'md'=>$md,
					
        );
        
        if ($id == 0) {
            return $this->db->insert('aturan', $data);
        } else {
            $this->db->where('id', $id);
            return $this->db->update('aturan', $data);
        }
    }

    public function delete_aturan($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('aturan');
    }

}