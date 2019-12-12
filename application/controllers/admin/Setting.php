<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('admin/Admin_m');
        $this->load->model('admin/Setting_m');
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
                $data['title'] = 'Daftar Perusahaan';
                $data['brand'] = $infopt->logo_pt;
                $data['infopt'] = $infopt;
                $data['users'] = $getuser;
                $data['aside'] = 'nav/nav';
                $data['detail'] = $getuser;
                $data['page'] = 'admin/setting/main-v';
                   $search_text = "";
                   if($post == TRUE ){
                       $search_text = $post;
                       $this->session->set_userdata($post);
                   }else{
                       $post = array();
                       if($this->session->userdata('string') != NULL){
                        $post['string'] = $this->session->userdata('string');
                       }
                       if($this->session->userdata('kode_pt') != NULL){
                        $post['kode_pt'] = $this->session->userdata('kode_pt');
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
                   $allcount = $this->Setting_m->getrecordCount($search_text);
                   // Get records
                   $users_record = $this->Setting_m->getData($rowno,$rowperpage,$search_text);
                }else{
                    // All records count
                    $allcount = $this->Setting_m->getrecordCountid($getuser->id_info_pt,$search_text);
                    // Get records
                    $users_record = $this->Setting_m->getDataid($getuser->id_info_pt,$rowno,$rowperpage,$search_text);
                }
                // Pagination Configuration
                 $config['base_url'] = base_url().'index.php/admin/setting';
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
            $level = array('admin','karyawan');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard'));
            }else{
                $result = $this->Admin_m->info_pt($id);
                $data['title'] = 'Setting - '.$result->nama_info_pt;
                $data['infopt'] = $result;
                $data['brand'] = 'assets/img/lembaga/'.$result->logo_pt;
                $data['users'] = $this->ion_auth->user()->row();
                $data['nav'] = 'nav/nav-admin';
                $data['page'] = 'admin/setting-v';
                // pagging setting
                $this->load->view('admin/dashboard-v',$data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function update(){
        if ($this->ion_auth->logged_in()) {
            $level=array('admin');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard'));
            }else{
                $getuser= $this->ion_auth->user()->row();
                $post = $this->input->post();
                $data = array(
                    'nama_info_pt' => $post['nama_info_pt'],
                    'kode_pt' => $post['kode_pt'],
                    'kontak_1' => $post['kontak_1'],
                    'kontak_2' => $post['kontak_2'],
                    'kontak_3' => $post['kontak_3'],
                    'kontak_4' => $post['kontak_4'],
                    'alamat_pt' => $post['alamat_pt'],
                    'slogan' => $post['slogan'],
                    'kontak_4' => $post['kontak_4'],
                    );
                if (!empty($_FILES["logopt"]["tmp_name"])) {
                    $config['file_name'] = strtolower(url_title('logo'.'-'.$post['nama_info_pt'].'-'.date('Ymd').'-'.time('Hms')));
                    $config['upload_path'] = './assets/img/lembaga/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size'] = 2048;
                    $config['max_width'] = '';
                    $config['max_height'] = '';

                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('logopt')){
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('eror', $error );
                        redirect(base_url('index.php/admin/setting'));
                    }
                    else{
                        $file = $this->Admin_m->cek_pt($getuser->id_info_pt)->row('logo_pt');
                        if ($file != "logo.png") {
                            unlink("assets/img/lembaga/$file");
                        }
                        $img = $this->upload->data('file_name');
                        $data['logo_pt'] = $img;
                        $file = "assets/img/lembaga/$img";
                        //output resize (bisa juga di ubah ke format yang berbeda ex: jpg, png dll)
                        $resizedFile = "assets/img/lembaga/$img";
                        $this->resize->smart_resize_image(null , file_get_contents($file), 250 , 250 , false , $resizedFile , true , false ,100 );
                    }
                }
                $this->Admin_m->update('info_pt','id_info_pt',$getuser->id_info_pt,$data);
                $pesan = 'Lembaga '.$post['nama_info_pt'].' Berhasil diubah';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/setting'));
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/admin/login'));
        }
    }
}
?>