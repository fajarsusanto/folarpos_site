<?php

if (!defined('BASEPATH'))
    exit('No direct access allowed');

class Dashboard extends MY_Controller {

    private $url_index = "dashboard";

    public function __construct() {
        parent::__construct();
        is_logged_in();
    }

    public function index() {
        $data['sess'] = $this->authentication_root();
        $data['dash_m'] = "active";
        $data['title'] = 'Home - Dashboard';
        $data['count_prod'] = $this->db->query("select count(prod_id) as jml from mg_products")->last_row();
        $data['count_testi'] = $this->db->query("select count(testi_id) as jml from mg_testimony")->last_row();
        $data['count_msg'] = $this->db->query("select count(msg_id) as jml from mg_msg")->last_row();
        $data['count_subs'] = $this->db->query("select count(subs_id) as jml from mg_subscribes")->last_row();
        $data['tahun'] = $this->db->query("select YEAR(read_date) as tahun from log_read GROUP BY YEAR(read_date) ORDER BY YEAR(read_date) ASC")->result();
  
        $data['content'] = "index";
        $this->load->view("../manage/index", $data);
    }

    public function folarium() {
        $data['sess'] = $this->authentication_root();
        $this->load->view("dashboard/extend/about", $data);
    }

    public function latest_news() {
        $latest = $this->db->query("select * from mg_content c join mod_menu m on m.menu_id = c.menu_id where m.menu_id = '4' order by c.content_id DESC limit 4")->result();
        foreach ($latest as $nom => $row) {
            $data['title'][$nom] = $row->content_id;
            $data['resume'][$nom] = shortext($row->content_desc, 200);
            $data['posted'][$nom] = indo_date($row->content_date, 1, 1);
            $data['url'][$nom] = $row->content_url;
            $data['header'][$nom] = $row->content_img;
        }
        json_encode($data);
    }
    
