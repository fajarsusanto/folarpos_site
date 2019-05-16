<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_m extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function target($dealer = null, $target = null, $year = null) {
        $year_cvt = (empty($year) ? date("Y") : $year);
        $target_cvt = (!empty($target) ? ($target != 'all' ? " where md5(target_id) = '$target' " : null) : null);
        $data['target_master'] = $this->db->query("select * from md_target $target_cvt order by target_id ASC")->result();
        if (!empty($dealer)) {
            foreach ($data['target_master'] as $nom_tm => $row_tm) {
                $data['target'][$nom_tm] = $this->db->query("select * from cf_target where dealer_id = $dealer and target_set_year = '$year_cvt' and target_id = $row_tm->target_id")->last_row();
                if ($row_tm->target_method == 1) {

                    if (!empty($data['target'][$nom_tm])) {
                        $data['acv'][$nom_tm] = $this->db->query("select * from cf_target_acv where target_set_id = " . $data['target'][$nom_tm]->target_set_id)->last_row();
                        for ($ii = 1; $ii <= 12; $i++) {
                            $target_descs = "target_set_" . $ii;
                            $target_acv_descs = "target_acv_" . $ii;
                            if (!empty($data['acv'][$nom_tm])) {
                                $data['result_acv'][$nom_tm][$ii] = percentage_cvt($data['acv'][$nom_tm]->$target_acv_descs, $data['target'][$nom_tm]->$target_descs);
                            }
                        }
                    }
                } else {
                    if ($row_tm->target_code == 1) {
                        for ($i = 1; $i <= 12; $i++) {
                            $data['acv'][$nom_tm][$i] = $this->db->query("select * from tr_services where dealer_id = $dealer and YEAR(services_date) = '$year_cvt' and MONTH(services_date)='$i'")->num_rows();
                            $target_desc = "target_set_" . $i;
                            if (!empty($data['acv'][$nom_tm][$i])) {
                                $data['result_acv'][$nom_tm][$i] = !empty($data['target'][$nom_tm]->$target_desc) ? percentage_cvt($data['acv'][$nom_tm][$i], $data['target'][$nom_tm]->$target_desc) : 0;
                            }
                        }
                    } elseif ($row_tm->target_code == 2) {
                        for ($ix = 1; $ix <= 12; $ix++) {
                            $target_desc_3 = "target_set_" . $ix;
                            $dealer_profile_cvti = $this->achv_target(array('dlr' => "$dealer", "y" => "$year_cvt", "m" => "$ix"));

                            if ($dealer_profile_cvti['status'] == 1) {
                                if (!empty($dealer_profile_cvti['frontdesk'])) {
                                    $data['acv'][$nom_tm][$ix] = $dealer_profile_cvti['frontdesk']['total'];
                                    $pit_cvti = (!empty($data['acv'][$nom_tm][$ix]) ? $data['acv'][$nom_tm][$ix] : 0);
                                    $data['result_acv'][$nom_tm][$ix] = (!empty($data['target'][$nom_tm]->$target_desc_3) ? percentage_cvt($pit_cvti, $data['target'][$nom_tm]->$target_desc_3) : 0);
                                }
                            }
                        }
                    } elseif ($row_tm->target_code == 3) {
                        for ($iix = 1; $iix <= 12; $iix++) {
                            $target_descii = "target_set_" . $iix;
                            $dealer_profile_cvtii = $this->achv_target(array('dlr' => "$dealer", "y" => "$year_cvt", "m" => "$iix"));
                            if ($dealer_profile_cvtii['status'] == 1) {
                                if (!empty($dealer_profile_cvt['mechanic'])) {
                                    $data['acv'][$nom_tm][$iix] = $dealer_profile_cvtii['mechanic']['total'];
                                    $pit_cvtii = (!empty($data['acv'][$nom_tm][$iix]) ? $data['acv'][$nom_tm][$iix] : 0);
                                    $data['result_acv'][$nom_tm][$iix] = percentage_cvt($pit_cvtii, $data['target'][$nom_tm]->$target_descii);
                                }
                            }
                        }
                    }
                }
            }
        }

        return $data;
    }

    public function achv_target($param = null) {

        $data_search = $this->db->query("select * from md_dealer_note dn where dn.dealer_id = $param[dlr] and YEAR(dn.dealer_note_date) = '$param[y]' and MONTH(dn.dealer_note_date)='$param[m]'")->last_row();
        if (!empty($data_search)) {
            $data['frontdesk'] = !empty($data_search->dealer_note_frontdesk) ? decode_data($data_search->dealer_note_frontdesk) : null;
            $data['pit'] = !empty($data_search->dealer_note_pit) ? decode_data($data_search->dealer_note_pit) : null;
            $data['mechanic'] = !empty($data_search->dealer_note_mechanic) ? decode_data($data_search->dealer_note_mechanic) : null;
            $data['status'] = 1;
        } else {
            $data['status'] = 2;
            $data['frontdesk'] = null;
            $data['mechanic'] = null;
            $data['pit'] = null;
        }
        return $data;
    }

    public function target_acv_dealer($dlr_profile, $year = null) {
        $year_cvt = (!empty($year) ? $year : date("Y"));
        for ($i = 1; $i <= 12; $i++) {
            $data['acv'][$i] = $this->db->query("select * from md_dealer_note where dealer_id = $dlr_profile and YEAR(dealer_note_date) = '$year_cvt' and MONTH(dealer_note_date) = '$i'")->last_row();
        }
        return $data;
    }
    

}
