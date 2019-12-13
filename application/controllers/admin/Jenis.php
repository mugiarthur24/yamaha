<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class jenis extends CI_Controller {
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
				$data['title'] = 'Daftar Jenis';
				$data['infopt'] = $infopt;
				$data['users'] = $getuser;
				$data['aside'] = 'nav/nav';
				$data['hasil'] = $this->Admin_m->select_data('jenis');
				$data['page'] = 'admin/jenis/main-v';
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
				$this->form_validation->set_rules('nm_jenis', 'Nama Jenis', 'required|alpha_numeric_spaces');
				$this->form_validation->set_rules('kode_jenis', 'Kode Jenis', 'required|alpha_numeric_spaces');
				$this->form_validation->set_rules('ket_jenis', 'Keterangan Jenis', 'required|alpha_numeric_spaces');
				if ($this->form_validation->run() == FALSE){
					$pesan = $pesan = validation_errors();
					$this->session->set_flashdata('message', $pesan );
					redirect(base_url('index.php/admin/jenis'));
				}else{
					$data = array(
						'nm_jenis' =>strip_tags(trim($post['nm_jenis'])),
						'kode_jenis' =>strip_tags(trim($post['kode_jenis'])),
						'ket_jenis' =>strip_tags(trim($post['ket_jenis'])),
					);
					$this->Admin_m->create('jenis',$data);
					$pesan = 'Jenis Produk '.strip_tags(trim($post['nm_jenis'])).' Berhasil ditambahkan';
					$this->session->set_flashdata('message', $pesan );
					redirect(base_url('index.php/admin/jenis'));
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
                $data['title'] = 'Edit jenis - '.$infopt->nama_info_pt;
                $data['infopt'] = $infopt;
                $data['users'] = $getuser;
                $data['aside'] = 'nav/nav';
                $data['hasil'] = $this->Admin_m->detail_data('jenis','id_jenis',$id);
                $data['page'] = 'admin/jenis/edit-v';
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
                $this->form_validation->set_rules('nm_jenis', 'Nama Jenis', 'required|alpha_numeric_spaces');
				$this->form_validation->set_rules('kode_jenis', 'Kode Jenis', 'required|alpha_numeric_spaces');
				$this->form_validation->set_rules('ket_jenis', 'Keterangan Jenis', 'required|alpha_numeric_spaces');
				if ($this->form_validation->run() == FALSE){
					$pesan = $pesan = validation_errors();
					$this->session->set_flashdata('message', $pesan );
					redirect(base_url('index.php/admin/jenis'));
				}else{
					$data = array(
						'nm_jenis' =>strip_tags(trim($post['nm_jenis'])),
						'kode_jenis' =>strip_tags(trim($post['kode_jenis'])),
						'ket_jenis' =>strip_tags(trim($post['ket_jenis'])),
					);
					$this->Admin_m->update('jenis','id_jenis',$id,$data);
					$pesan = 'Jenis Produk '.strip_tags(trim($post['nm_jenis'])).' Berhasil diedit';
					$this->session->set_flashdata('message', $pesan );
					redirect(base_url('index.php/admin/jenis'));
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
            	$this->Admin_m->delete('jenis','id_jenis',$id);
            	$pesan = 'Order berhasil dihapus';
            	$this->session->set_flashdata('message', $pesan );
            	redirect(base_url('index.php/admin/jenis/'));
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
}
