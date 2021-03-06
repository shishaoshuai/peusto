<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "welcome";
$route['404_override'] = '';

$route['register'] = 'user/register';
$route['create_user'] = 'user/create';
$route['login'] = 'user/login';
$route['logout'] = 'user/logout';

$route['home'] = 'home';

$route['todo'] = 'todo';
$route['todo/create'] = 'todo/create';

$route['interest_area'] = 'interest_area';
$route['interest_area/create'] = 'interest_area/create';
$route['interest_area/modify/(:any)'] = 'interest_area/modify/$1';
$route['interest_area/delete/(:any)'] = 'interest_area/delete_ia/$1';
$route['interest_area/update'] = 'interest_area/update';


$route['target'] = 'target';
$route['target/create'] = 'target/create';
$route['target/modify/(:any)'] = 'target/modify/$1';
$route['target/delete/(:any)'] = 'target/delete_target/$1';
$route['target/update'] = 'target/update';

$route['time_record'] = 'time_record';
$route['user_preferences'] = 'user_preferences/home';

$route['add_target_type/(:any)'] ='ajax/add_target_type/$1';
$route['delete_target_type/(:any)'] ='ajax/delete_target_type/$1';


$route['get_user_interest_areas'] = 'ajax/get_interest_areas';
$route['get_target_types'] = 'ajax/get_target_types';
$route['get_targets/(:any)'] = 'ajax/get_targets/$1';
$route['get_hierachy_targets'] = 'ajax/get_hierachy_targets';

$route['create_target'] = 'ajax/create_target';
$route['delete_target/(:any)'] = 'ajax/delete_target/$1';
$route['create_task_from_calendar'] = 'ajax/create_task_from_calendar';
$route['move_task_in_calendar'] = 'ajax/move_task_in_calendar';
$route['modify_task_from_calendar'] = 'ajax/modify_task_from_calendar';

/* End of file routes.php */
/* Location: ./application/config/routes.php */