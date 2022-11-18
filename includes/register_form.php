<?php
ob_start();
error_reporting(E_ALL & ~E_NOTICE);

?>

<?php

$all_header = getallheaders();
$token = substr($all_header['Authorization'], 7);

if ($token != H_Token) {
    echo  json_encode(["msg" => "Not Authorized..!!", "code" => 400]);
    die;
}
$objDB = new DB();
$account_type = $_POST['account_type'];
if ($account_type == "Individual") {
    $account_type = 1;
} else {
    $account_type = 0;
}
$associate_name = $_POST['associate_name'];
$associate_dob = $_POST['associate_dob'];
$associate_mobile = $_POST['associate_mobile'];
$associate_address = $_POST['associate_address'];
$associate_city = $_POST['associate_city'];
$associate_state = $_POST['associate_state'];
$associate_city_zip = $_POST['associate_city_zip'];
$associate_aadhar_card_no = $_POST['associate_aadhar_card_no'];
$associate_pan_no = $_POST['associate_pan_no'];
$associate_bank_name = $_POST['associate_bank_name'];
$associate_acc_no = $_POST['associate_acc_no'];
$associate_bnk_ifsc_no = $_POST['associate_bnk_ifsc_no'];
$associate_bnk_acc_name = $_POST['associate_bnk_acc_name'];
$associate_email = $_POST['associate_email'];
$associate_pass = $_POST['associate_pass'];
$associate_con_pass = $_POST['associate_con_pass'];
$sponsor_id = $_POST['sponsor_id'];
$terms_and_conditions = $_POST['terms_and_conditions'];
$associate_gstin_no = $_POST['associate_gstin_no'];
$associate_rera_reg_no = $_POST['associate_rera_reg_no'];
$associate_aadhar_card_front = $_FILE['associate_aadhar_card_front']['tmp_name'];
$associate_aadhar_card_front_realn = $_FILE['associate_aadhar_card_front']['name'];
$associate_aadhar_card_back = $_FILE['associate_aadhar_card_back']['tmp_name'];
$associate_aadhar_card_back_realn = $_FILE['associate_aadhar_card_back']['name'];
$associate_blank_cheque = $_FILE['associate_blank_cheque']['tmp_name'];
$associate_blank_cheque_realn = $_FILE['associate_blank_cheque']['name'];
$associate_pan_card_front = $_FILE['associate_pan_card_front']['tmp_name'];
$associate_pan_card_front_realn = $_FILE['associate_pan_card_front']['name'];

// POST Request Process Start

$associate_aadhar_card_front_extension = pathinfo($associate_aadhar_card_front_realn, PATHINFO_EXTENSION);
$associate_aadhar_card_front_new_name = uniqid('file_');
$new_associate_aadhar_card_front = $associate_aadhar_card_front_new_name . '.' . $associate_aadhar_card_front_extension;
$associate_aadhar_card_front_target = "public_html/api.shamniestate.com/assets/extra/associate/documents/" . $new_associate_aadhar_card_front;

$associate_aadhar_card_back_extension = pathinfo($associate_aadhar_card_back_realn, PATHINFO_EXTENSION);
$associate_aadhar_card_back_new_name = uniqid('file_');
$new_associate_aadhar_card_back = $associate_aadhar_card_back_new_name . '.' . $associate_aadhar_card_back_extension;
$associate_aadhar_card_back_target = "public_html/api.shamniestate.com/assets/extra/associate/documents/" . $new_associate_aadhar_card_back;

$associate_blank_cheque_extension = pathinfo($associate_blank_cheque_realn, PATHINFO_EXTENSION);
$associate_blank_cheque_new_name = uniqid('file_');
$new_associate_blank_cheque = $associate_blank_cheque_new_name . '.' . $associate_blank_cheque_extension;
$associate_blank_cheque_target = "public_html/api.shamniestate.com/assets/extra/associate/documents/" . $new_associate_blank_cheque;

