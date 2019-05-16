<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['dash-manage/mg-career'] = 'mg_career/career/index';
$route['dash-manage/mg-career/data'] = 'mg_career/career/index/tabel';
$route['dash-manage/mg-career/data/(:any)'] = 'mg_career/career/index/tabel/$1';
$route['dash-manage/mg-career/data/(:any)/(:any)'] = 'mg_career/career/index/tabel/$1/$2';
$route['dash-manage/mg-career/form'] = 'mg_career/career/form';
$route['dash-manage/mg-career/form/(:any)'] = 'mg_career/career/form/$1';
$route['dash-manage/mg-career/save'] = 'mg_career/career/save';
$route['dash-manage/mg-career/delete/(:any)'] = 'mg_career/career/delete/$1';
$route['dash-manage/mg-career/detail/(:any)'] = 'mg_career/career/detail/$1';
$route['dash-manage/mg-career/enabled/(:any)'] = 'mg_career/career/status/2/$1';
$route['dash-manage/mg-career/suspend/(:any)'] = 'mg_career/career/status/1/$1';



