<?php
ob_start();
error_reporting(E_ALL & ~E_NOTICE);
header('Access-Control-Allow-Origin: *');
include_once("lib/config.php");
include_once("lib/dbclass.php");
include_once("lib/lib.php");
require("php-jwt/src/BeforeValidException.php");
require("php-jwt/src/CachedKeySet.php");
require("php-jwt/src/ExpiredException.php");
require("php-jwt/src/JWK.php");
require("php-jwt/src/JWT.php");
require("php-jwt/src/Key.php");
require("php-jwt/src/SignatureInvalidException.php");

use Firebase\JWT\JWT;

$enc_key = "Jordan72";
function generateRandomString($length = 4)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$objDB = new DB();
$QU  = "SELECT * FROM " . TBL_USERS . " WHERE user_status='Active'";
$objDB->setQuery($QU);
$rs = $objDB->select();
$objDB->close();

$json_data = json_encode($rs);

$jwt = JWT::encode($rs, $enc_key, 'HS256');
$jwt = str_replace(".", "$", generateRandomString() . $jwt . generateRandomString());
echo  $jwt;
