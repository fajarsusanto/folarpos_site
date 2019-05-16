<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['dash-manage/mg-referral'] = 'mg_referral/referral/index';
$route['dash-manage/mg-referral/data'] = 'mg_referral/referral/index/tabel';
$route['dash-manage/mg-referral/data/(:any)'] = 'mg_referral/referral/index/tabel/$1';
$route['dash-manage/mg-referral/data/(:any)/(:any)'] = 'mg_referral/referral/index/tabel/$1/$2';
$route['dash-manage/mg-referral/form'] = 'mg_referral/referral/form';
$route['dash-manage/mg-referral/form/(:any)'] = 'mg_referral/referral/form/$1';
$route['dash-manage/mg-referral/save'] = 'mg_referral/referral/save';
$route['dash-manage/mg-referral/delete/(:any)'] = 'mg_referral/referral/delete/$1';
$route['dash-manage/mg-referral/detail/(:any)'] = 'mg_referral/referral/detail/$1';
$route['dash-manage/mg-referral/enabled/(:any)'] = 'mg_referral/referral/status/2/$1';
$route['dash-manage/mg-referral/suspend/(:any)'] = 'mg_referral/referral/status/1/$1';



