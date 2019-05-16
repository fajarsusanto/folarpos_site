<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Apps extends MY_Controller {

    private $title = "Setting System";
    private $header = "Profile System";
    private $url_index = "dash-v/apps";

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model('apps_m');
    }

    function index($ft = null) {
        $data['sess'] = $this->authentication_root();
        $data['title'] = $this->title;
        $data['url_index'] = $this->url_index;
        if ($ft == 'data') {
            $this->load->view("settings/apps/apps_data", $data);
        } else {
            $data['acc_s'] = 'active';
            $data['set_sm'] = 'active';

            $data['content'] = "settings/apps/apps_index";
            $data['js_load'] = "extend/js_fancybox";
            $this->load->view("../manage/index", $data);
        }
    }
    
    function upload($param = null) {
        $data['sess'] = $this->authentication_root();
        $data['url_index'] = $this->url_index;
        
        $this->load->view("apps/upload_catalog", $data);
    }
    
    public function save_upload() {
        $sess = $this->authentication_root();
        $id = $this->input->post("id");
            $this->load->helper(array('form', 'url'));
            $config['upload_path'] = './assets/catalog/';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 0;
            $config['file_name'] = url_title($this->input->post('userfile')); //nama gambar

            $this->upload->initialize($config);

            if (!$this->upload->do_upload()) {
                $err = $this->upload->display_errors();
                $this->session->set_flashdata('msgsys', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> ' . $err . '</div>');
                redirect('dash-v/apps-profile');
            } else {
                $file = $this->upload->file_name;
                $data['apps_id'] = $id;
                $data['apps_catalog'] = 'assets/catalog/' . $file;
                $this->crud_model->update_data("apps", $data, 'apps_id');
                $this->session->set_flashdata('msgsys', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> Data has been uploaded </div>');
                redirect('dash-v/apps-profile');
            }
    }

    function save() {
        $session = $this->authentication_root();
        $this->form_validation->set_rules('apps_name', 'Apps Name', 'required');
        $this->form_validation->set_rules('apps_phone', 'Telephone', 'required');
        $this->form_validation->set_rules('apps_mail', 'Mail', 'required');
        $this->form_validation->set_rules('apps_address', 'Address', 'required');
        $this->form_validation->set_rules('bg', 'Background', 'required');
        $this->form_validation->set_rules('logo', 'Logo', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('status' => 0, 'msg' => "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='fa fa-warning mg-r-sm'></i>Data with ( * ) can't empty !</div>"));
        } else {
            $data['apps_id'] = $session['app']->apps_id;
            $data['apps_name'] = $this->input->post('apps_name', TRUE);
            $data['apps_head'] = $this->input->post('apps_head', TRUE);
            $data['apps_caption'] = $this->input->post('apps_caption', TRUE);
            $data['apps_meta_keyword'] = $this->input->post('apps_meta_keyword', TRUE);
            $data['apps_meta_description'] = $this->input->post('apps_meta_description', TRUE);
            $data['apps_catalog'] = $this->input->post('apps_catalog', TRUE);
            $data['apps_address'] = $this->input->post('apps_address', TRUE);
            $data['apps_phone'] = $this->input->post('apps_phone', TRUE);
            $data['apps_keyword'] = $this->input->post('apps_keyword', TRUE);
            $data['apps_fb'] = $this->input->post('apps_fb', TRUE);
            $data['apps_ig'] = $this->input->post('apps_ig', TRUE);
            $data['apps_ln'] = $this->input->post('apps_ln', TRUE);
            $data['apps_youtube'] = $this->input->post('apps_youtube', TRUE);
            $data['apps_mail'] = $_POST['apps_mail'];
            $path = 'assets-ds';
            if (!empty($_POST['bg'])) {
                $img_bg = str_replace('data:image/png;base64,', '', $_POST['bg']);
                $img_bg = str_replace('data:image/jpeg;base64,', '', $img_bg);
                $img_bg = str_replace('data:image/jpg;base64,', '', $img_bg);
                $img_bg = str_replace(' ', '+', $img_bg);
                $img_upload_bg = $path . "/bg-" . uniqid() . ".jpg";
                file_put_contents($img_upload_bg, base64_decode($img_bg));
                $data['apps_bg'] = $img_upload_bg;
                if (!empty($session['app']->apps_bg)) {
                    $this->crud_model->unlink($session['app']->apps_bg);
                }
            }
            if (!empty($_POST['logo'])) {
                $img_logo = str_replace('data:image/png;base64,', '', $_POST['logo']);
                $img_logo = str_replace('data:image/jpeg;base64,', '', $img_logo);
                $img_logo = str_replace('data:image/jpg;base64,', '', $img_logo);
                $img_logo = str_replace(' ', '+', $img_logo);
                $img_upload_logo = $path . "/apps-" . uniqid() . ".png";
                file_put_contents($img_upload_logo, base64_decode($img_logo));
                $data['apps_logo'] = $img_upload_logo;
                if (!empty($session['app']->apps_logo)) {
                    $this->crud_model->unlink($session['app']->apps_logo);
                }
            }
            $this->crud_model->update_data('apps', $data, 'apps_id');
            $this->session->set_flashdata('msgsys', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-check mg-r-sm"></i>Profil successfully updating !</div>');
            echo json_encode(array('status' => 1));
        }
    }

    public function backup_apps() {
        $sess = $this->authentication_root();
        $this->load->dbutil();
        $backup = & $this->dbutil->backup();
        $this->load->helper('file');
        $now = date("d-m-Y H_i_s");
        write_file("z-database/ $now.zip", $backup);
        $this->load->helper('download');
        force_download("FORCE-DB " . $sess['system']->apps_name . " $now.zip", $backup);
    }

    public function signature($feature = null) {
        $data['sess'] = $this->authentication_root();
        if ($feature == 'save') {
            $head_id = $this->input->post('signature_id');
            $users_id = $this->input->post('users_id');
            for ($x = 0; $x < count($head_id); $x++) {
                $dt[$x]['signature_id'] = $head_id[$x];
                $dt[$x]['users_id'] = $users_id[$x];
                $this->crud_model->update_data("cf_signature", $dt[$x], "signature_id");
            }
            echo json_encode(array('status' => 1));
        } else {
            $data['head'] = $this->db->query("select * from cf_signature")->result();
            $data['pegawai'] = $this->db->query("select * from md_users")->result();
            $this->load->view("settings/apps/apps_signature", $data);
        }
    }

    public function set_interval($feature = null) {
        $data['sess'] = $this->authentication_root();
        if ($feature == 'save') {
            $dt['apps_interval'] = $this->input->post('apps_interval');
            $dt['apps_id'] = $data['sess']['app']->apps_id;
            $this->crud_model->update_data("apps", $dt, "apps_id");
            echo json_encode(array('status' => 1));
        } else {
            $this->load->view("settings/apps/apps_reminder", $data);
        }
    }

    public function ruless($feature = null) {
        $data['sess'] = $this->authentication_root();
        if ($feature == 'save') {
            $dt['rules_desc'] = $this->input->post('desc');
            $dt['rules_id'] = $this->input->post('rules_id');
            $this->crud_model->update_data("apps_rules", $dt, "rules_id");
            $this->session->set_flashdata('msgapps', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-check mg-r-sm"></i>Rules successfully updating!</div>');
            echo json_encode(array('status' => 1));
        } else {
            if (!empty($_GET)) {
                if (!empty($_GET['el'])) {
                    $data['apps'] = $this->db->query("select * from apps_rules where md5(rules_id) = '$_GET[el]'")->last_row();
                }
            }
            $data['rules'] = $this->db->query("select * from apps_rules order by rules_id")->result();
            $this->load->view("settings/apps/apps_rules", $data);
        }
    }

    public function folarium() {
        $data['sess'] = $this->authentication_root();
        $this->load->view("settings/apps/about", $data);
    }

    public function load_row_notif() {     //fungsi load_row untuk menampilkan jlh data pada navbar secara realtime
        $total = 0;
        $sess = $this->authentication_root();
        $datas = $this->apps_m->getnotifikasi(); //jumlah data akan langsung di tampilkan
        if (count($datas) > 0) {
            foreach ($datas as $rdata) {
                if ($rdata->status_read == 0) {
                    $total += 1;
                }
            }
        }
        echo $total;
    }

    public function load_data_notif() {    //fungsi load_data untuk menampilkan isi data pada navbar secara realtime
        $sess = $this->authentication_root();
        $uid = $sess['users']->users_id;
        $datas = $this->apps_m->getnotifikasi($uid);
        $no = 0;
        $not = 0;
        if (count($datas) > 0) {
            foreach ($datas as $rdata) {
                $no++;
                if ($rdata->status_read == 0) {
                    if ($no % 2 == 0) {
                        $strip = 'strip1';
                    } else {
                        $strip = 'strip2';
                    }
                    echo '<div class="sl-item">
                                <a href="' . base_url() . 'dash-v/notif/read/' . $rdata->apps_notif . '">
                                    <div class="icon bg-dark">
                                        <i class="zmdi zmdi-green"></i>
                                    </div>
                                    <div class="sl-content">
                                        <span class="inline-block capitalize-font  pull-left truncate head-notifications">
                                            '. $rdata->maint_complaint .'</span>
                                        <span class="inline-block font-11  pull-right notifications-time">'. timeAgo($rdata->notif_date) .'</span>
                                        <div class="clearfix"></div>
                                        <p class="truncate">&nbsp;</p>
                                    </div>
                                </a>	
                            </div>
                            <hr class="light-grey-hr ma-0"/>';
                   
                } else {
                    $not++;
                }
            }
//        if (count($datas) == 5) {
//            echo"<li><a href=".base_url().'dash-v/notif/all/'." class=\"\"><i>Show All Notification</i><br>
//            <small></small>
//            </a></li>";
//        }
        }
        if ($not > 0) {
//            echo"<li><a href='#' class=\"\"><i>Not Available</i><br>
//            <small></small>
//            </a></li>";
            echo '<div class="sl-item">
                                <a href="javascript:void(0)">
                                    <div class="icon bg-dark">
                                        <i class="zmdi zmdi-flag"></i>
                                    </div>
                                    <div class="sl-content">
                                        <span class="inline-block capitalize-font  pull-left truncate head-notifications">
                                            Not Available!</span>
                                        <span class="inline-block font-11  pull-right notifications-time">&nbsp;</span>
                                        <div class="clearfix"></div>
                                        <p class="truncate">&nbsp;</p>
                                    </div>
                                </a>	
                            </div>
                            <hr class="light-grey-hr ma-0"/>';
        }
    }

    public function read_data_notif($nid = null) {    //fungsi load_data untuk menampilkan isi data pada navbar secara realtime
        $sess = $this->authentication_root();
        $data['apps_notif'] = $nid;
        $data['apps_read_date'] = date("Y-m-d H:i:s");
        $this->crud_model->insert_data('apps_notif_read', $data);
        redirect($_SERVER['HTTP_REFERER']);
    }

}
