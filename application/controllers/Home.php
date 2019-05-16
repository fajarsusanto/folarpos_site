<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');
 
class Home extends MY_Controller {

    private $url_index = "dashboard";

    public function __construct() {
        parent::__construct();

        $this->load->library('facebook');
        $this->load->helper('folarium_helper');
        $this->load->model('user');
        $this->load->model('auth/Auth_model');
        $this->load->Model('Crud_model');
        $this->load->library('Recaptcha');
        $this->load->library('email'); 
    } 
    
    public function game() {
        $this->load->view("game/index");
    }
    
    public function index() {
        $data['apps'] = $this->systems();
        $data['gallery'] = $this->db->query("select * from mg_gallery where gal_status = 2 ORDER BY gal_id DESC")->result();
        foreach ($data['gallery'] as $k => $val) {
            $data['gallery_dt'][$k] = $this->db->query("select * from mg_gallery_dt where gal_id = $val->gal_id ORDER BY gal_dt_id ASC")->result();
        }
        $data['testimony_desc'] = $this->db->query("select * from mg_testimony t JOIN mg_products c ON c.prod_id = t.prod_id where testi_status = 2 ORDER BY testi_id DESC limit 2")->result();
        $data['testimony_asc'] = $this->db->query("select * from mg_testimony t JOIN mg_products c ON c.prod_id = t.prod_id where testi_status = 2 ORDER BY testi_id ASC limit 2")->result();
        $data['Products'] = $this->db->query("select * from mg_products where prod_status = 2 ORDER BY prod_post ASC")->result();
        $data['warranty'] = $this->db->query("select * from mg_warranty where war_status = 2 ORDER BY war_post ASC")->result();
        $data['tips'] = $this->db->query("select * from mg_contents s JOIN md_users u ON u.users_id = s.users_id where s.menu_id = 4 AND s.cont_status = 2 ORDER BY s.cont_id DESC LIMIT 4")->result();
        $data['career'] = $this->db->query("select * from mg_contents s JOIN md_users u ON u.users_id = s.users_id where s.menu_id = 5 AND s.cont_status = 2 ORDER BY s.cont_id DESC LIMIT 4")->result();
        $data['price'] = $this->db->query("select * from mg_pricing where pric_status = 2 ORDER BY pric_id DESC")->result();
        $data['premium'] = $this->db->query("select * from mg_products where prod_status = 2 AND prod_premium = 2 ORDER BY prod_post ASC")->last_row();
                
        $this->is_visited(array("menu" => 1));
        $data['script_captcha'] = $this->recaptcha->getScriptTag();
        $data['captcha'] = $this->recaptcha->getWidget();
                
        $this->load->view("../folarpos/element/header",$data);
        $this->load->view("../folarpos/home");
        $this->load->view("../folarpos/element/footer");
    }
    
    public function detail_blog($id=null) {
        $data['apps'] = $this->systems();
        $data['tips_lates'] = $this->db->query("select * from mg_contents s JOIN md_users u ON u.users_id = s.users_id where s.menu_id = 4 AND s.cont_status = 2 ORDER BY s.cont_id DESC LIMIT 3")->result();
        
        $data['script_captcha'] = $this->recaptcha->getScriptTag();
        $data['captcha'] = $this->recaptcha->getWidget();
        $cek_cont = $this->db->query("select * from mg_contents s JOIN md_users u ON u.users_id = s.users_id where s.menu_id = 4 AND s.cont_status = 2 AND s.cont_url = '$id' ORDER BY s.cont_id DESC")->last_row();
        if (!empty($cek_cont)) {
            $data['tips_dt'] = $this->db->query("select * from mg_contents s JOIN md_users u ON u.users_id = s.users_id where s.menu_id = 4 AND s.cont_status = 2 AND s.cont_url = '$id' ORDER BY s.cont_id DESC")->last_row();
            $this->is_visited(array("menu" => 4, "content" => $data['tips_dt']->cont_id ));
            $this->load->view("../folarpos/element/header",$data);
            $this->load->view("../folarpos/detail_tips");
            $this->load->view("../folarpos/element/footer");
        } else {
            $this->load->view("../folarpos/element/header",$data);
            $this->load->view("../folarpos/404");
            $this->load->view("../folarpos/element/footer");
        }
        
    }
    
