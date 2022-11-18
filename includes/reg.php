<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $url = "register_form";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
        "Authorizartion: 'Bearer ocLGuJGguH2u1KmxiYLii00XeBFePmvdLzy2MjxE2CoJOra7'",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $data = <<<DATA
{
  "Id": 78912,
  "Customer": "Jason Sweet",
  "Quantity": 1,
  "Price": 18.00
}
DATA;

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    $resp = curl_exec($curl);
    curl_close($curl);

    echo $resp;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>HVC Admin</title>
    <!-- plugins:css -->

    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <style>
        .container {
            font-family: arial;
            font-size: 30px;
            width: 100%;
            height: 100%;
            margin-top: 25%;
            position: relative;
        }
    </style>
</head>

<body>
    <form method="POST" action="" enctype="multipart/form-data">
        <input type="text" name="associate_email" placeholder="Email">
        <input type="text" name="associate_pass" placeholder="Password">
        <input type="file" name="associate_aadhar_card_front" placeholder="File">

        <button type="submit" class="btn">Submit</button>
    </form>
</body>

</html>