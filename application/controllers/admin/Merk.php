<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merk extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('admin/Admin_m');
	}
	public function index(){
		if ($this->ion_auth->logged_in()) {
			$level = array('admin');
			if (!$this->ion_auth->in_group($level)) {
				$pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/dashboard'));
			}else{
				$getuser = $this->ion_auth->user()->row();
				$infopt = $this->Admin_m->info_pt($getuser->id_info_pt);
				$data['title'] = 'Daftar merk';
				$data['infopt'] = $infopt;
				$data['users'] = $getuser;
				$data['aside'] = 'nav/nav';
				$data['hasil'] = $this->Admin_m->select_data('merk');
				$data['page'] = 'admin/merk/main-v';
				$this->load->view('admin/dashboard-v',$data);
			}
		}else{
			$pesan = 'Login terlebih dahulu';
			$this->session->set_flashdata('message', $pesan );
			redirect(base_url('index.php/login'));
		}
	}
	public function create(){
		if ($this->ion_auth->logged_in()) {
			$level = array('admin');
			if (!$this->ion_auth->in_group($level)) {
				$pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/dashboard'));
			}else{
				$post=$this->input->post();
				$this->form_validation->set_rules('nm_merk', 'Nama merk', 'required|alpha_numeric_spaces');
				$this->form_validation->set_rules('kode_merk', 'Kode merk', 'required|alpha_numeric_spaces');
				$this->form_validation->set_rules('ket_merk', 'Keterangan merk', 'required|alpha_numeric_spaces');
				if ($this->form_validation->run() == FALSE){
					$pesan = $pesan = validation_errors();
					$this->session->set_flashdata('message', $pesan );
					redirect(base_url('index.php/admin/merk'));
				}else{
					$data = array(
						'nm_merk' =>strip_tags(trim($post['nm_merk'])),
						'kode_merk' =>strip_tags(trim($post['kode_merk'])),
						'ket_merk' =>strip_tags(trim($post['ket_merk'])),
					);
					$this->Admin_m->create('merk',$data);
					$pesan = 'merk Produk '.strip_tags(trim($post['nm_merk'])).' Berhasil ditambahkan';
					$this->session->set_flashdata('message', $pesan );
					redirect(base_url('index.php/admin/merk'));
				}
			}
		}else{
			$pesan = 'Login terlebih dahulu';
			$this->session->set_flashdata('message', $pesan );
			redirect(base_url('index.php/login'));
		}
	}
	public function edit($id){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','members');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/dashboard'));
            }else{
                $getuser = $this->ion_auth->user()->row();
				$infopt = $this->Admin_m->info_pt($getuser->id_info_pt);
                $data['title'] = 'Edit merk - '.$infopt->nama_info_pt;
                $data['infopt'] = $infopt;
                $data['users'] = $getuser;
                $data['aside'] = 'nav/nav';
                $data['hasil'] = $this->Admin_m->detail_data('merk','id_merk',$id);
                $data['page'] = 'admin/merk/edit-v';
                // pagging setting
                $this->load->view('admin/dashboard-v',$data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function update($id){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/dashboard'));
            }else{
                $post=$this->input->post();
                $this->form_validation->set_rules('nm_merk', 'Nama merk', 'required|alpha_numeric_spaces');
				$this->form_validation->set_rules('kode_merk', 'Kode merk', 'required|alpha_numeric_spaces');
				$this->form_validation->set_rules('ket_merk', 'Keterangan merk', 'required|alpha_numeric_spaces');
				if ($this->form_validation->run() == FALSE){
					$pesan = $pesan = validation_errors();
					$this->session->set_flashdata('message', $pesan );
					redirect(base_url('index.php/admin/merk'));
				}else{
					$data = array(
						'nm_merk' =>strip_tags(trim($post['nm_merk'])),
						'kode_merk' =>strip_tags(trim($post['kode_merk'])),
						'ket_merk' =>strip_tags(trim($post['ket_merk'])),
					);
					$this->Admin_m->update('merk','id_merk',$id,$data);
					$pesan = 'merk Produk '.strip_tags(trim($post['nm_merk'])).' Berhasil diedit';
					$this->session->set_flashdata('message', $pesan );
					redirect(base_url('index.php/admin/merk'));
				}
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
	public function delete($id){
		if ($this->ion_auth->logged_in()) {
            $level = array('admin');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/dashboard'));
            }else{
            	$this->Admin_m->delete('merk','id_merk',$id);
            	$pesan = 'Order berhasil dihapus';
            	$this->session->set_flashdata('message', $pesan );
            	redirect(base_url('index.php/admin/merk/'));
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
}
