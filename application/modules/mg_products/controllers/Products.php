<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Products extends MY_Controller {

    private $url_index = "dash-manage/mg-products";
    private $title_param = "Products";

    public function __construct() {
        parent::__construct();
        is_logged_in();
    }

    public function index($el = null, $sort = null) {
        $data['sess'] = $this->authentication_root();
        $data['title'] = "Manage $this->title_param";
        $data['prods_sm'] = "active";
        $data['url_index'] = $this->url_index;
        $data['tit_param'] = $this->title_param;
        if (!empty($el)) {
            $sql_where = (!empty($sort) ? ($sort != "all" ? " AND prod_name like '%" . (str_replace("-", " ", $sort)) . "%' " : null) : null);
            $jml = $this->db->query("select * FROM mg_products where prod_id is not NULL $sql_where");
            $per = 25;
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
            $data['show'] = $this->db->query("select * FROM mg_products where prod_id is not NULL $sql_where order by prod_id DESC LIMIT " . $offset . "," . $per)->result();

            $this->load->view("products_tabel", $data);
        } else {
            $data['content'] = "mg_products/index";
            $this->load->view("../manage/index", $data);
        }
    }

    function detail($param = null) {
        if ($param != null) {
            $data['dt'] = $this->db->query("select * from mg_products where md5(prod_id) = '$param'")->last_row();
            $this->load->view("products_detail", $data);
        }
    }
    
    function upload($param = null) {
        $data['sess'] = $this->authentication_root();
        $data['url_index'] = $this->url_index;
        $data['tit_param'] = $this->title_param;
        if ($param != null) {
            $data['dt'] = $this->db->query("select * from mg_products where md5(prod_id) = '$param'")->last_row();            
        }
        $this->load->view("products_form_upload", $data);
    }
    
    public function save_upload() {
        $sess = $this->authentication_root();
        $id = $this->input->post("id");
        $check = $this->db->query("select * from mg_products where prod_id = '$id'")->last_row();
        if (!empty($check)) {
            $this->load->helper(array('form', 'url'));
            $config['upload_path'] = './assets/proposal_product/';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 0;
            $config['file_name'] = url_title($this->input->post('userfile')); //nama gambar

            $this->upload->initialize($config);

            if (!$this->upload->do_upload()) {
                $err = $this->upload->display_errors();
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> ' . $err . '</div>');
                redirect('products');
            } else {
                $file = $this->upload->file_name;
                $data['prod_id'] = $check->prod_id;
                $data['prod_attach'] = 'assets/proposal_product/' . $file;
                $this->crud_model->update_data("mg_products", $data, 'prod_id');
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> Data has been uploaded </div>');
                redirect('products');
            }
        }
    }

    public function form($el = null) {
        $data['sess'] = $this->authentication_root();
        $data['url_index'] = $this->url_index;
        $data['act'] = (empty($el)) ? "ADD" : "EDIT";
        $data['tit_param'] = $this->title_param;
        if (!empty($el)) {
            $checking = $this->db->query("select * from mg_products WHERE md5(prod_id) = '$el'")->last_row();
            if (!empty($checking)) {
                $data['dt'] = $checking;
            }
        }
        $this->load->view("products_form", $data);
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
        $this->form_validation->set_rules('prod_name', '', 'required');
        $this->form_validation->set_rules('prod_caption', '', 'required');
        $this->form_validation->set_rules('prod_desc', '', 'required');
        $this->form_validation->set_rules('prod_demo', '', 'required');
        $this->form_validation->set_rules('prod_post', '', 'required');
        $this->form_validation->set_rules('prod_keyword', '', 'required');
        $this->form_validation->set_rules('prod_features', '', 'required');
        $this->form_validation->set_rules('file_header', '', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array('status' => 0, 'msg' => '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> Data ' . $this->title_param . ' can not empty !</div>'));
        } else {        
            $data['users_id'] = $sess['users']->users_id;
            $data['prod_name'] = ucwords(trim($this->input->post("prod_name")));
            $data['prod_url'] = url_title(strtolower($data['prod_name']));           
            $data['prod_caption'] = strtolower(trim($this->input->post("prod_caption")));          
            $data['prod_desc'] = strtolower(trim($this->input->post("prod_desc")));          
            $data['prod_demo'] = strtolower(trim($this->input->post("prod_demo")));             
            $data['prod_post'] = strtolower(trim($this->input->post("prod_post")));          
            $data['prod_keyword'] = strtolower(trim($this->input->post("prod_keyword")));          
            $data['prod_status'] = 2;           
            $data['prod_features'] = strtolower(trim($this->input->post("prod_features")));
            
            $img_upload = null;
            if (!empty($_POST['file_header'])) {
                if (!empty($this->input->post('id'))) {
                    $file_img = $this->db->query("select * from mg_products where prod_id = '" . $this->input->post('id') . "'")->last_row();
                    $this->crud_model->unlink($file_img->prod_icon);
                }
                $path = 'assets/pict-products';
                $img = str_replace('[removed]', '', $_POST['file_header']);
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace('data:image/jpeg;base64,', '', $img);
                $img = str_replace('data:image/jpg;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data_upload = base64_decode($img);
                $img_upload = $path . "/folar-users-" . uniqid() . ".jpg";
                file_put_contents($img_upload, $data_upload);
//                $info_image = getimagesize($img_upload);
//                if ($info_image > 1000) {
//                    $img = $this->compress_gambar($img_upload, 80);
//                } else if ($info_image > 200 && $info_image <= 1000) {
//                    $img = $this->compress_gambar($img_upload, 50);
//                }
                $data['prod_icon'] = $img_upload;
            }

            if (!empty($this->input->post('id'))) {
                $data['prod_id'] = $this->input->post('id');
                $check_prod = $this->db->query("select * from mg_products where prod_id=" . $_POST['id'] . "")->last_row();
                if (!empty($_POST['id'])) {
                    if (!empty($_POST['file_header'])) {
                        if (file_exists($check_prod->prod_icon)) {
                            $this->crud_model->unlink($check_prod->prod_icon);
                        }
                    }
                }
                $this->crud_model->update_data("mg_products", $data, 'prod_id');
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> ' . $this->title_param . ' ' . $data['prod_name'] . ' successfully edited !</div>');
                
            } else {
                $this->crud_model->insert_data("mg_products", $data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> ' . $this->title_param . ' ' . $data['prod_name'] . ' successfully created !</div>');
                
            }
            echo json_encode(array("status" => 1));
        }
    }

    public function status($status = nul, $el = null) {
        if (!empty($el)) {
            $checking = $this->db->query("select * from mg_products where md5(prod_id) = '$el'")->last_row();
            if (!empty($checking)) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> ' . $this->title_param . ' ' . ucwords($checking->prod_name) . ' successfully ' . ($status == 2 ? "activated" : "disabled") . ' !</div>');
                $data['prod_id'] = $checking->prod_id;
                $data['prod_status'] = $status;
                $this->crud_model->update_data("mg_products", $data, "prod_id");
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
            $checking = $this->db->query("select * from mg_products where md5(prod_id) = '" . $el . "'")->row();
            if (!empty($checking)) {
                if (!empty($checking->prod_icon)) {
                    $this->crud_model->unlink($checking->prod_icon);
                }                
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> ' . $this->title_param . ' ' . ucwords($checking->prod_name) . ' berhasil dihapus !</div>');
                $this->crud_model->delete_data("mg_products", array("prod_id" => "$checking->prod_id"));
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-warning mr-10"></i> ' . $this->title_param . ' failed to remove !</div>');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-warning mr-10"></i> ' . $this->title_param . ' not found !</div>');
        }
        echo json_encode(array("status" => 1));
    }

}
