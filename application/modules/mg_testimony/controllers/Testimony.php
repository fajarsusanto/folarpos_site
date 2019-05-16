<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Testimony extends MY_Controller {

    private $url_index = "dash-manage/mg-testimony";
    private $title_param = "Testimony";

    public function __construct() {
        parent::__construct();
        is_logged_in();
    }

    public function index($el = null,$sort=null) {
        $data['sess'] = $this->authentication_root();
        $data['title'] = "Manage $this->title_param";
        $data['testi_sm'] = "active";
        $data['url_index'] = $this->url_index;
        $data['tit_param'] = $this->title_param;
        if (!empty($el)) {
            $sql_ = (!empty($sort) ? ($sort != "all" ? " AND y.testi_name like '%" . (str_replace("-", " ", $sort)) . "%' " : null) : null);
            $jml = $this->db->query("select * FROM mg_testimony y left JOIN mg_products p ON p.prod_id = y.prod_id where y.testi_id is not null $sql_");
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
            $data['show'] = $this->db->query("select * FROM mg_testimony y left JOIN mg_products p ON p.prod_id = y.prod_id where y.testi_id is not null $sql_ LIMIT " . $offset . "," . $per)->result();

            $this->load->view("Testimony_data", $data);
        } else {
            $data['content'] = "mg_testimony/testimony_index";
            $this->load->view("../manage/index", $data);
        }
    }

    function detail($param = null) {
        if ($param != null) {
            $data['dt'] = $this->db->query("select * FROM mg_testimony y JOIN mg_products p ON p.prod_id = y.prod_id where md5(y.testi_id) = '$param'")->last_row();
            $this->load->view("testimony_detail", $data);
        }
    }

    public function form($el = null) {
        $data['sess'] = $this->authentication_root();
        $data['url_index'] = $this->url_index;
        $data['act'] = (empty($el)) ? "ADD" : "EDIT";
        $data['tit_param'] = $this->title_param;
        $data['prod'] = $this->db->query("select * from mg_products order by prod_name ASC")->result();
        if (!empty($el)) {
            $checking = $this->db->query("select * from mg_testimony where md5(testi_id) = '$el'")->last_row();
            if (!empty($checking)) {
                $data['dt'] = $checking;
            }
        }
        $this->load->view("testimony_form", $data);
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
        $this->form_validation->set_rules('testi_name', '', 'required');
        $this->form_validation->set_rules('prod_id', '', 'required');
        $this->form_validation->set_rules('testi_desc', '', 'required');
        $this->form_validation->set_rules('testi_caption', '', 'required');
        $this->form_validation->set_rules('file_header', '', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('status' => 0, 'msg' => '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> Data ' . $this->title_param . ' can not empty !</div>'));
        } else {
            $img_upload = null;
            if (!empty($_POST['file_header'])) :
                $path = 'assets/testi-pict';
                $img = str_replace('data:image/png;base64,', '', $_POST['file_header']);
                $img = str_replace('data:image/jpeg;base64,', '', $img);
                $img = str_replace('data:image/jpg;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data_upload = base64_decode($img);
                $img_upload = $path . "/for-" . uniqid() . ".jpg";
                file_put_contents($img_upload, $data_upload);
                $data['testi_photo'] = $img_upload;
            endif;
            $data['testi_name'] = strtolower(trim($this->input->post("testi_name")));
            $data['users_id'] = $sess['users']->users_id;         
            $data['prod_id'] = strtolower(trim($this->input->post("prod_id")));   
            $data['testi_desc'] = $this->input->post("testi_desc", FALSE);
            $data['testi_caption'] = !empty($_POST["testi_caption"]) ? $_POST["testi_caption"] : null;
            $data['testi_date'] = date("Y-m-d H:i:s");
            $data['testi_status'] = 2;
            if (empty($_POST['id'])) {
                $this->crud_model->insert_data("mg_testimony", $data);
                $get_content_id = $this->db->insert_id();
            } else {
                $check_content = $this->db->query("select * from mg_testimony where md5(testi_id)='" . $_POST['id'] . "'")->last_row();
                $data['testi_id'] = $check_content->testi_id;
                if (!empty($_POST['id'])) {
                    if (!empty($_POST['file_header'])) {
                        if (file_exists($check_content->testi_photo)) {
                            $this->crud_model->unlink($check_content->testi_photo);
                        }
                    }
                }
                $this->crud_model->update_data("mg_testimony", $data, 'testi_id');
                $get_content_id = $data['testi_id'];
            }
            echo json_encode(array('status' => 1, 'msg' => '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> Data ' . $this->title_param . ' success save !</div>'));
        }
        
    }

    public function status($status = nul, $el = null) {
        if (!empty($el)) {
            $checking = $this->db->query("select * from mg_testimony where md5(testi_id) = '$el'")->last_row();
            if (!empty($checking)) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> ' . $this->title_param . ' ' . ucwords($checking->testi_name) . ' successfully ' . ($status == 2 ? "activated" : "disabled") . ' !</div>');
                $data['testi_id'] = $checking->testi_id;
                $data['testi_status'] = $status;
                $this->crud_model->update_data("mg_testimony", $data, "testi_id");
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
            $checking = $this->db->query("select * from mg_testimony where md5(testi_id) = '" . $el . "'")->row();
            if (!empty($checking)) {
                if (!empty($checking->testi_photo)) {
                    $this->crud_model->unlink($checking->testi_photo);
                }                
                $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> ' . $this->title_param . ' ' . ucwords($checking->testi_name) . ' berhasil dihapus !</div>');
                $this->crud_model->delete_data("mg_testimony", array("testi_id" => "$checking->testi_id"));
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-warning mr-10"></i> ' . $this->title_param . ' failed to remove !</div>');
            }
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-warning mr-10"></i> ' . $this->title_param . ' not found !</div>');
        }
        echo json_encode(array("status" => 1));
    }

}
