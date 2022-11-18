<?php
ob_start();
error_reporting(E_ALL & ~E_NOTICE);
?>

<?php

$all_header = getallheaders();

// echo print_r($all_header, true);
$token = substr($all_header['Authorization'], 7);

if ($token != H_Token) {
    echo  json_encode(["msg" => "Not Authorized..!!", "code" => 401]);
    die;
}

$QU1 = "SELECT * FROM " . TBL_ADMIN_BANK . "  ";
$objDB->setQuery($QU1);
$rs = $objDB->select();

if (count($rs) > 0) {

    echo  json_encode(["msg" => "Bank List", "code" => 200, "Data" => $rs]);
} else {
    echo  json_encode(["msg" => "No Data Found", "code" => 400]);
}
