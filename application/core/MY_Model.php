<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function unit_entry($param = null) {
        $select_variable = "services_id";
        if (!empty($param['select'])) {
            $select_variable = "";
            foreach ($param['select'] as $dec_nom => $declare) {
                $select_variable .= (($dec_nom > 0) ? ", " : null) . "$declare";
            }
        }
        $ahass_set = (!empty($param['ahass']) ? " and dealer_id = '$param[ahass]'" : null);
        $sql = $this->db->query("select $select_variable from tr_services where DATE(services_date) = '$param[date]' $ahass_set");
        if ($param['sql_type'] == 'count') {
            return $sql->num_rows();
        } elseif ($param['sql_type'] == 'row') {
            return $sql->last_row();
        } else {
            return $sql->result();
        }
    }

    public function job_type($param = null, $by_month = null) {
        if (!empty($by_month)) {
            $declare = $this->db->query("select services_job as data from tr_services "
                            . "where dealer_id = $param[ahass] and "
                            . "MONTH(services_date) = '$param[m]' and YEAR(services_date) = '$param[y]'")->result();
        } else {
            $declare = $this->db->query("select services_job as data from tr_services "
                            . "where dealer_id = $param[ahass] and "
                            . "DATE(services_date) = '$param[date]'")->result();
        }
        $total = 0;
        foreach ($declare as $d_nom => $d_row) {
            if (!empty($d_row->data)) {
                $total_kpb[$d_nom] = 0;
                foreach (json_decode($d_row->data) as $dec_nom => $dec_row) {
                    $kpb_cvt = (!empty($param['kpb_type']) ? "and services_group_type = $param[kpb_type]" : "");
                    $check_kpb = $this->db->query("select services_group_id from md_services_group where services_group_id = $dec_nom $kpb_cvt")->last_row();
                    if (!empty($check_kpb)) {
                        if ($param['type'] == "count") {
                            $total_kpb[$d_nom] += 1;
                        } else {
                            $total += $dec_row;
                        }
                    }
                }
                if ($param['type'] == "count") {
                    $total += ($total_kpb[$d_nom] > 0 ? 1 : 0);
                }
            }
        }
        return $total;
    }

    public function job_type_declare($param) {
        $data['md_job'] = $this->db->query("select * from md_services_group order by services_group_post ASC")->result();
        $data['unit_entry'] = $this->db->query("select services_job as data from tr_services "
                        . "where dealer_id = $param[ahass] and "
                        . "DATE(services_date) = '$param[date]'")->result();
        foreach ($data['md_job'] as $j_nom => $j_row) {
            $ue[$j_nom] = 0;
            $rev[$j_nom] = 0;
            foreach ($data['unit_entry'] as $d_nom => $d_row) {
                if (!empty($d_row->data)) {
                    if ($d_row->data != "null") {
                        foreach (json_decode($d_row->data) as $dec_nom => $dec_row) {
                            if ($j_row->services_group_id == $dec_nom) {
                                $ue[$j_nom] += 1;
                                $rev[$j_nom] += $dec_row;
                            }
                        }
                    }
                }
            }
            $data['total_ue'][$j_nom] = $ue[$j_nom];
            $data['total_rev'][$j_nom] = $rev[$j_nom];
        }
        return $data;
    }

    public function rev_olie_declare($param, $by_month = null) {
        if (!empty($by_month)) {
            $data['unit_entry'] = $this->db->query("select services_sparepart as data from tr_services "
                            . "where dealer_id = $param[ahass] and "
                            . "MONTH(services_date) = '$param[m]' and YEAR(services_date) = '$param[y]'")->result();
        } else {
            $data['unit_entry'] = $this->db->query("select services_sparepart as data from tr_services "
                            . "where dealer_id = $param[ahass] and "
                            . "DATE(services_date) = '$param[date]'")->result();
        }
        $ue = 0;
        $rev = 0;
        foreach ($data['unit_entry'] as $d_nom => $d_row) {
            if (!empty($d_row->data)) {
                if ($d_row->data != "null") {
                    foreach (json_decode($d_row->data) as $dec_nom => $dec_row) {
                        if ($dec_row[2] == $param['olie']) {
                            $ue += 1;
                            $rev += $dec_row[1];
                        }
                    }
                }
            }
        }
        $data['total_ue'] = $ue;
        $data['total_rev'] = $rev;
        return $data;
    }

    public function rev_part_declare($param) {
        $data['md_part'] = $this->db->query("select * from md_sparepart_group order by sparepart_group_post ASC")->result();
        $data['unit_entry'] = $this->db->query("select services_sparepart as data from tr_services "
                        . "where dealer_id = $param[ahass] and "
                        . "DATE(services_date) = '$param[date]'")->result();
        foreach ($data['md_part'] as $j_nom => $j_row) {
            $ue[$j_nom] = 0;
            $rev[$j_nom] = 0;
            foreach ($data['unit_entry'] as $d_nom => $d_row) {
                if (!empty($d_row->data)) {
                    if ($d_row->data != "null") {
                        foreach (json_decode($d_row->data) as $dec_nom => $dec_row) {
                            if ($j_row->sparepart_group_id == $dec_nom) {
                                $ue[$j_nom] += 1;
                                $rev[$j_nom] += $dec_row[1];
                            }
                        }
                    }
                }
            }
            $data['total_ue'][$j_nom] = $ue[$j_nom];
            $data['total_rev'][$j_nom] = $rev[$j_nom];
        }
        return $data;
    }

    public function ue_arrival_declare($param) {
        $data['md_uea'] = $this->db->query("select * from md_ue_arrival order by ue_arrival_post ASC")->result();
        foreach ($data['md_uea'] as $j_nom => $j_row) {
            $ue[$j_nom] = 0;
            $rev_part[$j_nom] = 0;
            $rev_olie[$j_nom] = 0;
            $rev_job[$j_nom] = 0;
            $rev_job_kpb[$j_nom] = 0;
            $data['ue'][$j_nom] = $this->db->query("select services_sparepart as part, services_job as job  from tr_services "
                            . "where dealer_id = $param[ahass] and ue_arrival_id = $j_row->ue_arrival_id and "
                            . "DATE(services_date) = '$param[date]'")->result();

            foreach ($data['ue'][$j_nom] as $d_nom => $d_row) {
                if (!empty($d_row->part)) {
                    if ($d_row->part != "null") {
                        foreach (json_decode($d_row->part) as $part_nom => $part_row) {
                            if (!empty($part_row[2])) {
                                $rev_olie[$j_nom] += $part_row[1];
                            } else {
                                $rev_part[$j_nom] += $part_row[1];
                            }
                        }
                    }
                }
                if (!empty($d_row->job)) {
                    if ($d_row->job != "null") {
                        foreach (json_decode($d_row->job) as $job_nom => $job_row) {
                            $rev_job[$j_nom] += $job_row;
                            $check_kpb[$j_nom] = $this->db->query("select services_group_id from md_services_group where services_group_id = $job_nom and services_group_type = '2'")->last_row();
                            if (!empty($check_kpb[$j_nom])) {
                                $rev_job_kpb[$j_nom] += 1;
                            }
                        }
                    }
                }

                $ue[$j_nom] += 1;
            }
            $data['total_ue'][$j_nom] = $ue[$j_nom];
            $data['total_ue_kpb'][$j_nom] = ($rev_job_kpb[$j_nom]);
            $data['total_ue_kpb_non'][$j_nom] = str_replace("-", "", $data['total_ue'][$j_nom] - $data['total_ue_kpb'][$j_nom]);
            $data['total_rev_part'][$j_nom] = $rev_part[$j_nom];
            $data['total_rev_olie'][$j_nom] = $rev_olie[$j_nom];
            $data['total_rev_job'][$j_nom] = $rev_job[$j_nom];
            $data['total_rev'][$j_nom] = ($rev_part[$j_nom] + $rev_olie[$j_nom] + $rev_job[$j_nom]);
        }
        return $data;
    }

    public function sparepart($param = null, $by_month = null) {
        if (!empty($by_month)) {
            $declare = $this->db->query("select services_sparepart as data from tr_services "
                            . "where dealer_id = $param[ahass] and "
                            . "MONTH(services_date) = '$param[m]' and YEAR(services_date) = '$param[y]'")->result();
        } else {
            $declare = $this->db->query("select services_sparepart as data from tr_services "
                            . "where dealer_id = $param[ahass] and "
                            . "DATE(services_date) = '" . date("Y-m-d", strtotime($param['date'])) . "'")->result();
        }
        $total = 0;
        foreach ($declare as $d_nom => $d_row) {

            if (!empty($d_row->data)) {
                if ($d_row->data != "null") {
                    foreach (json_decode($d_row->data) as $dec_nom => $dec_row) {
                        if (!empty($param['olie'])) {
                            if ($dec_nom == 3) {
                                if ($param['type'] == "count") {
                                    $total += 1;
                                } else {
                                    $total += $dec_row[1];
                                }
                            }
                        } else {
                            if ($dec_nom != 3) {
                                if ($param['type'] == "count") {
                                    $total += 1;
                                } else {
                                    $total += $dec_row[1];
                                }
                            }
                        }
                    };
                }
            }
        }

        return $total;
    }

    public function master_srv_group() {
        return $this->db->query("select * from md_services_group order by services_group_post ASC")->result();
    }

}
