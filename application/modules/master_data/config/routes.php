<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['dash-master/users-master'] = 'master_data/users/index';
$route['dash-master/users-master/data'] = 'master_data/users/index/tabel';
$route['dash-master/users-master/data/(:any)'] = 'master_data/users/index/tabel/$1';
$route['dash-master/users-master/data/(:any)/(:any)'] = 'master_data/users/index/tabel/$1/$2';
$route['dash-master/users-master/form'] = 'master_data/users/form';
$route['dash-master/users-master/form/(:any)'] = 'master_data/users/form/$1';
$route['dash-master/users-master/save'] = 'master_data/users/save';
$route['dash-master/users-master/delete/(:any)'] = 'master_data/users/delete/$1';
$route['dash-master/users-master/detail/(:any)'] = 'master_data/users/detail/$1';
$route['dash-master/users-master/enabled/(:any)'] = 'master_data/users/status/2/$1';
$route['dash-master/users-master/suspend/(:any)'] = 'master_data/users/status/1/$1';
