<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penjualan extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('admin/Admin_m');
        $this->load->model('admin/Penjualan_m');
        // $this->load->library('resize');
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
                $hariini = date('Y-m-d');
                $getuser = $this->ion_auth->user()->row();
                $infopt = $this->Admin_m->info_pt($getuser->id_info_pt);
                $jenis = $this->Admin_m->select_data('jenis');
                $merk = $this->Admin_m->select_data('merk');
                $type = $this->Admin_m->select_data('type');
                $dtpt = $this->Admin_m->select_data('info_pt');
                $data['title'] = 'Penjualan '.$infopt->nama_info_pt;
                $data['brand'] = $infopt->logo_pt;
                $data['infopt'] = $infopt;
                $data['users'] = $getuser;
                $data['aside'] = 'nav/nav';
                $data['detail'] = $getuser;
                $data['jenis'] = $jenis;
                $data['merk'] = $merk;
                $data['type'] = $type;
                $data['dtpt'] = $dtpt;
                $data['page'] = 'admin/penjualan/main-v';
                   $search_text = "";
                   if($post == TRUE ){
                       $search_text = $post;
                       $this->session->set_userdata($post);
                   }else{
                       $post = array();
                       if($this->session->userdata('no_nota_keluar') != NULL){
                        $post['no_nota_keluar'] = $this->session->userdata('no_nota_keluar');
                       }
                       if($this->session->userdata('nama') != NULL){
                        $post['nama'] = $this->session->userdata('nama');
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
                // All records count
                $allcount = $this->Penjualan_m->getrecordCountid($hariini,$getuser->id_info_pt,$search_text);
                // Get records
                $users_record = $this->Penjualan_m->getDataid($hariini,$getuser->id_info_pt,$rowno,$rowperpage,$search_text);
                // Pagination Configuration
                 $config['base_url'] = base_url().'index.php/admin/penjualan';
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
                $data['tgl'] = $hariini;
               $data['pagination'] = $this->pagination->create_links();
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
      $level = array('admin','members');
      if (!$this->ion_auth->in_group($level)) {
        $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/dashboard'));
      }else{
        $getuser = $this->ion_auth->user()->row();
        $infopt = $this->Admin_m->info_pt($getuser->id_info_pt);
        $hariini = date('Y-m-d');
        $last = $this->Penjualan_m->lastnota();
        if ($last == TRUE) {
          $nonota = $last->id_nota_keluar+1;
        }else{
          $nonota = 1;
        }
        // echo "<pre>";print_r($nonota);echo "</pre>";exit();
        $newkode = trim('NP'.date('dmy').str_pad($nonota,4,"0",STR_PAD_LEFT));
        $data = array(
          'id_info_pt'=>preg_replace("/[^0-9]/", "",trim($getuser->id_info_pt)),
          'tgl_jual'=>trim($hariini),
          'no_nota_keluar'=>trim($newkode),
          'id_user'=>preg_replace("/[^0-9]/", "",trim($getuser->id)),
        );
        $this->Admin_m->create('nota_keluar',$data);
        $pesan = 'Nota Baru Dengan Nomor '.$newkode.' Berhasil dibuat';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/admin/penjualan/tambah/'.$newkode));
      }
    }else{
      $pesan = 'Login terlebih dahulu';
      $this->session->set_flashdata('message', $pesan );
      redirect(base_url('index.php/login'));
    }
  }
  public function tambah($nonota,$rowno=0){
    if ($this->ion_auth->logged_in()) {
      $level = array('admin');
      if (!$this->ion_auth->in_group($level)) {
        $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/dashboard'));
      }else{
        $getnonota = preg_replace("/[^a-zA-Z0-9]/","",$nonota);
        // echo "<pre>";print_r($getnonota);echo "</pre>";exit();
        $ceknota = $this->Admin_m->detail_data('nota_keluar','no_nota_keluar',trim($getnonota));
        // echo "<pre>";print_r($ceknota);echo "</pre>";exit();
        if ($ceknota == TRUE) {
          $post = $this->input->post();
          $getuser = $this->ion_auth->user()->row();
          $infopt = $this->Admin_m->info_pt($getuser->id_info_pt);
          $hariini = date('Y-m-d');
          $jenis = $this->Admin_m->select_data('jenis');
          $merk = $this->Admin_m->select_data('merk');
          $type = $this->Admin_m->select_data('type');
          $dtpt = $this->Admin_m->select_data('info_pt');
          $leasing = $this->Penjualan_m->getleasing($infopt->kode_pt);
          $detail = $ceknota;
          $data['title'] = 'Tambah Penjualan hari ini, '.date('d F Y',strtotime($hariini));
          $data['infopt'] = $infopt;
          $data['users'] = $getuser;
          $data['aside'] = 'nav/nav';
          $data['jenis'] = $jenis;
          $data['merk'] = $merk;
          $data['type'] = $type;
          $data['dtpt'] = $dtpt;
          $data['leasing'] = $leasing;
          $data['tgl'] = $hariini;
          $data['page'] = 'admin/penjualan/tambah-v';
          $search_text = "";
          if($post == TRUE ){
            $search_text = $post;
            $this->session->set_userdata($post);
          }else{
            $post = array();
            if($this->session->userdata('id_type') != NULL){
              $post['id_type'] = $this->session->userdata('id_type');
            }
            if($this->session->userdata('cc') != NULL){
              $post['cc'] = $this->session->userdata('cc');
            }
            if($this->session->userdata('warna') != NULL){
              $post['warna'] = $this->session->userdata('warna');
            }
            $search_text = $post;
          }
             // Row per page
          $rowperpage = 20;
             // Row position
          if($rowno != 0){
            $rowno = ($rowno-1) * $rowperpage;
          }
          // All records count
          $allcount = $this->Penjualan_m->getrecordCountidPenjualan($getuser->id_info_pt,$search_text);
          // Get records
          $users_record = $this->Penjualan_m->getDataidPenjualan($getuser->id_info_pt,$rowno,$rowperpage,$search_text);
          // Pagination Configuration
          $config['base_url'] = base_url().'index.php/admin/penjualan/tambah/'.$nonota.'/';
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
          $data['detail'] = $detail;
          $data['hasil'] = $users_record;
          $data['row'] = $rowno;
          $data['jmldata'] = $allcount;
          $data['search'] = $search_text;
          $data['post'] = $search_text;
          $data['pagination'] = $this->pagination->create_links();
          $this->load->view('admin/dashboard-v',$data);
        }else{
          $pesan = 'Nomor Nota tidak ditemukan, harap periksa kembali nomor nota anda';
          $this->session->set_flashdata('message',$pesan);
          redirect(base_url('index.php/admin/penjualan/'));
        }
      }
    }else{
      $pesan = 'Login terlebih dahulu';
      $this->session->set_flashdata('message', $pesan );
      redirect(base_url('index.php/login'));
    }
  }
  public function addproduk($nota){
    if ($this->ion_auth->logged_in()) {
      $level = array('admin','members');
      if (!$this->ion_auth->in_group($level)) {
        $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/dashboard'));
      }else{
        $ceknota = $this->Admin_m->detail_data('nota_keluar','no_nota_keluar',preg_replace("/[^a-zA-Z0-9]/", "",trim($nota)));
        if ($ceknota == TRUE) {
          $post = $this->input->post();
          $getuser = $this->ion_auth->user()->row();
          $infopt = $this->Admin_m->info_pt($getuser->id_info_pt);
          $cekproduk = $this->Penjualan_m->detailproduk($post['id_produk']);
          $hariini = date('Y-m-d');
          // echo "<pre>";print_r($nonota);echo "</pre>";exit();
          if ($ceknota->id_produk =='0') {
            if ($cekproduk == TRUE) {
              $data = array(
                'id_produk'=>$cekproduk->id_produk,
                'no_rangka'=>$cekproduk->no_rangka,
                'no_mesin'=>$cekproduk->no_mesin,
                'harga_jual'=>$cekproduk->hrg_jual,
              );
              $this->Admin_m->update('nota_keluar','id_nota_keluar',$ceknota->id_nota_keluar,$data);
              // update status produk
              $upproduk = array(
                'id_status'=>'2',
                'tgl_keluar'=>$hariini,
              );
              $this->Admin_m->update('produk','id_produk',$cekproduk->id_produk,$upproduk);
              $pesan = 'Produk '.$cekproduk->nm_type.' '.$cekproduk->cc.' '.$cekproduk->warna.' Berhasil ditambahkan kedalam Nota '.$ceknota->no_nota_keluar;
              $this->session->set_flashdata('message', $pesan );
              redirect(base_url('index.php/admin/penjualan/tambah/'.$ceknota->no_nota_keluar));
            }else{
              $pesan = 'Kode Khusus Produk tidak ditemukan, harap periksa kembali Kode Khusus Produk anda';
              $this->session->set_flashdata('message',$pesan);
              redirect(base_url('index.php/admin/penjualan/tambah/'.$ceknota->no_nota_keluar));
            }
          }else{
            $pesan = 'Tidak dapat menambahkan produk lain karena Nota '.$ceknota->no_nota_keluar.' sudah terdaftar memiliki produk';
            $this->session->set_flashdata('message',$pesan);
            redirect(base_url('index.php/admin/penjualan/tambah/'.$ceknota->no_nota_keluar));
          }
        }else{
          $pesan = 'Nomor Nota tidak ditemukan, harap periksa kembali nomor nota anda';
          $this->session->set_flashdata('message',$pesan);
          redirect(base_url('index.php/admin/penjualan/'));
        }
      }
    }else{
      $pesan = 'Login terlebih dahulu';
      $this->session->set_flashdata('message', $pesan );
      redirect(base_url('index.php/login'));
    }
  }
  public function delprodukjual($nota){
    if ($this->ion_auth->logged_in()) {
      $level = array('admin','members');
      if (!$this->ion_auth->in_group($level)) {
        $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/dashboard'));
      }else{
        $ceknota = $this->Admin_m->detail_data('nota_keluar','no_nota_keluar',preg_replace("/[^a-zA-Z0-9]/", "",trim($nota)));
        if ($ceknota == TRUE) {
          if ($ceknota->id_status == '0') {
            // $cekproduk = $this->Penjualan_m->detailproduk($ceknota->id_produk);
            // if ($cekproduk->id_status =='1' || $cekproduk->id_status =='0') {
              $data = array(
                'id_produk'=>'0',
                'no_rangka'=>NULL,
                'no_mesin'=>NULL,
                'harga_jual'=>'0',
              );
              $this->Admin_m->update('nota_keluar','id_nota_keluar',$ceknota->id_nota_keluar,$data);
                            // update status produk
              $upproduk = array(
                'id_status'=>'1',
                'tgl_keluar'=>'0000-00-00',
              );
              $this->Admin_m->update('produk','id_produk',$cekproduk->id_produk,$upproduk);
              $pesan = 'Produk telah di hapus dari Nota '.$ceknota->no_nota_keluar;
              $this->session->set_flashdata('message', $pesan );
              redirect(base_url('index.php/admin/penjualan/tambah/'.$ceknota->no_nota_keluar));
            // }else{
            //   $pesan = 'Produk telah terjual sehingga tidak dapat melakukan pembatalan produk';
            //   $this->session->set_flashdata('message',$pesan);
            //   redirect(base_url('index.php/admin/penjualan/tambah/'.$ceknota->no_nota_keluar));
            // }
          }else{
            $pesan = 'Nota Telah Berstatus terjual tidak dapat melakukan pembatalan produk';
            $this->session->set_flashdata('message',$pesan);
            redirect(base_url('index.php/admin/penjualan/tambah/'.$ceknota->no_nota_keluar));
          }
        }else{
          $pesan = 'Nomor Nota tidak ditemukan, harap periksa kembali nomor nota anda';
          $this->session->set_flashdata('message',$pesan);
          redirect(base_url('index.php/admin/penjualan/'));
        }
      }
    }else{
      $pesan = 'Login terlebih dahulu';
      $this->session->set_flashdata('message', $pesan );
      redirect(base_url('index.php/login'));
    }
  }
   public function updatapembeli($nota){
    if ($this->ion_auth->logged_in()) {
      $level = array('admin','members');
      if (!$this->ion_auth->in_group($level)) {
        $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/dashboard'));
      }else{
        $ceknota = $this->Admin_m->detail_data('nota_keluar','no_nota_keluar',preg_replace("/[^a-zA-Z0-9]/", "",trim($nota)));
        if ($ceknota == TRUE) {
          // validasi
          $this->form_validation->set_rules('nm_p_ktp', 'Nama Pembeli Sesuai KTP', 'required|alpha_numeric_spaces');
          $this->form_validation->set_rules('alamat_1_p', 'Alamat Pertama', 'required|alpha_numeric_spaces');
          if ($this->form_validation->run() == FALSE){
              $pesan = validation_errors();
              $this->session->set_flashdata('message',$pesan); 
              redirect(base_url('index.php/admin/penjualan/tambah/'.$ceknota->no_nota_keluar));
          }else{
            $post = $this->input->post();
            $getuser = $this->ion_auth->user()->row();
            $infopt = $this->Admin_m->info_pt($getuser->id_info_pt);
            $data = array(
              'nm_p_ktp'=>$post['nm_p_ktp'],
              'alamat_1_p'=>$post['alamat_1_p'],
            );
            $this->Admin_m->update('nota_keluar','id_nota_keluar',$ceknota->id_nota_keluar,$data);
            $pesan = 'Data Pembeli pada Nota '.$ceknota->no_nota_keluar.' Berhasil ditambahkan disimpan';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/admin/penjualan/tambah/'.$ceknota->no_nota_keluar));
          }
        }else{
          $pesan = 'Nomor Nota tidak ditemukan, harap periksa kembali nomor nota anda';
          $this->session->set_flashdata('message',$pesan);
          redirect(base_url('index.php/admin/penjualan/'));
        }
      }
    }else{
      $pesan = 'Login terlebih dahulu';
      $this->session->set_flashdata('message', $pesan );
      redirect(base_url('index.php/login'));
    }
  }
  public function updatapembelilengkap($nota){
    if ($this->ion_auth->logged_in()) {
      $level = array('admin','members');
      if (!$this->ion_auth->in_group($level)) {
        $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/dashboard'));
      }else{
        $ceknota = $this->Admin_m->detail_data('nota_keluar','no_nota_keluar',preg_replace("/[^a-zA-Z0-9]/", "",trim($nota)));
        if ($ceknota == TRUE) {
          // validasi
          $this->form_validation->set_rules('nm_p_bku_uang', 'Nama Pada Buku Uang', 'required|alpha_numeric_spaces');
          $this->form_validation->set_rules('no_ktp_p', 'Nomor KTP', 'required|numeric');
          $this->form_validation->set_rules('tlp_p', 'Nomor Telepon', 'required|numeric');
          $this->form_validation->set_rules('jk_p', 'Jenis Kelamin', 'required|alpha_numeric_spaces');
          $this->form_validation->set_rules('tgl_lahir_p', 'Tanggal Lahir', 'required|alpha_dash');
          $this->form_validation->set_rules('pekerjaan_p', 'Pekerjaan', 'required|alpha_numeric_spaces');
          $this->form_validation->set_rules('pendidikan_p', 'Pendidikan', 'required|alpha_numeric_spaces');
          $this->form_validation->set_rules('pengeluaran_p', 'Pengeluaran', 'required|alpha_numeric_spaces');
          $this->form_validation->set_rules('propinsi_p', 'Propinsi', 'required|alpha_numeric_spaces');
          $this->form_validation->set_rules('kecamatan_p', 'Kecamatan', 'required|alpha_numeric_spaces');
          $this->form_validation->set_rules('kelurahan_p', 'kelurahan', 'required|alpha_numeric_spaces');
          $this->form_validation->set_rules('kode_pos_p', 'Kode Pos', 'required|alpha_dash');
          $this->form_validation->set_rules('alamat_2_p', 'Alamat Tambahan', 'required|alpha_numeric_spaces');
          if ($this->form_validation->run() == FALSE){
              $pesan = validation_errors();
              $this->session->set_flashdata('message',$pesan); 
              redirect(base_url('index.php/admin/penjualan/tambah/'.$ceknota->no_nota_keluar));
          }else{
            $post = $this->input->post();
            $getuser = $this->ion_auth->user()->row();
            $infopt = $this->Admin_m->info_pt($getuser->id_info_pt);
            $data = array(
              'nm_p_bku_uang'=>$post['nm_p_bku_uang'],
              'no_ktp_p'=>$post['no_ktp_p'],
              'tlp_p'=>$post['tlp_p'],
              'jk_p'=>$post['jk_p'],
              'tgl_lahir_p'=>$post['tgl_lahir_p'],
              'pekerjaan_p'=>$post['pekerjaan_p'],
              'pendidikan_p'=>$post['pendidikan_p'],
              'pengeluaran_p'=>$post['pengeluaran_p'],
              'propinsi_p'=>$post['propinsi_p'],
              'kecamatan_p'=>$post['kecamatan_p'],
              'kelurahan_p'=>$post['kelurahan_p'],
              'kode_pos_p'=>$post['kode_pos_p'],
              'alamat_2_p'=>$post['alamat_2_p']
            );
            $this->Admin_m->update('nota_keluar','id_nota_keluar',$ceknota->id_nota_keluar,$data);
            $pesan = 'Data Pembeli pada Nota '.$ceknota->no_nota_keluar.' Berhasil ditambahkan disimpan';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/admin/penjualan/tambah/'.$ceknota->no_nota_keluar));
          }
        }else{
          $pesan = 'Nomor Nota tidak ditemukan, harap periksa kembali nomor nota anda';
          $this->session->set_flashdata('message',$pesan);
          redirect(base_url('index.php/admin/penjualan/'));
        }
      }
    }else{
      $pesan = 'Login terlebih dahulu';
      $this->session->set_flashdata('message', $pesan );
      redirect(base_url('index.php/login'));
    }
  }
  public function updataleasing($nota){
    if ($this->ion_auth->logged_in()) {
      $level = array('admin','members');
      if (!$this->ion_auth->in_group($level)) {
        $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/dashboard'));
      }else{
        $ceknota = $this->Admin_m->detail_data('nota_keluar','no_nota_keluar',preg_replace("/[^a-zA-Z0-9]/", "",trim($nota)));
        if ($ceknota == TRUE) {
          // validasi
          $this->form_validation->set_rules('id_leasing', 'Kode Leasing', 'required|numeric');
          $this->form_validation->set_rules('stnk', 'STNK', 'alpha_numeric_spaces');
          $this->form_validation->set_rules('tgl_reg_stnk', 'Tanggal Reg STNK', 'alpha_dash');
          $this->form_validation->set_rules('harga_stnk', 'Harga STNK', 'numeric');
          $this->form_validation->set_rules('uang_muka', 'Uang Muka', 'numeric');
          $this->form_validation->set_rules('jangka_bayar', 'Jangka Bayar', 'alpha_numeric_spaces');
          $this->form_validation->set_rules('angsuran', 'Angsuran', 'numeric');
          $this->form_validation->set_rules('id_surveyor', 'Surveyor', 'alpha_numeric_spaces');
          if ($this->form_validation->run() == FALSE){
              $pesan = validation_errors();
              $this->session->set_flashdata('message',$pesan); 
              redirect(base_url('index.php/admin/penjualan/tambah/'.$ceknota->no_nota_keluar));
          }else{
            $post = $this->input->post();
            $getuser = $this->ion_auth->user()->row();
            $infopt = $this->Admin_m->info_pt($getuser->id_info_pt);
            $data = array(
              'id_leasing'=>$post['id_leasing'],
              'stnk'=>$post['stnk'],
              'tgl_reg_stnk'=>$post['tgl_reg_stnk'],
              'harga_stnk'=>$post['harga_stnk'],
              'uang_muka'=>$post['uang_muka'],
              'jangka_bayar'=>$post['jangka_bayar'],
              'angsuran'=>$post['angsuran'],
              'id_surveyor'=>$post['id_surveyor']
            );
            $this->Admin_m->update('nota_keluar','id_nota_keluar',$ceknota->id_nota_keluar,$data);
            $pesan = 'Data Pembeli pada Nota '.$ceknota->no_nota_keluar.' Berhasil ditambahkan disimpan';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/admin/penjualan/tambah/'.$ceknota->no_nota_keluar));
          }
        }else{
          $pesan = 'Nomor Nota tidak ditemukan, harap periksa kembali nomor nota anda';
          $this->session->set_flashdata('message',$pesan);
          redirect(base_url('index.php/admin/penjualan/'));
        }
      }
    }else{
      $pesan = 'Login terlebih dahulu';
      $this->session->set_flashdata('message', $pesan );
      redirect(base_url('index.php/login'));
    }
  }
  public function pembayaran($nota){
    if ($this->ion_auth->logged_in()) {
      $level = array('admin','members');
      if (!$this->ion_auth->in_group($level)) {
        $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/dashboard'));
      }else{
        $post = $this->input->post();
        // echo "<pre>";print_r($post);echo "</pre>";exit();
        $ceknota = $this->Admin_m->detail_data('nota_keluar','no_nota_keluar',preg_replace("/[^a-zA-Z0-9]/", "",trim($nota)));
        if ($ceknota == TRUE) {
          // validasi
          $this->form_validation->set_rules('jml_bayar', 'Jumlah Harus Dibayar', 'required|numeric');
          $this->form_validation->set_rules('jml_di_bayar', 'Uang Dari Pembeli', 'required|numeric');
          if ($this->form_validation->run() == FALSE){
              $pesan = validation_errors();
              $this->session->set_flashdata('message',$pesan); 
              redirect(base_url('index.php/admin/penjualan/tambah/'.$ceknota->no_nota_keluar));
          }else{
            $getuser = $this->ion_auth->user()->row();
            $infopt = $this->Admin_m->info_pt($getuser->id_info_pt);
            $data = array(
              'jml_bayar'=>$post['jml_bayar'],
              'jml_di_bayar'=>$post['jml_di_bayar'],
              'id_status'=>'1'
            );
            $this->Admin_m->update('nota_keluar','id_nota_keluar',$ceknota->id_nota_keluar,$data);
            $pesan = 'Data Pembeli pada Nota '.$ceknota->no_nota_keluar.' Berhasil ditambahkan disimpan';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/admin/penjualan/tambah/'.$ceknota->no_nota_keluar));
          }
        }else{
          $pesan = 'Nomor Nota tidak ditemukan, harap periksa kembali nomor nota anda';
          $this->session->set_flashdata('message',$pesan);
          redirect(base_url('index.php/admin/penjualan/'));
        }
      }
    }else{
      $pesan = 'Login terlebih dahulu';
      $this->session->set_flashdata('message', $pesan );
      redirect(base_url('index.php/login'));
    }
  }
  public function cetaknota($nota){
    if ($this->ion_auth->logged_in()) {
      $level = array('admin','members');
      if (!$this->ion_auth->in_group($level)) {
        $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/dashboard'));
      }else{
        $ceknota = $this->Admin_m->detail_data('nota_keluar','no_nota_keluar',preg_replace("/[^a-zA-Z0-9]/", "",trim($nota)));
        if ($ceknota == TRUE) {
          $post = $this->input->post();
          $getuser = $this->ion_auth->user()->row();
          $infopt = $this->Admin_m->info_pt($getuser->id_info_pt);
          $detail = $ceknota;
          $data['title'] = 'Cetak Nota Penjualan , '.$ceknota->no_nota_keluar;
          $data['infopt'] = $infopt;
          $data['users'] = $getuser;
          $data['aside'] = 'nav/nav';
          $this->load->view('admin/penjualan/cetak-v',$data);
        }else{
          $pesan = 'Nomor Nota tidak ditemukan, harap periksa kembali nomor nota anda';
          $this->session->set_flashdata('message',$pesan);
          redirect(base_url('index.php/admin/penjualan/'));
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