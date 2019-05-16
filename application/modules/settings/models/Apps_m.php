<?php

class Apps_m extends CI_Model {

    function data_bank($el) {
        $data['bank'] = $this->db->query("select * from cf_apps_bank ub join md_bank b on b.bank_id = ub.bank_id where ub.apps_id = '$el'")->result();
        foreach ($data['bank'] as $nom => $row) {
            $data['acc_bank'][$nom] = $row->bank_id;
            $data['acc_name'][$nom] = $row->apps_bank_acc_name;
            $data['acc_nom'][$nom] = $row->apps_bank_acc_nom;
        }
        return $data;
    }
    
    function notif_count() {
        $query = $this->db->query("SELECT *,(SELECT COUNT(nr.apps_notif) FROM apps_notif_read nr WHERE n.apps_notif = nr.apps_notif ) AS status_read FROM apps_notif n");
        return $query->num_rows();
	}

    function getnotifikasi() {
        $query = $this->db->query("SELECT *,(SELECT COUNT(nr.apps_notif) FROM apps_notif_read nr WHERE n.apps_notif = nr.apps_notif ) AS status_read FROM apps_notif n ORDER BY n.notif_date DESC LIMIT 5");

        if ($query->num_rows() >0) {
            return $query->result();
        }
    }

}

?>