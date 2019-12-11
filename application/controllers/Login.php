<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('admin/Admin_m');
        $this->load->helper('form');
    }

    function index(){
        if($this->ion_auth->logged_in()){
        //sudah login, redirect ke halaman welcome
        redirect(base_url('index.php/dashboard'));
       }
        //user tidak login, tampilkan halaman login
       $infopt = $this->Admin_m->info_pt(1);
       $data['title'] = 'Sistem Informasi '.$infopt->nama_info_pt;
       $data['infopt'] = $this->Admin_m->info_pt(1);
       $data['brand'] = 'asset/img/lembaga/'.$infopt->logo_pt;
       $this->load->view('admin/login-v', $data);
   }
    public function proses_login(){
        // validate form input
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() === TRUE)
        {
            // check to see if the user is logging in
            // check for "remember me"
            $remember = (bool)$this->input->post('remember');
            if ($this->ion_auth->login($this->input->post('username'), $this->input->post('password'), $remember))
            {
                //if the login is successful
                //redirect them back to the home page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect(base_url('index.php/dashboard'));
            }
            else
            {
                // if the login was un-successful
                // redirect them back to the login page
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect(base_url('index.php/login')); // use redirects instead of loading views for compatibility with MY_Controller libraries
            }
        }
    }
    function logout(){
        //log the user out
        $logout = $this->ion_auth->logout();
        //redirect ke halaman sebelumnya
        redirect(base_url('index.php/login'));
    }
    function forgot_password()
        {
            $this->form_validation->set_rules('email', 'Email Address', 'required');
            if ($this->form_validation->run() == false) {
                //setup the input
                $data['title'] ='Forgot Password';
                $data['email'] = array('name' => 'email','id' => 'email');
                //set any errors and display the form
                $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
                $this->load->view('forgot-password-v', $data);
            }
            else {
                //run the forgotten password method to email an activation code to the user
                $forgotten = $this->ion_auth->forgotten_password($this->input->post('email'));

                if ($forgotten) { //if there were no errors
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    redirect(base_url('index.php/login')); //we should display a confirmation page here instead of the login page
                }
                else {
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                    redirect(base_url('index.php/login/forgot_password'));
                }
            }
        }
}
?>