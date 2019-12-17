<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Type_m extends CI_Model
{
	// Fetch records
	public function getData($rowno,$rowperpage,$search) {
		$this->db->from('type');
		if (!empty($search['string'])) {
			$this->db->like('nm_type',$search['string']);
		}
		$this->db->limit($rowperpage, $rowno);
		$this->db->order_by('nm_type','asc');
		$query = $this->db->get();
		return $query->result_array();
	}

	  // Select total records
	public function getrecordCount($search) {
		$this->db->select('count(*) as allcount,type.*');
		$this->db->from('type');
		if (!empty($search['string'])) {
			$this->db->like('nm_type',$search['string']);
		}
		$this->db->order_by('nm_type','asc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['allcount'];
	}
}
