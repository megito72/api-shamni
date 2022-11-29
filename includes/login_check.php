<?php
ob_start();
error_reporting(E_ALL & ~E_NOTICE);
// header('Access-Control-Allow-Origin: *');

?>

<?php

$all_header = getallheaders();

// echo print_r($all_header, true);
$token = substr($all_header['Authorization'], 7);

if ($token != H_Token) {
  echo  json_encode(["msg" => "Not Authorized..!!", "code" => 401]);
  die;
}
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$objDB = new DB();

$QU1 = "SELECT * FROM " . TBL_ASSOCIATE_ACCOUNT . " WHERE associate_email='" . $email . "' ";
$objDB->setQuery($QU1);
$rs1 = $objDB->select();
// $objDB->close();
// $jwt = JWT::encode($rs, $enc_key, 'HS512');
// $jwt = str_replace(".", "$", generateRandomString() . $jwt . generateRandomString());
// echo  $jwt;
if (count($rs1) == 1) {
  $QU  = "SELECT * FROM " . TBL_ASSOCIATE_ACCOUNT . " WHERE associate_email='" . $email . "' AND associate_pass='" . $password . "'";
  $objDB->setQuery($QU);
  $rs = $objDB->select();
  $exp_date = date('Y-m-d', strtotime("+30 days"));
  if ($rs[0]['access_token'] == '') {
    $Query1  = " UPDATE " . TBL_ASSOCIATE_ACCOUNT . " SET ";
    $Query1 .= " access_token			= '" . access_token_gen() . "' ,";
    $Query1 .= " token_validity			= '" . $exp_date . "' ";
    $Query1 .= " WHERE associate_email   ='" . $rs[0]['associate_email'] . "' ";
    $objDB->setQuery($Query1);
    $objDB->update();
  } elseif ($rs[0]['access_token'] != '' && $rs[0]['token_validity'] >= date('Y-m-d')) {
    $Query1  = " UPDATE " . TBL_ASSOCIATE_ACCOUNT . " SET ";
    $Query1 .= " access_token			= '" . access_token_gen() . "' ,";
    $Query1 .= " token_validity			= '" . $exp_date . "' ";
    $Query1 .= " WHERE associate_email   ='" . $rs[0]['associate_email'] . "' ";
    $objDB->setQuery($Query1);
    $objDB->update();
  }
  $QU1  = "SELECT * FROM " . TBL_ASSOCIATE_ACCOUNT . " WHERE associate_email='" . $email . "' ";
  $objDB->setQuery($QU1);
  $rs_check = $objDB->select();
  $objDB->close();
  unset($rs_check[0]['associate_pass']);
  unset($rs_check[0]['token_validity']);
  unset($rs_check[0]['reset_link_token']);
  unset($rs_check[0]['reset_exp_date']);
  unset($rs_check[0]['reset_otp_exp_date']);
  unset($rs_check[0]['terms_and_conditions']);
  unset($rs_check[0]['form_clearing_heading']);
  unset($rs_check[0]['associate_mob_status']);
  unset($rs_check[0]['associate_doc_status']);
  unset($rs_check[0]['associate_otp']);
  unset($rs_check[0]['join_type']);
  if ($rs) {
    echo  json_encode(["msg" => "Login Success", "code" => 200, "Data" => $rs_check]);
  } else {
    echo  json_encode(["msg" => "Invalid Credentials", "code" => 401]);
  }
} else {
  echo  json_encode(["msg" => "User Not Found", "code" => 400]);
}
  // echo "\n";
  // echo  $jencode;
// echo "\n";
// echo  str_replace("$", ".", substr($jwt, 4, -4));
