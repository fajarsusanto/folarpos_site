<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['dash-manage/mg-pricing'] = 'mg_pricing/pricing/index';
$route['dash-manage/mg-pricing/data'] = 'mg_pricing/pricing/index/tabel';
$route['dash-manage/mg-pricing/data/(:any)'] = 'mg_pricing/pricing/index/tabel/$1';
$route['dash-manage/mg-pricing/data/(:any)/(:any)'] = 'mg_pricing/pricing/index/tabel/$1/$2';
$route['dash-manage/mg-pricing/form'] = 'mg_pricing/pricing/form';
$route['dash-manage/mg-pricing/form/(:any)'] = 'mg_pricing/pricing/form/$1';
$route['dash-manage/mg-pricing/save'] = 'mg_pricing/pricing/save';
$route['dash-manage/mg-pricing/delete/(:any)'] = 'mg_pricing/pricing/delete/$1';
$route['dash-manage/mg-pricing/detail/(:any)'] = 'mg_pricing/pricing/detail/$1';
$route['dash-manage/mg-pricing/enabled/(:any)'] = 'mg_pricing/pricing/status/2/$1';
$route['dash-manage/mg-pricing/suspend/(:any)'] = 'mg_pricing/pricing/status/1/$1';