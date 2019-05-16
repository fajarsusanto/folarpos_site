<?php

class Profile_m extends CI_Model {

    function check($id, $pass = null) {
        if (isset($pass)) {
            $this->db->where('users_password', $pass);
        }
        $this->db->where('users_id', $id);
        return $this->db->get('md_users');
    }
    function data_bank($el){
        $data['bank'] = $this->db->query("select * from md_users_bank ub join md_bank b on b.bank_id = ub.bank_id where ub.users_id = '$el'")->result();
        foreach ($data['bank'] as $nom => $row){
            $data['acc_bank'][$nom] = $row->bank_id;
            $data['acc_name'][$nom] = $row->users_bank_acc_name;
            $data['acc_nom'][$nom] = $row->users_bank_acc_number;
        }
        return $data;
    }

}

?>