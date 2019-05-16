<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Message extends MY_Controller {

    private $url_index = "dash-manage/mg-msg";
    private $title_param = "Message";

    public function __construct() {
        parent::__construct();
        is_logged_in();
    }

    public function index($el = null,$sort=null) {
        $data['sess'] = $this->authentication_root();
        $data['title'] = "Manage $this->title_param";
        $data['msg_sm'] = "active";
        $data['url_index'] = $this->url_index;
        $data['tit_param'] = $this->title_param;
        if (!empty($el)) {
            $sql_ = (!empty($sort) ? ($sort != "all" ? " AND msg_author like '%" . (str_replace("-", " ", $sort)) . "%' " : null) : null);
            $jml = $this->db->query("select * FROM mg_msg where msg_id is not null $sql_");
            $per = 15;
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
            $koma = get_browser_name($_SERVER['HTTP_USER_AGENT']) == 'Chrome' ? '' : ';';
            $config['base_url'] = "javascript:void(0)$koma";
            $config['_attributes'] = "onclick='paging(this)'";

            $this->pagination->initialize($config);
            $data['halaman'] = $this->pagination->create_links();
            if ($this->uri->segment(5) != null) {
                $offset = $this->uri->segment(5);
            } else {
                $offset = 0;
            }
            $data['nom_started'] = $offset + 1;
            $data['show'] = $this->db->query("select * FROM mg_msg where msg_id is not null $sql_ LIMIT " . $offset . "," . $per)->result();

            $this->load->view("msg_data", $data);
        } else {
            $data['content'] = "mg_msg/msg_index";
            $this->load->view("../manage/index", $data);
        }
    }

    function detail($param = null) {
        if ($param != null) {
            $data['dt'] = $this->db->query("select * FROM mg_msg where md5(msg_id) = '$param'")->last_row();
            $this->load->view("msg_detail", $data);
        }
    }

    public function status($status = nul, $el = null) {
        if (!empty($el)) {
            $checking = $this->db->query("select * from mg_msg where md5(msg_id) = '$el'")->last_row();
            if (!empty($checking)) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> ' . $this->title_param . ' ' . ucwords($checking->msg_author) . ' successfully ' . ($status == 2 ? "activated" : "disabled") . ' !</div>');
                $data['msg_id'] = $checking->users_id;
                $data['msg_read'] = $status;
                $this->crud_model->update_data("mg_msg", $data, "msg_id");
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-warning mr-10"></i> ' . $this->title_param . ' failed to edited !</div>');
            }
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-warning mr-10"></i> ' . $this->title_param . ' not found !</div>');
        }
        echo json_encode(array("status" => 1));
    }

    public function delete($el = null) {
        if (!empty($el)) {
            $checking = $this->db->query("select * from mg_msg where md5(msg_id) = '" . $el . "'")->row();
            if (!empty($checking)) {                
                $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> ' . $this->title_param . ' ' . ucwords($checking->msg_author) . ' berhasil dihapus !</div>');
                $this->crud_model->delete_data("mg_msg", array("msg_id" => "$checking->msg_id"));
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-warning mr-10"></i> ' . $this->title_param . ' failed to remove !</div>');
            }
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-warning mr-10"></i> ' . $this->title_param . ' not found !</div>');
        }
        echo json_encode(array("status" => 1));
    }

}
