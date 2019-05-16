<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Model {

    function __construct() {
        $this->tableName = 'md_users';
        $this->primaryKey = 'users_id';
    }

    public function checkUser($data = array()) {
        $this->db->select($this->primaryKey);
        $this->db->from($this->tableName);
        $this->db->where(array('facebook_id' => $data['facebook_id']));
        $prevQuery = $this->db->get();
        $prevCheck = $prevQuery->num_rows();

        if ($prevCheck > 0) {
            $prevResult = $prevQuery->row_array();
            $update = $this->db->update($this->tableName, $data, array('users_id' => $prevResult['users_id']));
            $userID = $prevResult['users_id'];
        } else {

            $userID = '';
        }

        return $userID ? $userID : FALSE;
    }

}
