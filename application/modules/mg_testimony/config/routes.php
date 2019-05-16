<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['dash-manage/mg-testimony'] = 'mg_testimony/testimony/index';
$route['dash-manage/mg-testimony/data'] = 'mg_testimony/testimony/index/tabel';
$route['dash-manage/mg-testimony/data/(:any)'] = 'mg_testimony/testimony/index/tabel/$1';
$route['dash-manage/mg-testimony/data/(:any)/(:any)'] = 'mg_testimony/testimony/index/tabel/$1/$2';
$route['dash-manage/mg-testimony/form'] = 'mg_testimony/testimony/form';
$route['dash-manage/mg-testimony/form/(:any)'] = 'mg_testimony/testimony/form/$1';
$route['dash-manage/mg-testimony/save'] = 'mg_testimony/testimony/save';
$route['dash-manage/mg-testimony/delete/(:any)'] = 'mg_testimony/testimony/delete/$1';
$route['dash-manage/mg-testimony/detail/(:any)'] = 'mg_testimony/testimony/detail/$1';
$route['dash-manage/mg-testimony/enabled/(:any)'] = 'mg_testimony/testimony/status/2/$1';
$route['dash-manage/mg-testimony/suspend/(:any)'] = 'mg_testimony/testimony/status/1/$1';



