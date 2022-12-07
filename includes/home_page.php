<?php
ob_start();
error_reporting(E_ALL & ~E_NOTICE);
?>

<?php

$all_header = getallheaders();

$token = $all_header['Access_Token'];

if (verify_token($token) == false) {
    echo  json_encode(["msg" => "Not Authorized..!!", "code" => 401]);
    die;
}

$uid = $_POST['associate_id'];
$associate_invite_code = getassoc_invitecode($uid);
$downline_member = getteam_member($uid);
$downline_members = getteam_member_arr($uid);
// echo print_r($downline_members);
$hold_property = get_hold_property_count($downline_members, 2, $uid);
$booked_property = get_booked_property_count($downline_members, 3, $uid);
// echo print_r($downline_members);
$rs[] = ["Total Members" => count($downline_member), "Hold Property" => $hold_property, "Booked Property" => $booked_property];
if ($uid) {
    echo  json_encode(["msg" => "Home Page Data", "code" => 200, "Data" => $rs]);
} else {
    echo  json_encode(["msg" => "Something Went Wrong..!!!", "code" => 400]);
}
