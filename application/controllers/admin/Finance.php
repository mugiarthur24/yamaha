<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class finance extends CI_Controller {
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
				$data['title'] = 'Daftar Finance';
				$data['infopt'] = $infopt;
				$data['users'] = $getuser;
				$data['aside'] = 'nav/nav';
				$data['hasil'] = $this->Admin_m->select_data('leasing');
				$data['page'] = 'admin/finance/main-v';
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
				$this->form_validation->set_rules('nm_leasing', 'Nama Leasing', 'required|alpha_numeric_spaces');
				$this->form_validation->set_rules('kode_leasing', 'Kode Leasing', 'required|alpha_numeric_spaces');
				$this->form_validation->set_rules('ket_leasing', 'Keterangan', 'required|alpha_numeric_spaces');
				$this->form_validation->set_rules('area', 'Area', 'required|alpha_numeric_spaces');
				if ($this->form_validation->run() == FALSE){
					$pesan = $pesan = validation_errors();
					$this->session->set_flashdata('message', $pesan );
					redirect(base_url('index.php/admin/finance'));
				}else{
					$data = array(
						'nm_leasing' =>strip_tags(trim($post['nm_leasing'])),
						'kode_leasing' =>strip_tags(trim($post['kode_leasing'])),
						'area' =>strip_tags(trim($post['area'])),
						'ket_leasing' =>strip_tags(trim($post['ket_leasing'])),
					);
					$this->Admin_m->create('leasing',$data);
					$pesan = 'Leasing'.strip_tags(trim($post['nm_leasing'])).' Berhasil ditambahkan';
					$this->session->set_flashdata('message', $pesan );
					redirect(base_url('index.php/admin/finance'));
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
                $data['title'] = 'Edit Finance - '.$infopt->nama_info_pt;
                $data['infopt'] = $infopt;
                $data['users'] = $getuser;
                $data['aside'] = 'nav/nav';
                $data['hasil'] = $this->Admin_m->detail_data('leasing','id_leasing',$id);
                $data['page'] = 'admin/finance/edit-v';
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
                $this->form_validation->set_rules('nm_leasing', 'Nama Leasing', 'required|alpha_numeric_spaces');
				$this->form_validation->set_rules('kode_leasing', 'Kode Leasing', 'required|alpha_numeric_spaces');
				$this->form_validation->set_rules('ket_leasing', 'Keterangan', 'required|alpha_numeric_spaces');
				$this->form_validation->set_rules('area', 'Area', 'required|alpha_numeric_spaces');
				if ($this->form_validation->run() == FALSE){
					$pesan = $pesan = validation_errors();
					$this->session->set_flashdata('message', $pesan );
					redirect(base_url('index.php/admin/jenis'));
				}else{
					$data = array(
						'nm_leasing' =>strip_tags(trim($post['nm_leasing'])),
						'kode_leasing' =>strip_tags(trim($post['kode_leasing'])),
						'area' =>strip_tags(trim($post['area'])),
						'ket_leasing' =>strip_tags(trim($post['ket_leasing'])),
					);
					$this->Admin_m->update('leasing','id_leasing',$id,$data);
					$pesan = 'Leasing '.strip_tags(trim($post['nm_leasing'])).' Berhasil diedit';
					$this->session->set_flashdata('message', $pesan );
					redirect(base_url('index.php/admin/finance'));
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
            	$this->Admin_m->delete('leasing','id_leasing',$id);
            	$pesan = 'Data berhasil dihapus';
            	$this->session->set_flashdata('message', $pesan );
            	redirect(base_url('index.php/admin/finance/'));
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
}
