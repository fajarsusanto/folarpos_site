<?php

if (!function_exists('is_logged_in')) {

    function is_logged_in() {
        $CI = & get_instance();
        $is_logged_in = $CI->session->userdata(md5('habitat_access'));
        if (!isset($is_logged_in) || $is_logged_in != true) :
            redirect('');
        endif;
    }

    function isnot_logged_in() {
        $CI = & get_instance();
        $is_logged_in = $CI->session->userdata(md5('habitat_access'));
        if (isset($is_logged_in) || $is_logged_in == true) :
            redirect('');
        endif;
    }

    function is_logged_check() {
        $CI = & get_instance();
        $is_logged_in = $CI->session->userdata(md5('habitat_access'));
        return $is_logged_in;
    }

    function isfb_logged_check() {
        $CI = & get_instance();
        $is_logged_in = $CI->session->userdata(md5('habitatfb_access'));
        return $is_logged_in;
    }

    function is_filtered($level) {
        $CI = & get_instance();
        $data_level = count($level);
        
        $jum = 0;
        
        for ($i = 0; $i < $data_level; $i++) {
        
        $is_logged_in = $CI->session->userdata(md5('habitat_access'));
        if (md5($is_logged_in['level_id']) == $level[$i]) :
            $jum ++;
        endif;
        }
        
        if ($jum == 0) {
            redirect("home");
        }
        
    }

}