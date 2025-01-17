<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['registration-page'] = 'Ums_controller/index/';
$route['register'] = 'Ums_controller/insert_data/';
$route['login-view'] = 'Ums_controller/login_view/';
$route['login'] = 'Ums_controller/login_data/';
$route['send-mail'] = 'Ums_controller/send_mail';
$route['forgot-password'] = 'Ums_controller/forgot_password/';
$route['check-user'] = 'Ums_controller/check_user/';
$route['reset-password'] = 'Ums_controller/reset_password/';
$route['new-forgot-password'] = 'Ums_controller/new_forgot_password/';
$route['verify-otp'] = 'Ums_controller/verify_otp/';
$route['reset-new-password'] = 'Ums_controller/reset_new_password';
$route['dashboard'] = 'Dashboard_controller/index/';
$route['dashboard/user-list/(:any)'] = 'Dashboard_controller/user_list/$1';
$route['view-profile/(:num)'] = 'Dashboard_controller/profile_view/$1';
$route['dashboard/edit-profile/(:num)'] = 'Dashboard_controller/edit_profile/$1';
$route['dashboard/edit-submit/(:num)'] = 'Dashboard_controller/edit_submit/$1';
$route['dashboard/delete-user/(:num)'] = 'Dashboard_controller/delete_user/$1';
$route['change-password'] = 'Dashboard_controller/change_password/';
$route['logout'] = 'Dashboard_controller/logout/';

$route['dashboard/download-pdf/(:num)'] = 'Download_controller/download_pdf/$1';
$route['dashboard/download-excel/(:any)'] = 'Download_controller/download_excel/$1';