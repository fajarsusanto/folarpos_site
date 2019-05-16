<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['dash-manage/mg-products'] = 'mg_products/products/index';
$route['dash-manage/mg-products/data'] = 'mg_products/products/index/tabel';
$route['dash-manage/mg-products/data/(:any)'] = 'mg_products/products/index/tabel/$1';
$route['dash-manage/mg-products/data/(:any)/(:any)'] = 'mg_products/products/index/tabel/$1/$2';
$route['dash-manage/mg-products/form'] = 'mg_products/products/form';
$route['dash-manage/mg-products/form/(:any)'] = 'mg_products/products/form/$1';
$route['dash-manage/mg-products/save'] = 'mg_products/products/save';
$route['dash-manage/mg-products/save_upload'] = 'mg_products/products/save_upload';
$route['dash-manage/mg-products/delete/(:any)'] = 'mg_products/products/delete/$1';
$route['dash-manage/mg-products/detail/(:any)'] = 'mg_products/products/detail/$1';
$route['dash-manage/mg-products/upload/(:any)'] = 'mg_products/products/upload/$1';
$route['dash-manage/mg-products/enabled/(:any)'] = 'mg_products/products/status/2/$1';
$route['dash-manage/mg-products/suspend/(:any)'] = 'mg_products/products/status/1/$1';