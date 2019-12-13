<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type extends CI_Controller {
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
				$data['title'] = 'Daftar type';
				$data['infopt'] = $infopt;
				$data['users'] = $getuser;
				$data['aside'] = 'nav/nav';
				$data['hasil'] = $this->Admin_m->select_data('type');
				$data['page'] = 'admin/type/main-v';
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
				$this->form_validation->set_rules('nm_type', 'Nama type', 'required|alpha_numeric_spaces');
				$this->form_validation->set_rules('kode_type', 'Kode type', 'required|alpha_numeric_spaces');
				$this->form_validation->set_rules('ket_type', 'Keterangan type', 'required|alpha_numeric_spaces');
				if ($this->form_validation->run() == FALSE){
					$pesan = $pesan = validation_errors();
					$this->session->set_flashdata('message', $pesan );
					redirect(base_url('index.php/admin/type'));
				}else{
					$data = array(
						'nm_type' =>strip_tags(trim($post['nm_type'])),
						'kode_type' =>strip_tags(trim($post['kode_type'])),
						'ket_type' =>strip_tags(trim($post['ket_type'])),
					);
					$this->Admin_m->create('type',$data);
					$pesan = 'type Produk '.strip_tags(trim($post['nm_type'])).' Berhasil ditambahkan';
					$this->session->set_flashdata('message', $pesan );
					redirect(base_url('index.php/admin/type'));
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
                $data['title'] = 'Edit type - '.$infopt->nama_info_pt;
                $data['infopt'] = $infopt;
                $data['users'] = $getuser;
                $data['aside'] = 'nav/nav';
                $data['hasil'] = $this->Admin_m->detail_data('type','id_type',$id);
                $data['page'] = 'admin/type/edit-v';
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
                $this->form_validation->set_rules('nm_type', 'Nama type', 'required|alpha_numeric_spaces');
				$this->form_validation->set_rules('kode_type', 'Kode type', 'required|alpha_numeric_spaces');
				$this->form_validation->set_rules('ket_type', 'Keterangan type', 'required|alpha_numeric_spaces');
				if ($this->form_validation->run() == FALSE){
					$pesan = $pesan = validation_errors();
					$this->session->set_flashdata('message', $pesan );
					redirect(base_url('index.php/admin/type'));
				}else{
					$data = array(
						'nm_type' =>strip_tags(trim($post['nm_type'])),
						'kode_type' =>strip_tags(trim($post['kode_type'])),
						'ket_type' =>strip_tags(trim($post['ket_type'])),
					);
					$this->Admin_m->update('type','id_type',$id,$data);
					$pesan = 'type Produk '.strip_tags(trim($post['nm_type'])).' Berhasil diedit';
					$this->session->set_flashdata('message', $pesan );
					redirect(base_url('index.php/admin/type'));
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
            	$this->Admin_m->delete('type','id_type',$id);
            	$pesan = 'Order berhasil dihapus';
            	$this->session->set_flashdata('message', $pesan );
            	redirect(base_url('index.php/admin/type/'));
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
}
