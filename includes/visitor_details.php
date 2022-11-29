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

$visitor_id = $_POST['visitor_id'];
$QU1 = "SELECT v.*,a.* FROM " . TBL_VISITOR . " v LEFT JOIN " . TBL_ASSOCIATE_ACCOUNT . " a  ON a.associate_id=v.associate_id WHERE v.visitor_id='" . $visitor_id . "' ";
$objDB->setQuery($QU1);
$rs = $objDB->select();

if (count($rs) > 0) {

    echo  json_encode(["msg" => "Visitor Details", "code" => 200, "Data" => $rs]);
} else {
    echo  json_encode(["msg" => "No Data Found", "code" => 400]);
}
