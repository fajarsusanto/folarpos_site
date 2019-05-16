<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Blog extends MY_Controller {

    private $url_index = "dash-manage/mg-blog";
    private $title_param = "Blog";

    public function __construct() {
        parent::__construct();
        is_logged_in();
    }

    public function index($el = null,$sort=null) {
        $data['sess'] = $this->authentication_root();
        $data['title'] = "Manage $this->title_param";
        $data['blog_sm'] = "active";
        $data['url_index'] = $this->url_index;
        $data['tit_param'] = $this->title_param;
        if (!empty($el)) {
            $sql_date = '';
            if (!empty($_GET['range'])) {
                $dateny = explode("_", $_GET['range']);
                $date_start = $dateny[0];
                $date_end = $dateny[1];

                $dayb_ = $date_start;
                $dayb__ = $date_end;

                $sql_date = "AND (DATE(cont_date) BETWEEN '$dayb_' and '$dayb__' )";
            }
            $sql_ = (!empty($sort) ? ($sort != "all" ? " AND cont_title like '%" . (str_replace("-", " ", $sort)) . "%' " : null) : null);
            $jml = $this->db->query("select * FROM mg_contents where menu_id = 4 $sql_date $sql_");
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
            $data['show'] = $this->db->query("select * FROM mg_contents where menu_id = 4 $sql_date $sql_ LIMIT " . $offset . "," . $per)->result();

            $this->load->view("blog_data", $data);
        } else {
            $data['content'] = "mg_blog/blog_index";
            $this->load->view("../manage/index", $data);
        }
    }

    function detail($param = null) {
        if ($param != null) {
            $data['dt'] = $this->db->query("select * from mg_contents where md5(cont_id) = '$param'")->last_row();
            $this->load->view("blog_detail", $data);
        }
    }

    public function form($el = null) {
        $data['sess'] = $this->authentication_root();
        $data['url_index'] = $this->url_index;
        $data['act'] = (empty($el)) ? "ADD" : "EDIT";
        $data['tit_param'] = $this->title_param;
        if (!empty($el)) {
            $checking = $this->db->query("select * from mg_contents where md5(cont_id) = '$el'")->last_row();
            if (!empty($checking)) {
                $data['dt'] = $checking;
            }
        }
        $this->load->view("blog_form", $data);
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
        $this->form_validation->set_rules('cont_title', '', 'required');
        $this->form_validation->set_rules('cont_desc', '', 'required');
        $this->form_validation->set_rules('cont_keyword', '', 'required');
        //print_r($data['sess']);
        //exit();
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('status' => 0, 'msg' => '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> Data ' . $this->title_param . ' can not empty !</div>'));
        } else {
            $img_upload = null;
            if (!empty($_POST['file_header'])) :
                $path = 'assets/photo-pict';
                $img = str_replace('data:image/png;base64,', '', $_POST['file_header']);
                $img = str_replace('data:image/jpeg;base64,', '', $img);
                $img = str_replace('data:image/jpg;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data_upload = base64_decode($img);
                $img_upload = $path . "/for-" . uniqid() . ".jpg";
                file_put_contents($img_upload, $data_upload);
                $data['cont_header'] = $img_upload;
            endif;
            $data['menu_id'] = 4;
            $data['users_id'] = $sess['users']->users_id;         
            $data['cont_title'] = strtolower(trim($this->input->post("cont_title")));       
            $data['cont_url'] = url_title(strtolower($data['cont_title']));
            $data['cont_desc'] = $this->input->post("cont_desc", FALSE);
            $data['cont_keyword'] = !empty($_POST["cont_keyword"]) ? $_POST["cont_keyword"] : null;
            $data['cont_date'] = date("Y-m-d H:i:s");
            $data['cont_status'] = 2;
            if (empty($_POST['id'])) {
                $this->crud_model->insert_data("mg_contents", $data);
                $get_content_id = $this->db->insert_id();
                //subscribes mail
//                if (empty($getmoduls)) {
//                    $this->subscribes_mail(array('url_pages' => "<a href='" . base_url("articles-detail/$data[content_url]") . "'>$data[content_title] ( News & Articles )</a>", 'title' => $data['content_title'], "msg" => $this->mail_subs('contents', $get_content_id)));
//                }
            } else {
                $check_content = $this->db->query("select * from mg_contents where md5(cont_id)='" . $_POST['id'] . "'")->last_row();
                $data['cont_id'] = $check_content->cont_id;
                if (!empty($_POST['id'])) {
                    if (!empty($_POST['file_header'])) {
                        if (file_exists($check_content->cont_header)) {
                            $this->crud_model->unlink($check_content->cont_header);
                        }
                    }
                }
                $this->crud_model->update_data("mg_contents", $data, 'cont_id');
                $get_content_id = $data['cont_id'];
            }
            echo json_encode(array('status' => 1, 'msg' => '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> Data ' . $this->title_param . ' success save !</div>'));
        }
        
    }

    public function status($status = nul, $el = null) {
        if (!empty($el)) {
            $checking = $this->db->query("select * from mg_contents where md5(cont_id) = '$el'")->last_row();
            if (!empty($checking)) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> ' . $this->title_param . ' ' . ucwords($checking->cont_title) . ' successfully ' . ($status == 2 ? "activated" : "disabled") . ' !</div>');
                $data['cont_id'] = $checking->cont_id;
                $data['cont_status'] = $status;
                $this->crud_model->update_data("mg_contents", $data, "cont_id");
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
            $checking = $this->db->query("select * from mg_contents where md5(cont_id) = '" . $el . "'")->row();
            if (!empty($checking)) {
                if (!empty($checking->cont_header)) {
                    $this->crud_model->unlink($checking->cont_header);
                }                
                $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> ' . $this->title_param . ' ' . ucwords($checking->cont_title) . ' berhasil dihapus !</div>');
                $this->crud_model->delete_data("mg_contents", array("cont_id" => "$checking->cont_id"));
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-warning mr-10"></i> ' . $this->title_param . ' failed to remove !</div>');
            }
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-warning mr-10"></i> ' . $this->title_param . ' not found !</div>');
        }
        echo json_encode(array("status" => 1));
    }

}
