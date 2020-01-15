<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Laporan_m extends CI_Model
{
	// Fetch records
	public function getData($rowno,$rowperpage,$search) {
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
		if (!empty($search['id_info_pt'])) {
			$this->db->where('id_info_pt',$search['id_info_pt']);
		}
		if (!empty($search['tahun'])) {
			$this->db->like('tgl_jual',$search['tahun']);
		}
		// $this->db->where('produk.id_validasi','1');
		$this->db->limit($rowperpage, $rowno);
		$this->db->order_by('id_nota_keluar','desc');
		$query = $this->db->get();
		return $query->result_array();
	}
	// Select total records
	public function getrecordCount($search) {
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
		if (!empty($search['id_info_pt'])) {
			$this->db->where('id_info_pt',$$search['id_info_pt']);
		}
		if (!empty($search['tahun'])) {
			$this->db->like('tgl_jual',$search['tahun']);
		}
		// $this->db->where('produk.id_validasi','1');
		$this->db->order_by('id_nota_keluar','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['allcount'];
	}
	// Fetch records
	public function getDataid($idinfopt,$rowno,$rowperpage,$search) {
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
		if (!empty($search['tahun'])) {
			$this->db->like('tgl_jual',$search['tahun']);
		}
		$this->db->where('id_info_pt',$idinfopt);
		// $this->db->where('produk.id_validasi','1');
		$this->db->limit($rowperpage, $rowno);
		$this->db->order_by('id_nota_keluar','desc');
		$query = $this->db->get();
		return $query->result_array();
	}
	// Select total records
	public function getrecordCountid($idinfopt,$search) {
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
		if (!empty($search['tahun'])) {
			$this->db->like('tgl_jual',$search['tahun']);
		}
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
		$this->db->where('produk.id_status','1');
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
		$this->db->where('produk.id_status','1');
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
	public function getleasing($area) {
		if (!empty($area)) {
			$this->db->like('area',$area);
		}
		$query = $this->db->get('leasing');
		return $query->result();
	}
	public function getnotatoday($today) {
		$this->db->where('tgl_jual',$today);
		$this->db->where('id_status','1');
		$query = $this->db->get('nota_keluar');
		return $query->result();
	}
	public function stnk_tunda($search) {
		$this->db->select('count(*) as allcount');
		$this->db->from('nota_keluar');		
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
		if (!empty($search['id_info_pt'])) {
			$this->db->where('id_info_pt',$$search['id_info_pt']);
		}
		if (!empty($search['tahun'])) {
			$this->db->like('tgl_jual',$search['tahun']);
		}
		$this->db->where('nota_keluar.id_status_stnk','0');
		$this->db->order_by('id_nota_keluar','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['allcount'];
	}
	public function byr_cash($search) {
		$this->db->select('count(*) as allcount');
		$this->db->from('nota_keluar');		
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
		if (!empty($search['id_info_pt'])) {
			$this->db->where('id_info_pt',$$search['id_info_pt']);
		}
		if (!empty($search['tahun'])) {
			$this->db->like('tgl_jual',$search['tahun']);
		}
		$this->db->where('nota_keluar.id_leasing','0');
		$this->db->order_by('id_nota_keluar','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['allcount'];
	}
	public function byr_leasing($search) {
		$this->db->select('count(*) as allcount');
		$this->db->from('nota_keluar');		
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
		if (!empty($search['id_info_pt'])) {
			$this->db->where('id_info_pt',$$search['id_info_pt']);
		}
		if (!empty($search['tahun'])) {
			$this->db->like('tgl_jual',$search['tahun']);
		}
		$this->db->where_not_in('nota_keluar.id_leasing','0');
		$this->db->order_by('id_nota_keluar','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['allcount'];
	}
	// Fetch records
	public function getDatatoday($date,$idinfopt) {
		$this->db->from('nota_keluar');
		$this->db->where('tgl_jual',$date);
		$this->db->where('id_info_pt',$idinfopt);
		$this->db->order_by('id_nota_keluar','desc');
		$query = $this->db->get();
		return $query->result_array();
	}
	// Select total records
	public function getrecordtoday($date,$idinfopt) {
		$this->db->select('count(*) as allcount,nota_keluar.*');
		$this->db->from('nota_keluar');
		$this->db->where('tgl_jual',$date);
		$this->db->where('id_info_pt',$idinfopt);
		$this->db->order_by('id_nota_keluar','desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result[0]['allcount'];
	}
	public function getprodukterjual($date,$idinfopt) {
		$this->db->select('COUNT(produk.id_type) as total,type.nm_type,nota_keluar.*');
		$this->db->join('produk', 'produk.id_produk = nota_keluar.id_produk');
		$this->db->join('type', 'type.id_type = produk.id_type');
		$this->db->where('nota_keluar.tgl_jual',$date);
		$this->db->where('nota_keluar.id_info_pt',$idinfopt);
		$this->db->where_not_in('nota_keluar.id_produk','0');
		$this->db->group_by('produk.id_type');
		$query = $this->db->get('nota_keluar');
		return $query->result();
	}
}
