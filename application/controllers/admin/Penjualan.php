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
          $detail = $ceknota;
          $data['title'] = 'Tambah Penjualan hari ini, '.date('d F Y',strtotime($hariini));
          $data['infopt'] = $infopt;
          $data['users'] = $getuser;
          $data['aside'] = 'nav/nav';
          $data['jenis'] = $jenis;
          $data['merk'] = $merk;
          $data['type'] = $type;
          $data['dtpt'] = $dtpt;
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
          if ($cekproduk == TRUE) {
            $data = array(
              'id_produk'=>$cekproduk->id_produk,
              'no_rangka'=>$cekproduk->no_rangka,
              'no_mesin'=>$cekproduk->no_mesin,
              'harga_jual'=>$cekproduk->hrg_jual,
            );
            $this->Admin_m->update('nota_keluar','id_nota_keluar',$ceknota->id_nota_keluar,$data);
            $pesan = 'Produk '.$cekproduk->nm_type.' '.$cekproduk->cc.' '.$cekproduk->warna.' Berhasil ditambahkan kedalam Nota '.$ceknota->no_nota_keluar;
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/admin/penjualan/tambah/'.$ceknota->no_nota_keluar));
          }else{
            $pesan = 'Kode Khusus Produk tidak ditemukan, harap periksa kembali Kode Khusus Produk anda';
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
}
?>