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
// $id = $_POST['city_id'];
// if ($id = '') {
//     echo  json_encode(["msg" => "City ID is Required", "code" => 400]);
// } else {
$QU1 = "SELECT * FROM " . TBL_ADMIN_AMENITIES . " ";
$objDB->setQuery($QU1);
$rs = $objDB->select();

if (count($rs) > 0) {
    echo  json_encode(["msg" => "Locality List", "code" => 200, "Data" => $rs]);
} else {
    echo  json_encode(["msg" => "No Data Found", "code" => 400]);
}
// }
