<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Penjualan_m extends CI_Model
{
	// Fetch records
	public function getDataid($date,$idinfopt,$rowno,$rowperpage,$search) {
		$this->db->from('nota_keluar');
		// $this->db->join('produk', 'produk.id_produk = nota_keluar.id_produk');
		// $this->db->join('jenis', 'jenis.id_jenis = produk.id_jenis');
		// $this->db->join('merk', 'merk.id_merk = produk.id_merk');
		// $this->db->join('type', 'type.id_type = produk.id_type');
		// $this->db->join('info_pt', 'info_pt.id_info_pt = produk.id_info_pt');
		if (!empty($search['no_nota_keluar'])) {
			$this->db->where('no_nota_keluar',$search['no_nota_keluar']);
		}
		if (!empty($search['nama'])) {
			$this->db->like('nm_p_ktp',$search['nama']);
			$this->db->or_like('no_ktp_p',$search['nama']);
		}
		if (!empty($search['id_status'])) {
			$this->db->where('id_status',$search['id_status']);
		}
		$this->db->where('tgl_jual',$date);
		$this->db->where('id_info_pt',$idinfopt);
		// $this->db->where('produk.id_validasi','1');
		$this->db->limit($rowperpage, $rowno);
		$this->db->order_by('id_nota_keluar','desc');
		$query = $this->db->get();
		return $query->result_array();
	}
	// Select total records
	public function getrecordCountid($date,$idinfopt,$search) {
		// $this->db->$this->db->select('count(*) as allcount,nota_keluar.*,jenis.nm_jenis,merk.nm_merk,type.nm_type,info_pt.nama_info_pt');
		$this->db->select('count(*) as allcount,nota_keluar.*');
		$this->db->from('nota_keluar');
		// $this->db->join('produk', 'produk.id_produk = nota_keluar.id_produk');
		// $this->db->join('jenis', 'jenis.id_jenis = produk.id_jenis');
		// $this->db->join('merk', 'merk.id_merk = produk.id_merk');
		// $this->db->join('type', 'type.id_type = produk.id_type');
		// $this->db->join('info_pt', 'info_pt.id_info_pt = produk.id_info_pt');
		if (!empty($search['no_nota_keluar'])) {
			$this->db->where('no_nota_keluar',$search['no_nota_keluar']);
		}
		if (!empty($search['nama'])) {
			$this->db->like('nm_p_ktp',$search['nama']);
			$this->db->or_like('no_ktp_p',$search['nama']);
		}
		if (!empty($search['id_status'])) {
			$this->db->where('id_status',$search['id_status']);
		}
		$this->db->where('tgl_jual',$date);
		$this->db->where('id_info_pt',$idinfopt);
		// $this->db->where('produk.id_validasi','1');
		$this->db->order_by('id_nota_keluar','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['allcount'];
	}
	// pencarian produk penjualan
	// Fetch records
	public function getDataidPenjualan($idinfopt,$rowno,$rowperpage,$search) {
		$this->db->from('produk');
		$this->db->join('jenis', 'jenis.id_jenis = produk.id_jenis');
		$this->db->join('merk', 'merk.id_merk = produk.id_merk');
		$this->db->join('type', 'type.id_type = produk.id_type');
		$this->db->join('info_pt', 'info_pt.id_info_pt = produk.id_info_pt');
		if (!empty($search['id_type'])) {
			$this->db->where('produk.id_type',$search['id_type']);
		}
		if (!empty($search['cc'])) {
			$this->db->where('produk.cc',$search['cc']);
		}
		if (!empty($search['warna'])) {
			$this->db->where('produk.warna',$search['warna']);
		}
		if (!empty($search['id_info_pt'])) {
			$this->db->where('produk.id_info_pt',$search['id_info_pt']);
		}
		$this->db->where('produk.id_info_pt',$idinfopt);
		$this->db->where('produk.id_validasi','1');
		$this->db->limit($rowperpage, $rowno);
		$this->db->order_by('produk.id_produk','desc');
		$query = $this->db->get();
		return $query->result_array();
	}
	// Select total records
	public function getrecordCountidPenjualan($idinfopt,$search) {
		$this->db->select('count(*) as allcount,produk.*,jenis.nm_jenis,merk.nm_merk,type.nm_type,info_pt.nama_info_pt');
		$this->db->from('produk');
		$this->db->join('jenis', 'jenis.id_jenis = produk.id_jenis');
		$this->db->join('merk', 'merk.id_merk = produk.id_merk');
		$this->db->join('type', 'type.id_type = produk.id_type');
		$this->db->join('info_pt', 'info_pt.id_info_pt = produk.id_info_pt');
		if (!empty($search['id_type'])) {
			$this->db->where('produk.id_type',$search['id_type']);
		}
		if (!empty($search['cc'])) {
			$this->db->where('produk.cc',$search['cc']);
		}
		if (!empty($search['warna'])) {
			$this->db->where('produk.warna',$search['warna']);
		}
		if (!empty($search['id_info_pt'])) {
			$this->db->where('produk.id_info_pt',$search['id_info_pt']);
		}
		$this->db->where('produk.id_info_pt',$idinfopt);
		$this->db->where('produk.id_validasi','1');
		$this->db->order_by('produk.id_produk','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['allcount'];
	}
	public function lastnota(){
		$this->db->select('id_nota_keluar');
		$this->db->order_by('id_nota_keluar','desc');
		$query = $this->db->get('nota_keluar');
		return $query->row();
	}
	public function detailproduk($id) {
		$this->db->select('produk.*,jenis.nm_jenis,merk.nm_merk,type.nm_type,info_pt.nama_info_pt');
		$this->db->join('jenis', 'jenis.id_jenis = produk.id_jenis');
		$this->db->join('merk', 'merk.id_merk = produk.id_merk');
		$this->db->join('type', 'type.id_type = produk.id_type');
		$this->db->join('info_pt', 'info_pt.id_info_pt = produk.id_info_pt');
		$this->db->where('produk.id_produk',$id);
		$this->db->where('produk.id_validasi','1');
		$query = $this->db->get('produk');
		return $query->row();
	}
}
