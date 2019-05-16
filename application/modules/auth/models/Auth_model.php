<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function login($name, $password) {
        $password_ = md5($password);
        $this->db->where('users_mail = "'.$name.'"');
        $this->db->where('users_password', $password_);
        $query = $this->db->get('md_users');        
        return $query;        
    }

    public function loginmail($mail) {

        $this->db->where('u.users_mail', $mail);
        $this->db->join("md_roles r", "r.roles_id = u.roles_id");
        $query = $this->db->get('md_users u');
        if ($query->num_rows() == 1) {

            $users_actived = $query->last_row();
            if ($users_actived->users_status == 2) {
                if (isset($_SESSION['loginsek']) == 'kuduliwatikisek') {
                    $data['id'] = md5($users_actived->users_id);
                    $data['level_id'] = $users_actived->roles_id;
                    $data['logged_in'] = TRUE;
                    $this->session->set_userdata(md5('habitat_access'), $data);
                    redirect($users_actived->roles_direct, 'refresh');
                } else {
                    $this->session->unset_userdata('loginsek');
                    $this->session->set_userdata('loginsek', 'kuduliwatikisek');
                    $this->session->set_flashdata("mailm", '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mg-r-md"></i>Akun Anda Telah terdaftar, silakan melakukan login</div>');
                    redirect('login', 'refresh');
                }
            } else if ($users_actived->users_status == 1) {
                $this->session->set_userdata("mail", '<div class="alert alert-danger alert-dismissable">Please contact administrator to activation your account</div>');
            } else if ($users_actived->users_status == 3) {
                $this->session->set_userdata("mail", '<div class="alert alert-danger alert-dismissable">Your account is suspended !</div>');
            }
        } else {
            $this->session->set_userdata("mail", '<div class="alert alert-danger alert-dismissable">Your account not valid !</div>');
        }
    }

    public function isLoggedIn() {

        $is_logged_in = $this->session->userdata('logged_in');

        if (!isset($is_logged_in) || $is_logged_in !== TRUE) {
            redirect('/');
            exit;
        }
    }

    public function isLoggedInnoFB() {

        $is_logged_infb = $this->session->userdata('logged_in');
    }

    function user_log($user, $action) {
        $data = array(
            'users_id' => $user,
            'users_log_date' => date("Y-m-d H:i:s"),
            'users_log_ip' => $_SERVER['REMOTE_ADDR'],
            'users_log_act' => $action
        );
        $this->db->insert('users_log', $data);
    }

    public function ForgotPassword($email) {
        $this->db->select('users_mail');
        $this->db->from('md_users');
        $this->db->where('users_mail', $email);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function sendpassword($data) {
        $email = $data['users_mail'];
        $from_email = 'no-reply@hunianid.com '; // ganti dengan email kalian
        $query1 = $this->db->query("SELECT *  from md_users where users_mail = '" . $email . "' ");
        $row = $query1->result_array();
        if ($query1->num_rows() > 0) {
            $passwordplain = "";
            $passwordplain = rand(999999999, 9999999999);
            $newpass['users_password'] = md5($passwordplain);
            $mail_message = '<html style="font-family:  Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                    <head>
                    <meta name="viewport" content="width=device-width" />
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <title>Reset Password HunianID</title>
                    <style type="text/css">
                    img {
                    max-width: 100%;
                    }
                    body {
                    -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em;
                    }
                    body {
                    background-color: #f6f6f6;
                    }
                    @media only screen and (max-width: 640px) {
                      body {
                        padding: 0 !important;
                      }
                      h1 {
                        font-weight: 800 !important; margin: 20px 0 5px !important;
                      }
                      h2 {
                        font-weight: 800 !important; margin: 20px 0 5px !important;
                      }
                      h3 {
                        font-weight: 800 !important; margin: 20px 0 5px !important;
                      }
                      h4 {
                        font-weight: 800 !important; margin: 20px 0 5px !important;
                      }
                      h1 {
                        font-size: 22px !important;
                      }
                      h2 {
                        font-size: 18px !important;
                      }
                      h3 {
                        font-size: 16px !important;
                      }
                      .container {
                        padding: 0 !important; width: 100% !important;
                      }
                      .content {
                        padding: 0 !important;
                      }
                      .content-wrap {
                        padding: 10px !important;
                      }
                      .invoice {
                        width: 100% !important;
                      }
                    }
                    </style>
                    </head>

                    <body style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">

                    <table class="body-wrap" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6"><tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
                                    <td class="container" width="600" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top">
                                            <div class="content" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
                                                    <table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope itemtype="http://schema.org/ConfirmAction" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" bgcolor="#fff"><tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-wrap" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;" valign="top">
                                                                            <meta itemprop="name" content="Confirm Email" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;" /><table width="100%" cellpadding="0" cellspacing="0" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                                                                                    Dear ' . ucwords($row[0]['users_fullname']) . ' Pembaruan Password berhasil dilakukan, silahkan login dengan password dibawah ini.
                                                                                            </td>
                                                                                    </tr><tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                                                                                    <b>' . $passwordplain . '</b>
                                                                                            </td>
                                                                                    </tr><tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                                                                                    &mdash; FolarPOS
                                                                                            </td>
                                                                                    </tr></table></td>
                                                            </tr></table><div class="footer" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;">
                                                            <table width="100%" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="aligncenter content-block" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top">Follow <a href="" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; color: #999; text-decoration: underline; margin: 0;">@folarpos</a> on Intagram.</td>
                                                                    </tr></table></div></div>
                                    </td>
                                    <td style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
                            </tr></table></body>
                    </html>';
            $config['smtp_host'] = 'folarpos.co.id'; // sesuaikan dengan host email
            $config['smtp_timeout'] = '7';
            $config['smtp_port'] = '465'; // sesuaikan
            $config['smtp_user'] = 'support@folarpos.co.id';
            $config['smtp_pass'] = 'suport3838'; // ganti dengan password email
            $config['mailtype'] = 'html';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $config['newline'] = "\r\n";
            $config['crlf'] = "\r\n";
            $this->email->initialize($config);

            $this->email->from($from_email, 'FolarPOS - Forgot Password');
            $this->email->to($email);
            $this->email->subject("Forgot Password");
            $this->email->message($mail_message);
            if (!$this->email->send()) {
                $this->session->set_flashdata('sendpsfail', 'Failed to send password, please try again!');
            } else {
                $this->db->where('users_mail', $email);
                $this->db->update('md_users', $newpass);
                $this->session->set_flashdata('sendpasuc', 'Password sent to your email!');
            }
            redirect(base_url() . '', 'refresh');
        } else {
            $this->session->set_flashdata('emailnf', 'Email not found try again!');
            redirect(base_url() . '', 'refresh');
        }
    }

    public function _simpanUser($data) {
        $do = $this->crud_model->insert_data('md_users', $data);
        return $do;
    }

    public function cek_usersstat($dt) {
        $cek = $this->db->query("select * from md_users where ( users_mail = '" . $dt['users_mail'] . "')")->num_rows();
        return $cek;
    }

    public function sendMail($email, $username) {

        $from_email = 'no-reply@hunianid.com '; // ganti dengan email kalian
        $subject = 'Verify Your Email Address';
        $message = '<html style="font-family:  Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                    <head>
                    <meta name="viewport" content="width=device-width" />
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <title>Registration HunianID</title>
                    <style type="text/css">
                    img {
                    max-width: 100%;
                    }
                    body {
                    -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em;
                    }
                    body {
                    background-color: #f6f6f6;
                    }
                    @media only screen and (max-width: 640px) {
                      body {
                        padding: 0 !important;
                      }
                      h1 {
                        font-weight: 800 !important; margin: 20px 0 5px !important;
                      }
                      h2 {
                        font-weight: 800 !important; margin: 20px 0 5px !important;
                      }
                      h3 {
                        font-weight: 800 !important; margin: 20px 0 5px !important;
                      }
                      h4 {
                        font-weight: 800 !important; margin: 20px 0 5px !important;
                      }
                      h1 {
                        font-size: 22px !important;
                      }
                      h2 {
                        font-size: 18px !important;
                      }
                      h3 {
                        font-size: 16px !important;
                      }
                      .container {
                        padding: 0 !important; width: 100% !important;
                      }
                      .content {
                        padding: 0 !important;
                      }
                      .content-wrap {
                        padding: 10px !important;
                      }
                      .invoice {
                        width: 100% !important;
                      }
                    }
                    </style>
                    </head>

                    <body style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">

                    <table class="body-wrap" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6"><tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
                                    <td class="container" width="600" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top">
                                            <div class="content" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
                                                    <table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" bgcolor="#fff"><tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-wrap" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;" valign="top">
                                                                            <meta itemprop="name" content="Confirm Email" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;" /><table width="100%" cellpadding="0" cellspacing="0" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                                                                                    Dear ' . ucwords($username) . ' Please confirm your email address by clicking the link below.
                                                                                            </td>
                                                                                    </tr><tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                                                                                    We may need to send you critical information about our service and it is important that we have an accurate email address.
                                                                                            </td>
                                                                                    </tr><tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" itemprop="handler" itemscope style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                                                                                    <a href="http://' . $_SERVER['HTTP_HOST'] . '/auth/verify/' . md5($email) . '" class="btn-primary" itemprop="url" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #348eda; margin: 0; border-color: #348eda; border-style: solid; border-width: 10px 20px;">Confirm email address</a>
                                                                                            </td>
                                                                                    </tr><tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                                                                                    &mdash; FolarPOS
                                                                                            </td>
                                                                                    </tr></table></td>
                                                            </tr></table><div class="footer" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;">
                                                            <table width="100%" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="aligncenter content-block" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top">Follow <a href="" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; color: #999; text-decoration: underline; margin: 0;">@folarpos</a> on Intagram.</td>
                                                                    </tr></table></div></div>
                                    </td>
                                    <td style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
                            </tr></table></body>
                    </html>';


        $config['smtp_host'] = 'folarpos.co.id'; // sesuaikan dengan host email
        $config['smtp_timeout'] = '7';
        $config['smtp_port'] = '465'; // sesuaikan
        $config['smtp_user'] = 'support@folarpos.co.id';
        $config['smtp_pass'] = 'suport3838'; // ganti dengan password email
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n";
        $config['crlf'] = "\r\n";
        $this->email->initialize($config);

        $this->email->from($from_email, 'HunianID - Verify');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);
        // gunakan return untuk mengembalikan nilai yang akan selanjutnya diproses ke verifikasi email
        return $this->email->send();
    }

    public function verify($key) {
        // nilai dari status yang berawal dari Tidak Aktif akan diubah menjadi Aktif disini
        $data = array('users_status' => "2");
        $this->db->where('md5(users_mail)', $key);
        return $this->db->update('md_users', $data);
    }

}
