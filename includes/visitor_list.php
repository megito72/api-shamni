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
$associate_id = $_POST['associate_id'];
$QU1 = "SELECT visitor_id,visitor_name,visitor_dov,visitor_mob,visitor_email FROM " . TBL_VISITOR . " WHERE associate_id='" . $associate_id . "' ";
$objDB->setQuery($QU1);
$rs = $objDB->select();

if (count($rs) > 0) {

    echo  json_encode(["msg" => "Visitor List", "code" => 200, "Data" => $rs]);
} else {
    echo  json_encode(["msg" => "No Data Found", "code" => 400]);
}
