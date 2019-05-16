<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Privacy extends MY_Controller {

    private $url_index = "dash-manage/mg-privacy";
    private $title_param = "Privacy";

    public function __construct() {
        parent::__construct();
        is_logged_in();
    }

    public function index() {
        $data['sess'] = $this->authentication_root();
        $data['title'] = "Manage $this->title_param";
        $data['priv_sm'] = "active";
        $data['url_index'] = $this->url_index;
        $data['tit_param'] = $this->title_param;
        $data['content'] = "mg_privacy/privacy_index";
        $this->load->view("../manage/index", $data);
    }

    public function form() {
        $data['sess'] = $this->authentication_root();
        $data['url_index'] = $this->url_index;
        $data['act'] = "EDIT";
        $data['tit_param'] = $this->title_param;
        $this->load->view("privacy_form", $data);
    }

    public function save() {
        $sess = $this->authentication_root();
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->form_validation->set_rules('apps_privacy', '', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('status' => 0, 'msg' => '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> Data ' . $this->title_param . ' can not empty !</div>'));
        } else {
            $data['apps_id'] = $sess['app']->apps_id;
            $data['apps_privacy'] = $this->input->post('apps_privacy'); 
            $this->crud_model->update_data("apps", $data, 'apps_id');
            echo json_encode(array('status' => 1, 'msg' => '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> Data ' . $this->title_param . ' success save !</div>'));
        }        
    }

}
