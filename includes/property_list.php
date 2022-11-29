<?php
ob_start();
error_reporting(E_ALL & ~E_NOTICE);
?>

<?php

$all_header = getallheaders();

// echo print_r($all_header, true);
$token = $all_header['Access_Token'];

if (verify_token($token) == false) {
    echo  json_encode(["msg" => "Not Authorized..!!", "code" => 401]);
    die;
}

$QU1 = "SELECT property_title,property_code FROM " . TBL_PROPERTY . " WHERE deleted='0' ";
$objDB->setQuery($QU1);
$rs = $objDB->select();

if (count($rs) > 0) {

    echo  json_encode(["msg" => "Property List", "code" => 200, "Data" => $rs]);
} else {
    echo  json_encode(["msg" => "No Data Found", "code" => 400]);
}
