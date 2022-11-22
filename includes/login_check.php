<?php
ob_start();
error_reporting(E_ALL & ~E_NOTICE);
// header('Access-Control-Allow-Origin: *');



// $enc_key = "Jordan72";
// function generateRandomString($length = 4)
// {
//   $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//   $charactersLength = strlen($characters);
//   $randomString = '';
//   for ($i = 0; $i < $length; $i++) {
//     $randomString .= $characters[rand(0, $charactersLength - 1)];
//   }
//   return $randomString;
// }

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
  $objDB->close();
  $rs_arr = [
    'uname' => $rs[0]['username'],
    'type' => $rs[0]['user_type'],
    'uid' => $rs[0]['user_id']
  ];
  if ($rs) {
    echo  json_encode(["msg" => "Login Success", "code" => 200, "Data" => $rs]);
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
