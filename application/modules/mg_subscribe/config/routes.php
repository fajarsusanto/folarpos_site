<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['dash-manage/mg-subscribe'] = 'mg_subscribe/subscribe/index';
$route['dash-manage/mg-subscribe/data'] = 'mg_subscribe/subscribe/index/tabel';
$route['dash-manage/mg-subscribe/data/(:any)'] = 'mg_subscribe/subscribe/index/tabel/$1';
$route['dash-manage/mg-subscribe/data/(:any)/(:any)'] = 'mg_subscribe/subscribe/index/tabel/$1/$2';
$route['dash-manage/mg-subscribe/form'] = 'mg_subscribe/subscribe/form';
$route['dash-manage/mg-subscribe/form/(:any)'] = 'mg_subscribe/subscribe/form/$1';
$route['dash-manage/mg-subscribe/save'] = 'mg_subscribe/subscribe/save';
$route['dash-manage/mg-subscribe/delete/(:any)'] = 'mg_subscribe/subscribe/delete/$1';
$route['dash-manage/mg-subscribe/detail/(:any)'] = 'mg_subscribe/subscribe/detail/$1';
$route['dash-manage/mg-subscribe/enabled/(:any)'] = 'mg_subscribe/subscribe/status/2/$1';
$route['dash-manage/mg-subscribe/suspend/(:any)'] = 'mg_subscribe/subscribe/status/1/$1';



