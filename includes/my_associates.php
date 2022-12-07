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
$associate_id = get_assoc_spons_id($_POST['associate_id']);
$QU1 = "SELECT associate_id,associate_name,associate_invite_code,associate_email,associate_mobile,associate_city FROM " . TBL_ASSOCIATE_ACCOUNT . " WHERE sponsor_id='" . $associate_id . "' ";
$objDB->setQuery($QU1);
$rs = $objDB->select();
for ($i = 0; $i < count($rs); $i++) {
    if ($rs[$i]['associate_invite_code'] == '') {
        unset($rs[$i]['associate_invite_code']);
        array_merge($rs, $rs[$i]['associate_invite_code'] = 'Not Generated');
    }
}

if (count($rs) > 0) {

    echo  json_encode(["msg" => "My Associate List", "code" => 200, "Data" => $rs]);
} else {
    echo  json_encode(["msg" => "No Data Found", "code" => 400]);
}
