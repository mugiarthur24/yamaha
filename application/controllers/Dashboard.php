<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Admin_m');
        $this->load->library('Excel');
        $this->load->library('Resize');
    }
    public function index($rowno=0){
        if ($this->ion_auth->logged_in()) {
            $level = array('admin','members');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard'));
            }else{
                $post = $this->input->post();
                $tahunini = date('Y');
                $this->load->model('admin/Laporan_m');
                $datauser = $this->ion_auth->user()->row();
                $getuser = $this->ion_auth->user()->row();
                $infopt = $this->Admin_m->info_pt($datauser->id_info_pt);
                $data['title'] = 'Beranda Utama - '.$datauser->username;
                $data['infopt'] = $infopt;
                $data['users'] = $datauser;
                $data['page'] = 'admin/dashboard/main-v';
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
                if ($getuser->id_info_pt !=='1') {
                    $data['stnktunda'] = $this->Laporan_m->stnk_tunda_pt($getuser->id_info_pt,$search_text);
                    $data['ttlchash'] = $this->Laporan_m->byr_cash_pt($getuser->id_info_pt,$search_text);
                    $data['ttlleasing'] = $this->Laporan_m->byr_leasing_pt($getuser->id_info_pt,$search_text);
                  }else{
                    $data['stnktunda'] = $this->Laporan_m->stnk_tunda($search_text);
                    $data['ttlchash'] = $this->Laporan_m->byr_cash($search_text);
                    $data['ttlleasing'] = $this->Laporan_m->byr_leasing($search_text);
                  }
                  $data['jmldata'] = $allcount;
                  $data['search'] = $search_text;
                  $data['post'] = $search_text;
                $this->load->view('admin/dashboard-v', $data);
            }
        }else{
            $pesan = 'Login terlebih dahulu';
            $this->session->set_flashdata('message', $pesan );
            redirect(base_url('index.php/login'));
        }
    }
}
?>