<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Warranty extends MY_Controller {

    private $url_index = "dash-manage/mg-warranty";
    private $title_param = "Warranty";

    public function __construct() {
        parent::__construct();
        is_logged_in();
    }

    public function index($el = null,$sort=null) {
        $data['sess'] = $this->authentication_root();
        $data['title'] = "Manage $this->title_param";
        $data['wrt_sm'] = "active";
        $data['url_index'] = $this->url_index;
        $data['tit_param'] = $this->title_param;
        if (!empty($el)) {
            $sql_ = (!empty($sort) ? ($sort != "all" ? " AND war_name like '%" . (str_replace("-", " ", $sort)) . "%' " : null) : null);
            $jml = $this->db->query("select * FROM mg_warranty where war_id is not null $sql_");
            $per = 12;
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
            $data['show'] = $this->db->query("select * FROM mg_warranty where war_id is not null $sql_ LIMIT " . $offset . "," . $per)->result();

            $this->load->view("warranty_data", $data);
        } else {
            $data['content'] = "mg_warranty/warranty_index";
            $this->load->view("../manage/index", $data);
        }
    }

    function detail($param = null) {
        if ($param != null) {
            $data['dt'] = $this->db->query("select * from mg_warranty where md5(war_id) = '$param'")->last_row();
            $this->load->view("warranty_detail", $data);
        }
    }

    public function form($el = null) {
        $data['sess'] = $this->authentication_root();
        $data['url_index'] = $this->url_index;
        $data['act'] = (empty($el)) ? "ADD" : "EDIT";
        $data['tit_param'] = $this->title_param;
        if (!empty($el)) {
            $checking = $this->db->query("select * from mg_warranty where md5(war_id) = '$el'")->last_row();
            if (!empty($checking)) {
                $data['dt'] = $checking;
            }
        }
        $this->load->view("warranty_form", $data);
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
        $sess = $this->authentication_root();
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->form_validation->set_rules('war_name', '', 'required');
        $this->form_validation->set_rules('war_caption', '', 'required');
        $this->form_validation->set_rules('war_post', '', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('status' => 0, 'msg' => '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> Data ' . $this->title_param . ' can not empty !</div>'));
        } else {
            $check_post = $this->db->query("select * from mg_warranty where war_post = ".strtolower(trim($this->input->post("war_post"))))->last_row();
            if (!empty($check_post)) {
                echo json_encode(array('status' => 0, 'msg' => '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> Data position can not same !</div>'));
                exit();
            }
            $img_upload = null;
            if (!empty($_POST['file_header'])) :
                $path = 'assets/war-icon';
                $img = str_replace('data:image/png;base64,', '', $_POST['file_header']);
                $img = str_replace('data:image/jpeg;base64,', '', $img);
                $img = str_replace('data:image/jpg;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data_upload = base64_decode($img);
                $img_upload = $path . "/for-" . uniqid() . ".jpg";
                file_put_contents($img_upload, $data_upload);
                $data['war_icon'] = $img_upload;
            endif;
            $data['users_id'] = $sess['users']->users_id;         
            $data['war_name'] = strtolower(trim($this->input->post("war_name")));       
            $data['war_caption'] = strtolower(trim($this->input->post("war_caption"))); 
            $data['war_post'] = strtolower(trim($this->input->post("war_post"))); 
            $data['war_status'] = 2;
            if (empty($_POST['id'])) {
                $this->crud_model->insert_data("mg_warranty", $data);
            } else {
                $check_content = $this->db->query("select * from mg_warranty where md5(war_id)='" . $_POST['id'] . "'")->last_row();
                $data['war_id'] = $check_content->cont_id;
                if (!empty($_POST['id'])) {
                    if (!empty($_POST['file_header'])) {
                        if (file_exists($check_content->war_icon)) {
                            $this->crud_model->unlink($check_content->war_icon);
                        }
                    }
                }
                $this->crud_model->update_data("mg_warranty", $data, 'war_id');
            }
            echo json_encode(array('status' => 1, 'msg' => '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> Data ' . $this->title_param . ' success save !</div>'));
        }
        
    }

    public function status($status = nul, $el = null) {
        if (!empty($el)) {
            $checking = $this->db->query("select * from mg_warranty where md5(war_id) = '$el'")->last_row();
            if (!empty($checking)) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> ' . $this->title_param . ' ' . ucwords($checking->war_name) . ' successfully ' . ($status == 2 ? "activated" : "disabled") . ' !</div>');
                $data['war_id'] = $checking->war_id;
                $data['war_status'] = $status;
                $this->crud_model->update_data("mg_warranty", $data, "war_id");
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
            $checking = $this->db->query("select * from mg_warranty where md5(war_id) = '" . $el . "'")->row();
            if (!empty($checking)) {
                if (!empty($checking->war_icon)) {
                    $this->crud_model->unlink($checking->war_icon);
                }                
                $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> ' . $this->title_param . ' ' . ucwords($checking->war_name) . ' berhasil dihapus !</div>');
                $this->crud_model->delete_data("mg_warranty", array("war_id" => "$checking->war_id"));
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-warning mr-10"></i> ' . $this->title_param . ' failed to remove !</div>');
            }
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-warning mr-10"></i> ' . $this->title_param . ' not found !</div>');
        }
        echo json_encode(array("status" => 1));
    }

}
