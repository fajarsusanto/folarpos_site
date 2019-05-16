<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['dash-manage/mg-gallery'] = 'mg_gallery/gallery/index';
$route['dash-manage/mg-gallery/data'] = 'mg_gallery/gallery/index/tabel';
$route['dash-manage/mg-gallery/data/(:any)'] = 'mg_gallery/gallery/index/tabel/$1';
$route['dash-manage/mg-gallery/data/(:any)/(:any)'] = 'mg_gallery/gallery/index/tabel/$1/$2';
$route['dash-manage/mg-gallery/form'] = 'mg_gallery/gallery/form';
$route['dash-manage/mg-gallery/form/(:any)'] = 'mg_gallery/gallery/form/$1';
$route['dash-manage/mg-gallery/save'] = 'mg_gallery/gallery/save';
$route['dash-manage/mg-gallery/delete/(:any)'] = 'mg_gallery/gallery/delete/$1';
$route['dash-manage/mg-gallery/detail/(:any)'] = 'mg_gallery/gallery/detail/$1';
$route['dash-manage/mg-gallery/enabled/(:any)'] = 'mg_gallery/gallery/status/2/$1';
$route['dash-manage/mg-gallery/suspend/(:any)'] = 'mg_gallery/gallery/status/1/$1';