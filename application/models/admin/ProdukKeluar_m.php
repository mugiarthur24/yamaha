<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ProdukKeluar_m extends CI_Model
{
	// Fetch records
	public function getData($rowno,$rowperpage,$search) {
		$this->db->from('produkkeluar');
		if (!empty($search['kode_pk'])) {
			$this->db->where('kode_pk',$search['kode_pk']);
		}
		if (!empty($search['nm_user'])) {
			$this->db->like('nm_user',$search['nm_user']);
		}
		if (!empty($search['id_info_pt_asal'])) {
			$this->db->where('id_info_pt_asal',$search['id_info_pt_asal']);
		}
		if (!empty($search['id_info_pt_tujuan'])) {
			$this->db->where('id_info_pt_tujuan',$search['id_info_pt_tujuan']);
		}
		if (!empty($search['tgl_buat'])) {
			$this->db->where('tgl_buat',$search['tgl_buat']);
		}
		if (!empty($search['id_status'])) {
			$this->db->where('id_status',$search['id_status']);
		}
		$this->db->limit($rowperpage, $rowno);
		$this->db->order_by('id_pk','desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	  // Select total records
	public function getrecordCount($search) {
		$this->db->select('count(*) as allcount,produkkeluar.*');
		$this->db->from('produkkeluar');
		if (!empty($search['kode_pk'])) {
			$this->db->where('kode_pk',$search['kode_pk']);
		}
		if (!empty($search['nm_user'])) {
			$this->db->like('nm_user',$search['nm_user']);
		}
		if (!empty($search['id_info_pt_asal'])) {
			$this->db->where('id_info_pt_asal',$search['id_info_pt_asal']);
		}
		if (!empty($search['id_info_pt_tujuan'])) {
			$this->db->where('id_info_pt_tujuan',$search['id_info_pt_tujuan']);
		}
		if (!empty($search['tgl_buat'])) {
			$this->db->where('tgl_buat',$search['tgl_buat']);
		}
		if (!empty($search['id_status'])) {
			$this->db->where('id_status',$search['id_status']);
		}
		$this->db->order_by('id_pk','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['allcount'];
	}
	// Fetch records
	public function getDataid($idinfopt,$rowno,$rowperpage,$search) {
		$this->db->from('produkkeluar');
		if (!empty($search['kode_pk'])) {
			$this->db->where('kode_pk',$search['kode_pk']);
		}
		if (!empty($search['nm_user'])) {
			$this->db->like('nm_user',$search['nm_user']);
		}
		if (!empty($search['id_info_pt_asal'])) {
			$this->db->where('id_info_pt_asal',$search['id_info_pt_asal']);
		}
		if (!empty($search['id_info_pt_tujuan'])) {
			$this->db->where('id_info_pt_tujuan',$search['id_info_pt_tujuan']);
		}
		if (!empty($search['tgl_buat'])) {
			$this->db->where('tgl_buat',$search['tgl_buat']);
		}
		if (!empty($search['id_status'])) {
			$this->db->where('id_status',$search['id_status']);
		}
		$this->db->where('produkkeluar.id_info_pt_asal',$idinfopt);
		$this->db->limit($rowperpage, $rowno);
		$this->db->order_by('id_pk','desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	  // Select total records
	public function getrecordCountid($idinfopt,$search) {
		$this->db->select('count(*) as allcount,produkkeluar.*');
		$this->db->from('produkkeluar');
		if (!empty($search['kode_pk'])) {
			$this->db->where('kode_pk',$search['kode_pk']);
		}
		if (!empty($search['nm_user'])) {
			$this->db->like('nm_user',$search['nm_user']);
		}
		if (!empty($search['id_info_pt_asal'])) {
			$this->db->where('id_info_pt_asal',$search['id_info_pt_asal']);
		}
		if (!empty($search['id_info_pt_tujuan'])) {
			$this->db->where('id_info_pt_tujuan',$search['id_info_pt_tujuan']);
		}
		if (!empty($search['tgl_buat'])) {
			$this->db->where('tgl_buat',$search['tgl_buat']);
		}
		if (!empty($search['id_status'])) {
			$this->db->where('id_status',$search['id_status']);
		}
		$this->db->where('produkkeluar.id_info_pt_asal',$idinfopt);
		$this->db->order_by('id_pk','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['allcount'];
	}
	public function getprodukkeluar($date,$time){
		$this->db->where('tgl_buat',$date);
		$this->db->where('waktu_buat',$time);
		$query = $this->db->get('produkkeluar');
		return $query->row();
	}
	public function lastid(){
		$this->db->order_by('id_pk','desc');
		$query = $this->db->get('produkkeluar');
		return $query->row();
	}
	public function getproduk($id){
		$this->db->select('brg_pk.*,type.nm_type');
		$this->db->where('id_pk',$id);
		$this->db->join('type', 'type.id_type = brg_pk.id_type');
		$query = $this->db->get('brg_pk');
		return $query->result();
	}
	public function cekbrgnota($idpm,$idtype){
		$this->db->where('id_pk',$idpm);
		$this->db->where('id_type',$idtype);
		$query = $this->db->get('brg_pk');
		return $query->row();
	}
	public function cekbrgproduk($brg){
		$this->db->where('id_brg_pk',$brg);
		$query = $this->db->get('brg_pk');
		return $query->row();
	}
	public function getsubproduk($id,$brg){
		$this->db->select('r_brg_pk.*,produk.*,jenis.nm_jenis,merk.nm_merk,type.nm_type,info_pt.nama_info_pt');
		$this->db->where('r_brg_pk.id_brg_pk',$brg);
		$this->db->where('r_brg_pk.id_pk',$id);
		$this->db->join('produk', 'produk.id_produk = r_brg_pk.id_produk');
		$this->db->join('jenis', 'jenis.id_jenis = produk.id_jenis');
		$this->db->join('merk', 'merk.id_merk = produk.id_merk');
		$this->db->join('type', 'type.id_type = produk.id_type');
		$this->db->join('info_pt', 'info_pt.id_info_pt = produk.id_info_pt');
		$this->db->order_by('produk.id_produk','desc');
		$query = $this->db->get('r_brg_pk');
		return $query->result();
	}
	public function gettype($id){
		$this->db->select('type.*,jenis.nm_jenis,merk.nm_merk');
		$this->db->join('jenis', 'jenis.id_jenis = type.id_jenis');
		$this->db->join('merk', 'merk.id_merk = type.id_merk');
		$this->db->where('id_type',$id);
		$query = $this->db->get('type');
		return $query->row();
	}
	public function getsubpk($id){
		$this->db->select('brg_pk.*,type.nm_type,jenis.nm_jenis,merk.nm_merk');
		$this->db->join('type', 'type.id_type =brg_pk.id_type');
		$this->db->join('jenis', 'jenis.id_jenis = type.id_jenis');
		$this->db->join('merk', 'merk.id_merk = type.id_merk');
		$this->db->where('id_brg_pk',$id);
		$query = $this->db->get('brg_pk');
		return $query->row();
	}
	public function brgtypediinfo($idpt,$idtype){
		$this->db->select('produk.*,type.nm_type,jenis.nm_jenis,merk.nm_merk');
		$this->db->join('type', 'type.id_type =produk.id_type');
		$this->db->join('jenis', 'jenis.id_jenis = type.id_jenis');
		$this->db->join('merk', 'merk.id_merk = type.id_merk');
		$this->db->where('produk.id_type',$idtype->id_type);
		$this->db->where('produk.id_info_pt',$idpt);
		$this->db->where('produk.cc',$idtype->cc);
		$this->db->like('produk.warna',$idtype->warna);
		$this->db->where('produk.id_status','1');
		$query = $this->db->get('produk');
		return $query->result();
	}
}
