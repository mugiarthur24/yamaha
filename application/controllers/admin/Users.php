<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('admin/Admin_m');
		$this->load->model('admin/Users_m');
		$this->load->library('resize');
	}
	public function index($rowno=0){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard'));
            }else{
                $post = $this->input->post();
                $getuser = $this->ion_auth->user()->row();
                $infopt = $this->Admin_m->info_pt($getuser->id_info_pt);
                $data['title'] = 'Daftar Karyawan Perusahaan '.$infopt->nama_info_pt;
                $data['brand'] = $infopt->logo_pt;
                $data['infopt'] = $infopt;
                $data['users'] = $getuser;
                $data['aside'] = 'nav/nav';
                $data['detail'] = $getuser;
                if ($this->ion_auth->in_group($level)) {
                	$data['dtpt'] = $this->Admin_m->select_data('info_pt');
                }
                $data['page'] = 'admin/users/main-v';
                   $search_text = "";
                   if($post == TRUE ){
                       $search_text = $post;
                       $this->session->set_userdata($post);
                   }else{
                       $post = array();
                       if($this->session->userdata('string') != NULL){
                        $post['string'] = $this->session->userdata('string');
                       }
                       if($this->session->userdata('id_info_pt') != NULL){
                        $post['id_info_pt'] = $this->session->userdata('id_info_pt');
                       }
                       $search_text = $post;
                   }
                   // Row per page
                   $rowperpage = 20;
                   // Row position
                   if($rowno != 0){
                     $rowno = ($rowno-1) * $rowperpage;
                 }
                if ($getuser->id_info_pt =='1') {
                   $allcount = $this->Users_m->getrecordCount($search_text);
                   // Get records
                   $users_record = $this->Users_m->getData($rowno,$rowperpage,$search_text);
                }else{
                    // All records count
                    $allcount = $this->Users_m->getrecordCountid($getuser->id_info_pt,$search_text);
                    // Get records
                    $users_record = $this->Users_m->getDataid($getuser->id_info_pt,$rowno,$rowperpage,$search_text);
                }
                // Pagination Configuration
                 $config['base_url'] = base_url().'index.php/admin/users';
                 $config['use_page_numbers'] = TRUE;
                 $config['total_rows'] = $allcount;
                 $config['per_page'] = $rowperpage;
                 // style pagging
                 $config['first_link']       = 'Pertama';
                 $config['last_link']        = 'Terakhir';
                 $config['next_link']        = 'Selanjutnya';
                 $config['prev_link']        = 'Sebelumnya';
                 $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination pagination-sm justify-content-center">';
                 $config['full_tag_close']   = '</ul></nav></div>';
                 $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
                 $config['num_tag_close']    = '</span></li>';
                 $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
                 $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
                 $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
                 $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
                 $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
                 $config['prev_tagl_close']  = '</span>Next</li>';
                 $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
                 $config['first_tagl_close'] = '</span></li>';
                 $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
                 $config['last_tagl_close']  = '</span></li>';
                // Initialize
                 $this->pagination->initialize($config);
                  $data['hasil'] = $users_record;
                  $data['row'] = $rowno;
                  $data['jmldata'] = $allcount;
                  $data['search'] = $search_text;
                  $data['post'] = $search_text;
                 $data['pagination'] = $this->pagination->create_links();
                 // echo "<pre>";print_r($search_text);echo "</pre>";exit();
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
				redirect(base_url('index.php/admin/dashboard'));
			}else{
				$post = $this->input->post();
                $getuser = $this->ion_auth->user()->row();
                $infopt = $this->Admin_m->info_pt($getuser->id_info_pt);
				$data['title'] = 'Tambah Karyawan Baru';
				$data['infopt'] = $infopt;
				$data['users'] = $getuser;
				$data['groups'] = $this->ion_auth->groups()->result();
				$data['dtpt'] = $this->Admin_m->select_data('info_pt');
				$data['page'] = 'admin/users/tambah-v';
				$this->load->view('admin/dashboard-v',$data);
			}
		}else{
			$pesan = 'Login terlebih dahulu';
			$this->session->set_flashdata('message', $pesan );
			redirect(base_url('index.php/login'));
		}
	}
	public function proses_create(){
		if ($this->ion_auth->logged_in()) {
			$level=array('admin');
			if (!$this->ion_auth->in_group($level)) {
				$pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/admin/dashboard'));
			}else{
				// echo "<pre>";print_r($this->input->post());echo "</pre>";exit();
				$this->form_validation->set_rules('first_name', 'Nama Depan', 'required|alpha_numeric_spaces');
				$this->form_validation->set_rules('last_name', 'Nama Belakang', 'alpha_numeric_spaces');
				$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required|alpha|max_length[1]');
				$this->form_validation->set_rules('phone', 'Nomor HP', 'required|numeric|min_length[12]|max_length[15]');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
				$this->form_validation->set_rules('id_info_pt', 'Cabang Perusahaan', 'required|numeric|max_length[3]');
				$this->form_validation->set_rules('password', 'Password', 'required|alpha_numeric|min_length[5]|max_length[20]');
				$this->form_validation->set_rules('repassword', 'Ulangi Password', 'required|alpha_numeric|min_length[5]|max_length[20]|matches[password]');
				if ($this->form_validation->run() == FALSE){
				    $pesan = validation_errors();
				    $this->session->set_flashdata('message',$pesan); 
				    redirect(base_url('index.php/admin/users/create/'));
				}else{
					$getuser = $this->ion_auth->user()->row();
					$infopt = $this->Admin_m->info_pt($getuser->id_info_pt);
					if ($getuser->id_info_pt == '1') {
						$idpt = strip_tags($this->input->post('id_info_pt'));
						$company = $this->Admin_m->detail_data('info_pt','id_info_pt',strip_tags($this->input->post('id_info_pt')))->nama_info_pt;
					}else{
						$idpt = strip_tags($getuser->id_info_pt);
						$company = $this->Admin_m->detail_data('info_pt','id_info_pt',$getuser->id_info_pt)->nama_info_pt;
					}
					$lastuser = $this->Users_m->lastuser();
					if ($lastuser == TRUE) {
						$getlus = trim($lastuser->id+1);
					}else{
						$getlus = trim('1');
					}
					$username = trim(date('Ymd').$getlus);
					$email = trim($this->input->post('email'));
					$password = $this->input->post('password');
					$group = array($this->input->post('groups'));

					$additional_data = array(
						'first_name' => strip_tags($this->input->post('first_name')),
						'last_name' => strip_tags($this->input->post('last_name')),
						'id_info_pt' => $idpt,
						'company' => $company,
						'phone' => strip_tags($this->input->post('phone')),
						'repassword' => $this->input->post('password'),
						'jk' => $this->input->post('jk'),
						);
					if (!empty($_FILES["logopt"]["tmp_name"])) {
					    $config['file_name'] = strtolower(url_title('karyawan'.'-'.$username.'-'.date('Ymd').'-'.time('Hms')));
					    $config['upload_path'] = './assets/img/users/';
					    $config['allowed_types'] = 'gif|jpg|png|jpeg';
					    $config['max_size'] = 2048;
					    $config['max_width'] = '';
					    $config['max_height'] = '';

					    $this->load->library('upload', $config);
					    if (!$this->upload->do_upload('logopt')){
					        $error = $this->upload->display_errors();
					        $this->session->set_flashdata('eror', $error );
					        redirect(base_url('index.php/admin/users/create'));
					    }
					    else{
					        $img = $this->upload->data('file_name');
					        $additional_data['profile'] = $img;
					        $file = "assets/img/lembaga/$img";
					        //output resize (bisa juga di ubah ke format yang berbeda ex: jpg, png dll)
					        $resizedFile = "assets/img/lembaga/$img";
					        $this->resize->smart_resize_image(null , file_get_contents($file), 250 , 250 , false , $resizedFile , true , false ,100 );
					    }
					}
					$this->ion_auth->register($username, $password, $email, $additional_data, $group);
					$pesan = 'Karyawan '.$username.' Berhasil dibuat';
					$this->session->set_flashdata('message', $pesan );
					redirect(base_url('index.php/admin/users'));
				}
			}
		}else{
			$pesan = 'Login terlebih dahulu';
			$this->session->set_flashdata('message', $pesan );
			redirect(base_url('index.php/admin/login'));
		}
	}
	public function edit($id){
		if ($this->ion_auth->logged_in()) {
			$level = array('admin','members');
			if (!$this->ion_auth->in_group($level)) {
				$pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/admin/dashboard'));
			}else{
				$getuser = $this->ion_auth->user()->row();
				$infopt = $this->Admin_m->info_pt($getuser->id_info_pt);
				$detail = $this->ion_auth->user($id)->row();
				$data['title'] = 'Edit Karyawan - '.$detail->username;
				$data['infopt'] = $infopt;
				$data['users'] = $getuser;
				$data['groups'] = $this->ion_auth->groups()->result();
				$data['usergroups'] = array();
				if($usergroups = $this->ion_auth->get_users_groups($id)->result()){
					foreach($usergroups as $group)
					{
						$data['usergroups'][] = $group->id;
					}
				}
				$data['detail'] = $detail;
				$data['page'] = 'admin/users/edit-v';
				$this->load->view('admin/dashboard-v',$data);
			}
		}else{
			$pesan = 'Login terlebih dahulu';
			$this->session->set_flashdata('message', $pesan );
			redirect(base_url('index.php/login'));
		}
	}
	public function detail($id){
		if ($this->ion_auth->logged_in()) {
			$level = array('admin','members');
			if (!$this->ion_auth->in_group($level)) {
				$pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/admin/dashboard'));
			}else{
				$getuser = $this->ion_auth->user()->row();
				$infopt = $this->Admin_m->info_pt($getuser->id_info_pt);
				$detail = $this->ion_auth->user($id)->row();
				$data['title'] = 'Detail Karyawan - '.$detail->username;
				$data['infopt'] = $infopt;
				$data['users'] = $getuser;
				$data['groups'] = $this->ion_auth->groups()->result();
				$data['usergroups'] = array();
				if($usergroups = $this->ion_auth->get_users_groups($detail->id)->result()){
					foreach($usergroups as $group)
					{
						$data['usergroups'][] = $group->id;
					}
				}
				$data['detail'] = $detail;
				$data['page'] = 'admin/users/detail-v';
				$this->load->view('admin/dashboard-v',$data);
			}
		}else{
			$pesan = 'Login terlebih dahulu';
			$this->session->set_flashdata('message', $pesan );
			redirect(base_url('index.php/login'));
		}
	}
	public function proses_edit($id){
		if ($this->ion_auth->logged_in()) {
			$level=array('admin','members');
			if (!$this->ion_auth->in_group($level)) {
				$pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
				$this->session->set_flashdata('message', $pesan );
				redirect(base_url('index.php/admin/dashboard'));
			}else{
				// echo "<pre>";print_r($this->input->post());echo "</pre>";exit();
				$this->form_validation->set_rules('first_name', 'Nama Depan', 'required|alpha_numeric_spaces');
				$this->form_validation->set_rules('last_name', 'Nama Belakang', 'alpha_numeric_spaces');
				$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required|alpha|max_length[1]');
				$this->form_validation->set_rules('phone', 'Nomor HP', 'required|numeric|min_length[12]|max_length[15]');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
				$this->form_validation->set_rules('id_info_pt', 'Cabang Perusahaan', 'required|numeric|max_length[3]');
				if ($this->form_validation->run() == FALSE){
				    $pesan = validation_errors();
				    $this->session->set_flashdata('message',$pesan); 
				    redirect(base_url('index.php/admin/users/create/'));
				}else{
					$getuser = $this->ion_auth->user(strip_tags(trim($id)))->row();
					if ($getuser == TRUE) {
						$infopt = $this->Admin_m->info_pt($getuser->id_info_pt);
						if ($getuser->id_info_pt == '1') {
							$idpt = strip_tags($this->input->post('id_info_pt'));
							$company = $this->Admin_m->detail_data('info_pt','id_info_pt',strip_tags($this->input->post('id_info_pt')))->nama_info_pt;
						}else{
							$idpt = strip_tags($getuser->id_info_pt);
							$company = $this->Admin_m->detail_data('info_pt','id_info_pt',$getuser->id_info_pt)->nama_info_pt;
						}
						$additional_data = array(
							'first_name' => strip_tags(trim($this->input->post('first_name'))),
							'last_name' => strip_tags(trim($this->input->post('last_name'))),
							'id_info_pt' => strip_tags(trim($idpt)),
							'email' => strip_tags(trim($this->input->post('email'))),
							'company' => strip_tags(trim($company)),
							'phone' => strip_tags(trim($this->input->post('phone'))),
							'jk' => strip_tags(trim($this->input->post('jk'))),
						);
						if (!empty($_FILES["logopt"]["tmp_name"])) {
						    $config['file_name'] = strtolower(url_title('karyawan'.'-'.$username.'-'.date('Ymd').'-'.time('Hms')));
						    $config['upload_path'] = './assets/img/users/';
						    $config['allowed_types'] = 'jpg|png|jpeg';
						    $config['max_size'] = 2048;
						    $config['max_width'] = '';
						    $config['max_height'] = '';
						    $this->load->library('upload', $config);
						    if (!$this->upload->do_upload('logopt')){
						        $error = $this->upload->display_errors();
						        $this->session->set_flashdata('message', $error );
						        redirect(base_url('index.php/admin/users/create'));
						    }
						    else{
						    	$file = $getuser->profile;
						    	if ($file != "default.svg" || $file != "avatar.jpg" || $file != "default.png" ) {
						    		unlink("assets/img/users/$file");
						    	}
						        $img = $this->upload->data('file_name');
						        $additional_data['profile'] = $img;
						        $file = "assets/img/lembaga/$img";
						        //output resize (bisa juga di ubah ke format yang berbeda ex: jpg, png dll)
						        $resizedFile = "assets/img/lembaga/$img";
						        $this->resize->smart_resize_image(null , file_get_contents($file), 250 , 250 , false , $resizedFile , true , false ,100 );
						    }
						}
						$groups = $this->input->post('groups');
						$this->ion_auth->remove_from_group('', $getuser->id);
						$this->ion_auth->add_to_group($groups, $getuser->id);
						if ($this->input->post('password') == TRUE) {
							$this->form_validation->set_rules('password', 'Password', 'min_length[5]|max_length[20]|alpha_numeric|required');
							$this->form_validation->set_rules('repassword', 'Ulangi Password', 'min_length[5]|max_length[20]|alpha_numeric|required|matches[password]');
							$this->form_validation->set_rules('oldpassword', 'Password Lama', 'min_length[5]|max_length[20]|alpha_numeric|required');
							if ($this->form_validation->run() == FALSE){
							    $pesan = $pesan = validation_errors();
							    $this->session->set_flashdata('message', $pesan );
							    redirect(base_url('index.php/admin/users/detail/'.$getuser->id));
							}else{
								if (password_verify($this->input->post('oldpassword'),$getuser->password)) {
									$passdata = array(
										'password' => $this->input->post('password'),
										'repassword' =>$this->input->post('password'),
									);
									$this->ion_auth->update($getuser->id,$passdata);
								} else {
									$pesan = 'Password lama anda tidak sesuai';
									$this->session->set_flashdata('message', $pesan );
									redirect(base_url('index.php/admin/users/detail/'.$getuser->id));
								}
							}
						}
						$this->ion_auth->update($getuser->id,$additional_data);
						$pesan = 'Karyawan '.$getuser->first_name.' Berhasil diubah';
						$this->session->set_flashdata('message', $pesan );
						redirect(base_url('index.php/admin/users/detail/'.$getuser->id));
					}else{
						$pesan = 'Karyawan dengan ID '.strip_tags(trim($id)).' Tidak Ditemukan';
						$this->session->set_flashdata('message', $pesan );
						redirect(base_url('index.php/admin/users/'));
					}
				}
			}
		}else{
			$pesan = 'Login terlebih dahulu';
			$this->session->set_flashdata('message', $pesan );
			redirect(base_url('index.php/admin/login'));
		}
	}
	public function delete($id){
		if(!$this->ion_auth->logged_in()){
			$pesan = 'Login terlebih dahulu';
			$this->session->set_flashdata('message', $pesan );
			redirect(base_url('index.php/admin/login'));
		}else{
			$this->ion_auth->delete_user($id);
			$this->session->set_flashdata('message', 'users berhasil di hapus');
			redirect(base_url('index.php/admin/users'));
		}
	}
}
