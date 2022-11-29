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
if ($_FILES['visitor_aadhar_card_front']) {
    $visitor_aadhar_card_front = $_FILES['visitor_aadhar_card_front']['tmp_name'];
    $visitor_aadhar_card_front_realn = $_FILES['visitor_aadhar_card_front']['name'];
    $visitor_aadhar_card_front_type = $_FILES['visitor_aadhar_card_front']['type'];
    $visitor_aadhar_card_front_type_arr = explode("/", $visitor_aadhar_card_front_type);
    $visitor_aadhar_card_front_type_ext = $visitor_aadhar_card_front_type_arr[1];
    $visitor_aadhar_card_front_new_name = uniqid('file_');
    $new_visitor_aadhar_card_front = $visitor_aadhar_card_front_new_name . '.' . $visitor_aadhar_card_front_type_ext;
    $visitor_aadhar_card_front_target = "/home/h5fmv45174px/public_html/api.shamniestate.com/assets/extra/visitor/documents/" . $new_visitor_aadhar_card_front;
    // move_uploaded_file($_FILES['visitor_aadhar_card_front']['tmp_name'], $visitor_aadhar_card_front_target);
    if (move_uploaded_file($_FILES['visitor_aadhar_card_front']['tmp_name'], $visitor_aadhar_card_front_target)) {
        echo  json_encode(["msg" => "Aadhar Card Image Uploaded Successfully...!!!", "code" => 200, "Data" => $new_visitor_aadhar_card_front]);
    } else {
        echo  json_encode(["msg" => "Image Upload failed", "code" => 400]);
    }
} elseif ($_FILES['visitor_aadhar_card_back']) {
    $visitor_aadhar_card_back = $_FILES['visitor_aadhar_card_back']['tmp_name'];
    $visitor_aadhar_card_back_realn = $_FILES['visitor_aadhar_card_back']['name'];
    $visitor_aadhar_card_back_type = $_FILES['visitor_aadhar_card_back']['type'];
    $visitor_aadhar_card_back_type_arr = explode("/", $visitor_aadhar_card_back_type);
    $visitor_aadhar_card_back_type_ext = $visitor_aadhar_card_back_type_arr[1];
    $visitor_aadhar_card_back_new_name = uniqid('file_');
    $new_visitor_aadhar_card_back = $visitor_aadhar_card_back_new_name . '.' . $visitor_aadhar_card_back_type_ext;
    $visitor_aadhar_card_back_target = "/home/h5fmv45174px/public_html/api.shamniestate.com/assets/extra/visitor/documents/" . $new_visitor_aadhar_card_back;
    // move_uploaded_file($_FILES['visitor_aadhar_card_back']['tmp_name'], $visitor_aadhar_card_back_target);
    if (move_uploaded_file($_FILES['visitor_aadhar_card_back']['tmp_name'], $visitor_aadhar_card_back_target)) {
        echo  json_encode(["msg" => "Aadhar Card Image Uploaded Successfully...!!!", "code" => 200, "Data" => $new_visitor_aadhar_card_back]);
    } else {
        echo  json_encode(["msg" => "Image Upload failed", "code" => 400]);
    }
} elseif ($_FILES['visitor_selfie']) {
    $visitor_selfie = $_FILES['visitor_selfie']['tmp_name'];
    $visitor_selfie_realn = $_FILES['visitor_selfie']['name'];
    $visitor_selfie_type = $_FILES['visitor_selfie']['type'];
    $visitor_selfie_type_arr = explode("/", $visitor_selfie_type);
    $visitor_selfie_type_ext = $visitor_selfie_type_arr[1];
    $visitor_selfie_new_name = uniqid('file_');
    $new_visitor_selfie = $visitor_selfie_new_name . '.' . $visitor_selfie_type_ext;
    $visitor_selfie_target = "/home/h5fmv45174px/public_html/api.shamniestate.com/assets/extra/visitor/selfie/" . $new_visitor_selfie;
    // move_uploaded_file($_FILES['visitor_selfie']['tmp_name'], $visitor_selfie_target);
    if (move_uploaded_file($_FILES['visitor_selfie']['tmp_name'], $visitor_selfie_target)) {
        echo  json_encode(["msg" => "Selfie Uploaded Successfully...!!!", "code" => 200, "Data" => $new_visitor_selfie]);
    } else {
        echo  json_encode(["msg" => "Image Upload failed", "code" => 400]);
    }
} elseif ($_FILES['associate_aadhar_card_front']) {
    $associate_aadhar_card_front = $_FILES['associate_aadhar_card_front']['tmp_name'];
    $associate_aadhar_card_front_realn = $_FILES['associate_aadhar_card_front']['name'];
    $associate_aadhar_card_front_type = $_FILES['associate_aadhar_card_front']['type'];
    $associate_aadhar_card_front_type_arr = explode("/", $associate_aadhar_card_front_type);
    $associate_aadhar_card_front_type_ext = $associate_aadhar_card_front_type_arr[1];
    $associate_aadhar_card_front_new_name = uniqid('file_');
    $new_associate_aadhar_card_front = $associate_aadhar_card_front_new_name . '.' . $associate_aadhar_card_front_type_ext;
    $associate_aadhar_card_front_target = "/home/h5fmv45174px/public_html/api.shamniestate.com/assets/extra/associate/documents/" . $new_associate_aadhar_card_front;
    // move_uploaded_file($_FILES['associate_aadhar_card_front']['tmp_name'], $associate_aadhar_card_front_target);
    if (move_uploaded_file($_FILES['associate_aadhar_card_front']['tmp_name'], $associate_aadhar_card_front_target)) {
        echo  json_encode(["msg" => "Aadhar Card Image Uploaded Successfully...!!!", "code" => 200, "Data" => $new_associate_aadhar_card_front]);
    } else {
        echo  json_encode(["msg" => "Image Upload failed", "code" => 400]);
    }
} elseif ($_FILES['associate_aadhar_card_back']) {
    $associate_aadhar_card_back = $_FILES['associate_aadhar_card_back']['tmp_name'];
    $associate_aadhar_card_back_realn = $_FILES['associate_aadhar_card_back']['name'];
    $associate_aadhar_card_back_type = $_FILES['associate_aadhar_card_back']['type'];
    $associate_aadhar_card_back_type_arr = explode("/", $associate_aadhar_card_back_type);
    $associate_aadhar_card_back_type_ext = $associate_aadhar_card_back_type_arr[1];
    $associate_aadhar_card_back_new_name = uniqid('file_');
    $new_associate_aadhar_card_back = $associate_aadhar_card_back_new_name . '.' . $associate_aadhar_card_back_type_ext;
    $associate_aadhar_card_back_target = "/home/h5fmv45174px/public_html/api.shamniestate.com/assets/extra/associate/documents/" . $new_associate_aadhar_card_back;
    // move_uploaded_file($_FILES['associate_aadhar_card_back']['tmp_name'], $associate_aadhar_card_back_target);
    if (move_uploaded_file($_FILES['associate_aadhar_card_back']['tmp_name'], $associate_aadhar_card_back_target)) {
        echo  json_encode(["msg" => "Aadhar Card Image Uploaded Successfully...!!!", "code" => 200, "Data" => $new_associate_aadhar_card_back]);
    } else {
        echo  json_encode(["msg" => "Image Upload failed", "code" => 400]);
    }
} elseif ($_FILES['associate_blank_cheque']) {
    $associate_blank_cheque = $_FILES['associate_blank_cheque']['tmp_name'];
    $associate_blank_cheque_realn = $_FILES['associate_blank_cheque']['name'];
    $associate_blank_cheque_type = $_FILES['associate_blank_cheque']['type'];
    $associate_blank_cheque_type_arr = explode("/", $associate_blank_cheque_type);
    $associate_blank_cheque_type_ext = $associate_blank_cheque_type_arr[1];
    $associate_blank_cheque_new_name = uniqid('file_');
    $new_associate_blank_cheque = $associate_blank_cheque_new_name . '.' . $associate_blank_cheque_type_ext;
    $associate_blank_cheque_target = "/home/h5fmv45174px/public_html/api.shamniestate.com/assets/extra/associate/documents/" . $new_associate_blank_cheque;
    // move_uploaded_file($_FILES['associate_blank_cheque']['tmp_name'], $associate_blank_cheque_target);
    if (move_uploaded_file($_FILES['associate_blank_cheque']['tmp_name'], $associate_blank_cheque_target)) {
        echo  json_encode(["msg" => "Blank Cheque Uploaded Successfully...!!!", "code" => 200, "Data" => $new_associate_blank_cheque]);
    } else {
        echo  json_encode(["msg" => "Image Upload failed", "code" => 400]);
    }
} elseif ($_FILES['associate_pan_card_front']) {
    $associate_pan_card_front = $_FILES['associate_pan_card_front']['tmp_name'];
    $associate_pan_card_front_realn = $_FILES['associate_pan_card_front']['name'];
    $associate_pan_card_front_type = $_FILES['associate_pan_card_front']['type'];
    $associate_pan_card_front_type_arr = explode("/", $associate_pan_card_front_type);
    $associate_pan_card_front_type_ext = $associate_pan_card_front_type_arr[1];
    $associate_pan_card_front_new_name = uniqid('file_');
    $new_associate_pan_card_front = $associate_pan_card_front_new_name . '.' . $associate_pan_card_front_type_ext;
    $associate_pan_card_front_target = "/home/h5fmv45174px/public_html/api.shamniestate.com/assets/extra/associate/documents/" . $new_associate_pan_card_front;
    // move_uploaded_file($_FILES['associate_pan_card_front']['tmp_name'], $associate_pan_card_front_target);
    if (move_uploaded_file($_FILES['associate_pan_card_front']['tmp_name'], $associate_pan_card_front_target)) {
        echo  json_encode(["msg" => "Pan Card Image Uploaded Successfully...!!!", "code" => 200, "Data" => $new_associate_pan_card_front]);
    } else {
        echo  json_encode(["msg" => "Image Upload failed", "code" => 400]);
    }
} else {
    echo  json_encode(["msg" => "Kindly Pass Mandatory Parameter", "code" => 400]);
}
