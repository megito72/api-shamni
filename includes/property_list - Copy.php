<?php
ob_start();
error_reporting(E_ALL & ~E_NOTICE);
?>

<?php

$all_header = getallheaders();

// echo print_r($all_header, true);
$token = $all_header['Access_Token'];
$property_code = $_POST['property_code'];
$property_place = $_POST['property_place'];
$property_type = $_POST['property_type'];
$city = $_POST['city'];
$locality = $_POST['locality'];
if (verify_token($token) == false) {
    echo  json_encode(["msg" => "Not Authorized..!!", "code" => 401]);
    die;
}

if ($property_code != '') {
    $QU1 = "SELECT * FROM " . TBL_PROPERTY . " WHERE deleted='0' AND property_code='" . $property_code . "' ";
    $objDB->setQuery($QU1);
    $rs = $objDB->select();
    for ($i = 0; $i < count($rs); $i++) {
        $rs[$i]['property_city_name'] = get_city_name($rs[$i]['property_city_id']);
        $rs[$i]['property_locality_name'] = get_locality_name($rs[$i]['property_locality_id']);
        if ($rs[$i]['property_place'] == 1) {
            $rs[$i]['property_place_name'] = "Residential";
        } elseif ($rs[$i]['property_place'] == 2) {
            $rs[$i]['property_place_name'] = "Commercial";
        } elseif ($rs[$i]['property_place'] == 3) {
            $rs[$i]['property_place_name'] = "FarmHouse";
        }
        $rs[$i]['property_place_type_name'] = get_property_type_name($rs[$i]['property_place_type']);
    }
    if (count($rs) > 0) {

        echo  json_encode(["msg" => "Property Details", "code" => 200, "Count" => count($rs), "Data" => $rs]);
    } else {
        echo  json_encode(["msg" => "No Data Found", "code" => 400]);
    }
} elseif ($property_code == '' && $property_place != '' && $property_type != '' && $city != '' && $locality != '') {
    $QU1 = "SELECT * FROM " . TBL_PROPERTY . " WHERE deleted='0' AND property_place='" . $property_place . "' AND property_place_type='" . $property_type . "' AND property_city_id='" . $city . "' AND property_locality_id='" . $locality . "'";
    $objDB->setQuery($QU1);
    $rs = $objDB->select();
    for ($i = 0; $i < count($rs); $i++) {
        $rs[$i]['property_city_name'] = get_city_name($rs[$i]['property_city_id']);
        $rs[$i]['property_locality_name'] = get_locality_name($rs[$i]['property_locality_id']);
        if ($rs[$i]['property_place'] == 1) {
            $rs[$i]['property_place_name'] = "Residential";
        } elseif ($rs[$i]['property_place'] == 2) {
            $rs[$i]['property_place_name'] = "Commercial";
        } elseif ($rs[$i]['property_place'] == 3) {
            $rs[$i]['property_place_name'] = "FarmHouse";
        }
        $rs[$i]['property_place_type_name'] = get_property_type_name($rs[$i]['property_place_type']);
    }
    if (count($rs) > 0) {

        echo  json_encode(["msg" => "Property Details", "code" => 200, "Count" => count($rs), "Data" => $rs]);
    } else {
        echo  json_encode(["msg" => "No Data Found", "code" => 400]);
    }
} elseif ($property_code == '' && $property_place != '' && $property_type == '' && $city != '' && $locality != '') {
    $QU1 = "SELECT * FROM " . TBL_PROPERTY . " WHERE deleted='0' AND property_place='" . $property_place . "' AND property_city_id='" . $city . "' AND property_locality_id='" . $locality . "'";
    $objDB->setQuery($QU1);
    $rs = $objDB->select();
    for ($i = 0; $i < count($rs); $i++) {
        $rs[$i]['property_city_name'] = get_city_name($rs[$i]['property_city_id']);
        $rs[$i]['property_locality_name'] = get_locality_name($rs[$i]['property_locality_id']);
        if ($rs[$i]['property_place'] == 1) {
            $rs[$i]['property_place_name'] = "Residential";
        } elseif ($rs[$i]['property_place'] == 2) {
            $rs[$i]['property_place_name'] = "Commercial";
        } elseif ($rs[$i]['property_place'] == 3) {
            $rs[$i]['property_place_name'] = "FarmHouse";
        }
        $rs[$i]['property_place_type_name'] = get_property_type_name($rs[$i]['property_place_type']);
    }
    if (count($rs) > 0) {

        echo  json_encode(["msg" => "Property Details", "code" => 200, "Count" => count($rs), "Data" => $rs]);
    } else {
        echo  json_encode(["msg" => "No Data Found", "code" => 400]);
    }
} elseif ($property_code == '' && $property_place != '' && $property_type != '' && $city != '') {
    $QU1 = "SELECT * FROM " . TBL_PROPERTY . " WHERE deleted='0' AND property_place='" . $property_place . "' AND property_place_type='" . $property_type . "' AND property_city_id='" . $city . "'";
    $objDB->setQuery($QU1);
    $rs = $objDB->select();
    for ($i = 0; $i < count($rs); $i++) {
        $rs[$i]['property_city_name'] = get_city_name($rs[$i]['property_city_id']);
        $rs[$i]['property_locality_name'] = get_locality_name($rs[$i]['property_locality_id']);
        if ($rs[$i]['property_place'] == 1) {
            $rs[$i]['property_place_name'] = "Residential";
        } elseif ($rs[$i]['property_place'] == 2) {
            $rs[$i]['property_place_name'] = "Commercial";
        } elseif ($rs[$i]['property_place'] == 3) {
            $rs[$i]['property_place_name'] = "FarmHouse";
        }
        $rs[$i]['property_place_type_name'] = get_property_type_name($rs[$i]['property_place_type']);
    }
    if (count($rs) > 0) {

        echo  json_encode(["msg" => "Property Details", "code" => 200, "Count" => count($rs), "Data" => $rs]);
    } else {
        echo  json_encode(["msg" => "No Data Found", "code" => 400]);
    }
} elseif ($property_code == '' && $property_place != '' && $property_type == '' && $city != '') {
    $QU1 = "SELECT * FROM " . TBL_PROPERTY . " WHERE deleted='0' AND property_place='" . $property_place . "' AND property_city_id='" . $city . "'";
    $objDB->setQuery($QU1);
    $rs = $objDB->select();
    for ($i = 0; $i < count($rs); $i++) {
        $rs[$i]['property_city_name'] = get_city_name($rs[$i]['property_city_id']);
        $rs[$i]['property_locality_name'] = get_locality_name($rs[$i]['property_locality_id']);
        if ($rs[$i]['property_place'] == 1) {
            $rs[$i]['property_place_name'] = "Residential";
        } elseif ($rs[$i]['property_place'] == 2) {
            $rs[$i]['property_place_name'] = "Commercial";
        } elseif ($rs[$i]['property_place'] == 3) {
            $rs[$i]['property_place_name'] = "FarmHouse";
        }
        $rs[$i]['property_place_type_name'] = get_property_type_name($rs[$i]['property_place_type']);
    }
    if (count($rs) > 0) {

        echo  json_encode(["msg" => "Property Details", "code" => 200, "Count" => count($rs), "Data" => $rs]);
    } else {
        echo  json_encode(["msg" => "No Data Found", "code" => 400]);
    }
} elseif ($property_code == '' && $property_place != '' && $property_type != '') {
    $QU1 = "SELECT * FROM " . TBL_PROPERTY . " WHERE deleted='0' AND property_place='" . $property_place . "' AND property_place_type='" . $property_type . "'";
    $objDB->setQuery($QU1);
    $rs = $objDB->select();
    for ($i = 0; $i < count($rs); $i++) {
        $rs[$i]['property_city_name'] = get_city_name($rs[$i]['property_city_id']);
        $rs[$i]['property_locality_name'] = get_locality_name($rs[$i]['property_locality_id']);
        if ($rs[$i]['property_place'] == 1) {
            $rs[$i]['property_place_name'] = "Residential";
        } elseif ($rs[$i]['property_place'] == 2) {
            $rs[$i]['property_place_name'] = "Commercial";
        } elseif ($rs[$i]['property_place'] == 3) {
            $rs[$i]['property_place_name'] = "FarmHouse";
        }
        $rs[$i]['property_place_type_name'] = get_property_type_name($rs[$i]['property_place_type']);
    }
    if (count($rs) > 0) {

        echo  json_encode(["msg" => "Property Details", "code" => 200, "Count" => count($rs), "Data" => $rs]);
    } else {
        echo  json_encode(["msg" => "No Data Found", "code" => 400]);
    }
} elseif ($property_code == '' && $property_place != '') {
    $QU1 = "SELECT * FROM " . TBL_PROPERTY . " WHERE deleted='0' AND property_place='" . $property_place . "' ";
    $objDB->setQuery($QU1);
    $rs = $objDB->select();
    for ($i = 0; $i < count($rs); $i++) {
        $rs[$i]['property_city_name'] = get_city_name($rs[$i]['property_city_id']);
        $rs[$i]['property_locality_name'] = get_locality_name($rs[$i]['property_locality_id']);
        if ($rs[$i]['property_place'] == 1) {
            $rs[$i]['property_place_name'] = "Residential";
        } elseif ($rs[$i]['property_place'] == 2) {
            $rs[$i]['property_place_name'] = "Commercial";
        } elseif ($rs[$i]['property_place'] == 3) {
            $rs[$i]['property_place_name'] = "FarmHouse";
        }
        $rs[$i]['property_place_type_name'] = get_property_type_name($rs[$i]['property_place_type']);
    }
    if (count($rs) > 0) {

        echo  json_encode(["msg" => "Property Details", "code" => 200, "Count" => count($rs), "Data" => $rs]);
    } else {
        echo  json_encode(["msg" => "No Data Found", "code" => 400]);
    }
} else {
    $QU1 = "SELECT * FROM " . TBL_PROPERTY . " WHERE deleted='0' ";
    $objDB->setQuery($QU1);
    $rs = $objDB->select();
    for ($i = 0; $i < count($rs); $i++) {
        $rs[$i]['property_city_name'] = get_city_name($rs[$i]['property_city_id']);
        $rs[$i]['property_locality_name'] = get_locality_name($rs[$i]['property_locality_id']);
        if ($rs[$i]['property_place'] == 1) {
            $rs[$i]['property_place_name'] = "Residential";
        } elseif ($rs[$i]['property_place'] == 2) {
            $rs[$i]['property_place_name'] = "Commercial";
        } elseif ($rs[$i]['property_place'] == 3) {
            $rs[$i]['property_place_name'] = "FarmHouse";
        }
        $rs[$i]['property_place_type_name'] = get_property_type_name($rs[$i]['property_place_type']);
    }
    if (count($rs) > 0) {

        echo  json_encode(["msg" => "All Property List", "code" => 200, "Count" => count($rs), "Data" => $rs]);
    } else {
        echo  json_encode(["msg" => "No Data Found", "code" => 400]);
    }
}
