<?php

function us_status($status) {
    if ($status == 1) {
        return "<i class='fa fa-warning text-warning mg-r-sm'></i>Not Active";
    } elseif ($status == 2) {
        return "<i class='fa fa-check text-success mg-r-sm'></i>Active";
    } else {
        return "<i class='fa fa-minus-circle text-danger mg-r-sm'></i>Suspend";
    }
}

function get_browser_name($user_agent)
{
    if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
    elseif (strpos($user_agent, 'Edge')) return 'Edge';
    elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
    elseif (strpos($user_agent, 'Safari')) return 'Safari';
    elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
    elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';    
    return 'Other';
}

function time_since($timestamp) {
    $diff = time() - (int) $timestamp;

    if ($diff == 0)
        return 'just now';

    $intervals = array
        (
        1 => array('Year', 31556926),
        $diff < 31556926 => array('Month', 2628000),
        $diff < 2629744 => array('Week', 604800),
        $diff < 604800 => array('Day', 86400),
        $diff < 86400 => array('Hour', 3600),
        $diff < 3600 => array('Minute', 60),
        $diff < 60 => array('Second', 1)
    );

    $value = floor($diff / $intervals[1][1]);
    return $value . ' ' . $intervals[1][0] . ($value > 1 ? 's' : '') . ' Ago';
}

function agent_status($el, $status = null) {
    if ($el == 3) {
        if ($status == 2) {
            return "<i class='fa fa-check text-success mg-r-sm'></i>Company";
        } else if ($status == 1) {
            return "<i class='fa fa-check text-success mg-r-sm'></i>Personal";
        }
    } elseif ($el == 2) {
        return "<i class='fa fa-check text-success'></i>";
    } else {
        return "-";
    }
}

function ads_status($start, $end) {
    $now = strtotime(date("Y-m-d"));
    if ($now < $start) {
        return "<i class='fa fa-th-list text-warning mg-r-sm'></i>Waiting List";
    } else if ($now > $end) {
        return "<i class='fa fa-minus-circle text-danger mg-r-sm'></i>Non Active";
    } else {
        return "<i class='fa fa-check text-success mg-r-sm'></i>Active";
    }
}

