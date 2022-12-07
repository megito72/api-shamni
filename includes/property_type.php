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

$QU1 = "SELECT * FROM " . TBL_ADMIN_PROPERTY_TYPE . " ";
$objDB->setQuery($QU1);
$rs = $objDB->select();
for ($i = 0; $i < count($rs); $i++) {
    if ($rs[$i]['property_type_id'] == 1) {
        $name = 'Residential';
    } elseif ($rs[$i]['property_type_id'] == 2) {
        $name = 'Commercial';
    } elseif ($rs[$i]['property_type_id'] == 3) {
        $name = 'Farmhouse';
    }
    $rs[$i]['property_type_ids'] = $rs[$i]['id'];
    $rs[$i]['property_type_master_id'] = $rs[$i]['property_type_id'];
    $rs[$i]['property_type_master_name'] = $name;
    unset($rs[$i]['property_type_status']);
    unset($rs[$i]['property_type_id']);
    unset($rs[$i]['id']);
}

if (count($rs) > 0) {
    echo  json_encode(["msg" => "Property Type List", "code" => 200, "Data" => $rs]);
} else {
    echo  json_encode(["msg" => "No Data Found", "code" => 400]);
}
