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
// $QU1 = "SELECT city_id,city_name FROM " . TBL_ADMIN_CITY . " WHERE city_status='1' AND city_id='" . $id . "'";
// // $QU1 = "SELECT ct.city_id,locali.locality_id,ct.city_name,locali.locality_name FROM " . TBL_ADMIN_CITY . " AS ct LEFT JOIN " . TBL_ADMIN_LOCALITY . " AS locali ON ct.city_id=locali.city_id";
// $objDB->setQuery($QU1);
// $rs = $objDB->select();
// for ($i = 0; $i < count($rs); $i++) {
//     $QU11 = "SELECT locality_name,locality_id FROM " . TBL_ADMIN_LOCALITY . " WHERE city_id='" . $rs[$i]['city_id'] . "'";
//     $objDB->setQuery($QU11);
//     $rs1 = $objDB->select();
// }
$rs1 = [['property_plan' => 1, 'property_plan_name' => 'Feature'], ['property_plan' => 2, 'property_plan_name' => 'Exclusive'], ['property_plan' => 3, 'property_plan_name' => 'New Projects'], ['property_plan' => 4, 'property_plan_name' => 'Resale Property']];
if (count($rs1) > 0) {

    echo  json_encode(["msg" => "Property Plan List", "code" => 200, "Data" => $rs1]);
} else {
    echo  json_encode(["msg" => "No Data Found", "code" => 400]);
}
// }