    public function blog() {
        $data['apps'] = $this->systems();
        $data['tips'] = $this->db->query("select * from mg_contents s JOIN md_users u ON u.users_id = s.users_id where s.menu_id = 4 AND s.cont_status = 2 ORDER BY s.cont_id DESC")->result();
        $this->is_visited(array("menu" => 4));
        $data['script_captcha'] = $this->recaptcha->getScriptTag();
        $data['captcha'] = $this->recaptcha->getWidget();
        $this->load->view("../folarpos/element/header",$data);
        $this->load->view("../folarpos/tips");
        $this->load->view("../folarpos/element/footer");
    }
    
    public function detail_career($id=null) {
        $data['apps'] = $this->systems();
        $data['tips_lates'] = $this->db->query("select * from mg_contents s JOIN md_users u ON u.users_id = s.users_id where s.menu_id = 4 AND s.cont_status = 2 ORDER BY s.cont_id DESC LIMIT 5")->result();
        //$data['tips_dt'] = $this->db->query("select * from mg_contents s JOIN md_users u ON u.users_id = s.users_id where s.menu_id = 5 AND s.cont_status = 2 AND md5(s.cont_id) = '$id' ORDER BY s.cont_id DESC")->last_row();
        $data['script_captcha'] = $this->recaptcha->getScriptTag();
        $data['captcha'] = $this->recaptcha->getWidget();
        $cek_cont = $this->db->query("select * from mg_contents s JOIN md_users u ON u.users_id = s.users_id where s.menu_id = 5 AND s.cont_status = 2 AND s.cont_url = '$id' ORDER BY s.cont_id DESC")->last_row();
        if (!empty($cek_cont)) {
            $data['tips_dt'] = $this->db->query("select * from mg_contents s JOIN md_users u ON u.users_id = s.users_id where s.menu_id = 5 AND s.cont_status = 2 AND s.cont_url = '$id' ORDER BY s.cont_id DESC")->last_row();
            $this->is_visited(array("menu" => 5, "content" => $data['tips_dt']->cont_id ));
            $this->load->view("../folarpos/element/header",$data);
            $this->load->view("../folarpos/detail_career");
            $this->load->view("../folarpos/element/footer");
        } else {
            $this->load->view("../folarpos/element/header",$data);
            $this->load->view("../folarpos/404");
            $this->load->view("../folarpos/element/footer");
        }
    }
    
    public function career() {
        $data['apps'] = $this->systems();
        $data['tips'] = $this->db->query("select * from mg_contents s JOIN md_users u ON u.users_id = s.users_id where s.menu_id = 5 AND s.cont_status = 2 ORDER BY s.cont_id DESC")->result();
        
        $this->is_visited(array("menu" => 5));
        $data['script_captcha'] = $this->recaptcha->getScriptTag();
        $data['captcha'] = $this->recaptcha->getWidget();
        $this->load->view("../folarpos/element/header",$data);
        $this->load->view("../folarpos/career");
        $this->load->view("../folarpos/element/footer");
    }
    
