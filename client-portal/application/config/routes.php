<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'FrontEndController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;



$route['dashboard'] = 'FrontEndController/dashboard';
$route['login'] = 'FrontEndController/login';
$route['logout'] = 'FrontEndController/logout';


$route['documents'] = 'FrontEndController/documents';