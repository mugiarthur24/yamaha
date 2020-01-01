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
                    'id_info_pt' => $getuser->id_info_pt,
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
    public function changetofull($idpm,$idbrg,$id){
      if ($this->ion_auth->logged_in()) {
        $level=array('admin');
        if (!$this->ion_auth->in_group($level)) {
          $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
          $this->session->set_flashdata('message', $pesan );
          redirect(base_url('index.php/dashboard'));
        }else{
          $getuser= $this->ion_auth->user()->row();
          $kode = strip_tags(trim($id));
          $detbrg = $this->Admin_m->detail_data('brg_pm','id_brg_pm',strip_tags(trim($idbrg)));
          $detpm = $this->Admin_m->detail_data('produkmasuk','id_pm',strip_tags(trim($idpm)));
          if ($detbrg == TRUE && $detpm == TRUE) {
            $cek = $this->Admin_m->detail_data('produk','id_produk',$kode);
            if ($cek == TRUE) {
              $data['id_validasi'] = '1';
              $this->Admin_m->update('produk','id_produk',$kode,$data);
              $pesan = 'Produk berhasi di ubah menjadi <b>"Ada"</b>';
              $this->session->set_flashdata('message', $pesan );
              redirect(base_url('index.php/admin/produkmasuk/addsubproduk/'.$detpm->id_pm.'/'.$detbrg->id_brg_pm));
            }else{
              $pesan = 'Kode Produk tidak di temukan, harap priksa kembali kode anda';
              $this->session->set_flashdata('message', $pesan );
              redirect(base_url('index.php/admin/produkmasuk/addsubproduk/'.$detpm->id_pm.'/'.$detbrg->id_brg_pm));
            }
          }else{
            $pesan = 'Kode struk dan kode sub struk tidak di temukan, harap priksa kembali kode anda';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/admin/produkmasuk/addsubproduk/'.$detpm->id_pm.'/'.$detbrg->id_brg_pm));
          }
        }
      }else{
        $pesan = 'Login terlebih dahulu';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/admin/login'));
      }
    }
    public function changetoempty($idpm,$idbrg,$id){
      if ($this->ion_auth->logged_in()) {
        $level=array('admin');
        if (!$this->ion_auth->in_group($level)) {
          $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
          $this->session->set_flashdata('message', $pesan );
          redirect(base_url('index.php/dashboard'));
        }else{
          $getuser= $this->ion_auth->user()->row();
          $kode = strip_tags(trim($id));
          $detbrg = $this->Admin_m->detail_data('brg_pm','id_brg_pm',strip_tags(trim($idbrg)));
          $detpm = $this->Admin_m->detail_data('produkmasuk','id_pm',strip_tags(trim($idpm)));
          if ($detbrg == TRUE && $detpm == TRUE) {
            $cek = $this->Admin_m->detail_data('produk','id_produk',$kode);
            if ($cek == TRUE) {
              $data['id_validasi'] = '0';
              $this->Admin_m->update('produk','id_produk',$kode,$data);
              $pesan = 'Produk berhasi di ubah menjadi <b>"Tidak Ada"</b>';
              $this->session->set_flashdata('message', $pesan );
              redirect(base_url('index.php/admin/produkmasuk/addsubproduk/'.$detpm->id_pm.'/'.$detbrg->id_brg_pm));
            }else{
              $pesan = 'Kode Produk tidak di temukan, harap priksa kembali kode anda';
              $this->session->set_flashdata('message', $pesan );
              redirect(base_url('index.php/admin/produkmasuk/addsubproduk/'.$detpm->id_pm.'/'.$detbrg->id_brg_pm));
            }
          }else{
            $pesan = 'Kode struk dan kode sub struk tidak di temukan, harap priksa kembali kode anda';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/admin/produkmasuk/addsubproduk/'.$detpm->id_pm.'/'.$detbrg->id_brg_pm));
          }
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
                // $cek = $this->ProdukMasuk_m->cekbrgnota($post['id_pm'],$post['id_type']);
                $detail = $this->Admin_m->detail_data('type','id_type',$post['id_type']);
                // if ($cek == TRUE) {
                //   $pesan = 'Produk <b>'.$detail->nm_type.'<b> Sudah ada dalam nota';
                //   $this->session->set_flashdata('message', $pesan );
                //   redirect(base_url('index.php/admin/produkmasuk/create/'.$post['id_pm']));
                // }else{
                  $data = array(
                    'id_type' => $post['id_type'],
                    'id_pm' => $post['id_pm'],
                  );
                  $this->Admin_m->create('brg_pm',$data);
                  $pesan = 'Produk <b>'.$detail->nm_type.'</b> Berhasil ditambahkan';
                  $this->session->set_flashdata('message', $pesan );
                  redirect(base_url('index.php/admin/produkmasuk/create/'.$post['id_pm']));
                // } 
              }
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/admin/login'));
        }
    }
    public function updatenota($id){
        if ($this->ion_auth->logged_in()) {
            $level=array('admin');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/dashboard'));
            }else{
              $post = $this->input->post();
              // echo "<pre>";print_r($post);echo "</pre>";exit();
              $this->form_validation->set_rules('so_ref', 'SO REF ', 'required|trim');
              $this->form_validation->set_rules('so_no', 'SO NO', 'required|trim|numeric');
              $this->form_validation->set_rules('ipdo_no', 'IPDO NO', 'required|trim|numeric');
              $this->form_validation->set_rules('ipdo_date', 'IPDO DATE ', 'required|trim|alpha_dash');
              $this->form_validation->set_rules('so_date', 'SO DATE ', 'required|trim|alpha_dash');
              if ($this->form_validation->run() == FALSE){
                $pesan = $pesan = validation_errors();
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/produkmasuk/create/'.$id));
              }else{
                $getuser= $this->ion_auth->user()->row();
                $cek = $this->Admin_m->detail_data('produkmasuk','id_pm',$id);
                if ($cek == FALSE) {
                  $pesan = 'Produk Yang di maksud tidak terdapat dalam daftar, harap periksa kembali kode unik anda';
                  $this->session->set_flashdata('message', $pesan );
                  redirect(base_url('index.php/admin/produkmasuk/create/'.$id));
                }else{
                  $data = array(
                    'so_ref' => $post['so_ref'],
                    'so_no' => $post['so_no'],
                    'ipdo_no' => $post['ipdo_no'],
                    'ipdo_date' => $post['ipdo_date'],
                    'so_date' => $post['so_date'],
                  );
                  $this->Admin_m->update('produkmasuk','id_pm',$id,$data);
                  $pesan = 'Produk  Berhasil diubah';
                  $this->session->set_flashdata('message', $pesan );
                  redirect(base_url('index.php/admin/produkmasuk/create/'.$id));
                } 
              }
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/admin/login'));
        }
    }
    public function updatelistbarang($id){
        if ($this->ion_auth->logged_in()) {
            $level=array('admin');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/dashboard'));
            }else{
              $post = $this->input->post();
              // echo "<pre>";print_r($post);echo "</pre>";exit();
              $this->form_validation->set_rules('id_brg_pm', 'Type', 'required|trim|numeric');
              $this->form_validation->set_rules('id_pm', 'Kode Produk Masuk', 'required|trim|numeric');
              $this->form_validation->set_rules('cc', 'Cc', 'required|trim|numeric');
              $this->form_validation->set_rules('jml_brg', 'Stok ', 'required|trim|numeric');
              $this->form_validation->set_rules('warna', 'Warna ', 'required|trim|alpha_numeric_spaces');
              if ($this->form_validation->run() == FALSE){
                $pesan = $pesan = validation_errors();
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/produkmasuk/create/'.$post['id_pm']));
              }else{
                $getuser= $this->ion_auth->user()->row();
                $cek = $this->ProdukMasuk_m->cekbrgproduk($post['id_brg_pm']);
                if ($cek == FALSE) {
                  $pesan = 'Produk Yang di maksud tidak terdapat dalam daftar, harap periksa kembali kode unik anda';
                  $this->session->set_flashdata('message', $pesan );
                  redirect(base_url('index.php/admin/produkmasuk/create/'.$post['id_pm']));
                }else{
                  $data = array(
                    'cc' => $post['cc'],
                    'warna' => $post['warna'],
                    'jml_brg' => $post['jml_brg'],
                  );
                  $this->Admin_m->update('brg_pm','id_brg_pm',$post['id_brg_pm'],$data);
                  $pesan = 'Produk  Berhasil diubah';
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
    public function addsubproduk($idpm,$idbrg){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','karyawan');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/dashboard'));
            }else{
                $getuser = $this->ion_auth->user()->row();
                $infopt = $this->Admin_m->info_pt($getuser->id_info_pt);
                $detbrg = $this->Admin_m->detail_data('brg_pm','id_brg_pm',strip_tags(trim($idbrg)));
                $detpm = $this->Admin_m->detail_data('produkmasuk','id_pm',strip_tags(trim($idpm)));
                $type = $this->ProdukMasuk_m->gettype($detbrg->id_type);
                if ($detbrg == TRUE && $detpm == TRUE) {
                  $hasil = $this->ProdukMasuk_m->getsubproduk(strip_tags(trim($idpm)),strip_tags(trim($idbrg)));
                  $data['infopt'] = $infopt;
                  $data['title'] = 'Sub Produk Masuk - '.$infopt->nama_info_pt;
                  $data['users'] = $getuser;
                  $data['detbrg'] = $detbrg;
                  $data['detpm'] = $detpm;
                  $data['hasil'] = $hasil;
                  $data['type'] = $type;
                  $data['nav'] = 'nav/nav-admin';
                  $data['page'] = 'admin/produkmasuk/subproduk-v';
                  // pagging produk
                  $this->load->view('admin/dashboard-v',$data);
                }else{
                  $pesan = 'Kode struk dan kode sub struk tidak di temukan, harap priksa kembali kode anda';
                  $this->session->set_flashdata('message', $pesan );
                  redirect(base_url('index.php/produkmasuk/create/'.$idpm));
                }
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
    public function prsaddsubproduk($idpm,$idbrg){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','members');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/dashboard'));
            }else{
                $post = $this->input->post();
                $getuser = $this->ion_auth->user()->row();
                $infopt = $this->Admin_m->info_pt($getuser->id_info_pt);
                $detbrg = $this->Admin_m->detail_data('brg_pm','id_brg_pm',strip_tags(trim($idbrg)));
                $detpm = $this->Admin_m->detail_data('produkmasuk','id_pm',strip_tags(trim($idpm)));
                $type = $this->ProdukMasuk_m->gettype(strip_tags(trim($detbrg->id_type)));
                if ($detbrg == TRUE && $detpm == TRUE) {
                  $this->form_validation->set_rules('no_rangka', 'Nomor Rangka', 'required|trim|alpha_numeric');
                  $this->form_validation->set_rules('no_mesin', 'Nomor Mesin ', 'required|trim|alpha_dash');
                  $this->form_validation->set_rules('thn_produk', 'Tahun Produk ', 'required|trim|numeric|min_length[4]|max_length[4]');
                  $this->form_validation->set_rules('bahan_bakar', 'bahan bakar ', 'required|trim|alpha_numeric_spaces');
                  if ($this->form_validation->run() == FALSE){
                    $pesan = $pesan = validation_errors();
                    $this->session->set_flashdata('message', $pesan );
                    redirect(base_url('index.php/admin/produkmasuk/addsubproduk/'.$idpm.'/'.$idbrg));
                  }else{
                    $data = array(
                      'id_pm' => strip_tags(trim($idpm)),
                      'id_brg_pm' => strip_tags(trim($idbrg)),
                      'id_info_pt' => strip_tags(trim($infopt->id_info_pt)),
                      'no_rangka' => strip_tags(trim($post['no_rangka'])),
                      'no_mesin' => strip_tags(trim($post['no_mesin'])),
                      'id_jenis' => strip_tags(trim($type->id_jenis)),
                      'id_merk' => strip_tags(trim($type->id_merk)),
                      'id_type' => strip_tags(trim($type->id_type)),
                      'thn_produk' => strip_tags(trim($post['thn_produk'])),
                      'tgl_masuk' => strip_tags(trim($post['tgl_masuk'])),
                      'cc' => strip_tags(trim($detbrg->cc)),
                      'bahan_bakar' => strip_tags(trim($post['bahan_bakar'])),
                      'warna' => strip_tags(trim($detbrg->warna)),
                      'id_validasi' => '0',
                      'id_status' => '1',
                    );
                    $this->Admin_m->create('produk',$data);
                    $pesan = 'Produk Baru Berhasil ditambahkan';
                    // tambah jumlah
                    $updata['jml_input'] = $detbrg->jml_input+1;
                    $this->Admin_m->update('brg_pm','id_brg_pm',$detbrg->id_brg_pm,$updata);
                    $this->session->set_flashdata('message', $pesan );
                    redirect(base_url('index.php/admin/produkmasuk/addsubproduk/'.$idpm.'/'.$idbrg));
                  }
                }else{
                  $pesan = 'Kode struk dan kode sub struk tidak di temukan, harap priksa kembali kode anda';
                  $this->session->set_flashdata('message', $pesan );
                  redirect(base_url('index.php/produkmasuk/create/'.$idpm));
                }
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
    public function delpm($idpm){
      if ($this->ion_auth->logged_in()) {
        $level = array('admin');
        if (!$this->ion_auth->in_group($level)) {
          $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
          $this->session->set_flashdata('message', $pesan );
          redirect(base_url('index.php/dashboard'));
        }else{
          $kode = preg_replace("/[^0-9]/", "", $idpm);
          $detail = $this->Admin_m->detail_data('produkmasuk','id_pm',$kode);
          if ($detail == TRUE) {
            if ($detail->id_status =='0') {
              $this->Admin_m->delete('produkmasuk','id_pm',$kode);
              $pesan = 'Produk Berhasil dihapus';
              $this->session->set_flashdata('message', $pesan );
              redirect(base_url('index.php/admin/produkmasuk/'));
            }else{
              $pesan = 'Produk ini sudah memiliki sub produk sehingga tidak dapat di hapus';
              $this->session->set_flashdata('message', $pesan );
              redirect(base_url('index.php/admin/produkmasuk/'));
            }
          }else{
            $pesan = 'Kode Produk tidak di temukan, harap priksa kembali kode anda';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/admin/produkmasuk/'));
          }
        }
      }else{
        $pesan = 'Login terlebih dahulu';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/login'));
      }
    }
    public function delproduk($idpm,$idbrg){
      if ($this->ion_auth->logged_in()) {
        $level = array('admin');
        if (!$this->ion_auth->in_group($level)) {
          $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
          $this->session->set_flashdata('message', $pesan );
          redirect(base_url('index.php/dashboard'));
        }else{
          $detpm = $this->Admin_m->detail_data('produkmasuk','id_pm',strip_tags(trim($idpm)));
          if ($detpm == TRUE ) {
            $kode = preg_replace("/[^0-9]/", "", $idbrg);
            $detail = $this->Admin_m->detail_data('brg_pm','id_brg_pm',$kode);
            if ($detail == TRUE) {
              if ($detail->id_status =='0') {
                $this->Admin_m->delete('brg_pm','id_brg_pm',$kode);
                $pesan = 'Produk Berhasil dihapus';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/produkmasuk/create/'.$idpm));
              }else{
                $pesan = 'Produk ini sudah memiliki sub produk sehingga tidak dapat di hapus';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/produkmasuk/create/'.$idpm));
              }
            }else{
              $pesan = 'Kode Produk tidak di temukan, harap priksa kembali kode anda';
              $this->session->set_flashdata('message', $pesan );
              redirect(base_url('index.php/admin/produkmasuk/create/'.$idpm));
            }
          }else{
            $pesan = 'Kode struk dan kode sub struk tidak di temukan, harap priksa kembali kode anda';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/admin/produkmasuk/addsubproduk/'.$idpm.'/'.$idbrg));
          }
        }
      }else{
        $pesan = 'Login terlebih dahulu';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/login'));
      }
    }
    public function delsubproduk($idpm,$idbrg,$id){
      if ($this->ion_auth->logged_in()) {
        $level = array('admin');
        if (!$this->ion_auth->in_group($level)) {
          $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
          $this->session->set_flashdata('message', $pesan );
          redirect(base_url('index.php/dashboard'));
        }else{
          $detbrg = $this->Admin_m->detail_data('brg_pm','id_brg_pm',strip_tags(trim($idbrg)));
          $detpm = $this->Admin_m->detail_data('produkmasuk','id_pm',strip_tags(trim($idpm)));
          if ($detbrg == TRUE && $detpm == TRUE) {
            $kode = preg_replace("/[^0-9]/", "", $id);
            $detail = $this->Admin_m->detail_data('produk','id_produk',$kode);
            if ($detail == TRUE) {
              if ($detail->id_validasi =='0') {
                $this->Admin_m->delete('produk','id_produk',$kode);
                $updata['jml_input'] = $detbrg->jml_input-1;
                $this->Admin_m->update('brg_pm','id_brg_pm',$detbrg->id_brg_pm,$updata);
                $pesan = 'Produk Berhasil dihapus';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/produkmasuk/addsubproduk/'.$idpm.'/'.$idbrg));
              }else{
                $pesan = 'Barang sudah tervalidasi keberadaannya sehingga tidak dapat di hapus';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/produkmasuk/addsubproduk/'.$idpm.'/'.$idbrg));
              }
            }else{
              $pesan = 'Kode Produk tidak di temukan, harap priksa kembali kode anda';
              $this->session->set_flashdata('message', $pesan );
              redirect(base_url('index.php/admin/produkmasuk/addsubproduk/'.$idpm.'/'.$idbrg));
            }
          }else{
            $pesan = 'Kode struk dan kode sub struk tidak di temukan, harap priksa kembali kode anda';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/admin/produkmasuk/addsubproduk/'.$idpm.'/'.$idbrg));
          }
        }
      }else{
        $pesan = 'Login terlebih dahulu';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/login'));
      }
    }
    function uploadexcel(){
      $this->load->library('Excel');
      $post = $this->input->post();
      if (!is_dir('assets/upload/')) {
        mkdir('assets/upload/');
      }
      if (!preg_match("/.(xls|xlsx)$/i", $_FILES["fileupload"]["name"]) ) {

        echo "pastikan file yang anda pilih xls|xlsx";
        exit();

      } else {
        move_uploaded_file($_FILES["fileupload"]["tmp_name"],'assets/upload/'.$_FILES['fileupload']['name']);
        $semester = array("fileupload"=>$_FILES["fileupload"]["name"]);

      }
      $objPHPExcel = PHPExcel_IOFactory::load('assets/upload/'.$_FILES['fileupload']['name']);
      $data = $objPHPExcel->getActiveSheet()->toArray();
      $error_count = 0;
      $error = array();
      $sukses = 0;
      $getuser= $this->ion_auth->user()->row();
      $date = date('Y-m-d');
      $time = date('H:i:s');
      foreach ($data as $key => $val) {
        if ($key>0){
          if ($val[0]!='') {
            $ceksoref = $this->Admin_m->detail_data('produkmasuk','so_ref',trim(filter_var($val[1], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH)));
            if ($ceksoref == TRUE) {
              $newsoref = $ceksoref;
            }else{
              $inpsoref = array(
                'tgl_create' => $date,
                'waktu_create' => $time,
                'id_info_pt' => $getuser->id_info_pt,
                'so_ref' => trim(filter_var($val[1], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH)),
                'so_no' => preg_replace("/[^a-zA-Z0-9]/", "",trim(filter_var($val[2], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH))),
                'ipdo_no' => preg_replace("/[^a-zA-Z0-9]/", "",trim(filter_var($val[3], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH))),
                'ipdo_date' => $date,
                'so_date' => $date,
              );
              $this->Admin_m->create('produkmasuk',$inpsoref);
              $newsoref = $this->Admin_m->detail_data('produkmasuk','so_ref',trim(filter_var($val[1], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH)));
            }
            $ceknmtype = $this->Admin_m->detail_data('type','nm_type',trim(filter_var($val[5], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH)));
            if ($ceknmtype == TRUE) {
              $nmtype = $ceknmtype;
            }else{
              $inptype = array(
                'nm_type'=>trim(filter_var($val[5], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH)),
                'id_merk'=>'1',
                'id_jenis'=>'1',
                'kode_type'=>preg_replace("/[^a-zA-Z0-9]/", "",trim(filter_var($val[5], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH))),
                'ket_type'=>preg_replace("/[^a-zA-Z0-9]/", "",trim(filter_var($val[5], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH))),
              );
              $this->Admin_m->create('type',$inptype);
              $newtype = $this->Admin_m->detail_data('type','nm_type',trim(filter_var($val[5], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH)));
              $nmtype = $newtype;
            }
            $cetype = $this->ProdukMasuk_m->cektype($newsoref->id_pm,trim(filter_var($val[4], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH)),$nmtype->id_type,trim(filter_var($val[10], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH)));
            if ($cetype == TRUE) {
              $newbrgpm = $cetype;
            }else{
              $inptpm = array(
                'id_pm' =>preg_replace("/[^a-zA-Z0-9]/", "",trim($newsoref->id_pm)),
                'cc' => preg_replace("/[^0-9]/", "",trim(filter_var($val[4], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH))),
                'warna' => preg_replace("/[^a-zA-Z0-9]/", "",trim(filter_var($val[10], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH))),
                'id_type' => $nmtype->id_type,
              );
              $this->Admin_m->create('brg_pm',$inptpm);

              $newbrgpm = $this->ProdukMasuk_m->cektype($newsoref->id_pm,trim(filter_var($val[4], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH)),$nmtype->id_type,trim(filter_var($val[10], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH)));
            }
            // echo "<pre>";print_r($nmtype);echo "</pre>";exit();
            $dttype = $this->Admin_m->detail_data('type','id_type',strip_tags(trim($newbrgpm->id_type)));
            $cekrangka = $this->Admin_m->detail_data('produk','no_rangka',preg_replace("/[^a-zA-Z0-9]/", "",trim(filter_var($val[7], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH))));
            if ($cekrangka == FALSE) {
              $data = array(
                'id_pm' => strip_tags($newsoref->id_pm),
                'id_brg_pm' => strip_tags(trim($newbrgpm->id_brg_pm)),
                'id_info_pt' => strip_tags(trim($getuser->id_info_pt)),
                'no_rangka' => preg_replace("/[^a-zA-Z0-9]/", "",trim(filter_var($val[7], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH))),
                'no_mesin' => strip_tags(trim(filter_var($val[9], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH))),
                'no_faktur' => strip_tags(trim(filter_var($val[8], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH))),
                'id_jenis' => strip_tags(trim($dttype->id_jenis)),
                'id_merk' => strip_tags(trim($dttype->id_merk)),
                'id_type' => strip_tags(trim($newbrgpm->id_type)),
                'thn_produk' => preg_replace("/[^0-9]/", "",trim(filter_var($val[11], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH))),
                'tgl_masuk' => trim(date('Y-m-d')),
                'cc' => strip_tags(trim($newbrgpm->cc)),
                'bahan_bakar' => preg_replace("/[^a-zA-Z0-9]/", "",trim(filter_var($val[12], FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH))),
                'warna' => strip_tags(trim($newbrgpm->warna)),
                'id_validasi' => '0',
                'id_status' => '1',
              );
              $this->Admin_m->create('produk',$data);
              //update jumlah produk
              $updata['jml_input'] = $newbrgpm->jml_input+1;
              $updata['jml_brg'] = $newbrgpm->jml_brg+1;
              $this->Admin_m->update('brg_pm','id_brg_pm',$newbrgpm->id_brg_pm,$updata);
              $sukses++;
            }
          }
        }
      }
      unlink("assets/upload/".$_FILES['fileupload']['name']);
      $msg = $sukses.' Produk berhasil di tambahkan';
      $this->session->set_flashdata('message', $msg);
      redirect(base_url('index.php/admin/produkmasuk/'));
    }
}
?>