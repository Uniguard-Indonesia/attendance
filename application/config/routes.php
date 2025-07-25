<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['dashboard/employee_attandances'] = 'employee_attandances/index';

$route['dashboard/positions'] = 'positions';
$route['dashboard/positions/create'] = 'positions/create';
$route['dashboard/positions/(:any)'] = 'positions/view/$1';
$route['dashboard/positions/employees/(:any)'] = 'positions/employees/$1';
$route['dashboard/positions/edit/(:any)'] = 'positions/edit/$1';

$route['dashboard/roles'] = 'roles';

$route['dashboard/attandance_devices'] = 'attandance_devices';
$route['dashboard/attandance_devices/create'] = 'attandance_devices/create';
$route['dashboard/attandance_devices/(:any)'] = 'attandance_devices/view/$1';
$route['dashboard/attandance_devices/products/(:any)'] = 'attandance_devices/products/$1';
$route['dashboard/attandance_devices/edit/(:any)'] = 'attandance_devices/edit/$1';

$route['dashboard/employees'] = 'employees';
$route['dashboard/employees/create'] = 'employees/create';
$route['dashboard/employees/(:any)'] = 'employees/view/$1';
$route['dashboard/employees/edit/(:any)'] = 'employees/edit/$1';


$route['dashboard/users'] = 'users';
$route['dashboard/users/create'] = 'users/create';
$route['dashboard/users/(:any)'] = 'users/view/$1';
$route['dashboard/users/edit/(:any)'] = 'users/edit/$1';
