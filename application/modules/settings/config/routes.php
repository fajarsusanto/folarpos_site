<?php

defined('BASEPATH') OR exit('No direct script access allowed');


$route['dash-v/apps-profile'] = 'settings/apps/index';
$route['dash-v/apps-data'] = 'settings/apps/index/data';
$route['dash-v/apps-update'] = 'settings/apps/save';
$route['about-folarium'] = 'settings/apps/folarium';

$route['dash-v/my-profile'] = 'settings/account';
$route['dash-v/my-profile/form'] = 'settings/account/index/form';
$route['dash-v/my-profile/content'] = 'settings/account/index/content';
$route['dash-v/my-profile/up-to-date'] = 'settings/account/save';
$route['dash-v/my-profile/change-password'] = 'settings/account/save_password';
$route['dash-v/my-profile/photo-upload'] = 'settings/account/photo';
$route['dash-v/set-signature'] = 'settings/apps/signature';
$route['dash-v/set-signature/save'] = 'settings/apps/signature/save';
$route['dash-v/set-reminder'] = 'settings/apps/set_interval';
$route['dash-v/set-reminder/save'] = 'settings/apps/set_interval/save';
$route['dash-v/set-rules'] = 'settings/apps/ruless';
$route['dash-v/set-rules/save'] = 'settings/apps/ruless/save';

$route['dash-v/notif/load_row'] = 'settings/apps/load_row_notif';
$route['dash-v/notif/load_data'] = 'settings/apps/load_data_notif';
$route['dash-v/notif/read/(:any)'] = 'settings/apps/read_data_notif/$1';

$route['dash-v/apps/upload/(:any)'] = 'settings/apps/upload/$1';
$route['dash-v/apps/save_upload'] = 'settings/apps/save_upload';