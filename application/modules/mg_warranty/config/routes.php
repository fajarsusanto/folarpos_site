<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['dash-manage/mg-warranty'] = 'mg_warranty/warranty/index';
$route['dash-manage/mg-warranty/data'] = 'mg_warranty/warranty/index/tabel';
$route['dash-manage/mg-warranty/data/(:any)'] = 'mg_warranty/warranty/index/tabel/$1';
$route['dash-manage/mg-warranty/data/(:any)/(:any)'] = 'mg_warranty/warranty/index/tabel/$1/$2';
$route['dash-manage/mg-warranty/form'] = 'mg_warranty/warranty/form';
$route['dash-manage/mg-warranty/form/(:any)'] = 'mg_warranty/warranty/form/$1';
$route['dash-manage/mg-warranty/save'] = 'mg_warranty/warranty/save';
$route['dash-manage/mg-warranty/delete/(:any)'] = 'mg_warranty/warranty/delete/$1';
$route['dash-manage/mg-warranty/detail/(:any)'] = 'mg_warranty/warranty/detail/$1';
$route['dash-manage/mg-warranty/enabled/(:any)'] = 'mg_warranty/warranty/status/2/$1';
$route['dash-manage/mg-warranty/suspend/(:any)'] = 'mg_warranty/warranty/status/1/$1';