$associate_pan_card_front_extension = pathinfo($associate_pan_card_front_realn, PATHINFO_EXTENSION);
$associate_pan_card_front_new_name = uniqid('file_');
$new_associate_pan_card_front = $associate_pan_card_front_new_name . '.' . $associate_pan_card_front_extension;
$associate_pan_card_front_target = "public_html/api.shamniestate.com/assets/extra/associate/documents/" . $new_associate_pan_card_front;

// POST Request Process End


$QU  = "SELECT * FROM " . TBL_ASSOCIATE_ACCOUNT . " WHERE associate_email='" . $associate_email . "' ";
$objDB->setQuery($QU);
$rs = $objDB->select();

if (count($rs) == 1) {
    echo  json_encode(["msg" => "Associate Email ID Already in Use", "code" => 200]);
} else {
    if ($associate_email != '' && $associate_name != '') {
        $sponsor_res = getsponsorid($sponsor_id);
        if ($sponsor_res) {
            move_uploaded_file($_FILES['associate_aadhar_card_front']['tmp_name'], $associate_aadhar_card_front_target);
            move_uploaded_file($_FILES['associate_aadhar_card_back']['tmp_name'], $associate_aadhar_card_back_target);
            move_uploaded_file($_FILES['associate_blank_cheque']['tmp_name'], $associate_blank_cheque_target);
            move_uploaded_file($_FILES['associate_pan_card_front']['tmp_name'], $associate_pan_card_front_target);
            $Query  = " INSERT INTO " . TBL_ASSOCIATE_ACCOUNT . " SET ";
            $Query .= " account_type						= '" . $account_type . "', ";
            $Query .= " associate_name				    = '" . $associate_name . "', ";
            $Query .= " associate_dob					    = '" . $associate_dob . "', ";
            $Query .= " associate_mobile					= '" . $associate_mobile . "', ";
            $Query .= " associate_address					= '" . $associate_address . "', ";
            $Query .= " associate_state					= '" . $associate_state . "', ";
            $Query .= " associate_city_zip					= '" . $associate_city_zip . "', ";
            $Query .= " associate_aadhar_card_no					= '" . $associate_aadhar_card_no . "', ";
            $Query .= " associate_pan_no					= '" . $associate_pan_no . "', ";
            $Query .= " associate_bank_name					= '" . $associate_bank_name . "', ";
            $Query .= " associate_acc_no					= '" . $associate_acc_no . "', ";
            $Query .= " associate_bnk_ifsc_no					= '" . $associate_bnk_ifsc_no . "', ";
            $Query .= " associate_bnk_acc_name					= '" . $associate_bnk_acc_name . "', ";
            $Query .= " associate_email					= '" . $associate_email . "', ";
            $Query .= " associate_pass					= '" . $associate_pass . "', ";
            $Query .= " terms_and_conditions					= '1', ";
            $Query .= " privacy_policy					= '1', ";
            $Query .= " associate_gstin_no					= '" . $associate_gstin_no . "', ";
            $Query .= " sponsor_id					= '" . $sponsor_id . "', ";
            $Query .= " associate_rera_reg_no					= '" . $associate_rera_reg_no . "', ";
            $Query .= " associate_aadhar_card_front					= '" . $associate_aadhar_card_front . "', ";
            $Query .= " associate_aadhar_card_back					= '" . $associate_aadhar_card_back . "', ";
            $Query .= " associate_pan_card_front					= '" . $associate_pan_card_front . "', ";
            $Query .= " associate_blank_cheque					= '" . $associate_blank_cheque . "' ";

            $objDB->setQuery($Query);
            $Query = $objDB->insert();
            if ($Query) {
                echo  json_encode(["msg" => "Associate Created Successfully...!!!", "code" => 200]);
            } else {
                echo  json_encode(["msg" => "Some Technical Error", "code" => 400]);
            }
        } elseif ($sponsor_res == "Invalid Sponsor ID") {
            echo  json_encode(["msg" => "Invalid Sponsor Code", "code" => 400]);
        } else {
            echo  json_encode(["msg" => $sponsor_res, "code" => 400]);
        }
    } else {
        echo json_encode(["msg" => "Kindly Fill All Mandatory Fields ", "code" => 400]);
    }
}
