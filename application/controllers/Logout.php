<?php

class Logout extends MY_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->library('facebook');
	$this->load->model('user');
    }

    public function index() {
        $this->session->sess_destroy();
        $this->session->unset_userdata(md5('habitat_access'));
        
        $this->facebook->destroy_session();
        $this->session->unset_userdata('userData');
        
        redirect('');
    }

}
