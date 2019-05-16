<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['dashboard/column/(:any)/(:any)'] = 'dashboard/dashboard/column/$1/$2';
$route['dashboard/column_prod/(:any)/(:any)'] = 'dashboard/dashboard/column_by_product/$1/$2';
$route['dashboard/pie_prod/(:any)/(:any)'] = 'dashboard/dashboard/pie_by_product/$1/$2/$3';
$route['dashboard/column_cont/(:any)/(:any)'] = 'dashboard/dashboard/column_by_content/$1/$2';
$route['dashboard/gauge/(:any)/(:any)'] = 'dashboard/dashboard/gauge/$1/$2';

