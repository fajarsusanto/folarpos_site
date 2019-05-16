<?php

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function get_user_connect() {
        $this->load->library('user_agent');
        $this->load->library('Mobile_Detect');
        $data["bros"] = $this->agent->browser();
        $data["dev"] = ($this->agent->is_mobile() == TRUE ? "mobile" : "desktop");
        return json_encode($data);
    }

    public function is_visited($el) {
        if (!empty($el)) {
            $this->load->library('user_agent');
            $analysis['read_ip'] = $_SERVER['REMOTE_ADDR'];
            $analysis['ref_id'] = (!empty($el['content']) ? $el['content'] : null);
            $analysis['menu_id'] = $el['menu'];
            $analysis['read_date'] = date("Y-m-d H:i:s");
            $detect = new Mobile_Detect();
            $analysis["read_device"] = ($detect->isTablet() == TRUE ? "tablet" : $detect->isMobile() == TRUE ? "mobile":"desktop");
            if (!empty($analysis['ref_id'])) {
                $check_visitor = $this->db->query("select * from log_read where read_ip = '$analysis[read_ip]' and DATE(read_date)='" . date("Y-m-d", strtotime($analysis['read_date'])) . "' and ref_id = '$analysis[ref_id]' and menu_id = '$analysis[menu_id]'")->last_row();
            } else {
                $check_visitor = $this->db->query("select * from log_read where read_ip = '$analysis[read_ip]' and DATE(read_date)='" . date("Y-m-d", strtotime($analysis['read_date'])) . "' and menu_id = '$analysis[menu_id]' and menu_id is null")->last_row();
            }
            if (empty($check_visitor)) {
                $this->crud_model->insert_data("log_read", $analysis);
            }
        }
    }

    public function systems() {
        $data['app'] = $this->db->query("select * from apps limit 1")->last_row();
        $data['logged_check'] = is_logged_check();
        if ($data['logged_check'] == TRUE) {
            $data['users'] = $this->db->query("select * from md_users u where md5(u.users_id) = '" . $data['logged_check']['id'] . "'")->last_row();
        }
        return $data;
    }

    public function authentication_root() {
        if ($this->session->userdata(md5('habitat_access'))) {
            $data['general'] = $this->systems();
            $data['session'] = $this->session->userdata(md5('habitat_access'));
            $data['app'] = $this->db->query("select * from apps limit 1")->last_row();
            $data['users'] = $this->db->query("select * from md_users u where md5(u.users_id) = '" . $data['session']['id'] . "'")->last_row();
            return $data;
        } else {
            redirect("");
        }
    }

    public function send_mail($msg, $type) {
        if (!empty($msg)) {
            $this->load->library('email');
            $config['protocol'] = 'smtp';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['charset'] = 'iso-8859-1';
            $config['smtp_host'] = 'hunianid.com';
            $config['smtp_user'] = 'no-reply@hunianid.com ';
            $config['smtp_pass'] = '^WAm!F,y{?M#';
            $config['smtp_port'] = '465';
            $config['mailtype'] = 'html';
            $config['wordwrap'] = TRUE;

            $this->email->initialize($config);
            $this->email->from('no-reply@hunianid.com', 'HunianID (Subscribes)');
            $this->email->to($msg['to']);
            if (!empty($exe_incl['cc'])) {
                $this->email->cc($msg['cc']);
            }
            $this->email->subject($msg['title']);
            $this->email->message($msg['desc']);

            $kirim = $this->email->send();
//            $this->email->print_debugger();
//            exit();
            if ($kirim) {

                $histor['subs_id'] = $msg['subs_id'];
                $histor['subs_send_page'] = $msg['url_pages'];
                $histor['subs_send_date'] = date('Y-m-d H:i:s');

                $this->crud_model->insert_data("mg_subs_send", $histor);
            }
        }
    }

    public function mail_subs($el, $param = null, $mail = null) {
        $appdt = $this->systems();
        if ($el == 'contents') {
            $get_data = $this->db->query("select * from mg_content c "
                            . "join mod_menu m on m.menu_id = c.menu_id "
                            . "where c.content_id = $param")->last_row();
            $data['title'] = $get_data->content_title;
            $data['cont_title'] = $get_data->content_title;
            $data['cont_url'] = "$get_data->menu_url-detail/$get_data->content_url";
            $data['cont_desc'] = $get_data->content_desc;
            $data['cont_image'] = $get_data->content_img;
        } else if ($el == 'listing') {
            $get_data = $this->db->query("select *, cs.condition_name as sell_condition, cr.condition_name as rent_condition from mg_listing l "
                            . "join mg_prop_unit au on au.unit_id= l.unit_id join mg_properties a "
                            . "on a.prop_id = au.prop_id join md_location lc on lc.location_id = a.location_id "
                            . "join md_users u on u.users_id = l.users_id left join md_condition cs on cs.condition_id = l.list_sell_condition "
                            . "left join md_condition cr on cr.condition_id = l.list_rent_condition where l.list_id = '6'")->last_row();
            $data['title'] = $get_data->list_title;
            $data['cont_title'] = $get_data->list_title . " "
                    . "<sup><small style='font-size:12px'>( New Listing )</small></sup><hr style='margin:5px 0px 5px 0px; padding:0px'/><small style='font-size: 14px'><i>$get_data->prop_name - $get_data->location_name</i></small>";
            $data['cont_url'] = "apt-achieve/$get_data->prop_url/$get_data->list_url";
            $data['cont_desc'] = $get_data->list_desc;
            $data['cont_image'] = $get_data->list_header;
        } else if ($el == 'apartment') {
            $get_data = $this->db->query("select *, (select count(list_id) from mg_listing where prop_id = a.prop_id) as total_listing from mg_properties a "
                            . "join md_prop_status ast on ast.status_id = a.status_id "
                            . "join md_loc_area ar on ar.area_id = a.area_id join md_location l on l.location_id = ar.location_id where a.prop_id = '1'")->last_row();
            $data['title'] = $get_data->prop_name;
            $data['cont_title'] = $get_data->prop_name . " "
                    . "<sup><small style='font-size:12px'>( New Apartment )</small></sup><hr style='margin:5px 0px 5px 0px; padding:0px'/><small style='font-size: 14px'><i>Location : $get_data->location_name</i></small>";
            $data['cont_url'] = "apt-detail/$get_data->prop_url";
            $data['cont_desc'] = $get_data->prop_desc;
            $data['cont_image'] = $get_data->prop_header;
        }
        $msg_subs = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'
                . '<html xmlns="http://www.w3.org/1999/xhtml" style="background: #f6f6f6; color: #2c3e50; margin: 0; padding: 0;">'
                . '<head>'
                . '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>'
                . '<title>' . $data['title'] . '</title>'
                . '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>'
                . '</head>'
                . '<body style="background: #f6f6f6; color: #2c3e50; margin: 0; padding: 0;">'
                . '<table class="wrapper" style="background: #f6f6f6; border-spacing: 0; font-family:Source Sans Pro, Arial, Helvetica, sans-serif; width: 100%;">'
                . '<tr class="header" style="background: #00bbaa;">'
                . '<td colspan="3">'
                . '<table class="header__wrap" style="border-spacing: 0; margin: 0 auto; max-width: 600px; width: 600px;">'
                . '<tr>'
                . '<td style="width: 350px">'
                . '<p class="header__slogan" style="color: #fff; font-size: 13px; font-style: italic;">' . ucwords($appdt['app']->apps_slogan) . '</p>'
                . '</td>'
                . '<td class="header__social" style="text-align: right;">';
        if (!empty($appdt['app']->apps_fb)) {
            $msg_subs .= '<a href="' . $appdt['app']->apps_fb . '" class="header__link" style="color: #2c3e50; display: inline-block; margin: 5px 0 0 10px;">'
                    . '<img src="' . base_url('assets/img/social/icon-facebook.png') . '" alt="" style="max-width: 100%;"/>'
                    . '</a>';
        }
        if (!empty($appdt['app']->apps_twit)) {
            $msg_subs .= '<a href="' . $appdt['app']->apps_twit . '" class="header__link" style="color: #2c3e50; display: inline-block; margin: 5px 0 0 10px;">'
                    . '<img src="' . base_url('assets/img/social/icon-twitter.png') . '" alt="" style="max-width: 100%;"/>'
                    . '</a>';
        }
        $msg_subs .= '</td>'
                . '</tr>'
                . '</table>'
                . '</td>'
                . '</tr>'
                . '<tr class="main">'
                . '<td colspan="3">'
                . '<a href="' . base_url() . '" class="logo" style="background: url(' . base_url($appdt['app']->apps_logo) . '); color: #2c3e50; display: block; margin: 30px auto 20px; width: 254px;">'
                . '<img src="' . base_url($appdt['app']->apps_logo) . '" alt="" style="max-width: 100%;"/>'
                . '</a>'
                . '<table class="body" style="background: #fff; border-spacing: 0; margin: 0 auto; max-width: 600px;">'
                . '<tr>'
                . '<td colspan="3">'
                . '<img src="' . base_url($data['cont_image']) . '" alt="" style="max-width: 100%;"/>'
                . '</td>'
                . '</tr>'
                . '<tr>'
                . '<td></td>'
                . '<td>'
                . '<table class="content" style="border-spacing: 0; margin: 0 auto; max-width: 500px;">'
                . '<tr>'
                . '<td>'
                . '<h1 style="color: #2c3e50; font-size: 26px;">' . $data['cont_title'] . '</h1>'
                . '<p style="color: #2c3e50; font-size: 14px;">' . $data['cont_desc'] . '</p>'
                . '<p style="color: #2c3e50; font-size: 15px; text-align: center;"><a href="' . base_url($data['cont_url']) . '" class="btn-link" style="background: #f3bc65; background-image: none; border: none; border-bottom: 4px solid #d99221; color: #222222; cursor: pointer; display: inline-block; font-weight: bold; line-height: 35px; margin-bottom: 0; padding-left: 10px; padding-right: 10px; text-align: center; text-decoration: none; text-transform: uppercase; vertical-align: middle; white-space: nowrap; width: 210px;">See more details</a></p>'
                . '<p style="color: #2c3e50; font-size: 15px; text-align: center;">On our site</p>'
                . '<p style="color: #2c3e50; font-size: 15px;">Thanks,<br>' . ucwords($appdt['app']->apps_company) . '</p>'
                . '</td>'
                . '</tr>'
                . '</table>'
                . '</td>'
                . '<td></td>'
                . '</tr>'
                . '</table>'
                . '</td>'
                . '</tr>'
                . '<tr class="footer" style="color: #2c3e50; font-size: 15px; text-align: center;">'
                . '<td colspan="3">'
                . '<p>'
                . 'Please do not reply directly to this email. You can reach us by sending message to'
                . '<br/>'
                . '<a href="mailto:' . strtolower($appdt['app']->apps_mail) . '" style="color: #2c3e50; text-decoration: none;">' . strtolower($appdt['app']->apps_mail) . '</a>'
                . '<br/>'
                . '</p>'
                . '</td>'
                . '</tr>'
                . '</table>'
                . '</body>'
                . '</html>';
        return $msg_subs;
    }

}
