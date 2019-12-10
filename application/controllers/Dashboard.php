<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('Nusoap_lib');
        $this->load->model('admin/Admin_m');
        $this->load->library('Init_lib');
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
                $infopt = $this->Admin_m->info_pt(1);
                $data['title'] = 'Beranda Utama - '.$datauser->username;
                $data['infopt'] = $infopt;
                $data['users'] = $datauser;
                $data['nav'] = 'nav/nav-admin';
                $data['page'] = 'admin/dashboard/main-v';
                // feeder data
                $hostname = $infopt->hostname;
                $port = $infopt->port;
                $url = 'http://'.$hostname.':'.$port.'/ws/live.php?wsdl';
                $client = new nusoap_client($url, true);
                $proxy = $client->getProxy();
                $username =$infopt->userfeeder;
                $pass = $infopt->passfeeder;
                $token = $proxy->getToken($username, $pass);
                $datamhspt = $proxy->getRecord($token,'mahasiswa_pt',"p.id_reg_pd = '{$datauser->id_reg_pd}'");
                $datamhss = $proxy->getRecord($token,'mahasiswa',"id_pd = '{$datauser->id_pd}'");
                $listmhs = $proxy->getListMahasiswa($token,"id_reg_pd = '{$datauser->id_reg_pd}'",'','');
                $data['hasil'] =$datamhspt['result']; 
                $data['detail'] = $datamhss['result'];
                $data['listmhs'] = $listmhs['result'];
                // ?$data['dtadm'] = $this->ion_auth->user()->row();
                // echo "<pre>";print_r($data['detail']);echo "</pre>";exit();
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