<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Setting_m extends CI_Model
{
	// Fetch records
	public function getData($rowno,$rowperpage,$search) {
		$this->db->from('info_pt');
		if (!empty($search['string'])) {
			$this->db->like('nama_info_pt',$search['string']);
		}
		if (!empty($search['kode_pt'])) {
			$this->db->like('kode_pt',$search['kode_pt']);
		}
		$this->db->limit($rowperpage, $rowno);
		$this->db->order_by('nama_info_pt','asc');
		$query = $this->db->get();
		return $query->result_array();
	}

	  // Select total records
	public function getrecordCount($search) {
		$this->db->select('count(*) as allcount,info_pt.*');
		$this->db->from('info_pt');
		if (!empty($search['string'])) {
			$this->db->like('nama_info_pt',$search['string']);
		}
		if (!empty($search['kode_pt'])) {
			$this->db->like('kode_pt',$search['kode_pt']);
		}
		$this->db->order_by('nama_info_pt','asc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['allcount'];
	}
	// Fetch records
	public function getDataid($id,$rowno,$rowperpage,$search) {
		$this->db->from('info_pt');
		if (!empty($search['string'])) {
			$this->db->like('nama_info_pt',$search['string']);
		}
		if (!empty($search['kode_pt'])) {
			$this->db->like('kode_pt',$search['kode_pt']);
		}
		$this->db->limit($rowperpage, $rowno);
		$this->db->where('id_info_pt',$id);
		$this->db->order_by('nama_info_pt','asc');
		$query = $this->db->get();
		return $query->result_array();
	}

	  // Select total records
	public function getrecordCountid($id,$search) {
		$this->db->select('count(*) as allcount,info_pt.*');
		$this->db->from('info_pt');
		if (!empty($search['string'])) {
			$this->db->like('nama_info_pt',$search['string']);
		}
		if (!empty($search['kode_pt'])) {
			$this->db->like('kode_pt',$search['kode_pt']);
		}
		$this->db->where('id_info_pt',$id);
		$this->db->order_by('nama_info_pt','asc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['allcount'];
	}
}
