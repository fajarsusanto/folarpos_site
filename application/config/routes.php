<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['login'] = 'login/index';
$route['register'] = 'login/signup';
$route['reset'] = 'login/reset';
$route['logout'] = 'login/logout';

$route['load-home'] = 'home/home_load';

$route['users-mail-unsubscribes/(:any)'] = 'subscribes/unsub/$1';

$route['default_controller'] = 'home';
$route['katalog'] = 'home/katalog';
$route['products/(:any)'] = 'home/detail_products/$1';
$route['blog/(:any)'] = 'home/detail_blog/$1';
$route['career/(:any)'] = 'home/detail_career/$1';
$route['blog'] = 'home/blog';
$route['download_aplikasi'] = 'home/download_aplikasi';
$route['testimony'] = 'home/testimony';
//$route['menu/login'] = 'home/menu_login/login';
//$route['menu/signup'] = 'home/menu_login';

$route['gallery'] = 'home/gallery';
$route['contact'] = 'home/contact_us';
$route['career'] = 'home/career';
$route['profile'] = 'home/apps/profile';
$route['help'] = 'home/apps/help';
$route['term'] = 'home/apps/term';
$route['privacy'] = 'home/apps/privacy';
$route['referral'] = 'home/referral';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
