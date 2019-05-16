<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_model extends CI_Model {    
    public function __construct() {
        parent::__construct();
    }

    private $tables = "md_users";

    public function shows($status = null) {

        $this->db->select("u.users_id, u.users_registered, p.position_name, u.users_joined, u.users_mail, u.users_name, u.users_status");
        $this->db->join('md_roles r', 'r.roles_id = u.roles_id');
        $this->db->join('md_position p', 'p.position_id = u.position_id');
        $this->db->where('u.users_type', 1);
        return $this->db->get("$this->tables u")->result();
    }

    function get_by_id($id) {

        $this->db->join('md_roles r', 'r.roles_id = u.roles_id');
        $this->db->join('md_position p', 'p.position_id = u.position_id');
        $this->db->where('md5(u.users_id)', $id);
        return $this->db->get("$this->tables u")->last_row();
    }

    public function show_dt($id) {
        $detail = array();
        if ($id) {
            $check_data = $this->db->query("select * from $this->tables where md5(position_id) = '$id'")->last_row();
            if (!empty($check_data)) {
                $detail = $check_data;
            }
        }
        return $detail;
    }

    public function show_pn_pos() {

        $this->db->order_by("position_name", "ASC");
        return $this->db->get("md_position")->result();
    }

    public function show_pn_rol() {

        $this->db->order_by("roles_name", "ASC");
        return $this->db->get("md_roles")->result();
    }

    public function check_data_exist($data) {
        $this->db->where('users_mail', $data['users_mail']);

        if (!empty($data['users_id'])) {
            $this->db->where_not_in('users_id', $data['users_id']);
        }

        $result = $this->db->get('md_users');

        if ($result->num_rows() > 0) {
            return array('check' => true);
        } else {
            return array('check' => false);
        }
    }

}
