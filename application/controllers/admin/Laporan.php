<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('admin/Admin_m');
        $this->load->model('admin/Laporan_m');
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
                $tahunini = date('Y');
                $getuser = $this->ion_auth->user()->row();
                $infopt = $this->Admin_m->info_pt($getuser->id_info_pt);
                $alltahun = $this->Admin_m->caritahun($getuser->id_info_pt);
                $dtpt = $this->Admin_m->select_data('info_pt');
                $data['title'] = 'Laporan Tahunan '.$infopt->nama_info_pt;
                $data['brand'] = $infopt->logo_pt;
                $data['infopt'] = $infopt;
                $data['users'] = $getuser;
                $data['aside'] = 'nav/nav';
                $data['detail'] = $getuser;
                $data['page'] = 'admin/laporan/main-v';
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
                       if($this->session->userdata('id_info_pt') != NULL){
                        $post['id_info_pt'] = $this->session->userdata('id_info_pt');
                       }
                       if($this->session->userdata('id_status') != NULL){
                        $post['id_status'] = $this->session->userdata('id_status');
                       }
                       if($this->session->userdata('tahun') != NULL){
                        $post['tahun'] = $this->session->userdata('tahun');
                       }else{
                        $post['tahun'] = $tahunini;
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
                   $allcount = $this->Laporan_m->getrecordCount($search_text);
                   // Get records
                   $users_record = $this->Laporan_m->getData($rowno,$rowperpage,$search_text);
                }else{
                    // All records count
                    $allcount = $this->Laporan_m->getrecordCountid($getuser->id_info_pt,$search_text);
                    // Get records
                    $users_record = $this->Laporan_m->getDataid($getuser->id_info_pt,$rowno,$rowperpage,$search_text);
                }
                // Pagination Configuration
                 $config['base_url'] = base_url().'index.php/admin/laporan/index/';
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
                  if ($getuser->id_info_pt !=='1') {
                    $data['stnktunda'] = $this->Laporan_m->stnk_tunda_pt($getuser->id_info_pt,$search_text);
                    $data['ttlchash'] = $this->Laporan_m->byr_cash_pt($getuser->id_info_pt,$search_text);
                    $data['ttlleasing'] = $this->Laporan_m->byr_leasing_pt($getuser->id_info_pt,$search_text);
                  }else{
                    $data['stnktunda'] = $this->Laporan_m->stnk_tunda($search_text);
                    $data['ttlchash'] = $this->Laporan_m->byr_cash($search_text);
                    $data['ttlleasing'] = $this->Laporan_m->byr_leasing($search_text);
                  }
                  $data['row'] = $rowno;
                  $data['jmldata'] = $allcount;
                  $data['search'] = $search_text;
                  $data['post'] = $search_text;
                  $data['alltahun'] = $alltahun;
                  $data['dtpt'] = $dtpt;
                $data['tgl'] = $tahunini;
               $data['pagination'] = $this->pagination->create_links();
              $this->load->view('admin/dashboard-v',$data);
          }
      }else{
          $pesan = 'Login terlebih dahulu';
          $this->session->set_flashdata('message', $pesan );
          redirect(base_url('index.php/login'));
      }
    }
    public function hariini($rowno=0){
      if ($this->ion_auth->logged_in()) {
        $level = array('admin');
        if (!$this->ion_auth->in_group($level)) {
          $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
          $this->session->set_flashdata('message', $pesan );
          redirect(base_url('index.php/dashboard'));
        }else{
          $this->load->model('admin/Penjualan_m');
          $post = $this->input->post();
          $hariini = date('Y-m-d');
          $getuser = $this->ion_auth->user()->row();
          $infopt = $this->Admin_m->info_pt($getuser->id_info_pt);
          $jenis = $this->Admin_m->select_data('jenis');
          $merk = $this->Admin_m->select_data('merk');
          $type = $this->Admin_m->select_data('type');
          $dtpt = $this->Admin_m->select_data('info_pt');
          $data['title'] = 'Laporan Penjualan Harian '.$infopt->nama_info_pt;
          $data['brand'] = $infopt->logo_pt;
          $data['infopt'] = $infopt;
          $data['users'] = $getuser;
          $data['aside'] = 'nav/nav';
          $data['detail'] = $getuser;
          $data['jenis'] = $jenis;
          $data['merk'] = $merk;
          $data['type'] = $type;
          $data['dtpt'] = $dtpt;
          $data['page'] = 'admin/laporan/hariini-v';
                // All records count
          $allcount = $this->Laporan_m->getrecordtoday($hariini,$getuser->id_info_pt);
                // Get records
          $users_record = $this->Laporan_m->getDatatoday($hariini,$getuser->id_info_pt);
          $produk_record = $this->Laporan_m->getprodukterjual($hariini,$getuser->id_info_pt);
          $data['hasil'] = $users_record;
          $data['row'] = $rowno;
          $data['jmldata'] = $allcount;
          $data['produk'] = $produk_record;
          $data['tgl'] = $hariini;
          $this->load->view('admin/dashboard-v',$data);
        }
      }else{
        $pesan = 'Login terlebih dahulu';
        $this->session->set_flashdata('message', $pesan );
        redirect(base_url('index.php/login'));
      }
    }
    public function bulanan($rowno=0){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/dashboard'));
            }else{
                $post = $this->input->post();
                $tahunini = date('Y');
                $getuser = $this->ion_auth->user()->row();
                $infopt = $this->Admin_m->info_pt($getuser->id_info_pt);
                $alltahun = $this->Admin_m->caritahun($getuser->id_info_pt);
                $dtpt = $this->Admin_m->select_data('info_pt');
                $data['title'] = 'Laporan Bulanan '.$infopt->nama_info_pt;
                $data['brand'] = $infopt->logo_pt;
                $data['infopt'] = $infopt;
                $data['users'] = $getuser;
                $data['aside'] = 'nav/nav';
                $data['detail'] = $getuser;
                $data['page'] = 'admin/laporan/bulanan-v';
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
                       if($this->session->userdata('id_info_pt') != NULL){
                        $post['id_info_pt'] = $this->session->userdata('id_info_pt');
                       }
                       if($this->session->userdata('tgl_awal') != NULL){
                        $post['tgl_awal'] = $this->session->userdata('tgl_awal');
                       }
                       if($this->session->userdata('tgl_akhir') != NULL){
                        $post['tgl_akhir'] = $this->session->userdata('tgl_akhir
                          ');
                       }
                       if($this->session->userdata('id_status') != NULL){
                        $post['id_status'] = $this->session->userdata('id_status');
                       }
                       if($this->session->userdata('tahun') != NULL){
                        $post['tahun'] = $this->session->userdata('tahun');
                       }else{
                        $post['tahun'] = $tahunini;
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
                   $allcount = $this->Laporan_m->getrecordCountbulanan($search_text);
                   // Get records
                   $users_record = $this->Laporan_m->getDatabulanan($rowno,$rowperpage,$search_text);
                }else{
                    // All records count
                    $allcount = $this->Laporan_m->getrecordCountidbulanan($getuser->id_info_pt,$search_text);
                    // Get records
                    $users_record = $this->Laporan_m->getDataidbulanan($getuser->id_info_pt,$rowno,$rowperpage,$search_text);
                }
                // Pagination Configuration
                 $config['base_url'] = base_url().'index.php/admin/laporan/index/';
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
                  if ($getuser->id_info_pt !=='1') {
                    $data['stnktunda'] = $this->Laporan_m->stnk_tunda_pt_bulanan($getuser->id_info_pt,$search_text);
                    $data['ttlchash'] = $this->Laporan_m->byr_cash_pt_bulanan($getuser->id_info_pt,$search_text);
                    $data['ttlleasing'] = $this->Laporan_m->byr_leasing_pt_bulanan($getuser->id_info_pt,$search_text);
                  }else{
                    $data['stnktunda'] = $this->Laporan_m->stnk_tunda_bulanan($search_text);
                    $data['ttlchash'] = $this->Laporan_m->byr_cash_bulanan($search_text);
                    $data['ttlleasing'] = $this->Laporan_m->byr_leasing_bulanan($search_text);
                  }
                  $data['row'] = $rowno;
                  $data['jmldata'] = $allcount;
                  $data['search'] = $search_text;
                  $data['post'] = $search_text;
                  $data['alltahun'] = $alltahun;
                  $data['dtpt'] = $dtpt;
                $data['tgl'] = $tahunini;
               $data['pagination'] = $this->pagination->create_links();
              $this->load->view('admin/dashboard-v',$data);
          }
      }else{
          $pesan = 'Login terlebih dahulu';
          $this->session->set_flashdata('message', $pesan );
          redirect(base_url('index.php/login'));
      }
    }
}
?>