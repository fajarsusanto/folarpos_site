<?php

class Account extends MY_Controller {

    private $title = "Account";
    private $header = "Account";
    private $url = "dash-v/my-profile";

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model('profile_m');
    }

    function index($ft = null) {
        $data['sess'] = $this->authentication_root();
        $data['title'] = $this->title;
        $data['url'] = $this->url;
        if ($ft == 'content') {
            $this->load->view("settings/account/account_content", $data);
        } else if ($ft == 'form') {
            $this->load->view("settings/account/account_form", $data);
        } else {
            $data['acc_s'] = 'active';
            $data['profile_sm'] = 'active';
            $data['content'] = "settings/account/account_index";
            $this->load->view("../manage/index", $data);
        }
    }

    function save() {
        $session = $this->authentication_root();
        $this->form_validation->set_rules('fullname', 'Fullname', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('phone', 'Handphone', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-warning mg-r-sm'></i>Nama, No. Handphone & Email can't empty ! !</div>"));
        } else {
            $data['users_id'] = $session['users']->users_id;
            $data['users_mail'] = strtolower($_POST['email']);
            $data['users_phone'] = $this->input->post('phone', TRUE);
            $data['users_fullname'] = $this->input->post('fullname', TRUE);
            if (!empty($this->input->post('password'))) {
                $this->save_password($data['users_id']);
            }
            $this->crud_model->update_data('md_users', $data, 'users_id');
            $pesan = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-check mg-r-sm"></i>Profil successfully updating ! !</div>';
            echo json_encode(array('status' => 1, 'msg' => $pesan));
        }
    }

    function save_password($id) {
        $session = $this->authentication_root();
        $this->form_validation->set_rules('password', 'Password Lama', 'required');
        $this->form_validation->set_rules('new', 'Password Baru', 'required');
        if ($this->form_validation->run() == FALSE) {
          echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-warning mg-r-sm'></i>Password can't empty ! !</div>"));
        } else {
        $count = $this->profile_m->check($session['users']->users_id, md5($_POST['password']));
        if ($count->num_rows() == 0) {
            //$usr = $count->row();
            $data['users_password'] = md5($_POST['password']);
            $data['users_id'] = $id; //$usr->users_id;
            $this->crud_model->update_data('md_users', $data, 'users_id');
            $this->session->set_flashdata('msgpass', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-check mg-r-sm"></i>Password successfully updating ! !</div>');
            echo json_encode(array('status' => 1));
        } else {
            echo json_encode(array('status' => 0, 'msg' => '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-warning mg-r-sm"></i>Please check the password you entered !</div>'));
        }
        }
    }

    function photo() {
        if (!empty($_POST['photo'])) {
            $data['sess'] = $this->authentication_root();
            if (file_exists($data['sess']['users']->users_photo)) :
                unlink($data['sess']['users']->users_photo);
            endif;
            $path = 'assets-ds/photo-pict';
            $img = str_replace('data:image/png;base64,', '', $_POST['photo']);
            $img = str_replace('data:image/jpeg;base64,', '', $img);
            $img = str_replace('data:image/jpg;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data_upload = base64_decode($img);
            $img_upload = $path . "/" . strtolower($data['sess']['users']->users_usersname) . "-" . uniqid() . ".jpg";
            file_put_contents($img_upload, $data_upload);
            $save_data['users_photo'] = $img_upload;
            $save_data['users_id'] = $data['sess']['users']->users_id;
            $this->crud_model->update_data('md_users', $save_data, 'users_id');
            echo json_encode(array('status' => 1));
        }else {
            echo json_encode(array('status' => 0));
        }
    }

}

?>