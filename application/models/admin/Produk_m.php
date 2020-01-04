<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Produk_m extends CI_Model
{
	// Fetch records
	public function getData($rowno,$rowperpage,$search) {
		$this->db->from('produk');
		$this->db->join('jenis', 'jenis.id_jenis = produk.id_jenis');
		$this->db->join('merk', 'merk.id_merk = produk.id_merk');
		$this->db->join('type', 'type.id_type = produk.id_type');
		$this->db->join('info_pt', 'info_pt.id_info_pt = produk.id_info_pt');
		if (!empty($search['id_jenis'])) {
			$this->db->where('produk.id_jenis',$search['id_jenis']);
		}
		if (!empty($search['id_merk'])) {
			$this->db->where('produk.id_merk',$search['id_merk']);
		}
		if (!empty($search['id_type'])) {
			$this->db->where('produk.id_type',$search['id_type']);
		}
		if (!empty($search['no_rangka'])) {
			$this->db->where('produk.no_rangka',$search['no_rangka']);
		}
		if (!empty($search['no_mesin'])) {
			$this->db->where('produk.no_mesin',$search['no_mesin']);
		}
		if (!empty($search['id_info_pt'])) {
			$this->db->where('produk.id_info_pt',$search['id_info_pt']);
		}
		$this->db->where('produk.id_validasi','1');
		$this->db->limit($rowperpage, $rowno);
		$this->db->order_by('id_produk','desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	  // Select total records
	public function getrecordCount($search) {
		$this->db->select('count(*) as allcount,produk.*,jenis.nm_jenis,merk.nm_merk,type.nm_type,info_pt.nama_info_pt,info_pt.kode_pt');
		$this->db->from('produk');
		$this->db->join('jenis', 'jenis.id_jenis = produk.id_jenis');
		$this->db->join('merk', 'merk.id_merk = produk.id_merk');
		$this->db->join('type', 'type.id_type = produk.id_type');
		$this->db->join('info_pt', 'info_pt.id_info_pt = produk.id_info_pt');
		if (!empty($search['id_jenis'])) {
			$this->db->where('produk.id_jenis',$search['id_jenis']);
		}
		if (!empty($search['id_merk'])) {
			$this->db->where('produk.id_merk',$search['id_merk']);
		}
		if (!empty($search['id_type'])) {
			$this->db->where('produk.id_type',$search['id_type']);
		}
		if (!empty($search['no_rangka'])) {
			$this->db->where('produk.no_rangka',$search['no_rangka']);
		}
		if (!empty($search['no_mesin'])) {
			$this->db->where('produk.no_mesin',$search['no_mesin']);
		}
		if (!empty($search['id_info_pt'])) {
			$this->db->where('produk.id_info_pt',$search['id_info_pt']);
		}
		$this->db->where('produk.id_validasi','1');
		$this->db->order_by('produk.id_produk','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['allcount'];
	}
	// Fetch records
	public function getDataid($idinfopt,$rowno,$rowperpage,$search) {
		$this->db->from('produk');
		$this->db->join('jenis', 'jenis.id_jenis = produk.id_jenis');
		$this->db->join('merk', 'merk.id_merk = produk.id_merk');
		$this->db->join('type', 'type.id_type = produk.id_type');
		$this->db->join('info_pt', 'info_pt.id_info_pt = produk.id_info_pt');
		if (!empty($search['id_jenis'])) {
			$this->db->where('produk.id_jenis',$search['id_jenis']);
		}
		if (!empty($search['id_merk'])) {
			$this->db->where('produk.id_merk',$search['id_merk']);
		}
		if (!empty($search['id_type'])) {
			$this->db->where('produk.id_type',$search['id_type']);
		}
		if (!empty($search['no_rangka'])) {
			$this->db->where('produk.no_rangka',$search['no_rangka']);
		}
		if (!empty($search['no_mesin'])) {
			$this->db->where('produk.no_mesin',$search['no_mesin']);
		}
		$this->db->where('produk.id_info_pt',$idinfopt);
		$this->db->where('produk.id_validasi','1');
		$this->db->limit($rowperpage, $rowno);
		$this->db->order_by('produk.id_produk','desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	  // Select total records
	public function getrecordCountid($idinfopt,$search) {
		$this->db->select('count(*) as allcount,produk.*,jenis.nm_jenis,merk.nm_merk,type.nm_type,info_pt.nama_info_pt,info_pt.kode_pt');
		$this->db->from('produk');
		$this->db->join('jenis', 'jenis.id_jenis = produk.id_jenis');
		$this->db->join('merk', 'merk.id_merk = produk.id_merk');
		$this->db->join('type', 'type.id_type = produk.id_type');
		$this->db->join('info_pt', 'info_pt.id_info_pt = produk.id_info_pt');
		if (!empty($search['id_jenis'])) {
			$this->db->where('id_jenis',$search['id_jenis']);
		}
		if (!empty($search['id_merk'])) {
			$this->db->where('produk.id_merk',$search['id_merk']);
		}
		if (!empty($search['id_type'])) {
			$this->db->where('produk.id_type',$search['id_type']);
		}
		if (!empty($search['no_rangka'])) {
			$this->db->where('produk.no_rangka',$search['no_rangka']);
		}
		if (!empty($search['no_mesin'])) {
			$this->db->where('produk.no_mesin',$search['no_mesin']);
		}
		$this->db->where('produk.id_info_pt',$idinfopt);
		$this->db->where('produk.id_validasi','1');
		$this->db->order_by('produk.id_produk','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['allcount'];
	}
}
