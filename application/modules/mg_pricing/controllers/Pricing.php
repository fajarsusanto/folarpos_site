<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Pricing extends MY_Controller {

    private $url_index = "dash-manage/mg-pricing";
    private $title_param = "Pricing";

    public function __construct() {
        parent::__construct();
        is_logged_in();
    }

    public function index($el = null, $sort = null) {
        $data['sess'] = $this->authentication_root();
        $data['title'] = "Manage $this->title_param";
        $data['pric_sm'] = "active";
        $data['url_index'] = $this->url_index;
        $data['tit_param'] = $this->title_param;
        if (!empty($el)) {
            $sql_where = (!empty($sort) ? ($sort != "all" ? " AND pric_name like '%" . (str_replace("-", " ", $sort)) . "%' " : null) : null);
            $jml = $this->db->query("select * FROM mg_pricing where pric_id is not NULL $sql_where");
            $per = 15;
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
            $data['show'] = $this->db->query("select * FROM mg_pricing where pric_id is not NULL $sql_where order by pric_id DESC LIMIT " . $offset . "," . $per)->result();

            $this->load->view("pricing_tabel", $data);
        } else {
            $data['content'] = "mg_pricing/index";
            $this->load->view("../manage/index", $data);
        }
    }

    function detail($param = null) {
        if ($param != null) {
            $data['dt'] = $this->db->query("select * from mg_pricing where md5(pric_id) = '$param'")->last_row();
            $this->load->view("pricing_detail", $data);
        }
    }

    public function form($el = null) {
        $data['sess'] = $this->authentication_root();
        $data['url_index'] = $this->url_index;
        $data['act'] = (empty($el)) ? "ADD" : "EDIT";
        $data['tit_param'] = $this->title_param;
        if (!empty($el)) {
            $checking = $this->db->query("select * from mg_pricing WHERE md5(pric_id) = '$el'")->last_row();
            if (!empty($checking)) {
                $data['dt'] = $checking;
            }
        }
        $this->load->view("pricing_form", $data);
    }

    public function save() {
        $sess = $this->authentication_root();
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->form_validation->set_rules('pric_name', '', 'required');
        $this->form_validation->set_rules('pric_curency', '', 'required');
        $this->form_validation->set_rules('pric_nominal', '', 'required');
        $this->form_validation->set_rules('pric_period', '', 'required');
        $this->form_validation->set_rules('pric_desc', '', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('status' => 0, 'msg' => '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> Data ' . $this->title_param . ' can not empty !</div>'));
        } else {
            $data['pric_name'] = ucwords(trim($this->input->post("pric_name")));
            $data['pric_curency'] = strtolower(trim($this->input->post("pric_curency")));     
            $data['pric_nominal'] = strtolower(trim($this->input->post("pric_nominal")));          
            $data['pric_period'] = strtolower(trim($this->input->post("pric_period")));          
            $data['pric_desc'] = strtolower(trim($this->input->post("pric_desc")));          
            $data['pric_status'] = 2;

            if (!empty($this->input->post('id'))) {
                $data['pric_id'] = $this->input->post('id');
                
                $this->crud_model->update_data("mg_pricing", $data, 'pric_id');
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> ' . $this->title_param . ' ' . $data['pric_name'] . ' successfully edited !</div>');
                
            } else {
                $this->crud_model->insert_data("mg_pricing", $data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> ' . $this->title_param . ' ' . $data['pric_name'] . ' successfully created !</div>');
                
            }
            echo json_encode(array("status" => 1));
        }
    }

    public function status($status = nul, $el = null) {
        if (!empty($el)) {
            $checking = $this->db->query("select * from mg_pricing where md5(pric_id) = '$el'")->last_row();
            if (!empty($checking)) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> ' . $this->title_param . ' ' . ucwords($checking->pric_name) . ' successfully ' . ($status == 2 ? "activated" : "disabled") . ' !</div>');
                $data['pric_id'] = $checking->pric_id;
                $data['pric_status'] = $status;
                $this->crud_model->update_data("mg_pricing", $data, "pric_id");
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
            $checking = $this->db->query("select * from mg_pricing where md5(pric_id) = '" . $el . "'")->row();
            if (!empty($checking)) {                
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> ' . $this->title_param . ' ' . ucwords($checking->pric_name) . ' berhasil dihapus !</div>');
                $this->crud_model->delete_data("mg_pricing", array("pric_id" => "$checking->pric_id"));
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-warning mr-10"></i> ' . $this->title_param . ' failed to remove !</div>');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-warning mr-10"></i> ' . $this->title_param . ' not found !</div>');
        }
        echo json_encode(array("status" => 1));
    }

}
