<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crud_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->db->flush_cache();
    }

    public function insert_data($table, $fordata) {
        return $this->db->insert($table, $fordata);
    }

    public function update_data($table, $content, $selection) {
        $this->db->where($selection, $content[$selection]);
        $this->db->update($table, $content);
    }

    public function read_data($table, $fordata = null, $orderby = null, $joined = null, $limit = null, $group = null, $select = null) {
        if (isset($select)) {
            $this->db->select($select);
        }
        if (!empty($limit)) {
            $this->db->limit($limit);
        }
        if (isset($fordata)) {
            $this->db->where($fordata);
        }
        if (!empty($group)) {
            $this->db->group_by("$group");
        }
        if (isset($joined)) {
            foreach ($joined as $tabled => $inisiasi) {
                if (is_array($inisiasi)) {
                    $this->db->join($tabled, $inisiasi[0], $inisiasi[1]);
                } else {
                    $this->db->join($tabled, $inisiasi);
                }
            }
        }
        if (isset($orderby)) {
            foreach ($orderby as $condition => $act) {
                $this->db->order_by($condition, $act);
            }
        }
        if (is_array($table)) {
            $get = $this->db->get($table[0], $table[1], $table[2]);
        } else {
            $get = $this->db->get($table);
        }
        return $get;
    }

    public function read_fordata($fordata = NULL) {
        if (isset($fordata['select'])) {
            $this->db->select($fordata['select'], false);
        }

        if (!empty($fordata['limit'])) {
            if (count($fordata['limit']) > 1) {
                $this->db->limit($fordata['limit'][0], $fordata['limit'][1]);
            } else {
                $this->db->limit($fordata['limit']);
            }
        }

        if (isset($fordata['where'])) {
            $this->db->where($fordata['where']);
        }

        if (isset($fordata['or_where'])) {
            $this->db->or_where($fordata['or_where']);
        }

        if (isset($fordata['like'])) {
            foreach ($fordata['like'] as $column => $inisiasi) {
                if (is_array($inisiasi)) {
                    $this->db->like($column, $inisiasi[0], $inisiasi[1]);
                } else {
                    $this->db->like($column, $inisiasi);
                }
            }
        }

        if (isset($fordata['group'])) {
            $this->db->group_by($fordata['group']);
        }

        if (isset($fordata['join'])) {
            foreach ($fordata['join'] as $tabled => $inisiasi) {
                if (is_array($inisiasi)) {
                    $this->db->join($tabled, $inisiasi[0], $inisiasi[1]);
                } else {
                    $this->db->join($tabled, $inisiasi);
                }
            }
        }

        if (isset($fordata['order'])) {
            foreach ($fordata['order'] as $condition => $act) {
                $this->db->order_by($condition, $act);
            }
        }

        if (is_array($fordata['table'])) {
            $get = $this->db->get($fordata['table'][0], $foradata['table'][1], $foradata['table'][2]);
        } else {
            $get = $this->db->get($fordata['table']);
        }

        return $get;
    }

    public function read_sg_data($table, $fordata = null, $orderby = null, $joined = null, $limit = null, $group = null, $select = null) {
        if (isset($select)) {
            $this->db->select($select);
        }
        if (!empty($limit)) {
            $this->db->limit($limit);
        }
        if (isset($fordata)) {
            $this->db->where($fordata);
        }
        if (!empty($group)) {
            $this->db->group_by("$group");
        }
        if (isset($joined)) {
            foreach ($joined as $tabled => $inisiasi) {
                if (is_array($inisiasi)) {
                    $this->db->join($tabled, $inisiasi[0], $inisiasi[1]);
                } else {
                    $this->db->join($tabled, $inisiasi);
                }
            }
        }
        if (isset($orderby)) {
            foreach ($orderby as $condition => $act) {
                $this->db->order_by($condition, $act);
            }
        }
        if (is_array($table)) {
            $get = $this->db->get($table[0], $table[1], $table[2]);
        } else {
            $get = $this->db->get($table);
        }
        return $get;
    }

    public function delete_data($table, $data = null) {
        if (isset($data)) {
            $this->db->where($data);
        }
        return $this->db->delete($table);
    }

    public function json_autocomplete($search, $table, $column) {
        $sql = "SELECT * FROM $table WHERE $column LIKE '%$search%'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function check_exist($table, $data) {
        $this->db->where($data);
        $sql = $this->db->get($table)->num_rows();
        if ($sql > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    public function check_referral($data) {
        $this->db->where("referral_client_mail = '".$data['referral_client_mail']."'");
        $this->db->where("referral_client_phone = '".$data['referral_client_phone']."'");
        $sql = $this->db->get('mg_referral')->num_rows();
        if ($sql > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function upload($path = null, $fupload_name, $var = null, $width = null) {
        $vdir_upload = !empty($path) ? "./assets/$path/" : "./assets/image/";
        $vfile_upload = $vdir_upload . $fupload_name;
        $variable = empty($var) ? 'foto' : $var;
        $s = move_uploaded_file($_FILES["$variable"]["tmp_name"], $vfile_upload);
        $tipe_file = $_FILES["$variable"]['type'];
//        if ($tipe_file == "image/png") {
//            $im_src = imagecreatefrompng($vfile_upload);
//            $src_width = imageSX($im_src);
//            $src_height = imageSY($im_src);
//            $dst_width = isset($width) ? $width : 505;
//            $dst_height = ($dst_width / $src_width) * $src_height;
//            $im = imagecreatetruecolor($dst_width, $dst_height);
////            imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
//            $nm = imagepng($im, $vdir_upload . "" . $fupload_name);
//            imagedestroy($im_src);
//            imagedestroy($im);
//        }
        if ($s == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
public function upload_multi($path = null, $fupload_name, $var = null, $el) {
        $vdir_upload = !empty($path) ? "./assets/$path/" : "./assets/files/";
        $vfile_upload = $vdir_upload . $fupload_name;
        $variable = empty($var) ? 'files' : $var;
        $s = move_uploaded_file($_FILES["$variable"]["tmp_name"][$el], $vfile_upload);
        $tipe_file = $_FILES["$variable"]['type'][$el];
//        if ($tipe_file == "image/png") {
//            $im_src = imagecreatefrompng($vfile_upload);
//            $src_width = imageSX($im_src);
//            $src_height = imageSY($im_src);
//            $dst_width = isset($width) ? $width : 505;
//            $dst_height = ($dst_width / $src_width) * $src_height;
//            $im = imagecreatetruecolor($dst_width, $dst_height);
////            imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
//            $nm = imagepng($im, $vdir_upload . "" . $fupload_name);
//            imagedestroy($im_src);
//            imagedestroy($im);
//        }
        if ($s == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function unlink($file) {
        $cek_file = file_exists($file);
        if ($cek_file) {
            unlink($file);
        }
    }

    public function get_id($table, $column, $data) {
        $this->db->where($data);
        $sql = $this->db->get($table);
        if ($sql->num_rows() > 0) {
            $column = $column;
            return $sql->row()->$column;
        } else {
            return NULL;
        }
    }

}
