<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['dash-manage/mg-msg'] = 'mg_msg/message/index';
$route['dash-manage/mg-msg/data'] = 'mg_msg/message/index/tabel';
$route['dash-manage/mg-msg/data/(:any)'] = 'mg_msg/message/index/tabel/$1';
$route['dash-manage/mg-msg/data/(:any)/(:any)'] = 'mg_msg/message/index/tabel/$1/$2';
$route['dash-manage/mg-msg/form'] = 'mg_msg/message/form';
$route['dash-manage/mg-msg/form/(:any)'] = 'mg_msg/message/form/$1';
$route['dash-manage/mg-msg/save'] = 'mg_msg/message/save';
$route['dash-manage/mg-msg/delete/(:any)'] = 'mg_msg/message/delete/$1';
$route['dash-manage/mg-msg/detail/(:any)'] = 'mg_msg/message/detail/$1';
$route['dash-manage/mg-msg/enabled/(:any)'] = 'mg_msg/message/status/2/$1';
$route['dash-manage/mg-msg/suspend/(:any)'] = 'mg_msg/message/status/1/$1';



