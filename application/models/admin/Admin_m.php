<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_m extends CI_Model
{
	public function info_pt($id){
		$this->db->where('id_info_pt', $id);
		$query = $this->db->get('info_pt');
		return $query->row();
	}
	public function cek_pt($id){
		$this->db->where('id_info_pt', $id);
		$query = $this->db->get('info_pt');
		return $query;
	}
	function create($table,$data){
		$this->db->insert($table,$data);
	}
	function update($table,$field,$id,$data){
		$this->db->where($field,$id);
		$this->db->update($table,$data);
	}
	function delete($table,$field,$id){
		$this->db->where($field, $id);
		$this->db->delete($table);
	}
	public function detail_data($table,$field,$id){
		$this->db->where($field, $id);
		$query = $this->db->get($table);
		return $query->row();
	}
	public function select_data($table){
		$query = $this->db->get($table);
		return $query->result();
	}
	public function select_data_order($table,$field,$id){
		$this->db->where($field, $id);
		$query = $this->db->get($table);
		return $query->result();
	}
	public function get_smt_kemarin($smt){
		$this->db2->where('id_stat_mhs','A');
		$this->db2->where('id_smt',$smt);
		$query = $this->db2->get('kuliah_mahasiswa');
		return $query;
	}
	public function mhsblmbayar($smt){
		$this->db->where_not_in('id_stat','1');
		$this->db->where('id_smt',$smt);
		$query = $this->db->get('transaksi');
		return $query;
	}
	public function mhssdhbayar($smt){
		$this->db->where('id_stat','1');
		$this->db->where('id_smt',$smt);
		$query = $this->db->get('transaksi');
		return $query;
	}
	public function rwlayanan($idkar){
		$this->db->select('transaksi.*,nota.id_users,jenis_transaksi.nm_transaksi');
		$this->db->where('id_users',$idkar);
		$this->db->limit(25);
		$this->db->join('nota', 'nota.kode_nota = transaksi.kode_nota');
		$this->db->join('jenis_transaksi', 'jenis_transaksi.id_jns_transaksi = transaksi.id_jns_transaksi');
		$this->db->order_by('id_transaksi','desc');
		$query = $this->db->get('transaksi');
		return $query->result();
	}
	public function getangtrxbysmt($smt){
		$this->db->select('transaksi.angkatan,COUNT(angkatan) as total');
		$this->db->group_by('angkatan');
		$this->db->where('id_smt',$smt);
		$query = $this->db->get('transaksi');
		return $query->result();
	}
}
