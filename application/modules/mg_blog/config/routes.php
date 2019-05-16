<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['dash-manage/mg-blog'] = 'mg_blog/blog/index';
$route['dash-manage/mg-blog/data'] = 'mg_blog/blog/index/tabel';
$route['dash-manage/mg-blog/data/(:any)'] = 'mg_blog/blog/index/tabel/$1';
$route['dash-manage/mg-blog/data/(:any)/(:any)'] = 'mg_blog/blog/index/tabel/$1/$2';
$route['dash-manage/mg-blog/form'] = 'mg_blog/blog/form';
$route['dash-manage/mg-blog/form/(:any)'] = 'mg_blog/blog/form/$1';
$route['dash-manage/mg-blog/save'] = 'mg_blog/blog/save';
$route['dash-manage/mg-blog/delete/(:any)'] = 'mg_blog/blog/delete/$1';
$route['dash-manage/mg-blog/detail/(:any)'] = 'mg_blog/blog/detail/$1';
$route['dash-manage/mg-blog/enabled/(:any)'] = 'mg_blog/blog/status/2/$1';
$route['dash-manage/mg-blog/suspend/(:any)'] = 'mg_blog/blog/status/1/$1';