    public function detail_products($id=null) {
        $data['apps'] = $this->systems();
        $data['tips_lates'] = $this->db->query("select * from mg_contents s JOIN md_users u ON u.users_id = s.users_id where s.menu_id = 4 AND s.cont_status = 2 ORDER BY s.cont_id DESC LIMIT 3")->result();
        $data['script_captcha'] = $this->recaptcha->getScriptTag();
        $data['captcha'] = $this->recaptcha->getWidget();
        $cek_prod = $this->db->query("select * from mg_products s JOIN md_users u ON u.users_id = s.users_id where s.prod_status = 2 AND s.prod_url = '$id' ORDER BY s.prod_id DESC")->last_row();
        if (!empty($cek_prod)) {           
                $data['prod_dt'] = $this->db->query("select * from mg_products s JOIN md_users u ON u.users_id = s.users_id where s.prod_status = 2 AND s.prod_url = '$id' ORDER BY s.prod_id DESC")->last_row();
                $this->is_visited(array("menu" => 10, "content" => $data['prod_dt']->prod_id )); 
                $this->load->view("../folarpos/element/header",$data);
                $this->load->view("../folarpos/detail_product");
                $this->load->view("../folarpos/element/footer");
        } else {
                $this->load->view("../folarpos/element/header",$data);
                $this->load->view("../folarpos/404");
                $this->load->view("../folarpos/element/footer");
        }
    }
    
    public function katalog() {
        $data['apps'] = $this->systems();
        $this->load->view("../folarpos/e-catalog/catalog_folarpos");
    }
    
    public function demo_products($id=null) {
        $data['apps'] = $this->systems();
        $data['prod_dt'] = $this->db->query("select * from mg_products s JOIN md_users u ON u.users_id = s.users_id where s.prod_status = 2 AND md5(s.prod_id) = '$id' ORDER BY s.prod_id DESC")->last_row();
        $demo = $data['prod_dt']->prod_demo;
        if (!empty($demo)) {
            header("Location: $demo");
            }
        $this->is_visited(array("menu" => 11, "content" => $data['prod_dt']->prod_id));
        $data['script_captcha'] = $this->recaptcha->getScriptTag();
        $data['captcha'] = $this->recaptcha->getWidget();
        $this->load->view("../folarpos/element/header",$data);
        $this->load->view("../folarpos/detail_product");
        $this->load->view("../folarpos/element/footer");
    }
    
    public function apps($dat = null) {
        $data['apps'] = $this->systems();
        if ($dat == 'help') {
            $data['cont'] = $this->db->query("select apps_help as content from apps")->last_row();
            $data['title']  = 'Bantuan';
        } else if ($dat == 'term') {
            $data['cont'] = $this->db->query("select apps_term as content from apps")->last_row();
            $data['title']  = 'Ketentuan';
        } else if ($dat == 'privacy'){
            $data['cont'] = $this->db->query("select apps_privacy as content from apps")->last_row();
            $data['title']  = 'Keamanan';
        } else if ($dat == 'profile'){
            $data['cont'] = $this->db->query("select apps_desc as content from apps")->last_row();
            $data['title']  = 'Profil Kami';
        }
        $data['tips_lates'] = $this->db->query("select * from mg_contents s JOIN md_users u ON u.users_id = s.users_id where s.menu_id = 4 AND s.cont_status = 2 ORDER BY s.cont_id DESC LIMIT 3")->result();
        $data['script_captcha'] = $this->recaptcha->getScriptTag();
        $data['captcha'] = $this->recaptcha->getWidget();
        $this->load->view("../folarpos/element/header",$data);
        $this->load->view("../folarpos/help_term_privacy");
        $this->load->view("../folarpos/element/footer");
    }
    
    public function gallery() {
        $data['apps'] = $this->systems();
        $data['tips_lates'] = $this->db->query("select * from mg_contents s JOIN md_users u ON u.users_id = s.users_id where s.menu_id = 4 AND s.cont_status = 2 ORDER BY s.cont_id DESC LIMIT 3")->result();
        $data['gal'] = $this->db->query("select * from mg_gallery where gal_status = 2 ORDER BY gal_id DESC")->result();
        foreach ($data['gal'] as $k => $val) {
            $data['gal_dt'][$k] = $this->db->query("select * from mg_gallery_dt where gal_id = $val->gal_id ORDER BY gal_dt_id ASC")->result();
        }        
        
        $this->is_visited(array("menu" => 6));
        $data['script_captcha'] = $this->recaptcha->getScriptTag();
        $data['captcha'] = $this->recaptcha->getWidget();
        $this->load->view("../folarpos/element/header",$data);
        $this->load->view("../folarpos/gallery");
        $this->load->view("../folarpos/element/footer");
    }
    
