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
// $associate_id = $_POST['associate_id'];
$QU1 = "SELECT city_id,city_name FROM " . TBL_ADMIN_CITY . " WHERE city_status='1'";
// $QU1 = "SELECT ct.city_id,locali.locality_id,ct.city_name,locali.locality_name FROM " . TBL_ADMIN_CITY . " AS ct LEFT JOIN " . TBL_ADMIN_LOCALITY . " AS locali ON ct.city_id=locali.city_id";
$objDB->setQuery($QU1);
// $rs = $objDB->select();
// for ($i = 0; $i < count($rs); $i++) {
//     $QU11 = "SELECT locality_name FROM " . TBL_ADMIN_LOCALITY . " WHERE city_id='" . $rs[$i]['city_id'] . "'";
//     $objDB->setQuery($QU11);
//     $rs1 = $objDB->select();
// }
if (count($rs) > 0) {

    echo  json_encode(["msg" => "City List", "code" => 200, "Data" => $rs]);
} else {
    echo  json_encode(["msg" => "No Data Found", "code" => 400]);
}
