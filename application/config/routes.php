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

// Faces
$route['faces/index'] = 'faces/index';
$route['faces/(:any)'] = 'faces/view/$1';
$route['faces'] = 'faces';

// CREF test
$route['creftest/add'] = 'creftest/add';
$route['creftest/save'] = 'creftest/save';
$route['creftest/index'] = 'creftest/index';
$route['creftest/results/(:any)'] = 'creftest/results/$1';
$route['creftest/(:any)'] = 'creftest/view/$1';
$route['creftest'] = 'creftest';

// timed CREF test
$route['timedcreftest/add'] = 'timedcreftest/add';
$route['timedcreftest/save'] = 'timedcreftest/save';
$route['timedcreftest/index'] = 'timedcreftest/index';
$route['timedcreftest/results/(:any)'] = 'timedcreftest/results/$1';
$route['timedcreftest/(:any)'] = 'timedcreftest/view/$1';
$route['timedcreftest'] = 'timedcreftest';

// Memory CREF test
$route['memcreftest/add'] = 'memcreftest/add';
$route['memcreftest/save'] = 'memcreftest/save';
$route['memcreftest/index'] = 'memcreftest/index';
$route['memcreftest/results/(:any)'] = 'memcreftest/results/$1';
$route['memcreftest/(:any)'] = 'memcreftest/view/$1';
$route['memcreftest'] = 'memcreftest';

// Digits
$route['digittest/add'] = 'digittest/add';
$route['digittest/save'] = 'digittest/save';
$route['digittest/index'] = 'digittest/index';
$route['digittest/results/(:any)'] = 'digittest/results/$1';
$route['digittest/(:any)'] = 'digittest/view/$1';
$route['digittest'] = 'digittest';

// Stroop
$route['strooptest/add'] = 'strooptest/add';
$route['strooptest/save'] = 'strooptest/save';
$route['strooptest/index'] = 'strooptest/index';
$route['strooptest/results/(:any)'] = 'strooptest/results/$1';
$route['strooptest/(:any)'] = 'strooptest/view/$1';
$route['strooptest'] = 'strooptest';

$route['(:any)'] = 'home/view/$1';
$route['default_controller'] = 'home/view';

/* End of file routes.php */
/* Location: ./application/config/routes.php */