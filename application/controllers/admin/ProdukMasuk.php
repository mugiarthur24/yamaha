<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProdukMasuk extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('admin/Admin_m');
        $this->load->model('admin/ProdukMasuk_m');
        $this->load->library('resize');
    }
    public function index($rowno=0){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/dashboard'));
            }else{
                $post = $this->input->post();
                $getuser = $this->ion_auth->user()->row();
                $infopt = $this->Admin_m->info_pt($getuser->id_info_pt);
                $status = $this->Admin_m->select_data('status');
                $data['title'] = 'Daftar Produk Masuk '.$infopt->nama_info_pt;
                $data['brand'] = $infopt->logo_pt;
                $data['infopt'] = $infopt;
                $data['users'] = $getuser;
                $data['aside'] = 'nav/nav';
                $data['detail'] = $getuser;
                $data['status'] = $status;
                $data['page'] = 'admin/produkmasuk/main-v';
                   $search_text = "";
                   if($post == TRUE ){
                       $search_text = $post;
                       $this->session->set_userdata($post);
                   }else{
                       $post = array();
                       if($this->session->userdata('so_ref') != NULL){
                        $post['so_ref'] = $this->session->userdata('so_ref');
                       }
                       if($this->session->userdata('so_no') != NULL){
                        $post['so_no'] = $this->session->userdata('so_no');
                       }
                       if($this->session->userdata('ipdo_no') != NULL){
                        $post['ipdo_no'] = $this->session->userdata('ipdo_no');
                       }
                       if($this->session->userdata('ipdo_date') != NULL){
                        $post['ipdo_date'] = $this->session->userdata('ipdo_date');
                       }
                       if($this->session->userdata('so_date') != NULL){
                        $post['so_date'] = $this->session->userdata('so_date');
                       }
                       if($this->session->userdata('id_info_pt') != NULL){
                        $post['id_info_pt'] = $this->session->userdata('id_info_pt');
                       }
                       if($this->session->userdata('id_status') != NULL){
                        $post['id_status'] = $this->session->userdata('id_status');
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
                   $allcount = $this->ProdukMasuk_m->getrecordCount($search_text);
                   // Get records
                   $users_record = $this->ProdukMasuk_m->getData($rowno,$rowperpage,$search_text);
                }else{
                    // All records count
                    $allcount = $this->ProdukMasuk_m->getrecordCountid($getuser->id_info_pt,$search_text);
                    // Get records
                    $users_record = $this->ProdukMasuk_m->getDataid($getuser->id_info_pt,$rowno,$rowperpage,$search_text);
                }
                // Pagination Configuration
                 $config['base_url'] = base_url().'index.php/admin/produk';
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
    public function crtprodukmasuk(){
        if ($this->ion_auth->logged_in()) {
            $level=array('admin');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/dashboard'));
            }else{
                $getuser= $this->ion_auth->user()->row();
                $post = $this->input->post();
                $date = date('Y-m-d');
                $time = date('H:i:s');
                $data = array(
                    'tgl_create' => $date,
                    'waktu_create' => $time,
                    );
                $this->Admin_m->create('produkmasuk',$data);
                $getdata=$this->ProdukMasuk_m->getprodukmasuk($date,$time);
                $pesan = 'Nota Baru Berhasil dibuat';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/produkmasuk/create/'.$getdata->id_pm));
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/admin/login'));
        }
    }
    public function create($id,$rowno=0){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/dashboard'));
            }else{
              $post = $this->input->post();
                $this->load->model('admin/Type_m');
                $getuser = $this->ion_auth->user()->row();
                $infopt = $this->Admin_m->info_pt($getuser->id_info_pt);
                $data['infopt'] = $infopt;
                $getuser = $this->ion_auth->user()->row();
                $detnota = $this->Admin_m->detail_data('produkmasuk','id_pm',$id);
                $result =  $infopt;
                $data['title'] = 'Buat Perusahaan baru ';
                $data['brand'] = 'assets/img/lembaga/'.$result->logo_pt;
                $data['users'] = $getuser;
                $data['nav'] = 'nav/nav-admin';
                $data['page'] = 'admin/produkmasuk/tambah-v';
                // pagging produk
                   $search_text = "";
                   if($post == TRUE ){
                       $search_text = $post;
                       $this->session->set_userdata($post);
                   }else{
                       $post = array();
                       if($this->session->userdata('string') != NULL){
                        $post['string'] = $this->session->userdata('string');
                       }
                       $search_text = $post;
                   }
                   // Row per page
                   $rowperpage = 10;
                   // Row position
                   if($rowno != 0){
                     $rowno = ($rowno-1) * $rowperpage;
                 }
                $allcount = $this->Type_m->getrecordCount($search_text);
                // Get records
                $users_record = $this->Type_m->getData($rowno,$rowperpage,$search_text);
                // Pagination Configuration
                 $config['base_url'] = base_url().'index.php/admin/produkmasuk/create/'.$id.'/';
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
                 $data['barang'] = $this->ProdukMasuk_m->getproduk($id);
                 $data['detail'] = $detnota;
                 // echo "<pre>";print_r($data['barang']);echo "</pre>";exit();
                // load
                $this->load->view('admin/dashboard-v',$data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function addproduk($id){
        if ($this->ion_auth->logged_in()) {
            $level=array('admin');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/dashboard'));
            }else{
              $this->form_validation->set_rules('id_type', 'Type', 'required|trim|numeric');
              $this->form_validation->set_rules('id_pm', 'Kode Produk Masuk', 'required|trim|numeric');
              if ($this->form_validation->run() == FALSE){
                $pesan = $pesan = validation_errors();
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/produkmasuk/create/'.$post['id_pm']));
              }else{
                $getuser= $this->ion_auth->user()->row();
                $post = $this->input->post();
                $cek = $this->ProdukMasuk_m->cekbrgnota($post['id_pm'],$post['id_type']);
                $detail = $this->Admin_m->detail_data('type','id_type',$post['id_type']);
                if ($cek == TRUE) {
                  $pesan = 'Produk <b>'.$detail->nm_type.'<b> Sudah ada dalam nota';
                  $this->session->set_flashdata('message', $pesan );
                  redirect(base_url('index.php/admin/produkmasuk/create/'.$post['id_pm']));
                }else{
                  $data = array(
                    'id_type' => $post['id_type'],
                    'id_pm' => $post['id_pm'],
                  );
                  $this->Admin_m->create('brg_pm',$data);
                  $pesan = 'Produk <b>'.$detail->nm_type.'</b> Berhasil ditambahkan';
                  $this->session->set_flashdata('message', $pesan );
                  redirect(base_url('index.php/admin/produkmasuk/create/'.$post['id_pm']));
                } 
              }
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/admin/login'));
        }
    }
    public function detail($id){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','karyawan');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/dashboard'));
            }else{
                $getuser = $this->ion_auth->user()->row();
                $infopt = $this->Admin_m->info_pt($getuser->id_info_pt);
                $data['infopt'] = $infopt;
                $result = $this->Admin_m->info_pt($id);
                $data['title'] = 'produk - '.$result->nama_info_pt;
                $data['infopt'] = $result;
                $data['brand'] = 'assets/img/lembaga/'.$result->logo_pt;
                $data['users'] = $getuser;
                $data['nav'] = 'nav/nav-admin';
                $data['page'] = 'admin/produk-v';
                // pagging produk
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
                redirect(base_url('index.php/dashboard'));
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
                        redirect(base_url('index.php/admin/produk'));
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
                        $this->resize->smart_resize_image(null , file_get_contents($file), 150 , 30 , false , $resizedFile , true , false ,100 );
                    }
                }
                $this->Admin_m->update('info_pt','id_info_pt',$getuser->id_info_pt,$data);
                $pesan = 'Lembaga '.$post['nama_info_pt'].' Berhasil diubah';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/produk'));
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/admin/login'));
        }
    }
}
?>