function base64_encode_image($url) {
    $urlParts = pathinfo($url);
    $extension = $urlParts['extension'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    $base64 = 'data:image/' . $extension . ';base64,' . base64_encode($response);
    return $base64;
}

function decode_data($el = null, $selected = null) {
    if (!empty($el)) {
        foreach (json_decode($el) as $desc => $result) {
            $cvt[$desc] = $result;
        }
    }
    if (!empty($selected)) {
        return (!empty($cvt[$selected]) ? $cvt[$selected] : null);
    } else {
        return (!empty($cvt) ? $cvt : null);
    }
}

function convert_nominal($param) {
    return str_replace(",", ".", str_replace(".", "", $param));
}

function encode_data($el = null) {
    $data_check = 0;
    if (!empty($el)) {
        foreach ($el as $desc => $result) {
            if (!empty($result)) {
                if (count($result) > 1) {
                    foreach ($result as $re_nom => $re_row) {
                        if (!empty($re_row)) {
                            $cvt[$desc][$re_nom] = $re_row;
                            $data_check += 1;
                        }
                    }
                } else {
                    $cvt[$desc] = $result;
                    $data_check += 1;
                }
            }
        }
    }
    return ($data_check > 0 ? json_encode($cvt) : NULL);
}

function currency_short($jml) {
    $text = array('', '', 'K', 'Jt', 'M', 'T');
    $input = explode('.', rupiah($jml));
    $dcmc_param = (count($input) > 2) ? 0 : 0;
    $ints = empty($jml) ? 0 : number_format($input[0], $dcmc_param, ",", ".");
    $convert = $ints . '<small>' . $text[count($input)] . '</small>';
    return $convert;
}

function upload_by_encode($param, $path = null, $upload_action = null) {
    $path = (!empty($path) ? $path : 'assets/img');
    $img = str_replace('data:image/png;base64,', '', $param);
    $img = str_replace('data:image/jpeg;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data_upload = base64_decode($img);
    $img_upload = $path . "/ams-" . uniqid() . ".jpg";
    if (empty($upload_action)) {
        file_put_contents($img_upload, $data_upload);
    }
    return $img_upload;
}

function monitor_classification($param = null) {
    $monitor_cvt = null;
    if ($param == 'consumer') {
        $monitor_cvt = "Konsumen";
    } elseif ($param == 'sparepart') {
        $monitor_cvt = "Sparepart";
    } elseif ($param == 'unit_entry') {
        $monitor_cvt = "Unit Entry";
    }
    return $monitor_cvt;
}

function percentage_cvt($acv = null, $target = null) {
    $target_cvt = (!empty($target) ? $target : 0);
    $target_acv_cvt = (!empty($acv) ? $acv : 0);
    $growth = 0;
    if ($target_cvt != 0 && $target_acv_cvt != 0) {
        $growth = rupiah(($target_acv_cvt / ($target_cvt == 0 ? 1 : $target_cvt)) * 100) . "%";
    } else {
        if ($target_cvt == 1) {
            if ($target_acv_cvt == 0) {
                $growth = "-";
            } else {
                $growth = "-";
            }
        } else {
            if ($target_acv_cvt == 0) {
                $growth = "-";
            } else {
                $growth = "0%";
            }
        }
    }
    return $growth;
}

function crud_active($param) {
    $crud_split = explode(",", $param);
    $data = null;
    if (count($crud_split) == 5) {
        $data['c'] = ($crud_split[0] == 0 ? false : true);
        $data['r'] = ($crud_split[1] == 0 ? false : true);
        $data['u'] = ($crud_split[2] == 0 ? false : true);
        $data['d'] = ($crud_split[3] == 0 ? false : true);
        $data['s'] = ($crud_split[4] == 0 ? false : true);
    }
    return $data;
}

function greetings() {
    $now = date("H:i");
    if ($now >= '00:01' && $now <= '04:00') {
        return "Selamat Menanti Pagi !";
    } else if ($now > '04:00' && $now <= '10:00') {
        return "Selamat Pagi !";
    } else if ($now > '10:00' && $now <= '15:00') {
        return "Selamat Siang !";
    } else if ($now > '15:00' && $now <= '18:00') {
        return "Selamat Sore !";
    } else if ($now > '18:00' && $now <= "24:00") {
        return "Selamat Malam !";
    } else {
        return "Selamat beristirahat !";
    }
}

function crud_cvt($param) {
    $data = null;
    if ($param == 0) {
        $data = "Create";
    } elseif ($param == 1) {
        $data = "Read";
    } elseif ($param == 2) {
        $data = "Edit";
    } elseif ($param == 3) {
        $data = "Delete";
    } elseif ($param == 4) {
        $data = "Special";
    }
    return $data;
}

function replace_escape($param) {
    return str_replace(array("'", "''", "&nbsp;"), "", $param);
}

function check_char($param, $char = null) {
    return (!empty($param) ? ($param == $char ? null : trim(ucwords(str_replace(array("'", "''", "&nbsp;"), "", $param)))) : null);
}

function shortext($value, $length, $non = null) {
    $isi_berita = htmlentities(strip_tags($value));
    $isi1 = substr($isi_berita, 0, $length);
    if (empty($non)) {
        $isi = substr($isi_berita, 0, strrpos($isi1, " "));
    } else {
        $isi = $isi1;
    }
    if ($isi1 != $value) {
        $show = "$isi...";
    } else {
        $show = $value;
    }
    return $show;
}

function align_right($count = 0, $condition = null) {
    if ($count < 0) {
        $margin = 540;
        $margin_large = 530;
    } elseif ($count == 1) {
        $margin = 545;
        $margin_large = 540;
    } elseif ($count == 2) {
        $margin = 530;
        $margin_large = 510;
    } elseif ($count == 3) {
        $margin = 515;
        $margin_large = 490;
    } elseif ($count == 4) {
        $margin = 499;
        $margin_large = 470;
    } elseif ($count == 5) {
        $margin = 492;
        $margin_large = 450;
    } elseif ($count == 6) {
        $margin = 477;
        $margin_large = 453;
    } elseif ($count == 7) {
        $margin = 462;
        $margin_large = 432;
    } elseif ($count == 8) {
        $margin = 441;
        $margin_large = 390;
    } elseif ($count == 9) {
        $margin = 438;
        $margin_large = 403;
    } elseif ($count == 10) {
        $margin = 407;
        $margin_large = 382;
    } elseif ($count == 11) {
        $margin = 390;
        $margin_large = 361;
    } elseif ($count == 12) {
        $margin = 373;
        $margin_large = 310;
    } elseif ($count == 13) {
        $margin = 356;
        $margin_large = 333;
    } elseif ($count == 14) {
        $margin = 356;
        $margin_large = 312;
    }
    return !empty($condition) ? $margin_large : $margin;
}

function align_center($count = 0, $condition = null) {
    $margin = 0;
    $start = 250;
    $guide = !empty($condition) ? $condition == "small" ? 4 : 7 : 9;
    $margin = $start - ($guide * $count);
    return $margin;
}

function no_order($value) {

    $jml = strlen($value);
    if ($jml == 1)
        $no = "000000" . $value;
    if ($jml == 2)
        $no = "00000" . $value;
    if ($jml == 3)
        $no = "0000" . $value;
    if ($jml == 4)
        $no = "000" . $value;
    if ($jml == 5)
        $no = "00" . $value;
    if ($jml == 6)
        $no = "0" . $value;
    if ($jml == 7)
        $no = $value;
    if ($jml == 0)
        $no = "0000001";

    return $no;
}

function table_no($value) {

    $jml = strlen($value);
    if ($jml == 1)
        $no = "0" . $value;
    if ($jml == 2)
        $no = $value;
    if ($jml == 0)
        $no = "01";

    return "$no";
}

function table_no_cetak($value) {

    $jml = strlen($value);
    if ($jml == 1)
        $no = "0" . $value;
    if ($jml == 2)
        $no = $value;
    if ($jml == 0)
        $no = "01";

    return "$no";
}

function fin_code($value) {
    $jml = strlen($value);
    if ($jml == 1) {
        $no = "00000" . $value;
    } elseif ($jml == 2) {
        $no = "0000" . $value;
    } elseif ($jml == 3) {
        $no = "000" . $value;
    } elseif ($jml == 4) {
        $no = "00" . $value;
    } elseif ($jml == 5) {
        $no = "0" . $value;
    } elseif ($jml == 0) {
        $no = "0000001";
    } else {
        $no = $value;
    }
    return "$no";
}

function status_bayar($x) {
    if ($x != null) {
        if ($x == 0) {
            return '<div style="background : #d9534f; border-color: #d43f3a; color: white; padding: 4px; font-size: 12px; margin: 0px"><i class="fa fa-minus-circle mg-r-sm"></i>Belum dibayar</div>';
        } else if ($x == 1) {
            return '<div style="background : #5cb85c; border-color: #4cae4c;color: white; padding: 4px; font-size: 12px; margin: 0px"><i class="fa fa-check mg-r-sm"></i>Sudah dibayar</div>';
        } else if ($x == 3) {
            return '<div style="background : #5cb85c; border-color: #4cae4c;color: white; padding: 4px; font-size: 12px; margin: 0px"><i class="fa fa-check mg-r-sm"></i>Batal</div>';
        }
    }
}

function rupiah($jml) {
    $dcm_cvt = explode('.', $jml);
    $dcm_param = (count($dcm_cvt) == 2) ? (strlen($dcm_cvt[1]) > 2) ? 2 : strlen($dcm_cvt[1]) : 0;
    $int = empty($jml) ? 0 : number_format($jml, $dcm_param, ',', '.');
    return $int;
}

function timeToReal($time, $format = null) {

    $y = date(empty($format) ? "H:i" : "H:i:s", strtotime($time));
    return $y;
}

function disc_param_cvt($value, $param) {
    $cvt = null;
    $cvt_value = rupiah($value);
    if ($param == 'percent') {
        $cvt = "$cvt_value %";
    } elseif ($param == 'nominal') {
        $cvt = "Rp $cvt_value";
    }
    return $cvt;
}

function rounding($jml) {
    $int = number_format($jml, 2, ',', '.');
    $angka = explode('.', $jml);
    if ($angka[1] <= 25) {
        return $angka[0];
    } else if ($angka[1] <= 75) {
        return intval($angka[0]) + 0.5;
    } else {
        return intval($angka[0]) + 1;
    }
}

function date2mysql($dates, $time = null) {
    $date = explode('-', $dates);
    $show_time = isset($time) ? "00:00:00" : null;
    return "$date[2]-$date[1]-$date[0] $show_time";
}

function datexls2mysql($dates) {
    $cvt = NULL;
    if (!empty($dates)) {
        $split_cvt = explode(".", $dates);
        $re_create = "$split_cvt[2]-$split_cvt[1]-$split_cvt[0]";
        $cvt = date("Y-m-d", strtotime($re_create));
    }
    return $cvt;
}

function indo_date($date, $length = null, $show_hour = null, $format = null) {
    $datetime = explode(' ', $date);

    if (empty($datetime[1])) {
        $get_hour = null;
    } else {
        if (isset($show_hour)) {
            $hour = explode(":", $datetime[1]);
            $milis = !empty($format) ? ":$hour[2]" : null;
            $get_hour = "/ $hour[0]:$hour[1]$milis";
        } else {
            $get_hour = null;
        }
    }
    $tgl = explode("-", $datetime[0]);
    if ($tgl[1] == '01')
        $mo = empty($length) ? "Januari" : "Jan";
    if ($tgl[1] == '02')
        $mo = empty($length) ? "Februari" : "Feb";
    if ($tgl[1] == '03')
        $mo = empty($length) ? "Maret" : "Mar";
    if ($tgl[1] == '04')
        $mo = empty($length) ? "April" : "Apr";
    if ($tgl[1] == '05')
        $mo = "Mei";
    if ($tgl[1] == '06')
        $mo = "Juni";
    if ($tgl[1] == '07')
        $mo = "Juli";
    if ($tgl[1] == '08')
        $mo = empty($length) ? "Agustus" : "Agust";
    if ($tgl[1] == '09')
        $mo = empty($length) ? "September" : "Sept";
    if ($tgl[1] == '10')
        $mo = empty($length) ? "Oktober" : "Okt";
    if ($tgl[1] == '11')
        $mo = empty($length) ? "November" : "Nov";
    if ($tgl[1] == '12')
        $mo = empty($length) ? "Desember" : "Des";
    $convert = "$tgl[2] $mo $tgl[0] $get_hour";

    return $convert;
}

function getmonth($tgl, $length = null) {
    if ($tgl == '1')
        $mo = empty($length) ? "Januari" : "Jan";
    if ($tgl == '2')
        $mo = empty($length) ? "Februari" : "Feb";
    if ($tgl == '3')
        $mo = empty($length) ? "Maret" : "Mar";
    if ($tgl == '4')
        $mo = empty($length) ? "April" : "Apr";
    if ($tgl == '5')
        $mo = "Mei";
    if ($tgl == '6')
        $mo = empty($length) ? "Juni" : "Jun";
    if ($tgl == '7')
        $mo = empty($length) ? "Juli" : "Jul";
    if ($tgl == '8')
        $mo = empty($length) ? "Agustus" : "Agust";
    if ($tgl == '9')
        $mo = empty($length) ? "September" : "Sept";
    if ($tgl == '10')
        $mo = empty($length) ? "Oktober" : "Okt";
    if ($tgl == '11')
        $mo = empty($length) ? "November" : "Nov";
    if ($tgl == '12')
        $mo = empty($length) ? "Desember" : "Des";
    return $mo;
}

function calculate_age($tgl) {
    $tanggal = explode("/", $tgl);
    $tahun = $tanggal[2];
    $bulan = $tanggal[1];
    $hari = $tanggal[0];

    $day = date('d');
    $month = date('m');
    $year = date('Y');

    $tahun = $year - $tahun;
    $bulan = $month - $bulan;
    $hari = $day - $hari;

    $jumlahHari = 0;
    $bulanTemp = ($month == 1) ? 12 : $month - 1;
    if ($bulanTemp == 1 || $bulanTemp == 3 || $bulanTemp == 5 || $bulanTemp == 7 || $bulanTemp == 8 || $bulanTemp == 10 || $bulanTemp == 12) {
        $jumlahHari = 31;
    } else if ($bulanTemp == 2) {
        if ($tahun % 4 == 0)
            $jumlahHari = 29;
        else
            $jumlahHari = 28;
    }else {
        $jumlahHari = 30;
    }

    if ($hari < 0) {
        $hari += $jumlahHari;
        $bulan--;
    }
    if ($bulan < 0 || ($bulan == 0 && $tahun != 0)) {
        $bulan += 12;
        $tahun--;
    }
    if ($bulan == 12) {
        $bulan = 0;
        $tahun += 1;
    }
    if ($tahun == '0') {
        $tahunz = '';
    } else {
        $tahunz = $tahun . " Tahun ";
    }
    return $tahunz . $bulan . " Bulan " . $hari . " Hari";
}

function get_hour($jam) {
    $var = explode(" ", $jam);
    return $var[1];
}

function selisih_hari($startDate, $endDate) {
    $tgl1 = $startDate;  // 1 Oktober 2009
    $tgl2 = $endDate;  // 10 Oktober 2009
    // memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun
    // dari tanggal pertama
//    echo "$tgl1 $tgl2";
    $pecah1 = explode("-", $tgl1);

    $date1 = $pecah1[2];
    $month1 = $pecah1[1];
    $year1 = $pecah1[0];

    // memecah tanggal untuk mendapatkan bagian tanggal, bulan dan tahun
    // dari tanggal kedua

    $pecah2 = explode("-", $tgl2);
    $date2 = $pecah2[2];
    $month2 = $pecah2[1];
    $year2 = $pecah2[0];

    // menghitung JDN dari masing-masing tanggal

    $jd1 = GregorianToJD($month1, $date1, $year1);
    $jd2 = GregorianToJD($month2, $date2, $year2);

    // hitung selisih hari kedua tanggal

    $selisih = $jd2 - $jd1;
    return $selisih;
}

function romawi($num) {
    switch ($num) {
        case 1:
            $romawi = 'I';
            break;
        case 2:
            $romawi = 'II';
            break;
        case 3:
            $romawi = 'III';
            break;
        case 4:
            $romawi = 'IV';
            break;
        case 5:
            $romawi = 'V';
            break;
        case 6:
            $romawi = 'VI';
            break;
        default:
            $romawi = '';
            break;
    }
    return $romawi;
}

function IntervalDays($CheckIn, $CheckOut) {
    $CheckInX = explode("-", $CheckIn);
    $CheckOutX = explode("-", $CheckOut);
    $date1 = mktime(0, 0, 0, $CheckInX[1], $CheckInX[2], $CheckInX[0]);
    $date2 = mktime(0, 0, 0, $CheckOutX[1], $CheckOutX[2], $CheckOutX[0]);
    $interval = ($date2 - $date1) / (3600 * 24);
// returns numberofdays
    return $interval;
}

function get_listing_cekup($list_id) {
    $CI = & get_instance();
    $me = "no";
    $data_cek2 = $CI->db->query("select * from tr_listing where md5(list_id) = '$list_id'");
    if ($data_cek2->num_rows() > 0) {
        $last_transc = $data_cek2->last_row();
        $count_days = IntervalDays(date("Y-m-d"), date("Y-m-d", strtotime($last_transc->transc_prem_expired)));
        if ($count_days > 0) {
            $me = "yes";
        } else {
            $me = "no";
        }
    }
    return $me;
}