    public function contact_us() {
        $data['apps'] = $this->systems();
        $data['tips_lates'] = $this->db->query("select * from mg_contents s JOIN md_users u ON u.users_id = s.users_id where s.menu_id = 4 AND s.cont_status = 2 ORDER BY s.cont_id DESC LIMIT 3")->result();
        $data['script_captcha'] = $this->recaptcha->getScriptTag();
        $data['captcha'] = $this->recaptcha->getWidget();
        $this->load->view("../folarpos/element/header",$data);
        $this->load->view("../folarpos/contact_us");
        $this->load->view("../folarpos/element/footer");
    }
    
    public function receive_message() {
        $data['apps'] = $this->systems();
        $recaptcha = $this->input->post('g-recaptcha-response');
        $response = $this->recaptcha->verifyResponse($recaptcha);
        $dat['msg_author'] = ucwords(trim($this->input->post("msg_author")));
        $dat['msg_subject'] = strtolower(trim($this->input->post("msg_subject")));            
        $dat['msg_mail'] = strtolower(trim($this->input->post("msg_mail")));         
        $dat['msg_content'] = strtolower(trim($this->input->post("msg_content")));         
        $dat['apps_id'] = $data['apps']['app']->apps_id;         
        $dat['msg_read'] = 1;         
        $dat['msg_date'] = date("Y-m-d H:i:s");
        if ((!isset($response['success']) || $response['success'] <> true)) {
            $this->crud_model->insert_data("mg_msg", $dat);
            $this->session->set_flashdata('sukses_receive', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> Pesan berhasil terkirim kepada kami !</div>');
        } else {
            $this->session->set_flashdata('sukses_receive', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mr-10"></i> Ulangi Recaphta!</div>');
        }
        redirect('contact_us');
    }
    
    public function receive_referral() {
        $data['apps'] = $this->systems();
        $recaptcha = $this->input->post('g-recaptcha-response');
        $response = $this->recaptcha->verifyResponse($recaptcha);
        $dat['referral_name'] = strtolower(trim($this->input->post("ref_name")));            
        $dat['referral_mail'] = strtolower(trim($this->input->post("ref_mail")));         
        $dat['referral_phone'] = strtolower(trim($this->input->post("ref_hp")));         
        $dat['referral_client_name'] = strtolower(trim($this->input->post("ref_recomended")));        
        $dat['referral_client_bisnis'] = strtolower(trim($this->input->post("ref_bisnis_referral")));        
        $dat['referral_client_mail'] =strtolower(trim($this->input->post("ref_mail_referral")));
        $dat['referral_client_phone'] =strtolower(trim($this->input->post("ref_hp_referral")));
        $dat['referral_client_type_bisnis'] = strtolower(trim($this->input->post("ref_jenis_referral")));
        $dat['referral_client_info'] = strtolower(trim($this->input->post("ref_info")));
        $dat['referral_date'] = date("Y-m-d H:i:s");
        $dat['referral_status'] = 1;
        if ((!isset($response['success']) || $response['success'] <> true)) {
            $this->session->set_flashdata('referral', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mg-r-md"></i>Ulangi Recaptcha</div>');
            redirect('referral');
        } else {
            $cek = $this->Crud_model->check_referral($dat);
            if ($cek == TRUE) {
                $this->Crud_model->insert_data('mg_referral',$dat);
                //email
                $this->sendmailReferral($dat);
                $this->session->set_flashdata('referral', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mg-r-md"></i>Selamat bergabung menjadi Referral Folarpos, kami akan Follow up klien yang anda ajukan</div>');
                redirect('referral');
            } else {
                $this->session->set_flashdata('referral', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mg-r-md"></i>Klien yang anda ajukan sudah didaftarkan</div>');
                redirect('referral');
            }
        }
    }
    
    public function download_aplikasi(){
        $apps = $this->systems();
        $email = $this->input->post('mail');
        $company = $this->input->post('company');
        $phone = $this->input->post('phone');
        $name = $this->input->post('name');
        $data = array (
            'subs_mail' => $email
        );
        $cek = $this->Crud_model->check_exist('mg_subscribes',$data);
        if ($cek == TRUE) {
            $data_in = array (
                'subs_mail' => $email,
                'subs_name' => $name,
                'subs_company' => $company,
                'subs_phone' => $phone,
                'subs_date' => date("Y-m-d H:i:s")
            );
            $this->Crud_model->insert_data('mg_subscribes',$data_in);
            if (empty($apps['app']->apps_catalog)) {
                $this->session->set_flashdata('sukses', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mg-r-md"></i>Aplikasi berhasil didownload</div>');
                $data_d = $apps['app']->apps_catalog;
                force_download("$data_d", NULL);
                redirect();
            } else {
                $this->session->set_flashdata('sukses', '<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mg-r-md"></i>Maaf aplikasi belum tersedia</div>');
                redirect(); 
            }
            
        } else {
            $this->session->set_flashdata('sukses', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mg-r-md"></i>Anda telah mendapatkan penawaran sebelumnya, hubungi kami untuk lebih lanjut</div>');
            redirect();
        }
        
    }
    
    public function testimony() {
        $data['apps'] = $this->systems();
        $data['script_captcha'] = $this->recaptcha->getScriptTag();
        $data['captcha'] = $this->recaptcha->getWidget();
        $data['tips_lates'] = $this->db->query("select * from mg_contents s JOIN md_users u ON u.users_id = s.users_id where s.menu_id = 4 AND s.cont_status = 2 ORDER BY s.cont_id DESC LIMIT 3")->result();
        $data['testimony'] = $this->db->query("select * from mg_testimony where testi_status = 2 ORDER BY testi_id DESC")->result();
        $this->load->view("../folarpos/element/header",$data);
        $this->load->view("../folarpos/testimoni");
        $this->load->view("../folarpos/element/footer");        
    }
    
    public function referral() {
        $data['apps'] = $this->systems();
        $data['script_captcha'] = $this->recaptcha->getScriptTag();
        $data['captcha'] = $this->recaptcha->getWidget();
        $data['tips_lates'] = $this->db->query("select * from mg_contents s JOIN md_users u ON u.users_id = s.users_id where s.menu_id = 4 AND s.cont_status = 2 ORDER BY s.cont_id DESC LIMIT 3")->result();
        $this->load->view("../folarpos/element/header",$data);
        $this->load->view("../folarpos/referral");
        $this->load->view("../folarpos/element/footer");        
    }
    
    public function contents($pg_type = null, $pages = null, $dt = null) {
        $data['apps'] = $this->systems();
        $data['md_locs'] = $this->db->query("select * from md_location order by location_id DESC");
        $data['md_fac'] = $this->db->query("select * from md_facilities order by fac_id DESC");
        $data['md_type'] = $this->db->query("select * from md_prop_type order by prop_type_id ASC");

        $data['header'] = "hunianid/header/header_home";

        $data['cont_data'] = $this->db->query("select * from mg_content c JOIN mod_menu m on m.menu_id = c.menu_id where c.content_url = '$dt'")->last_row();
        $data['list_latest'] = $this->db->query("select * from mg_listing  l "
                        . "left JOIN mg_prop_unit au on au.unit_id = l.unit_id "
                        . "JOIN mg_properties a on a.prop_id = au.prop_id "
                        . "JOIN md_loc_area lc on lc.area_id = a.area_id JOIN md_location loc on loc.location_id = lc.location_id "
                        . "where l.list_status = 2 order by l.list_id DESC limit 3")->result();

        $data['latest_res'] = $this->db->query("select *, (select count(list_id) from mg_listing where prop_id = a.prop_id and list_status = 2) as total_listing from mg_properties a "
                        . "JOIN md_loc_area l on l.area_id = a.area_id JOIN md_location loc on loc.location_id = l.location_id order by a.prop_id DESC "
                        . "limit 6")->result();

        if ($pg_type == "data") {
            $data['apart'] = $this->db->get_where('mg_properties', array('prop_status' => 2))->num_rows();
            $data['personal'] = $this->db->get_where('md_users', array('users_status' => 2, 'users_agents_status' => 1))->num_rows();
            $data['agent'] = $this->db->get_where('md_users', array('users_status' => 2, 'users_agents_status' => 2))->num_rows();
            $data['lists'] = $this->db->get_where('mg_listing', array('list_status' => 2))->num_rows();

//            $data['sidebar'] = "frontend/sidebar";

            $data['pages'] = $this->db->query("select * from mod_menu where menu_url = '$pages'")->last_row();
            $data['title'] = $data['pages']->menu_title;
            $data['m_actived'] = $data['pages']->menu_id;
            if (!empty($data['pages'])) {

                $jml = $this->db->query("select * from mg_content where menu_id = " . $data['pages']->menu_id);
                $config['base_url'] = base_url("articles");
                $config['total_rows'] = $jml->num_rows();
                $config['per_page'] = 9; /* Jumlah data yang dipanggil perhalaman */
                $config['uri_segment'] = 2; /* data selanjutnya di parse diurisegmen 3 */
                //echo $this->uri->segment(2);
                /* Class bootstrap pagination yang digunakan */
                $config['full_tag_open'] = "<ul class='pagination pagination-sm' style='position:relative; top:-25px;'>";
                $config['full_tag_close'] = "</ul>";
                $config['num_tag_open'] = '<li>';
                $config['num_tag_close'] = '</li>';
                $config['cur_tag_open'] = "<li class='disabled'><li class='active'>";
                $config['cur_tag_close'] = "</a></li>";
                $config['next_tag_open'] = "<li>";
                $config['next_tagl_close'] = "</li>";
                $config['prev_tag_open'] = "<li>";
                $config['prev_tagl_close'] = "</li>";
                $config['first_tag_open'] = "<li>";
                $config['first_tagl_close'] = "</li>";
                $config['last_tag_open'] = "<li>";
                $config['last_tagl_close'] = "</li>";



                $this->pagination->initialize($config);
                $data['halaman'] = $this->pagination->create_links();
                /* membuat variable halaman untuk dipanggil di view nantinya */
                //$data['offset'] = $offset;
                if ($this->uri->segment(2) != null) {
                    $offset = $this->uri->segment(2);
                } else {
                    $offset = 0;
                }

                $data['cont_data'] = $this->db->query("select * from mg_content c JOIN mod_menu m on m.menu_id = c.menu_id where c.content_status = 1 and c.menu_id = " . $data['pages']->menu_id . " ORDER BY c.content_id DESC LIMIT " . $offset . "," . $config['per_page'])->result();
                $data['contact_send'] = 'contact-us/send';
                $data['content'] = "hunianid/" . (!empty($data['pages']->menu_page) ? $data['pages']->menu_page : "contents");
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {

                        $responseData = $this->catchCaptcha($_POST['g-recaptcha-response']);

                        if ($responseData == true) {
                            //contact form submission code
                            $data_msg['msg_author'] = !empty($_POST['name']) ? $_POST['name'] : '';
                            $data_msg['msg_content'] = !empty($_POST['message']) ? $_POST['message'] : '';
                            $data_msg['apps_id'] = 1;
                            $data_msg['msg_read'] = 1;
                            //$data_msg['msg_phone'] = !empty($_POST['phone']) ? $_POST['phone'] : '';
                            $data_msg['msg_subject'] = $_POST['subject'];
                            $data_msg['msg_mail'] = $_POST['email'];
                            $data_msg['msg_content'] = $_POST['message'];
                            $data_msg['msg_date'] = date("Y-m-d H:i:s");
                            $this->crud_model->insert_data("tr_msg", $data_msg);
                            $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mg-r-md"></i>Your contact request have submitted successfully.</div>');
                            redirect('contact-us');
                        } else {

                            $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mg-r-md"></i>Robot verification failed, please try again.</div>');
                        }
                    } else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info-circle mg-r-md"></i>Please Cek Recaptcha!.</div>');
                    }
                }
            }
            $data['blog_ads'] = $this->db->query("SELECT a.* FROM mg_ads a JOIN md_ads_position ap ON a.position_id = ap.position_id WHERE ap.position_id = 5 AND a.ads_expired > CURDATE() ORDER BY rand()")->last_row();
            $data['footer_ads'] = $this->db->query("SELECT a.* FROM mg_ads a JOIN md_ads_position ap ON a.position_id = ap.position_id WHERE ap.position_id = 1 AND a.ads_expired > CURDATE() ORDER BY rand()")->last_row();
            $this->load->view("../hunianid/index", $data);
        } elseif ($pg_type == "detail") {
            $data['js_load'] = "dashboard/extend/js_fancybox";
            if (!empty($data['cont_data'])) {
                $data['content'] = "hunianid/contents_dt";
                $data['title'] = ($pages == "menu" ? $data['cont_data']->menu_title : $data['cont_data']->content_title);
                $data['m_actived'] = $data['cont_data']->menu_id;
//                $data['sidebar'] = "frontend/sidebar";
                $data['footer_ads'] = $this->db->query("SELECT a.* FROM mg_ads a JOIN md_ads_position ap ON a.position_id = ap.position_id WHERE ap.position_id = 1 AND a.ads_expired > CURDATE() ORDER BY rand()")->last_row();
                $this->load->view("../hunianid/index", $data);
            } else {
                $data['heading'] = "404 Page Not Found";
                $data['message'] = "<p>The page you requested was not found.<hr style='width: 30%; float:left; margin-left: 10px'/><br/><a style='text-decoration: none; margin-left: 20px; color: grey' href='" . base_url() . "'> Back to HOMEPAGE</a></p>";
                $this->load->view("../errors/html/error_404", $data);
            }
        }
    }

    public function set_to($language) {
        if (strtolower($language) === 'english') {
            $lang = 'en';
        } else {
            $lang = 'in';
        }
        set_cookie(
                array(
                    'name' => 'lang_is',
                    'value' => $lang,
                    'expire' => '8650',
                    'prefix' => ''
                )
        );
    }
    
    public function sendmailReferral($dat) {
        //$email = $data['users_mail'];
        $from_email = 'no-reply@folarpos.co.id '; // ganti dengan email kalian
            $mail_message = '<html style="font-family:  Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                    <head>
                    <meta name="viewport" content="width=device-width" />
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <title>New Referral Folarpos</title>
                    <style type="text/css">
                    img {
                    max-width: 100%;
                    }
                    body {
                    -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em;
                    }
                    body {
                    background-color: #f6f6f6;
                    }
                    @media only screen and (max-width: 640px) {
                      body {
                        padding: 0 !important;
                      }
                      h1 {
                        font-weight: 800 !important; margin: 20px 0 5px !important;
                      }
                      h2 {
                        font-weight: 800 !important; margin: 20px 0 5px !important;
                      }
                      h3 {
                        font-weight: 800 !important; margin: 20px 0 5px !important;
                      }
                      h4 {
                        font-weight: 800 !important; margin: 20px 0 5px !important;
                      }
                      h1 {
                        font-size: 22px !important;
                      }
                      h2 {
                        font-size: 18px !important;
                      }
                      h3 {
                        font-size: 16px !important;
                      }
                      .container {
                        padding: 0 !important; width: 100% !important;
                      }
                      .content {
                        padding: 0 !important;
                      }
                      .content-wrap {
                        padding: 10px !important;
                      }
                      .invoice {
                        width: 100% !important;
                      }
                    }
                    </style>
                    </head>

                    <body style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">

                    <table class="body-wrap" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6"><tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
                                    <td class="container" width="600" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top">
                                            <div class="content" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
                                                    <table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope itemtype="http://schema.org/ConfirmAction" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" bgcolor="#fff"><tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                        <td class="content-wrap" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;" valign="top">
                                                                            <meta itemprop="name" content="Confirm Email" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;" />
                                                                            <table width="100%" cellpadding="0" cellspacing="0" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                                        <tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                                            <td class="content-block" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                                                                                    Dear Admin folarpos, Referral baru telah mendaftar, silahkan login untuk melihat Referral baru.
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                                            <td class="content-block" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 10px;" valign="top">
                                                                                                    <b>Refferal Name : </b> '.$dat[referral_name].'
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                                            <td class="content-block" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 10px;" valign="top">
                                                                                                    <b>Refferal Mail : </b> '.$dat[referral_mail].'
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                                            <td class="content-block" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 10px;" valign="top">
                                                                                                    <b>Refferal Phone : </b> '.$dat[referral_phone].'
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                                            <td class="content-block" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 10px;" valign="top">
                                                                                                    <b>Client Name : </b> '.$dat[referral_client_name].'
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                                            <td class="content-block" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 10px;" valign="top">
                                                                                                    <b>Client Mail : </b> '.$dat[referral_client_mail].'
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                                            <td class="content-block" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 10px;" valign="top">
                                                                                                    <b>Client Phone : </b> '.$dat[referral_client_phone].'
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                                            <td class="content-block" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 10px;" valign="top">
                                                                                                    <b>Client Bisnis : </b> '.$dat[referral_client_bisnis].'
                                                                                            </td>
                                                                                        </tr><tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                                            <td class="content-block" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 10px;" valign="top">
                                                                                                    <b>Client Type Bisnis : </b> '.$dat[referral_client_type_bisnis].'
                                                                                            </td>
                                                                                        </tr>
                                                                                        </tr><tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                                            <td class="content-block" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 10px;" valign="top">
                                                                                                    <b>Client Info : </b> '.$dat[referral_client_info].'
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                                                            <td class="content-block" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                                                                                    &mdash; FolarPOS
                                                                                            </td>
                                                                                    </tr>
                                                                            </table>
                                                            </td>
                                                            </tr></table><div class="footer" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;">
                                                            <table width="100%" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><tr style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="aligncenter content-block" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top">Follow <a href="" style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; color: #999; text-decoration: underline; margin: 0;">@folarpos</a> on Intagram.</td>
                                                                    </tr></table></div></div>
                                    </td>
                                    <td style="font-family: Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
                            </tr></table></body>
                    </html>';
            $config['smtp_host'] = 'folarpos.co.id'; // sesuaikan dengan host email
            $config['smtp_timeout'] = '7';
            $config['smtp_port'] = '465'; // sesuaikan
            $config['smtp_user'] = 'support@folarpos.co.id';
            $config['smtp_pass'] = 'suport3838'; // ganti dengan password email
            $config['mailtype'] = 'html';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $config['newline'] = "\r\n";
            $config['crlf'] = "\r\n";
            $this->email->initialize($config);

            $this->email->from($from_email, 'FolarPOS - New Referral');
            $this->email->to('fajarsusanto57@gmail.com','anggit@folarium.co.id','fachrur@folarium.co.id');
            $this->email->subject("Referral");
            $this->email->message($mail_message);
            if (!$this->email->send()) {
                return FALSE;
            } else {                
                return TRUE;
            }
//
    }

}
