<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users_m extends CI_Model
{
	// Fetch records
	public function getData($rowno,$rowperpage,$search) {
		$this->db->from('users');
		if (!empty($search['string'])) {
			$this->db->like('users.first_name',$search['string']);
		}
		if (!empty($search['id_info_pt'])) {
			$this->db->where('users.id_info_pt',$search['id_info_pt']);
		}
		$this->db->join('info_pt', 'info_pt.id_info_pt = users.id_info_pt');
		$this->db->limit($rowperpage, $rowno);
		$this->db->order_by('users.first_name','asc');
		$query = $this->db->get();
		return $query->result_array();
	}

	  // Select total records
	public function getrecordCount($search) {
		$this->db->select('count(*) as allcount,users.*,info_pt.nama_info_pt,info_pt.kode_pt');
		$this->db->from('users');
		if (!empty($search['string'])) {
			$this->db->like('user.first_name',$search['string']);
		}
		if (!empty($search['users.id_info_pt'])) {
			$this->db->where('id_info_pt',$search['id_info_pt']);
		}
		$this->db->join('info_pt', 'info_pt.id_info_pt = users.id_info_pt');
		$this->db->order_by('users.first_name','asc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['allcount'];
	}
	// Fetch records
	public function getDataid($id,$rowno,$rowperpage,$search) {
		$this->db->from('users');
		if (!empty($search['string'])) {
			$this->db->like('users.first_name',$search['string']);
		}
		$this->db->where('users.id_info_pt',$id);
		$this->db->limit($rowperpage, $rowno);
		$this->db->where('users.id_info_pt',$id);
		$this->db->join('info_pt', 'info_pt.id_info_pt = users.id_info_pt');
		$this->db->order_by('users.first_name','asc');
		$query = $this->db->get();
		return $query->result_array();
	}

	  // Select total records
	public function getrecordCountid($id,$search) {
		$this->db->select('count(*) as allcount,users.*,info_pt.nama_info_pt,info_pt.kode_pt');
		$this->db->from('users');
		if (!empty($search['string'])) {
			$this->db->like('users.first_name',$search['string']);
		}
		$this->db->where('users.id_info_pt',$id);
		$this->db->join('info_pt', 'info_pt.id_info_pt = users.id_info_pt');
		$this->db->order_by('users.first_name','asc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['allcount'];
	}
	function insert_users($data){
		$this->db->insert('users', $data);
	}
	function update_users($id,$data){
		$this->db->where('id',$id);
		$this->db->update('users', $data);
	}
	public function detail_users($id){
		$this->db->where('id',$id);
		$query = $this->db->get('users');
		return $query->row();
	}
	public function cek_users($id){
		$this->db->where('id',$id);
		$query = $this->db->get('users');
		return $query->row();
	}
	public function lastuser(){
		$this->db->order_by('id','desc');
		$query = $this->db->get('users');
		return $query->row();
	}
	public function delete_users($id){
		$this->db->where('id', $id);
		$this->db->delete('users');
	}
}
