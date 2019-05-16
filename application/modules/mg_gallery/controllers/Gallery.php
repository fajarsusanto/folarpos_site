<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Gallery extends MY_Controller {

    private $url_index = "dash-manage/mg-gallery";
    private $title_param = "Gallery";

    public function __construct() {
        parent::__construct();
        is_logged_in();
    }

    public function index($el = null, $sort = null) {
        $data['sess'] = $this->authentication_root();
        $data['title'] = "Manage $this->title_param";
        $data['gal_sm'] = "active";
        $data['url_index'] = $this->url_index;
        $data['tit_param'] = $this->title_param;
        if (!empty($el)) {
            $sql_where = (!empty($sort) ? ($sort != "all" ? " AND gal_title like '%" . (str_replace("-", " ", $sort)) . "%' " : null) : null);
            $jml = $this->db->query("select * FROM mg_gallery where gal_id is not NULL $sql_where");
            $per = 12;
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
            $data['show'] = $this->db->query("select * FROM mg_gallery where gal_id is not NULL $sql_where order by gal_id DESC LIMIT " . $offset . "," . $per)->result();
            foreach ($data['show'] as $k => $val) {
                $data['show_dt'][$k] = $this->db->query("select * FROM mg_gallery_dt where gal_id = $val->gal_id")->first_row();
            }

            $this->load->view("gallery_tabel", $data);
        } else {
            $data['content'] = "mg_gallery/index";
            $this->load->view("../manage/index", $data);
        }
    }

    function detail($param = null) {
        if ($param != null) {
            $data['dt'] = $this->db->query("select * from mg_gallery where md5(gal_id) = '$param'")->last_row();
            $data['dt_'] = $this->db->query("select * from mg_gallery_dt where gal_id = " . $data['dt']->gal_id)->result();
            $this->load->view("gallery_detail", $data);
        }
    }

    public function form($el = null) {
        $data['sess'] = $this->authentication_root();
        $data['url_index'] = $this->url_index;
        $data['act'] = (empty($el)) ? "ADD" : "EDIT";
        $data['tit_param'] = $this->title_param;
        if (!empty($el)) {
            $checking = $this->db->query("select * from mg_gallery WHERE md5(gal_id) = '$el'")->last_row();
            if (!empty($checking)) {
                $data['dt'] = $checking;
                $data['gal'] = $this->db->query("select * from mg_gallery_dt where md5(gal_id) = '$el'")->result();
            }
        }
        $this->load->view("gallery_form", $data);
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
        $this->form_validation->set_rules('gal_title', '', 'required');
        $this->form_validation->set_rules('gal_caption', '', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('status' => 0, 'msg' => '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> Data ' . $this->title_param . ' can not empty !</div>'));
        } else {
            if (empty($_POST['gallery'])) {
                echo json_encode(array('status' => 0, 'msg' => '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> Data gallery can not empty !</div>'));
                exit();
            }
            $data['gal_title'] = ucwords(trim($this->input->post("gal_title")));
            $data['gal_url'] = url_title(strtolower($data['gal_title']));
            $data['gal_caption'] = strtolower(trim($this->input->post("gal_caption")));
            $data['gal_date'] = date("Y-m-d H:i:s");
            $data['gal_status'] = 2;

            if (isset($_POST['id'])) {
                $data['gal_id'] = $_POST['id'];
                $check_data = $this->db->query("select * from mg_gallery where gal_id != '$data[gal_id]' and gal_url = '" . ($data['gal_url']) . "'")->last_row();
                if (empty($check_data)) {
                    $this->crud_model->update_data("mg_gallery", $data, 'gal_id');
                    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mg-r-md"></i>' . $this->title_param . ' ' . $data['gal_title'] . ' successfully up to date !</div>');
                    $get_last_id = $data['gal_id'];
                } else {
                    echo json_encode(array('status' => 0, 'msg' => '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mg-r-md"></i>Data ' . $this->title_param . ' ' . $data['gal_title'] . ' already, Please use other title !</div>'));
                    exit();
                }
            } else {
                $check_data = $this->db->query("select * from mg_gallery where gal_url = '" . ($data['gal_url']) . "'")->last_row();
                if (empty($check_data)) {
                    $this->crud_model->insert_data("mg_gallery", $data);
                    $get_last_idd = $this->db->query("select * from mg_gallery")->last_row();
                    $get_last_id = $get_last_idd->gal_id;
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mg-r-md"></i>' . $this->title_param . ' ' . $data['gal_title'] . ' successfully created !</div>');
                } else {
                    echo json_encode(array('status' => 0, 'msg' => '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mg-r-md"></i>Data ' . $this->title_param . ' ' . $data['gal_title'] . ' already, Please use other title !!</div>'));
                    exit();
                }
            }
        
        $path_gal = 'assets/gallery-pict';
        if (!empty($_POST['gallery'])) {
            for ($in = 0; $in < count($_POST['gallery']); $in++) {
                $img_unit = str_replace("[removed]", "", $_POST['gallery'][$in]);
                $img_unit = str_replace('data:image/png;base64,', '', $img_unit);
                $img_unit = str_replace('data:image/jpeg;base64,', '', $img_unit);
                $img_unit = str_replace('data:image/jpg;base64,', '', $img_unit);
                $data_gal = base64_decode($img_unit);
                $data_gals[$in]['gal_dt_photo'] = $path_gal . "/$data[gal_url]-gallery" . uniqid() . "$in.jpg";
                file_put_contents($data_gals[$in]['gal_dt_photo'], $data_gal);
                $info_image = getimagesize($data_gals[$in]['gal_dt_photo']);
                if ($info_image > 1000) {
                    $img = $this->compress_gambar($data_gals[$in]['gal_dt_photo'], 20);
                }
                $data_gals[$in]['gal_id'] = $get_last_id;
                $data_gals[$in]['gal_dt_date'] = date("Y-m-d H:i:s");
                if (!empty($_POST['gal_dt_id'][$in])) {
                    $check_gals[$in] = $this->db->query("select * from mg_gallery_dt where gal_id = " . $_POST['gal_dt_id'][$in])->last_row();
                    if (!empty($check_gals[$in]->gal_dt_photo)) {
                        $this->crud_model->unlink($check_gals[$in]->gal_dt_photo);
                    }
                    $data_gals[$in]['gal_dt_id'] = $_POST['gal_dt_id'][$in];
                    if ($_POST['gal_status'][$in] == 1) {
                        $this->crud_model->update_data("mg_gallery_dt", $data_gals[$in], "gal_dt_id");
                    } else {
                        $this->crud_model->delete_data("mg_gallery_dt", "gal_dt_id = " . $data_gals[$in]['gal_dt_id']);
                    }
                } else {
                    $this->crud_model->insert_data("mg_gallery_dt", $data_gals[$in]);
                }
            }
        }
        echo json_encode(array('status' => 1));
      }
    }

    public function status($status = nul, $el = null) {
        if (!empty($el)) {
            $checking = $this->db->query("select * from mg_gallery where md5(gal_id) = '$el'")->last_row();
            if (!empty($checking)) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> ' . $this->title_param . ' ' . ucwords($checking->gal_title) . ' successfully ' . ($status == 2 ? "activated" : "disabled") . ' !</div>');
                $data['gal_id'] = $checking->gal_id;
                $data['gal_status'] = $status;
                $this->crud_model->update_data("mg_gallery", $data, "gal_id");
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
            $checking = $this->db->query("select * from mg_gallery where md5(gal_id) = '" . $el . "'")->row();
            $checking_dt = $this->db->query("select * from mg_gallery_dt where md5(gal_id) = '" . $el . "'")->result();
            foreach ($checking_dt as $k => $val) {
                if (!empty($val->gal_dt_photo)) {
                    $this->crud_model->unlink($checking->gal_dt_photo);
                }
                $this->crud_model->delete_data("mg_gallery_dt", array("gal_dt_id" => "$checking->gal_dt_id"));
            }
            if (!empty($checking)) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> ' . $this->title_param . ' ' . ucwords($checking->gal_title) . ' berhasil dihapus !</div>');
                $this->crud_model->delete_data("mg_gallery", array("gal_id" => "$checking->gal_id"));
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-warning mr-10"></i> ' . $this->title_param . ' failed to remove !</div>');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-warning mr-10"></i> ' . $this->title_param . ' not found !</div>');
        }
        echo json_encode(array("status" => 1));
    }

}
