<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Admin_m');
        $this->load->library('Excel');
        $this->load->library('Resize');
    }
    public function index(){
        if ($this->ion_auth->logged_in()) {
            $level = array('members');
            if (!$this->ion_auth->in_group($level)) {
                $pesan = 'Anda tidak memiliki Hak untuk Mengakses halaman ini';
                $this->session->set_flashdata('message', $pesan );
                redirect(base_url('index.php/admin/dashboard'));
            }else{
                $datauser = $this->ion_auth->user()->row();
                $infopt = $this->Admin_m->info_pt($datauser->id_info_pt);
                $data['title'] = 'Beranda Utama - '.$datauser->username;
                $data['infopt'] = $infopt;
                $data['users'] = $datauser;
                $data['page'] = 'admin/dashboard/main-v';
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