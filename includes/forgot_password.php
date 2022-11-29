<?php
ob_start();
error_reporting(E_ALL & ~E_NOTICE);
require_once "/home/h5fmv45174px/public_html/api.shamniestate.com/vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
?>

<?php

$all_header = getallheaders();
$token = substr($all_header['Authorization'], 7);

if ($token != H_Token) {
    echo  json_encode(["msg" => "Not Authorized..!!", "code" => 401]);
    die;
}
$objDB = new DB();

$associate_email = $_POST['associate_email'];
// $associate_email = "pritesh.patidar123@gmail.com";

$token = md5($associate_email) . rand(10, 9999);
$expFormat = mktime(date("H") + 1, date("i"), date("s"), date("m"), date("d"), date("Y"));
// POST Request Process Start
$to = $associate_email;
$message = "<h2>Hello " . email_to_name($associate_email) . "</h2>";
$message .= "<h2>Reset Your Shamni Estate Associate Account Password</h2>";
$message .= "<a href='http://api.shamniestate.com/verify_token/?str=" . $token . "'>Click Here To Reset Your Password</a>";


$mail = new PHPMailer;
//Enable SMTP debugging.
// $mail->SMTPDebug = 3;
//Set PHPMailer to use SMTP.
$mail->isSMTP();
//Set SMTP host name                      
$mail->Host = "sg2plzcpnl487155.prod.sin2.secureserver.net";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;
//Provide username and password
$mail->Username = "support@shamniestate.com";
$mail->Password = 'Support@2022';
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "SSL";
//Set TCP port to connect to
$mail->Port = 587;
$mail->From = "support@shamniestate.com";
$mail->FromName = "Support Shamni";
$mail->addAddress($to, "Recepient Name");
$mail->isHTML(true);
$mail->Subject = "Reset Your Shamni Estate Associate Account Password";
$mail->Body = $message;
$mail->AltBody = "This is the plain text version of the email content";
if (!$mail->send()) {
    // echo "Mailer Error: " . $mail->ErrorInfo;
    echo  json_encode(["msg" => "Mail Sending Failed", "code" => 400, "Error" => $mail->ErrorInfo]);
} else {
    $Query  = " UPDATE " . TBL_ASSOCIATE_ACCOUNT . " SET ";
    $Query .= " reset_link_token						= '" . $token . "', ";
    $Query .= " reset_exp_date				    = '" . $expFormat . "' ";
    $Query .= " WHERE associate_email					= '" . $associate_email . "' ";
    $objDB->setQuery($Query);
    $Query = $objDB->update();
    if ($Query) {
        echo  json_encode(["msg" => "Password Reset Link Send Successfully...!!!", "code" => 200]);
    } else {
        echo  json_encode(["msg" => "Some Technical Error", "code" => 400]);
    }
}
