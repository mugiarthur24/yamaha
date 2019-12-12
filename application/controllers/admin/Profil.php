<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('admin/Admin_m');
		$this->load->model('admin/Users_m');
		$this->load->library('resize');
	}
	public function index(){
		if ($this->ion_auth->logged_in()) {
			$level = array('admin','karyawan');
			if (!$this->ion_auth->in_group($level)) {
				$pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/dashboard'));
			}else{
				$users = $this->ion_auth->user()->row();
				$data['title'] = 'Data Akun - '.$users->username;
				$data['infopt'] = $this->Admin_m->info_pt(1);
				$data['users'] = $users;
				$data['dttrans'] = $this->Admin_m->select_data('jenis_transaksi');
				$data['rlayanan'] = $this->Admin_m->rwlayanan($users->id);
				// echo "<pre>";print_r($data['rlayanan']);echo "</pre>";exit();
				$data['nav'] = 'nav/nav-admin';
				$data['groups'] = $this->ion_auth->groups()->result();
				$data['usergroups'] = array();
				if($usergroups = $this->ion_auth->get_users_groups($users->id)->result()){
					foreach($usergroups as $group)
					{
						$data['usergroups'][] = $group->id;
					}
				}
				$data['page'] = 'admin/profil/profil-v';
				$this->load->view('admin/dashboard-v',$data);
			}
		}else{
			$pesan = 'Login terlebih dahulu';
			$this->session->set_flashdata('message', $pesan );
			redirect(base_url('index.php/login'));
		}
	}
	public function proses_edit(){
		if ($this->ion_auth->logged_in()) {
			$level=array('admin');
			if (!$this->ion_auth->in_group($level)) {
				$pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/dashboard'));
			}else{

				$users = $this->ion_auth->user()->row();
				$id = $this->input->post('id');
				$additional_data = array(
					'email' => $this->input->post('email'),
					'username' => $this->input->post('username'),
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'company' => $this->input->post('company'),
					'phone' => $this->input->post('phone'),
					);
				if (!empty($_FILES["profile"]["tmp_name"])) {
					$config['file_name'] = strtolower(url_title('users'.'-'.$this->input->post('first_name').'-'.date('Ymd').'-'.time('His')));
					$config['upload_path'] = './assets/img/users/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size'] = 2048;
					$config['max_width'] = 1024;
					$config['max_height'] = 768;

					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('profile')){
						$error = $this->upload->display_errors();
						$this->session->set_flashdata('message', $error );
						redirect(base_url('index.php/admin/profil'));
					}
					else{
						$file = $users->profile;
						if ($file != "default.svg") {
							unlink("assets/img/users/$file");
						}
						$img = $this->upload->data('file_name');
						$additional_data['profile'] = $img;
						//file yang akan di resize
						$file = "assets/img/users/$img";
    					//output resize (bisa juga di ubah ke format yang berbeda ex: jpg, png dll)
						$resizedFile = "assets/img/users/$img";
						$this->resize->smart_resize_image(null , file_get_contents($file), 250 , 250 , false , $resizedFile , true , false ,100 );
					}
				}
				// $groups = $this->input->post('groups');
				// $this->ion_auth->remove_from_group('', $id);
				// $this->ion_auth->add_to_group($groups, $id);
				$this->ion_auth->update($id, $additional_data);
				if ($this->input->post('password') == TRUE) {
					$this->form_validation->set_rules('password', 'Password', 'min_length[5]|max_length[25]|alpha_numeric|required');
					// $this->form_validation->set_rules('repassword', 'Ulangi Password', '|required');
					// 
					if ($this->form_validation->run() == FALSE)
					{
					    $pesan = $pesan = validation_errors();
					    $this->session->set_flashdata('message', $pesan );
					    redirect(base_url('index.php/admin/profil'));
					}
					else
					{
						if (password_verify($this->input->post('oldpassword'),$users->password)) {
							$passdata = array(
								'password' => $this->input->post('password'),
								'repassword' =>$this->input->post('password'),
							);
							$this->ion_auth->update($users->id,$passdata);
						} else {
							$pesan = 'Password lama anda tidak sesuai';
							$this->session->set_flashdata('message', $pesan );
							redirect(base_url('index.php/admin/profil'));
						}
					}
				}
				$this->ion_auth->update($users->id, $additional_data);

				$pesan = 'user '.$this->input->post('username').' Berhasil di edit';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/admin/profil'));
			}
		}else{
			$pesan = 'Login terlebih dahulu';
			$this->session->set_flashdata('message', $pesan );
			redirect(base_url('index.php/login'));
		}
	}
}
