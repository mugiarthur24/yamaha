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
                $hariini = date('Y-m-d');
                $getuser = $this->ion_auth->user()->row();
                $infopt = $this->Admin_m->info_pt($getuser->id_info_pt);
                $data['title'] = 'Laporan '.$infopt->nama_info_pt;
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
}
?>