<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History_model extends CI_Model
{
	public function __construct()
    {
        $this->load->database();
    }


    public function listHistory($id)
    {
        return $this->db->select('*')
                        ->from('history a')
                        ->join('gejala b', 'b.id = a.gejala_id')
                        ->where('a.user_id', $id)
                        ->get()
                        ->result();




    }


    public function listHasil($id)
    {
        return $this->db->select('*')
                        ->from('hasil_konsul')
                        ->where('user_id', $id)
                        ->get()
                        ->result_array();
       
    }

}