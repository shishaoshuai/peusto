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
$route['user/create'] = 'user/create';
$route['user/login'] = 'user/login';

$route['home'] = 'home';
$route['home/logout'] = 'home/logout';

$route['interest_area'] = 'interest_area';
$route['interest_area/create'] = 'interest_area/create';
$route['target'] = 'target';
$route['target/create'] = 'target/create';
$route['time_record'] = 'time_record';
$route['user_preferences'] = 'user_preferences';
$route['get_user_interest_areas'] = 'ajax/get_interest_areas';
$route['get_targets/(:any)'] = 'ajax/get_targets/$1';
/* End of file routes.php */
/* Location: ./application/config/routes.php */