<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Users extends MY_Controller {

    private $url_index = "dash-master/users-master";
    private $url_index_position = "dash-master/position-master";
    private $title_param = "Users";

    public function __construct() {
        parent::__construct();
        is_logged_in();
    }

    public function index($el = null, $sort = null) {
        $data['sess'] = $this->authentication_root();
        $data['title'] = "Master $this->title_param";
        $data['usr_sm'] = "active";
        $data['url_index'] = $this->url_index;
        $data['url_index_position'] = $this->url_index_position;
        $data['tit_param'] = $this->title_param;
        if (!empty($el)) {
            $sql_where = (!empty($sort) ? ($sort != "all" ? " AND s.users_fullname like '%" . (str_replace("-", " ", $sort)) . "%' " : null) : null);
            $jml = $this->db->query("select * FROM md_users s where s.users_id is not NULL $sql_where");
            $per = 10;
            $data['count_usr'] = $jml->num_rows();
            $config['total_rows'] = $jml->num_rows();
            $config['per_page'] = $per; /* Jumlah data yang dipanggil perhalaman */
            $config['uri_segment'] = 5;
            $config['full_tag_open'] = "<ul class='pagination pagination-sm' style='position:relative; top:-25px;'>";
            $config['full_tag_close'] = "</ul>";
            $config['num_tag_open'] = '<li class="paging-load">';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = "<li class='disabled'><li  class='active'>";
            $config['cur_tag_close'] = "</li>";
            $config['next_tag_open'] = "<li >";
            $config['next_tagl_close'] = "</li>";
            $config['prev_tag_open'] = "<li >";
            $config['prev_tagl_close'] = "</li>";
            $config['first_tag_open'] = "<li>";
            $config['first_tagl_close'] = "</li>";
            $config['last_tag_open'] = "<li>";
            $config['last_tagl_close'] = "</li>";

            $config['base_url'] = "javascript:void(0)";
            $config['_attributes'] = "onclick='paging(this)'";

            $this->pagination->initialize($config);
            $data['halaman'] = $this->pagination->create_links();
            if ($this->uri->segment(5) != null) {
                $offset = $this->uri->segment(5);
            } else {
                $offset = 0;
            }
            $data['nom_started'] = $offset + 1;
            $data['show'] = $this->db->query("select *,"
                    . "(select count(users_id) from mg_warranty t where t.users_id = s.users_id) as count_w,"
                    . "(select count(users_id) from mg_testimony te where te.users_id = s.users_id) as count_te,"
                    . "(select count(users_id) from mg_contents c where c.users_id = s.users_id) as count_c,"
                    . "(select count(users_id) from mg_products cs where cs.users_id = s.users_id) as count_cs "
                    . "FROM md_users s where s.users_id is not NULL $sql_where order by s.users_id DESC LIMIT " . $offset . "," . $per)->result();

            $this->load->view("users/users_tabel", $data);
        } else {
            $data['content'] = "users/index";
            $this->load->view("../manage/index", $data);
        }
    }

    function detail($param = null) {
        if ($param != null) {
            $data['dt'] = $this->db->query("select * from md_users where md5(users_id) = '$param'")->last_row();
            $this->load->view("users/users_detail", $data);
        }
    }

    public function form($el = null) {
        //$data['sess'] = $this->authentication_root();
        $data['url_index'] = $this->url_index;
        $data['act'] = (empty($el)) ? "ADD" : "EDIT";
        $data['tit_param'] = $this->title_param;
        if (!empty($el)) {
            $checking = $this->db->query("select * from md_users WHERE md5(users_id) = '$el'")->last_row();
            if (!empty($checking)) {
                $data['dt'] = $checking;
            }
        }
        $this->load->view("users/users_form", $data);
    }
    
    function compress_gambar($source_url, $quality) {
        $info = getimagesize($source_url);

        if ($info['mime'] == 'image/jpeg')
            $gambar = imagecreatefromjpeg($source_url);
        elseif ($info['mime'] == 'image/gif')
            $gambar = imagecreatefromgif($source_url);
        elseif ($info['mime'] == 'image/png')
            $gambar = imagecreatefrompng($source_url);

        imagejpeg($gambar, $source_url, $quality);
        return $source_url;
    }

    public function save() {
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->form_validation->set_rules('fullname', '', 'required');
        $this->form_validation->set_rules('mail', '', 'required');
        $this->form_validation->set_rules('phone', '', 'required');
        $this->form_validation->set_rules('password', '', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('status' => 0, 'msg' => '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> Data ' . $this->title_param . ' can not empty !</div>'));
        } else {
            $data['users_fullname'] = ucwords(trim($this->input->post("fullname")));
            $data['users_mail'] = strtolower(trim($this->input->post("mail")));            
            $data['users_phone'] = strtolower(trim($this->input->post("phone")));
            
            $img_upload = null;
            if (!empty($_POST['file'])) {

                if (!empty($this->input->post('id'))) {
                    $file_img = $this->db->query("select * from md_users where users_id = '" . $this->input->post('id') . "'")->last_row();
                    $this->crud_model->unlink($file_img->users_photo);
                }

                $path = 'assets/pict-users';
                $img = str_replace('data:image/png;base64,', '', $_POST['file']);
                $img = str_replace('data:image/jpeg;base64,', '', $img);
                $img = str_replace('data:image/jpg;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data_upload = base64_decode($img);
                $img_upload = $path . "/folar-users-" . uniqid() . ".jpg";
                file_put_contents($img_upload, $data_upload);
                $info_image = getimagesize($img_upload);
                if ($info_image > 1000) {
                    $img = $this->compress_gambar($img_upload, 80);
                } else if ($info_image > 200 && $info_image <= 1000) {
                    $img = $this->compress_gambar($img_upload, 50);
                }
                $data['users_photo'] = $img_upload;
            }

            if (!empty($this->input->post('id'))) {
                $data['users_id'] = $this->input->post('id');
                if (!empty($_POST['users_id'])) {
                    $check_data = $this->db->query("select * from md_users where users_fullname = '" . $data['users_fullname'] . "' AND users_id != '$data[users_id]'")->last_row();
                }
                if (empty($check_data)) {
                        $get_data = $this->db->query("select * from md_users where users_id = '$data[users_id]'")->last_row();
                        if ($get_data->users_password != $this->input->post("password")) {
                            $data['users_password'] = md5(trim($this->input->post("password")));
                    }
                    $this->crud_model->update_data("md_users", $data, 'users_id');
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> ' . $this->title_param . ' ' . $data['users_fullname'] . ' successfully edited !</div>');
                } else {
                    echo json_encode(array('status' => 0, 'msg' => '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> Data ' . $this->title_param . ' ' . $data['users_fullname'] . ' already exist, Please entry other data !</div>'));
                    exit();
                }
            } else {

                if (!empty($_POST['mail'])) {
                    $data['users_password'] = md5(trim($this->input->post("password")));
                    $check_data = $this->db->query("select * from md_users where users_mail = '$data[users_mail]'")->last_row();
                } else {
                    $check_data = $this->db->query("select * from md_users where users_fullname = '$data[users_fullname]' ")->last_row();
                }
                $data['users_status'] = 1;

                if (empty($check_data)) {
                    $this->crud_model->insert_data("md_users", $data);
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> ' . $this->title_param . ' ' . $data['users_fullname'] . ' successfully created !</div>');
                } else {
                    echo json_encode(array('status' => 0, 'msg' => '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> Data ' . $this->title_param . ' ' . $data['users_fullname'] . ' already exist, Please entry other data !</div>'));
                    exit();
                }
            }
            echo json_encode(array("status" => 1));
        }
    }

    public function status($status = nul, $el = null) {
        if (!empty($el)) {
            $checking = $this->db->query("select * from md_users where md5(users_id) = '$el'")->last_row();
            if (!empty($checking)) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> ' . $this->title_param . ' ' . ucwords($checking->users_fullname) . ' successfully ' . ($status == 2 ? "activated" : "disabled") . ' !</div>');
                $data['users_id'] = $checking->users_id;
                $data['users_status'] = $status;
                $this->crud_model->update_data("md_users", $data, "users_id");
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-warning mr-10"></i> ' . $this->title_param . ' failed to edited !</div>');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-warning mr-10"></i> ' . $this->title_param . ' not found !</div>');
        }
        echo json_encode(array("status" => 1));
    }

    public function delete($el = null) {
        if (!empty($el)) {
            $checking = $this->db->query("select * from md_users where md5(users_id) = '" . $el . "'")->row();
            if (!empty($checking)) {
                if (!empty($checking->users_photo)) {
                    $this->crud_model->unlink($checking->users_photo);
                }                
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> ' . $this->title_param . ' ' . ucwords($checking->users_usersname) . ' berhasil dihapus !</div>');
                $this->crud_model->delete_data("md_users", array("users_id" => "$checking->users_id"));
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-warning mr-10"></i> ' . $this->title_param . ' failed to remove !</div>');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-warning mr-10"></i> ' . $this->title_param . ' not found !</div>');
        }
        echo json_encode(array("status" => 1));
    }

}
