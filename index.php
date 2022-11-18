<?php
ob_start();
error_reporting(E_ALL & ~E_NOTICE);
include_once("lib/config.php");
include_once("lib/dbclass.php");
include_once("lib/lib.php");
header('Access-Control-Allow-credentials:true');
header('Access-Control-Allow-Method:GET,POST,OPTIONS');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Content-Type:application/json');
require("php-jwt/src/BeforeValidException.php");
require("php-jwt/src/CachedKeySet.php");
require("php-jwt/src/ExpiredException.php");
require("php-jwt/src/JWK.php");
require("php-jwt/src/JWT.php");
require("php-jwt/src/Key.php");
require("php-jwt/src/SignatureInvalidException.php");

use Firebase\JWT\JWT;
?>
<?php
(isset($_REQUEST['p']) && $_REQUEST['p'] != '') ? $p = $_REQUEST['p'] : $p = '404.php';
$objDB = new DB();
if (file_exists('includes/' . $p . '.php')) {
  $pa = $p . '.php';
} else {
  $pa = '404.php';
}
include('includes/' . $pa);
?>
