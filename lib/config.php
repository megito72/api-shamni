<?php
session_start();
ob_start();
error_reporting(E_ALL & ~E_NOTICE);

date_default_timezone_set('Asia/Kolkata');
ini_set('session_cookie_secure', 'On');
ini_set('display_error', 'On');
ini_set('error_reporting', 1);
ini_set('memory_limit', '2500M');
ini_set('post_max_size', '20M');
ini_set('max_execution_time', 1000);
ini_set('max_input_time', 1);
ini_set("log_errors", 1);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');


ini_set("allow_url_fopen", 1);
ini_set("allow_url_include", 'On');


define('__CONFIG__', '__CONFIG__');


define('H_Token', 'ocLGuJGguH2u1KmxiYLii00XeBFePmvdLzy2MjxE2CoJOra7');
define('DBHOST', 'localhost');
define('DBNAME', 'shamni');
define('DBUSER', 'root');
define('DBPASSWORD', 'redhat');

define('TBL_ADMIN_BANK', 'admin_bank');
define('TBL_ASSOCIATE_ACCOUNT', 'associate_account');
define('TBL_FREQUENTLY', 'frequently');
define('TBL_INVESTORS', 'investors');
define('TBL_PROJECT_AMINITIES', 'project_amenities');
define('TBL_PROPERTY', 'property');
define('TBL_PROPERTY_BANK', 'property_bank');
define('TBL_PROPERTY_BOOKING_HOLD', 'property_booking_hold');
define('TBL_PROPERTY_ENQUIRY', 'property_enquiry');
define('TBL_PROPERTY_FAQ', 'property_faq');
define('TBL_PROPERTY_GALLERY', 'property_gallery');
define('TBL_PROPERTY_SOLD', 'property_sold');
define('TBL_PROPERTY_TYPE', 'property_type');
define('TBL_PROPERTY_UNIT', 'property_unit');
define('TBL_VISITOR', 'visitor');





define('MESSAGE_TEXT', 'mt');
define('MESSAGE_TEXT_ERROR', 'mt_e');
define('MESSAGE_TEXT_IPL', 'mt');
define('MESSAGE_TEXT_ERROR_IPL', 'mt_e');
define('USER_SESSION_VAR', 'number');
define('USER_SESSION_ID', 'uid');
define('USER_VAR_ID', 'uid');
define('AUTH_VER_VAR', 'auth_ver_var');
define('USER_SESSION_TYPE', 'type');
define('MOBILE', 'mobile');
define('Header_Load', 'header');

define('COMPANY_NAME', 'AVM Plays');

//define('USER_SESSION_TYPE','type');

define('TIMESTAMP', 'time');
define('SITE_URL', 'http://localhost/avm_10/');
// define('SITE_URL','https://ludo.titleekhelo.com/');
//define('SITE_URL','http://ewebindia.in/demo/crm/');
define('SITE_TITLE', 'AVM Plays');
define('SITE_FOOTER', 'AVM Plays 2020');
// define('COMPANY_URL','https://ludo.titleekhelo.com/');
define('COMPANY_URL', 'http://localhost/avm_10/');
