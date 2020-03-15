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



$route['default_controller'] = "home";

$route['404_override'] = 'home/pageNotFound';





$route['admin'] = 'admin/login';















/*******************	Front End Links		*********************************/
$route['pvcprint'] = 'pvcprint/pvcprint';
$route['pvcprint/aadhaarpvc'] = 'pvcprint/aadhaarpvc';
$route['pvcprint/cmhealthpvc'] = 'pvcprint/cmhealthpvc';
$route['pvcprint/pancardpvc'] = 'pvcprint/pancardpvc';
$route['pvcprint/pmjaypvc'] = 'pvcprint/pmjaypvc';
$route['pvcprint/pmsmypvc'] = 'pvcprint/pmsmypvc';
$route['pvcprint/tnsmatpvc'] = 'pvcprint/tnsmatpvc';
$route['pvcprint/uanpvc'] = 'pvcprint/uanpvc';
$route['pvcprint/pay'] = 'pvcprint/pay';
$route['property/add'] = 'property/add';
$route['property/update/(:any)'] = 'property/update/$1';
$route['property/user_listing'] = 'property/user_listing';
$route['property/user_listing/(:any)'] = 'property/user_listing/$1';
$route['property/update/(:any)/(:any)'] = 'property/update/$1/$2';
$route['property/delete/(:any)/(:any)'] = 'property/delete/$1/$2';
$route['property/addPicture/(:any)/(:any)'] = 'property/addPicture/$1/$2';
$route['property/changePictureStatus/(:any)/(:any)/(:any)'] = 'property/changePictureStatus/$1/$2/$3';
$route['property/removePicture/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'property/removePicture/$1/$2/$3/$4/$5';
$route['property/info/(:any)'] = 'property/info/$1';
$route['property/featured'] = 'property/featured';
$route['property/featured/(:any)'] = 'property/featured/$1';
$route['property/(:any)'] = 'property/index/$1';
$route['property/(:any)/(:any)'] = 'property/index/$1/$2';
$route['city/(:any)'] = 'city/index/$1';
$route['city/(:any)/(:any)'] = 'city/index/$1/$2';
$route['content/(:any)'] = 'content/index/$1';
/*$route['contact-us.html'] = 'contactUs/index';

$route['about-us.html'] = 'aboutUs/index';

$route['web-hosting.html'] = 'webHosting/index';

$route['web-design.html'] = 'webDesign/index';
$route['web-design-services-pakistan.html'] = 'webDesign/index';

$route['web-development.html'] = 'webDevelopment/index';
$route['web-development-services.html'] = 'webDevelopment/index';

$route['graphic-design.html'] = 'graphicDesign/index';

$route['internet-marketing.html'] = 'internetMarketing/index';

$route['seo.html'] = 'seo-company-pakistan';
$route['seo-company-pakistan.html'] = 'seo/index';

$route['portfolio.html'] = 'portfolio/index';

$route['privacy-policy.html'] = 'privacyPolicy/index';

$route['refund-policy.html'] = 'refundPolicy/index';

$route['terms-conditions.html'] = 'termsConditions/index';

$route['application-development.html'] = 'applicationDevelopment/index';*/

/*******************	@Front End Links		*****************************/









/* End of file routes.php */

/* Location: ./application/config/routes.php */