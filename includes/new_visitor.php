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
$objDB = new DB();

$associate_id = $_POST['associate_id'];
$visitor_name = $_POST['visitor_name'];
$visitor_mob = $_POST['visitor_mob'];
$visitor_dob = $_POST['visitor_dob'];
$visitor_dov = $_POST['visitor_dov'];
$visitor_proffession = $_POST['visitor_proffession'];
$visitor_email = $_POST['visitor_email'];
$visitor_address = $_POST['visitor_address'];
$visitor_city = $_POST['visitor_city'];
$visitor_state = $_POST['visitor_state'];
$visitor_city_code = $_POST['visitor_city_code'];
$visitor_aadhar_card_no = $_POST['visitor_aadhar_card_no'];
$visitor_budget = $_POST['visitor_budget'];
$visitor_project_name = $_POST['visitor_project_name'];
$visitor_project_code = $_POST['visitor_project_code'];
$visitor_unit_no = $_POST['visitor_unit_no'];
$visitor_aadhar_card_front = $_POST['visitor_aadhar_card_front'];
$visitor_aadhar_card_back = $_POST['visitor_aadhar_card_back'];
$visitor_selfie = $_POST['visitor_selfie'];

// POST Request Process Start


if ($associate_id == '') {
    echo  json_encode(["msg" => "Invalid Entry.. Associate ID is Mandatory", "code" => 400]);
} else {
    if ($visitor_name != '' && $visitor_mob != '') {

        $Query  = " INSERT INTO " . TBL_VISITOR . " SET ";
        $Query .= " associate_id						= '" . $associate_id . "', ";
        $Query .= " visitor_name				    = '" . $visitor_name . "', ";
        $Query .= " visitor_mob					    = '" . $visitor_mob . "', ";
        $Query .= " visitor_dob					= '" . $visitor_dob . "', ";
        $Query .= " visitor_dov					= '" . $visitor_dov . "', ";
        $Query .= " visitor_proffession					= '" . $visitor_proffession . "', ";
        $Query .= " visitor_email					= '" . $visitor_email . "', ";
        $Query .= " visitor_address					= '" . $visitor_address . "', ";
        $Query .= " visitor_city					= '" . $visitor_city . "', ";
        $Query .= " visitor_state					= '" . $visitor_state . "', ";
        $Query .= " visitor_city_code					= '" . $visitor_city_code . "', ";
        $Query .= " visitor_aadhar_card_no					= '" . $visitor_aadhar_card_no . "', ";
        $Query .= " visitor_budget					= '" . $visitor_budget . "', ";
        $Query .= " visitor_project_name					= '" . $visitor_project_name . "', ";
        $Query .= " visitor_project_code					= '" . $visitor_project_code . "', ";
        $Query .= " visitor_aadhar_card_front					= '" . $visitor_aadhar_card_front . "', ";
        $Query .= " visitor_aadhar_card_back					= '" . $visitor_aadhar_card_back . "', ";
        $Query .= " visitor_selfie					= '" . $visitor_selfie . "' ";

        $objDB->setQuery($Query);
        $Query = $objDB->insert();
        if ($Query) {
            echo  json_encode(["msg" => "Visitor Submitted Successfully...!!!", "code" => 200]);
        } else {
            echo  json_encode(["msg" => "Some Technical Error", "code" => 400]);
        }
    } else {
        echo json_encode(["msg" => "Kindly Fill All Mandatory Fields ", "code" => 400]);
    }
}