    public function column($year,$type_d) {
        $data['sess'] = $this->authentication_root();  
        $sql_year = 'AND year(mm.read_date) = '.$year;
        $data['devicee'] = $this->db->query("select read_device, read_id from log_read group by read_device")->result();
        foreach ($data['devicee'] as $k => $val) {
            $data['device'][$k] = $this->db->query("select m.read_device , "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '01' $sql_year AND mm.read_device ='$val->read_device') as januari, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '02' $sql_year AND mm.read_device ='$val->read_device') as februari, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '03' $sql_year AND mm.read_device ='$val->read_device') as maret, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '04' $sql_year AND mm.read_device ='$val->read_device') as april, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '05' $sql_year AND mm.read_device ='$val->read_device') as mei, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '06' $sql_year AND mm.read_device ='$val->read_device') as juni, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '07' $sql_year AND mm.read_device ='$val->read_device') as juli, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '08' $sql_year AND mm.read_device ='$val->read_device') as agustus, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '09' $sql_year AND mm.read_device ='$val->read_device') as september, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '10' $sql_year AND mm.read_device ='$val->read_device') as oktober, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '11' $sql_year AND mm.read_device ='$val->read_device') as november, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '12' $sql_year AND mm.read_device ='$val->read_device') as desember "
                        . " from log_read m "
                        . "")->last_row();
        }
        
        $this->load->view("dashboard/column", $data);
    }
    
    public function column_by_product($year,$type_d) {
        $data['sess'] = $this->authentication_root();  
        $sql_year = 'AND year(mm.read_date) = '.$year;
        $data['devicee'] = $this->db->query("select p.prod_id, p.prod_name, l.read_id from log_read l JOIN mg_products p ON p.prod_id = l.ref_id where l.menu_id =11 group by l.ref_id")->result();
        foreach ($data['devicee'] as $k => $val) {
            $data['device'][$k] = $this->db->query("select m.read_device , "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '01' $sql_year AND mm.ref_id =$val->prod_id AND mm.menu_id = 11) as januari, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '02' $sql_year AND mm.ref_id =$val->prod_id AND mm.menu_id = 11) as februari, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '03' $sql_year AND mm.ref_id =$val->prod_id AND mm.menu_id = 11) as maret, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '04' $sql_year AND mm.ref_id =$val->prod_id AND mm.menu_id = 11) as april, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '05' $sql_year AND mm.ref_id =$val->prod_id AND mm.menu_id = 11) as mei, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '06' $sql_year AND mm.ref_id =$val->prod_id AND mm.menu_id = 11) as juni, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '07' $sql_year AND mm.ref_id =$val->prod_id AND mm.menu_id = 11) as juli, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '08' $sql_year AND mm.ref_id =$val->prod_id AND mm.menu_id = 11) as agustus, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '09' $sql_year AND mm.ref_id =$val->prod_id AND mm.menu_id = 11) as september, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '10' $sql_year AND mm.ref_id =$val->prod_id AND mm.menu_id = 11) as oktober, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '11' $sql_year AND mm.ref_id =$val->prod_id AND mm.menu_id = 11) as november, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '12' $sql_year AND mm.ref_id =$val->prod_id AND mm.menu_id = 11) as desember "
                        . " from log_read m "
                        . "")->last_row();
        }
        
        $this->load->view("dashboard/column_by_product", $data);
    }
    
    public function column_by_content($year,$type_d) {
        $data['sess'] = $this->authentication_root();  
        $sql_year = 'AND year(mm.read_date) = '.$year;
        $data['devicee'] = $this->db->query("select p.cont_id, p.cont_title, l.read_id from log_read l JOIN mg_contents p ON p.cont_id = l.ref_id where l.menu_id =4 group by l.ref_id")->result();
        foreach ($data['devicee'] as $k => $val) {
            $data['device'][$k] = $this->db->query("select m.read_device , "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '01' $sql_year AND mm.ref_id =$val->cont_id AND mm.menu_id = 4) as januari, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '02' $sql_year AND mm.ref_id =$val->cont_id AND mm.menu_id = 4) as februari, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '03' $sql_year AND mm.ref_id =$val->cont_id AND mm.menu_id = 4) as maret, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '04' $sql_year AND mm.ref_id =$val->cont_id AND mm.menu_id = 4) as april, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '05' $sql_year AND mm.ref_id =$val->cont_id AND mm.menu_id = 4) as mei, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '06' $sql_year AND mm.ref_id =$val->cont_id AND mm.menu_id = 4) as juni, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '07' $sql_year AND mm.ref_id =$val->cont_id AND mm.menu_id = 4) as juli, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '08' $sql_year AND mm.ref_id =$val->cont_id AND mm.menu_id = 4) as agustus, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '09' $sql_year AND mm.ref_id =$val->cont_id AND mm.menu_id = 4) as september, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '10' $sql_year AND mm.ref_id =$val->cont_id AND mm.menu_id = 4) as oktober, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '11' $sql_year AND mm.ref_id =$val->cont_id AND mm.menu_id = 4) as november, "
                        . "(select count(mm.read_id) from log_read mm WHERE month(mm.read_date) = '12' $sql_year AND mm.ref_id =$val->cont_id AND mm.menu_id = 4) as desember "
                        . " from log_read m "
                        . "")->last_row();
        }
        
        $this->load->view("dashboard/column_by_content", $data);
    }
    
    public function pie_by_product($year,$type_d) {
        $data['sess'] = $this->authentication_root(); 
        $sql_year = 'AND year(m.read_date) = '.$year;
        $sql_device = !empty($type_d) && $type_d != 'all' ? "AND m.read_device = '".$type_d."'": NULL;
        $data['type_prop'] = $this->db->query("select prod_name, prod_id from mg_products ORDER BY prod_id ASC")->result();
        foreach ($data['type_prop'] as $nn1 => $r1) {
            $data['count'][$nn1] = $this->db->query("select count(m.read_id) as jum_read, m.read_date from log_read m "
                            . "join mg_products p ON p.prod_id = m.ref_id "
                            . "WHERE p.prod_id = $r1->prod_id AND m.menu_id = 11 $sql_device $sql_year ")->last_row()->jum_read;
        }
        $this->load->view("dashboard/pie_by_product", $data);
    }   
    
    public function gauge($year=null,$type_d=null) {
        $data['sess'] = $this->authentication_root(); 
        $this->load->view("dashboard/gauge");
    }
    
    
    public function bar() {
        $data['sess'] = $this->authentication_root();
        if (!empty($_GET['range'])) {
            $dateny = explode("_", $_GET['range']);
            $date_start = $dateny[0];
            $date_end = $dateny[1];

            $dayb_ = $date_start;
            $dayb__ = $date_end;

            $data['default_range'] = indo_date($dayb_) . ' - ' . indo_date($dayb__);
        } else {
            $dayb = mktime(0, 0, 0, date('m'), date('d') - 45, date('Y'));
            $daybb = mktime(0, 0, 0, date("m"), date("d"), date("Y"));

            $dayb_ = date("Y", $dayb) . '-' . date("m", $dayb) . '-' . date("d", $dayb);
            $dayb__ = date("Y", $daybb) . '-' . date("m", $daybb) . '-' . date("d", $daybb);
            $data['default_range'] = indo_date($dayb_) . ' - ' . indo_date($dayb__);
        }

        $data['array'] = '';
        $data['type'] = $this->db->query("select tp.read_device, tp.menu_id, tp.read_date from log_read tp "
                . "WHERE menu_id = 4 AND (DATE(tp.read_date) BETWEEN '$dayb_' and '$dayb__') GROUP BY tp.ref_id ASC");
        foreach ($data['type']->result() as $nt => $nr) {
            $data['ttek'] = '';
            $data['t_'][$nt] = $this->db->query("select m.maint_date from mg_maintenance m "
                            . "WHERE ( DATE(m.maint_date) BETWEEN '$dayb_' and '$dayb__' ) GROUP BY DATE(m.maint_date) ASC ")->result();

            foreach ($data['t_'][$nt] as $ntt => $rtt) {

                $data['ctype'][$nt] = $this->db->query("select count(type_id) as tpe from mg_maintenance m "
                                . "WHERE ( DATE(m.maint_date) = '$rtt->maint_date' ) AND m.type_id = '$nr->type_id' ")->result();

                foreach ($data['ctype'][$nt] as $nnn => $rtd) {
                    $data['ctype_'][$nt] = '';
                    $koma = ( ( $ntt + 1 ) % count($data['t_'][$nt]) == 0 ? '|' : ',' );
                    $data['ctype_'][$nt] .= $rtd->tpe . $koma;
                    $data['ttek'] .= $data['ctype_'][$nt];
                }
            }
            $data['array'] .= $data['ttek'];
        }


        $data['tanggal_array'] = $this->db->query("select m.maint_date from mg_maintenance m "
                        . "WHERE ( DATE(m.maint_date) BETWEEN '$dayb_' and '$dayb__' ) GROUP BY DATE(m.maint_date) ASC ")->result();
        $data['tanggal'] = '';
        foreach ($data['tanggal_array'] as $nt => $rt) {
            $data['tanggal'] .= "'" . indo_date($rt->maint_date) . "'" . ', ';
        }
        $data['tanggal_new'] = $data['tanggal'];

        $this->load->view("dashboard/bar", $data);
    }

}
