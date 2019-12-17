<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ProdukMasuk_m extends CI_Model
{
	// Fetch records
	public function getData($rowno,$rowperpage,$search) {
		$this->db->from('produkmasuk');
		if (!empty($search['so_ref'])) {
			$this->db->like('so_ref',$search['so_ref']);
		}
		if (!empty($search['so_no'])) {
			$this->db->like('so_no',$search['so_no']);
		}
		if (!empty($search['ipdo_no'])) {
			$this->db->like('ipdo_no',$search['ipdo_no']);
		}
		if (!empty($search['ipdo_date'])) {
			$this->db->like('ipdo_date',$search['ipdo_date']);
		}
		if (!empty($search['so_date'])) {
			$this->db->like('so_date',$search['so_date']);
		}
		if (!empty($search['id_status'])) {
			$this->db->where('id_status',$search['id_status']);
		}
		$this->db->limit($rowperpage, $rowno);
		$this->db->order_by('id_pm','desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	  // Select total records
	public function getrecordCount($search) {
		$this->db->select('count(*) as allcount,produkmasuk.*');
		$this->db->from('produkmasuk');
		if (!empty($search['so_ref'])) {
			$this->db->like('so_ref',$search['so_ref']);
		}
		if (!empty($search['so_no'])) {
			$this->db->like('so_no',$search['so_no']);
		}
		if (!empty($search['ipdo_no'])) {
			$this->db->like('ipdo_no',$search['ipdo_no']);
		}
		if (!empty($search['ipdo_date'])) {
			$this->db->like('ipdo_date',$search['ipdo_date']);
		}
		if (!empty($search['so_date'])) {
			$this->db->like('so_date',$search['so_date']);
		}
		if (!empty($search['id_status'])) {
			$this->db->where('id_status',$search['id_status']);
		}
		$this->db->order_by('id_pm','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['allcount'];
	}
	// Fetch records
	public function getDataid($idinfopt,$rowno,$rowperpage,$search) {
		$this->db->from('produkmasuk');
		if (!empty($search['so_ref'])) {
			$this->db->like('so_ref',$search['so_ref']);
		}
		if (!empty($search['so_no'])) {
			$this->db->like('so_no',$search['so_no']);
		}
		if (!empty($search['ipdo_no'])) {
			$this->db->like('ipdo_no',$search['ipdo_no']);
		}
		if (!empty($search['ipdo_date'])) {
			$this->db->like('ipdo_date',$search['ipdo_date']);
		}
		if (!empty($search['so_date'])) {
			$this->db->like('so_date',$search['so_date']);
		}
		if (!empty($search['id_status'])) {
			$this->db->where('id_status',$search['id_status']);
		}
		$this->db->where('id_info_pt',$idinfopt);
		$this->db->limit($rowperpage, $rowno);
		$this->db->order_by('id_pm','desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	  // Select total records
	public function getrecordCountid($idinfopt,$search) {
		$this->db->select('count(*) as allcount,produkmasuk.*');
		$this->db->from('produkmasuk');
		if (!empty($search['so_ref'])) {
			$this->db->like('so_ref',$search['so_ref']);
		}
		if (!empty($search['so_no'])) {
			$this->db->like('so_no',$search['so_no']);
		}
		if (!empty($search['ipdo_no'])) {
			$this->db->like('ipdo_no',$search['ipdo_no']);
		}
		if (!empty($search['ipdo_date'])) {
			$this->db->like('ipdo_date',$search['ipdo_date']);
		}
		if (!empty($search['so_date'])) {
			$this->db->like('so_date',$search['so_date']);
		}
		if (!empty($search['id_status'])) {
			$this->db->where('id_status',$search['id_status']);
		}
		$this->db->where('id_info_pt',$idinfopt);
		$this->db->order_by('id_pm','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['allcount'];
	}
	public function getprodukmasuk($date,$time){
		$this->db->where('tgl_create',$date);
		$this->db->where('waktu_create',$time);
		$query = $this->db->get('produkmasuk');
		return $query->row();
	}
	public function getproduk($id){
		$this->db->select('brg_pm.*,type.nm_type');
		$this->db->where('id_pm',$id);
		$this->db->join('type', 'type.id_type = brg_pm.id_type');
		$query = $this->db->get('brg_pm');
		return $query->result();
	}
	public function cekbrgnota($idpm,$idtype){
		$this->db->where('id_pm',$idpm);
		$this->db->where('id_type',$idtype);
		$query = $this->db->get('brg_pm');
		return $query->row();
	}
	public function cekbrgproduk($brg){
		$this->db->where('id_brg_pm',$brg);
		$query = $this->db->get('brg_pm');
		return $query->row();
	}
}
