<?php

class Login extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('facebook');
        isnot_logged_in();
    }

    public function index() {
        $data['apps'] = $this->systems();
        $data['m_actived'] = 1;
        $data['title'] = "AUTHGATE";
        $data['top_direct'] = 'dashboard';
        $data['header'] = "hunianid/header/header_home";
        $data['content'] = "hunianid/sign_in";
        $this->load->view("../hunianid/index", $data);
    }

    public function signup() {
        $data['apps'] = $this->systems();
        
        $data['authUrl'] = $this->facebook->login_url();
        $data['m_actived'] = 1;
        $data['title'] = "REGISTER";
        $data['menu'] = "frontend/menu/menu_nonhome";
        $data['header'] = "frontend/header/header_auth_desk";
        $data['content'] = "frontend/sign_up";
        $this->load->view("../frontend/index", $data);
    }

    public function reset() {
        $data['apps'] = $this->systems();
        $data['m_actived'] = 1;
        $data['title'] = "AUTHGATE";
        $data['top_direct'] = 'dashboard';
        $data['header'] = "hunianid/header/header_home";
        $data['content'] = "hunianid/reset_password";
        $this->load->view("../hunianid/index", $data);
    }
    
    public function logout() {
        $this->session->sess_destroy();
        //redirect();
        redirect('Home');
    }

}
