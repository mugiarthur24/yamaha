<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProdukKeluar extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('admin/Admin_m');
        $this->load->model('admin/ProdukKeluar_m');
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
                $dftrpt = $this->Admin_m->select_data('info_pt');
                $data['title'] = 'Daftar Produk Keluar '.$infopt->nama_info_pt;
                $data['brand'] = $infopt->logo_pt;
                $data['infopt'] = $infopt;
                $data['users'] = $getuser;
                $data['aside'] = 'nav/nav';
                $data['detail'] = $getuser;
                $data['status'] = $status;
                $data['dtpt'] = $dftrpt;
                $data['page'] = 'admin/produkkeluar/main-v';
                   $search_text = "";
                   if($post == TRUE ){
                       $search_text = $post;
                       $this->session->set_userdata($post);
                   }else{
                       $post = array();
                       if($this->session->userdata('kode_pk') != NULL){
                        $post['kode_pk'] = $this->session->userdata('kode_pk');
                       }
                       if($this->session->userdata('nm_user') != NULL){
                        $post['nm_user'] = $this->session->userdata('nm_user');
                       }
                       if($this->session->userdata('id_info_pt_asal') != NULL){
                        $post['id_info_pt_asal'] = $this->session->userdata('id_info_pt_asal');
                       }
                       if($this->session->userdata('id_info_pt_tujuan') != NULL){
                        $post['id_info_pt_tujuan'] = $this->session->userdata('id_info_pt_tujuan');
                       }
                       if($this->session->userdata('tgl_buat') != NULL){
                        $post['tgl_buat'] = $this->session->userdata('tgl_buat');
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
                   $allcount = $this->ProdukKeluar_m->getrecordCount($search_text);
                   // Get records
                   $users_record = $this->ProdukKeluar_m->getData($rowno,$rowperpage,$search_text);
                }else{
                    // All records count
                    $allcount = $this->ProdukKeluar_m->getrecordCountid($getuser->id_info_pt,$search_text);
                    // Get records
                    $users_record = $this->ProdukKeluar_m->getDataid($getuser->id_info_pt,$rowno,$rowperpage,$search_text);
                }
                // Pagination Configuration
                 $config['base_url'] = base_url().'index.php/admin/produkkeluar';
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
    public function crtprodukkeluar(){
        if ($this->ion_auth->logged_in()) {
            $level=array('admin');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/dashboard'));
            }else{
              $post = $this->input->post();
              $getuser= $this->ion_auth->user()->row();
              $lastid = $this->ProdukKeluar_m->lastid()->id_pk;
              if ($lastid == TRUE) {
                $last = $lastid+1;
              }else{
                $last = 1;
              }
              $date = date('Y-m-d');
              $time = date('H:i:s');
              $data = array(
                'kode_pk' => trim('PK'.date('dmy').str_pad($last,4,"0",STR_PAD_LEFT)),
                'id_user' => $getuser->id,
                'nm_user' => $getuser->first_name,
                'tgl_buat' => $date,
                'waktu_buat' => $time,
                'id_info_pt_asal' => $getuser->id_info_pt,
                );
              $this->Admin_m->create('produkkeluar',$data);
              $getdata=$this->ProdukKeluar_m->getProdukKeluar($date,$time);
              $pesan = 'Nota Baru Berhasil dibuat';
              $this->session->set_flashdata('message', $pesan );
              redirect(base_url('index.php/admin/produkkeluar/create/'.$getdata->id_pk));
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
          $detbrg = $this->Admin_m->detail_data('brg_pk','id_brg_pk',strip_tags(trim($idbrg)));
          $detpm = $this->Admin_m->detail_data('produkkeluar','id_pk',strip_tags(trim($idpm)));
          if ($detbrg == TRUE && $detpm == TRUE) {
            $cek = $this->Admin_m->detail_data('produk','id_produk',$kode);
            if ($cek == TRUE) {
              $data['id_validasi'] = '1';
              $this->Admin_m->update('produk','id_produk',$kode,$data);
              $pesan = 'Produk berhasi di ubah menjadi <b>"Ada"</b>';
              $this->session->set_flashdata('message', $pesan );
              redirect(base_url('index.php/admin/produkkeluar/addsubproduk/'.$detpm->id_pk.'/'.$detbrg->id_brg_pk));
            }else{
              $pesan = 'Kode Produk tidak di temukan, harap priksa kembali kode anda';
              $this->session->set_flashdata('message', $pesan );
              redirect(base_url('index.php/admin/produkkeluar/addsubproduk/'.$detpm->id_pk.'/'.$detbrg->id_brg_pk));
            }
          }else{
            $pesan = 'Kode struk dan kode sub struk tidak di temukan, harap priksa kembali kode anda';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/admin/produkkeluar/addsubproduk/'.$detpm->id_pk.'/'.$detbrg->id_brg_pk));
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
          $detbrg = $this->Admin_m->detail_data('brg_pk','id_brg_pk',strip_tags(trim($idbrg)));
          $detpm = $this->Admin_m->detail_data('produkkeluar','id_pk',strip_tags(trim($idpm)));
          if ($detbrg == TRUE && $detpm == TRUE) {
            $cek = $this->Admin_m->detail_data('produk','id_produk',$kode);
            if ($cek == TRUE) {
              $data['id_validasi'] = '0';
              $this->Admin_m->update('produk','id_produk',$kode,$data);
              $pesan = 'Produk berhasi di ubah menjadi <b>"Tidak Ada"</b>';
              $this->session->set_flashdata('message', $pesan );
              redirect(base_url('index.php/admin/produkkeluar/addsubproduk/'.$detpm->id_pk.'/'.$detbrg->id_brg_pk));
            }else{
              $pesan = 'Kode Produk tidak di temukan, harap priksa kembali kode anda';
              $this->session->set_flashdata('message', $pesan );
              redirect(base_url('index.php/admin/produkkeluar/addsubproduk/'.$detpm->id_pk.'/'.$detbrg->id_brg_pk));
            }
          }else{
            $pesan = 'Kode struk dan kode sub struk tidak di temukan, harap priksa kembali kode anda';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/admin/produkkeluar/addsubproduk/'.$detpm->id_pk.'/'.$detbrg->id_brg_pk));
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
                $detnota = $this->Admin_m->detail_data('produkkeluar','id_pk',$id);
                $dftrpt = $this->Admin_m->select_data('info_pt');
                $result =  $infopt;
                $data['title'] = 'Buat Perusahaan baru ';
                $data['brand'] = 'assets/img/lembaga/'.$result->logo_pt;
                $data['users'] = $getuser;
                $data['dtpt'] = $dftrpt;
                $data['nav'] = 'nav/nav-admin';
                $data['page'] = 'admin/produkkeluar/tambah-v';
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
                 $config['base_url'] = base_url().'index.php/admin/produkkeluar/create/'.$id.'/';
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
                 $data['barang'] = $this->ProdukKeluar_m->getproduk($id);
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
              $this->form_validation->set_rules('id_pk', 'Kode Produk Masuk', 'required|trim|numeric');
              if ($this->form_validation->run() == FALSE){
                $pesan = $pesan = validation_errors();
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/produkkeluar/create/'.$post['id_pk']));
              }else{
                $getuser= $this->ion_auth->user()->row();
                $post = $this->input->post();
                // $cek = $this->ProdukKeluar_m->cekbrgnota($post['id_pk'],$post['id_type']);
                $detail = $this->Admin_m->detail_data('type','id_type',$post['id_type']);
                // if ($cek == TRUE) {
                //   $pesan = 'Produk <b>'.$detail->nm_type.'<b> Sudah ada dalam nota';
                //   $this->session->set_flashdata('message', $pesan );
                //   redirect(base_url('index.php/admin/produkkeluar/create/'.$post['id_pk']));
                // }else{
                  $data = array(
                    'id_type' => $post['id_type'],
                    'id_pk' => $post['id_pk'],
                  );
                  $this->Admin_m->create('brg_pk',$data);
                  $pesan = 'Produk <b>'.$detail->nm_type.'</b> Berhasil ditambahkan';
                  $this->session->set_flashdata('message', $pesan );
                  redirect(base_url('index.php/admin/produkkeluar/create/'.$post['id_pk']));
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
              $getuser= $this->ion_auth->user()->row();
              // echo "<pre>";print_r($post);echo "</pre>";exit();
              if ($getuser->id_info_pt =='1') {
                 $this->form_validation->set_rules('id_info_pt_asal', 'Asal', 'required|trim|numeric');
              }
              $this->form_validation->set_rules('id_info_pt_tujuan', 'Tujuan', 'required|trim|numeric');
              if ($this->form_validation->run() == FALSE){
                $pesan = $pesan = validation_errors();
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/produkkeluar/create/'.$id));
              }else{
                $cek = $this->Admin_m->detail_data('produkkeluar','id_pk',$id);
                if ($cek == FALSE) {
                  $pesan = 'Produk Yang di maksud tidak terdapat dalam daftar, harap periksa kembali kode unik anda';
                  $this->session->set_flashdata('message', $pesan );
                  redirect(base_url('index.php/admin/produkkeluar/create/'.$id));
                }else{
                  if ($getuser->id_info_pt =='1') {
                    $data = array(
                      'id_info_pt_asal' => $post['id_info_pt_asal'],
                      'id_info_pt_tujuan' => $post['id_info_pt_tujuan'],
                    );
                  }else{
                    $data = array(
                      'id_info_pt_tujuan' => $post['id_info_pt_tujuan'],
                    );
                  }
                  $this->Admin_m->update('produkkeluar','id_pk',$id,$data);
                  $pesan = 'Produk  Berhasil diubah';
                  $this->session->set_flashdata('message', $pesan );
                  redirect(base_url('index.php/admin/produkkeluar/create/'.$id));
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
              $this->form_validation->set_rules('id_brg_pk', 'Type', 'required|trim|numeric');
              $this->form_validation->set_rules('id_pk', 'Kode Produk Masuk', 'required|trim|numeric');
              $this->form_validation->set_rules('cc', 'Cc', 'required|trim|numeric');
              $this->form_validation->set_rules('jml_brg', 'Stok ', 'required|trim|numeric');
              $this->form_validation->set_rules('warna', 'Warna ', 'required|trim|alpha_numeric_spaces');
              if ($this->form_validation->run() == FALSE){
                $pesan = $pesan = validation_errors();
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/produkkeluar/create/'.$post['id_pk']));
              }else{
                $getuser= $this->ion_auth->user()->row();
                $cek = $this->ProdukKeluar_m->cekbrgproduk($post['id_brg_pk']);
                if ($cek == FALSE) {
                  $pesan = 'Produk Yang di maksud tidak terdapat dalam daftar, harap periksa kembali kode unik anda';
                  $this->session->set_flashdata('message', $pesan );
                  redirect(base_url('index.php/admin/produkkeluar/create/'.$post['id_pk']));
                }else{
                  $data = array(
                    'cc' => $post['cc'],
                    'warna' => $post['warna'],
                    'jml_brg' => $post['jml_brg'],
                  );
                  $this->Admin_m->update('brg_pk','id_brg_pk',$post['id_brg_pk'],$data);
                  $pesan = 'Produk  Berhasil diubah';
                  $this->session->set_flashdata('message', $pesan );
                  redirect(base_url('index.php/admin/produkkeluar/create/'.$post['id_pk']));
                } 
              }
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/admin/login'));
        }
    }
    public function addsubpk($idpk,$idbrg){
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
          $dftrpt = $this->Admin_m->select_data('info_pt');
          $detbrg = $this->ProdukKeluar_m->getsubpk(strip_tags(trim($idbrg)));
          $detpm = $this->Admin_m->detail_data('produkkeluar','id_pk',strip_tags(trim($idpk)));
          if ($detpm == TRUE && $detbrg == TRUE) {
            $search_text = "";
            if($post == TRUE ){
             $search_text = $post;
             $this->session->set_userdata($post);
            }else{
              $post = array();
              if($this->session->userdata('id_info_pt_asal') != NULL){
                $post['id_info_pt_asal'] = $this->session->userdata('id_info_pt_asal');
              }
              if($this->session->userdata('id_info_pt_tujuan') != NULL){
               $post['id_info_pt_tujuan'] = $this->session->userdata('id_info_pt_tujuan');
              }
              $search_text = $post;
            }
            if ($getuser->id_info_pt !== '1') {
              $gudangasal = $this->ProdukKeluar_m->brgtypediinfo($detpm->id_info_pt_asal,$detbrg->id_type);
            }else{
              if (@$search_text['id_info_pt_asal'] == TRUE) {
                $gudangasal = $this->ProdukKeluar_m->brgtypediinfo($search_text['id_info_pt_asal'],$detbrg->id_type);
              }else{
                $gudangasal = $this->ProdukKeluar_m->brgtypediinfo($detpm->id_info_pt_asal,$detbrg->id_type);
              }
            }
            $data['title'] = 'Produk yang akan dikirim Keluar dari '.$infopt->nama_info_pt;
            $data['brand'] = $infopt->logo_pt;
            $data['infopt'] = $infopt;
            $data['users'] = $getuser;
            $data['aside'] = 'nav/nav';
            $data['detail'] = $getuser;
            $data['status'] = $status;
            $data['dtpt'] = $dftrpt;
            $data['detpm'] = $detpm;
            $data['detbrg'] = $detbrg;
            $data['gudangasal'] = $gudangasal;
            if ($search_text == TRUE) {
              $infoptlain = $this->Admin_m->info_pt($search_text['id_info_pt_tujuan']);
              $gudanglain = $this->ProdukKeluar_m->brgtypediinfo($infoptlain->id_info_pt,$detbrg->id_type);
              $data['gudanglain'] = $gudanglain;
            }
            $data['post'] = $search_text;
            $data['page'] = 'admin/produkkeluar/listproduk-v';
            // echo "<pre>";print_r($data['gudangasal']);echo "</pre>";exit();
            $this->load->view('admin/dashboard-v',$data);
          }else{
            $pesan = 'Kode struk dan kode sub struk tidak di temukan, harap priksa kembali kode anda';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url());
          }
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
                $detbrg = $this->ProdukKeluar_m->getsubpk(strip_tags(trim($idbrg)));
                $detpm = $this->Admin_m->detail_data('produkkeluar','id_pk',strip_tags(trim($idpm)));
                $type = $this->ProdukKeluar_m->gettype($detbrg->id_type);
                if ($detbrg == TRUE && $detpm == TRUE) {
                  $hasil = $this->ProdukKeluar_m->getsubproduk(strip_tags(trim($idpm)),strip_tags(trim($idbrg)));
                  $data['infopt'] = $infopt;
                  $data['title'] = 'Sub Produk Keluar - '.$infopt->nama_info_pt;
                  $data['users'] = $getuser;
                  $data['detbrg'] = $detbrg;
                  $data['detpm'] = $detpm;
                  $data['hasil'] = $hasil;
                  $data['type'] = $type;
                  $data['nav'] = 'nav/nav-admin';
                  $data['page'] = 'admin/produkkeluar/subproduk-v';
                  // pagging produk
                  $this->load->view('admin/dashboard-v',$data);
                }else{
                  $pesan = 'Kode struk dan kode sub struk tidak di temukan, harap priksa kembali kode anda';
                  $this->session->set_flashdata('message', $pesan );
                  redirect(base_url('index.php/produkkeluar/create/'.$idpm));
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
                $detbrg = $this->Admin_m->detail_data('brg_pk','id_brg_pk',strip_tags(trim($idbrg)));
                $detpm = $this->Admin_m->detail_data('produkkeluar','id_pk',strip_tags(trim($idpm)));
                $type = $this->ProdukKeluar_m->gettype(strip_tags(trim($detbrg->id_type)));
                if ($detbrg == TRUE && $detpm == TRUE) {
                  $this->form_validation->set_rules('no_rangka', 'Nomor Rangka', 'required|trim|numeric');
                  $this->form_validation->set_rules('no_mesin', 'Nomor Mesin ', 'required|trim|numeric');
                  $this->form_validation->set_rules('thn_produk', 'Tahun Produk ', 'required|trim|numeric|min_length[4]|max_length[4]');
                  $this->form_validation->set_rules('bahan_bakar', 'bahan bakar ', 'required|trim|alpha_numeric_spaces');
                  if ($this->form_validation->run() == FALSE){
                    $pesan = $pesan = validation_errors();
                    $this->session->set_flashdata('message', $pesan );
                    redirect(base_url('index.php/admin/produkkeluar/addsubproduk/'.$idpm.'/'.$idbrg));
                  }else{
                    $data = array(
                      'id_pk' => strip_tags(trim($idpm)),
                      'id_brg_pk' => strip_tags(trim($idbrg)),
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
                    $this->Admin_m->update('brg_pk','id_brg_pk',$detbrg->id_brg_pk,$updata);
                    $this->session->set_flashdata('message', $pesan );
                    redirect(base_url('index.php/admin/produkkeluar/addsubproduk/'.$idpm.'/'.$idbrg));
                  }
                }else{
                  $pesan = 'Kode struk dan kode sub struk tidak di temukan, harap priksa kembali kode anda';
                  $this->session->set_flashdata('message', $pesan );
                  redirect(base_url('index.php/produkkeluar/create/'.$idpm));
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
    public function delpk($idpm){
      if ($this->ion_auth->logged_in()) {
        $level = array('admin');
        if (!$this->ion_auth->in_group($level)) {
          $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
          $this->session->set_flashdata('message', $pesan );
          redirect(base_url('index.php/dashboard'));
        }else{
          $kode = preg_replace("/[^0-9]/", "", $idpm);
          $detail = $this->Admin_m->detail_data('produkkeluar','id_pk',$kode);
          if ($detail == TRUE) {
            if ($detail->id_status =='0') {
              $this->Admin_m->delete('produkkeluar','id_pk',$kode);
              $pesan = 'Produk Berhasil dihapus';
              $this->session->set_flashdata('message', $pesan );
              redirect(base_url('index.php/admin/produkkeluar/'));
            }else{
              $pesan = 'Produk ini sudah memiliki sub produk sehingga tidak dapat di hapus';
              $this->session->set_flashdata('message', $pesan );
              redirect(base_url('index.php/admin/produkkeluar/'));
            }
          }else{
            $pesan = 'Kode Produk tidak di temukan, harap priksa kembali kode anda';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/admin/produkkeluar/'));
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
          $detpm = $this->Admin_m->detail_data('produkkeluar','id_pk',strip_tags(trim($idpm)));
          if ($detpm == TRUE ) {
            $kode = preg_replace("/[^0-9]/", "", $idbrg);
            $detail = $this->Admin_m->detail_data('brg_pk','id_brg_pk',$kode);
            if ($detail == TRUE) {
              if ($detail->id_status =='0') {
                $this->Admin_m->delete('brg_pk','id_brg_pk',$kode);
                $pesan = 'Produk Berhasil dihapus';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/produkkeluar/create/'.$idpm));
              }else{
                $pesan = 'Produk ini sudah memiliki sub produk sehingga tidak dapat di hapus';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/produkkeluar/create/'.$idpm));
              }
            }else{
              $pesan = 'Kode Produk tidak di temukan, harap priksa kembali kode anda';
              $this->session->set_flashdata('message', $pesan );
              redirect(base_url('index.php/admin/produkkeluar/create/'.$idpm));
            }
          }else{
            $pesan = 'Kode struk dan kode sub struk tidak di temukan, harap priksa kembali kode anda';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/admin/produkkeluar/addsubproduk/'.$idpm.'/'.$idbrg));
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
          $detbrg = $this->Admin_m->detail_data('brg_pk','id_brg_pk',strip_tags(trim($idbrg)));
          $detpm = $this->Admin_m->detail_data('produkkeluar','id_pk',strip_tags(trim($idpm)));
          if ($detbrg == TRUE && $detpm == TRUE) {
            $kode = preg_replace("/[^0-9]/", "", $id);
            $detail = $this->Admin_m->detail_data('produk','id_produk',$kode);
            if ($detail == TRUE) {
              if ($detail->id_validasi =='0') {
                $this->Admin_m->delete('produk','id_produk',$kode);
                $updata['jml_input'] = $detbrg->jml_input-1;
                $this->Admin_m->update('brg_pk','id_brg_pk',$detbrg->id_brg_pk,$updata);
                $pesan = 'Produk Berhasil dihapus';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/produkkeluar/addsubproduk/'.$idpm.'/'.$idbrg));
              }else{
                $pesan = 'Barang sudah tervalidasi keberadaannya sehingga tidak dapat di hapus';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/produkkeluar/addsubproduk/'.$idpm.'/'.$idbrg));
              }
            }else{
              $pesan = 'Kode Produk tidak di temukan, harap priksa kembali kode anda';
              $this->session->set_flashdata('message', $pesan );
              redirect(base_url('index.php/admin/produkkeluar/addsubproduk/'.$idpm.'/'.$idbrg));
            }
          }else{
            $pesan = 'Kode struk dan kode sub struk tidak di temukan, harap priksa kembali kode anda';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/admin/produkkeluar/addsubproduk/'.$idpm.'/'.$idbrg));
          }
        }
      }else{
        $pesan = 'Login terlebih dahulu';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/login'));
      }
    }
}
?>