<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Auth extends MY_Controller {

    private $title = " Administrator";

    public function __construct() {
        parent::__construct();
        $this->load->library('facebook');
        $this->load->Model('Auth_model');
        $this->load->Model('Crud_model');
        $this->load->library('email');        
        $this->load->library('Recaptcha');
        $this->load->helper('download');
    }

    public function login() {
        $username_ = $this->input->post('email', true);
        $password_ = $this->input->post('password', true);
        
        $recaptcha = $this->input->post('g-recaptcha-response');
        $response = $this->recaptcha->verifyResponse($recaptcha);

        if ((!isset($response['success']) || $response['success'] <> true)) {
            $this->session->set_flashdata('login', '<div class="col-xs-12"><div id="danger-alert" class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mg-r-md"></i>Ulangi Recaptcha </div></div>');
            redirect();
        } else {
            $query = $this->Auth_model->login($username_, $password_);
            if ($query->num_rows() == 1) {
                $users_actived = $query->last_row();
                if ($users_actived->users_status == 2) {
                    $data['id'] = md5($users_actived->users_id);
                    $data['logged_in'] = TRUE;
                    $this->session->set_userdata(md5('habitat_access'), $data);
                    redirect('dashboard');
                } else if ($users_actived->users_status == 1) {
                    $this->session->set_flashdata('login', '<div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mg-r-md"></i>Account anda belum diaktivasi </div></div>');
                    redirect();
                } else if ($users_actived->users_status == 3) {
                    $this->session->set_flashdata('login', '<div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mg-r-md"></i>Account anda diberhentikan </div></div>');
                    redirect();
                }
            } else {
                $this->session->set_flashdata('login', '<div class="col-xs-12"><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mg-r-md"></i>Account tidak ditemukan, periksa username dan password anda </div></div>');
                redirect();
            }            
        }        
    }

    public function loginmail($mail) {
        $username_ = $this->input->post('user_username', true);
        $password_ = $this->input->post('user_password', true);
        //call the model for auth
        $this->Auth_model->loginmail($mail);
    }

    public function logout() {
        $this->session->sess_destroy();
        //redirect();
        redirect('Home');
    }

    public function dashboard() {
        $this->Auth_model->isLoggedIn();
        $data['title_page'] = $this->title;
        $data['system'] = $this->crud_model->read_fordata(array("table" => "setting", "where" => array("setting_id" => 1)))->last_row();
        $this->load->view('auth/dashboard', $data);
    }

    public function ForgotPassword() {
        $email = $this->input->post('email');
        $findemail = $this->Auth_model->ForgotPassword($email);
        
        $recaptcha = $this->input->post('g-recaptcha-response');
        $response = $this->recaptcha->verifyResponse($recaptcha);

        if ((!isset($response['success']) || $response['success'] <> true)) {
            redirect();
        } else {
            if ($findemail) {
                $this->Auth_model->sendpassword($findemail);
                $this->session->set_flashdata('login', '<div class="col-sm-12"><div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mg-r-md"></i>Password berhasil direset, silahkan periksa pesan masuk atau spam email Anda untuk mendapatkan password baru</div></div>');
                redirect();
            } else {
                $this->session->set_flashdata('login', '<div class="col-sm-12"><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mg-r-md"></i>Email tidak ditemukan</div></div>');
                redirect();
            }
        }
        
    }

    public function Registration() {
        if ($this->input->post('password') != $this->input->post('password2')) {
            $this->session->set_flashdata('register', '<div class="col-sm-12"><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mg-r-md"></i>Password tidak sama </div></div>');
            redirect('login');
        }
        $data = array(
            'users_mail' => strtolower(trim($this->input->post('email'))),
            'users_fullname' => strtolower(trim($this->input->post('fullname', true))),
            'users_status' => 1,
            'users_registered' => date("Y-m-d H:i:s"),
            'users_password' => md5(trim($this->input->post('password')))
        );
        
        if (!empty($_SESSION['datafb'])) {
            $data['facebook_id'] = $_SESSION['datafb']['efbiid']; 
            $data['users_status'] = 2;
        } else {
           $data['users_status'] = 1; 
        }
        $cek = $this->Auth_model->cek_usersstat($data);
        if ($cek == 0) {
            $this->Auth_model->_simpanUser($data);
            
            $this->facebook->destroy_session();
            $this->session->unset_userdata('datafb');
                  
            if ($this->Auth_model->sendMail($this->input->post('email'), $this->input->post('fullname'))) {
                $this->session->set_flashdata('sukses', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mg-r-md"></i>Anda berhasil melakukan registrasi, silahkan periksa pesan masuk atau spam email Anda untuk mengaktifkan akun yang baru Anda buat</div>');
                
                redirect('login');
            } else {
                                
                $this->session->set_flashdata('sukses', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mg-r-md"></i>Terjadi kesalahan dalam melakukan registrasi, silahkan coba lagi!</div>');
                redirect('home');
            }
        }
    }

    public function verify($hash = NULL) {
        if ($this->Auth_model->verify($hash)) {
            $this->session->set_flashdata('login', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mg-r-md"></i>Email berhasil diverifikasi</div>');
            redirect('home');
        } else {
            $this->session->set_flashdata('login', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mg-r-md"></i>Email gagal diverifikasi</div>');
            redirect('home');
        }
    }

}
