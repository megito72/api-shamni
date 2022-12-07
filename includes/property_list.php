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
$property_plan = $_POST['property_plan'];
$amenities = $_POST['amenities'];
$city = $_POST['city'];
$locality = $_POST['locality'];
$mip = $_POST['mip'];
$mxp = $_POST['mxp'];
if (verify_token($token) == false) {
    echo  json_encode(["msg" => "Not Authorized..!!", "code" => 401]);
    die;
}


if ($property_code) {
    $where = "WHERE p.published=1 AND p.deleted=0 AND p.property_code='" . $property_code . "'";
    $QU1 = "SELECT p.*,pa.amenities_id,(SELECT gallery_name FROM property_gallery WHERE property_id = p.property_id LIMIT 1) AS property_image,(SELECT city_name FROM admin_city WHERE city_id = p.property_city_id) AS city_name,(SELECT locality_name FROM admin_locality WHERE locality_id = p.property_locality_id) AS locality_name,(SELECT MAX(unit_size_price) FROM property_unit WHERE property_id = p.property_id) AS max_unit_area,(SELECT MIN(unit_size_price) FROM property_unit WHERE property_id = p.property_id) AS min_unit_area FROM " . TBL_PROPERTY . " AS p LEFT OUTER JOIN " . TBL_PROJECT_AMINITIES . " AS pa ON pa.property_id = p.property_id LEFT OUTER JOIN " . TBL_PROPERTY_TYPE . " AS pt ON pt.property_id = p.property_id  " . $where . " GROUP BY p.property_id ORDER BY p.property_plan_type DESC";
    $objDB->setQuery($QU1);
    $rs = $objDB->select();
    for ($i = 0; $i < count($rs); $i++) {

        $rs[$i]['amenities_id'] = get_project_amenities($rs[$i]['property_id']);
        if ($rs[$i]['property_possession'] == 1) {
            $rs[$i]['property_possession'] = 'READY TO MOVE';
        } else {
            $rs[$i]['property_possession'] = '';
        }
        if ($rs[$i]['property_rera_no'] != '') {
            $rs[$i]['property_rera_no'] = 'RERA';
        } else {
            $rs[$i]['property_rera_no'] = '';
        }
        if ($rs[$i]['property_image'] == '') {
            $rs[$i]['property_image'] = 'http://shamniestate.com/assets/extra/property/' . 'property-placeholder.webp';
        } else {
            $rs[$i]['property_image'] = 'http://shamniestate.com/assets/extra/property/' . $rs[$i]['property_image'];
        }
        if ($rs[$i]['property_map'] == '') {
            $rs[$i]['property_map'] = 'http://shamniestate.com/assets/extra/property/' . 'property-placeholder.webp';
        } else {
            $rs[$i]['property_map'] = 'http://shamniestate.com/assets/extra/property_map/' . $rs[$i]['property_map'];
        }
    }
    if (count($rs) > 0) {
        echo  json_encode(["msg" => "Property Details", "code" => 200, "Count" => count($rs), "Data" => $rs]);
    } else {
        echo  json_encode(["msg" => "No Data Found", "code" => 400]);
    }
} elseif ($property_place != "") {
    $where = "WHERE p.published=1 AND p.deleted=0 AND p.property_place='" . $property_place . "'";
    $QU1 = "SELECT p.*,pa.amenities_id,(SELECT gallery_name FROM property_gallery WHERE property_id = p.property_id LIMIT 1) AS property_image,(SELECT city_name FROM admin_city WHERE city_id = p.property_city_id) AS city_name,(SELECT locality_name FROM admin_locality WHERE locality_id = p.property_locality_id) AS locality_name,(SELECT MAX(unit_size_price) FROM property_unit WHERE property_id = p.property_id) AS max_unit_area,(SELECT MIN(unit_size_price) FROM property_unit WHERE property_id = p.property_id) AS min_unit_area FROM " . TBL_PROPERTY . " AS p LEFT OUTER JOIN " . TBL_PROJECT_AMINITIES . " AS pa ON pa.property_id = p.property_id LEFT OUTER JOIN " . TBL_PROPERTY_TYPE . " AS pt ON pt.property_id = p.property_id  " . $where . " GROUP BY p.property_id ORDER BY p.property_plan_type DESC";
    $objDB->setQuery($QU1);
    $rs = $objDB->select();
    for ($i = 0; $i < count($rs); $i++) {

        $rs[$i]['amenities_id'] = get_project_amenities($rs[$i]['property_id']);
        if ($rs[$i]['property_possession'] == 1) {
            $rs[$i]['property_possession'] = 'READY TO MOVE';
        } else {
            $rs[$i]['property_possession'] = '';
        }
        if ($rs[$i]['property_rera_no'] != '') {
            $rs[$i]['property_rera_no'] = 'RERA';
        } else {
            $rs[$i]['property_rera_no'] = '';
        }
        if ($rs[$i]['property_image'] == '') {
            $rs[$i]['property_image'] = 'http://shamniestate.com/assets/extra/property/' . 'property-placeholder.webp';
        } else {
            $rs[$i]['property_image'] = 'http://shamniestate.com/assets/extra/property/' . $rs[$i]['property_image'];
        }
        if ($rs[$i]['property_map'] == '') {
            $rs[$i]['property_map'] = 'http://shamniestate.com/assets/extra/property/' . 'property-placeholder.webp';
        } else {
            $rs[$i]['property_map'] = 'http://shamniestate.com/assets/extra/property_map/' . $rs[$i]['property_map'];
        }
    }
    if (count($rs) > 0) {
        echo  json_encode(["msg" => "Property Details", "code" => 200, "Count" => count($rs), "Data" => $rs]);
    } else {
        echo  json_encode(["msg" => "No Data Found", "code" => 400]);
    }
} elseif ($city != "") {
    $where = "WHERE p.published=1 AND p.deleted=0 AND p.property_city_id='" . $city . "'";
    $QU1 = "SELECT p.*,pa.amenities_id,(SELECT gallery_name FROM property_gallery WHERE property_id = p.property_id LIMIT 1) AS property_image,(SELECT city_name FROM admin_city WHERE city_id = p.property_city_id) AS city_name,(SELECT locality_name FROM admin_locality WHERE locality_id = p.property_locality_id) AS locality_name,(SELECT MAX(unit_size_price) FROM property_unit WHERE property_id = p.property_id) AS max_unit_area,(SELECT MIN(unit_size_price) FROM property_unit WHERE property_id = p.property_id) AS min_unit_area FROM " . TBL_PROPERTY . " AS p LEFT OUTER JOIN " . TBL_PROJECT_AMINITIES . " AS pa ON pa.property_id = p.property_id LEFT OUTER JOIN " . TBL_PROPERTY_TYPE . " AS pt ON pt.property_id = p.property_id  " . $where . " GROUP BY p.property_id ORDER BY p.property_plan_type DESC";
    $objDB->setQuery($QU1);
    $rs = $objDB->select();
    for ($i = 0; $i < count($rs); $i++) {

        $rs[$i]['amenities_id'] = get_project_amenities($rs[$i]['property_id']);
        if ($rs[$i]['property_possession'] == 1) {
            $rs[$i]['property_possession'] = 'READY TO MOVE';
        } else {
            $rs[$i]['property_possession'] = '';
        }
        if ($rs[$i]['property_rera_no'] != '') {
            $rs[$i]['property_rera_no'] = 'RERA';
        } else {
            $rs[$i]['property_rera_no'] = '';
        }
        if ($rs[$i]['property_image'] == '') {
            $rs[$i]['property_image'] = 'http://shamniestate.com/assets/extra/property/' . 'property-placeholder.webp';
        } else {
            $rs[$i]['property_image'] = 'http://shamniestate.com/assets/extra/property/' . $rs[$i]['property_image'];
        }
        if ($rs[$i]['property_map'] == '') {
            $rs[$i]['property_map'] = 'http://shamniestate.com/assets/extra/property/' . 'property-placeholder.webp';
        } else {
            $rs[$i]['property_map'] = 'http://shamniestate.com/assets/extra/property_map/' . $rs[$i]['property_map'];
        }
    }
    if (count($rs) > 0) {
        echo  json_encode(["msg" => "Property Details", "code" => 200, "Count" => count($rs), "Data" => $rs]);
    } else {
        echo  json_encode(["msg" => "No Data Found", "code" => 400]);
    }
} elseif ($locality != "") {
    $where = 'WHERE p.published=1 AND p.deleted=0 AND p.property_locality_id=' . $locality . ' ';
    $QU1 = "SELECT p.*,pa.amenities_id,(SELECT gallery_name FROM property_gallery WHERE property_id = p.property_id LIMIT 1) AS property_image,(SELECT city_name FROM admin_city WHERE city_id = p.property_city_id) AS city_name,(SELECT locality_name FROM admin_locality WHERE locality_id = p.property_locality_id) AS locality_name,(SELECT MAX(unit_size_price) FROM property_unit WHERE property_id = p.property_id) AS max_unit_area,(SELECT MIN(unit_size_price) FROM property_unit WHERE property_id = p.property_id) AS min_unit_area FROM " . TBL_PROPERTY . " AS p LEFT OUTER JOIN " . TBL_PROJECT_AMINITIES . " AS pa ON pa.property_id = p.property_id LEFT OUTER JOIN " . TBL_PROPERTY_TYPE . " AS pt ON pt.property_id = p.property_id  " . $where . " GROUP BY p.property_id ORDER BY p.property_plan_type DESC";
    $objDB->setQuery($QU1);
    $rs = $objDB->select();
    for ($i = 0; $i < count($rs); $i++) {

        $rs[$i]['amenities_id'] = get_project_amenities($rs[$i]['property_id']);
        if ($rs[$i]['property_possession'] == 1) {
            $rs[$i]['property_possession'] = 'READY TO MOVE';
        } else {
            $rs[$i]['property_possession'] = '';
        }
        if ($rs[$i]['property_rera_no'] != '') {
            $rs[$i]['property_rera_no'] = 'RERA';
        } else {
            $rs[$i]['property_rera_no'] = '';
        }
        if ($rs[$i]['property_image'] == '') {
            $rs[$i]['property_image'] = 'http://shamniestate.com/assets/extra/property/' . 'property-placeholder.webp';
        } else {
            $rs[$i]['property_image'] = 'http://shamniestate.com/assets/extra/property/' . $rs[$i]['property_image'];
        }
        if ($rs[$i]['property_map'] == '') {
            $rs[$i]['property_map'] = 'http://shamniestate.com/assets/extra/property/' . 'property-placeholder.webp';
        } else {
            $rs[$i]['property_map'] = 'http://shamniestate.com/assets/extra/property_map/' . $rs[$i]['property_map'];
        }
    }
    if (count($rs) > 0) {
        echo  json_encode(["msg" => "Property Details", "code" => 200, "Count" => count($rs), "Data" => $rs]);
    } else {
        echo  json_encode(["msg" => "No Data Found", "code" => 400]);
    }
} elseif ($property_type != "") {
    $where = "WHERE p.published=1 AND p.deleted=0 AND pt.property_type_id='" . $property_type . "'";
    $QU1 = "SELECT p.*,pa.amenities_id,(SELECT gallery_name FROM property_gallery WHERE property_id = p.property_id LIMIT 1) AS property_image,(SELECT city_name FROM admin_city WHERE city_id = p.property_city_id) AS city_name,(SELECT locality_name FROM admin_locality WHERE locality_id = p.property_locality_id) AS locality_name,(SELECT MAX(unit_size_price) FROM property_unit WHERE property_id = p.property_id) AS max_unit_area,(SELECT MIN(unit_size_price) FROM property_unit WHERE property_id = p.property_id) AS min_unit_area FROM " . TBL_PROPERTY . " AS p LEFT OUTER JOIN " . TBL_PROJECT_AMINITIES . " AS pa ON pa.property_id = p.property_id LEFT OUTER JOIN " . TBL_PROPERTY_TYPE . " AS pt ON pt.property_id = p.property_id  " . $where . " GROUP BY p.property_id ORDER BY p.property_plan_type DESC";
    $objDB->setQuery($QU1);
    $rs = $objDB->select();
    for ($i = 0; $i < count($rs); $i++) {

        $rs[$i]['amenities_id'] = get_project_amenities($rs[$i]['property_id']);
        if ($rs[$i]['property_possession'] == 1) {
            $rs[$i]['property_possession'] = 'READY TO MOVE';
        } else {
            $rs[$i]['property_possession'] = '';
        }
        if ($rs[$i]['property_rera_no'] != '') {
            $rs[$i]['property_rera_no'] = 'RERA';
        } else {
            $rs[$i]['property_rera_no'] = '';
        }
        if ($rs[$i]['property_image'] == '') {
            $rs[$i]['property_image'] = 'http://shamniestate.com/assets/extra/property/' . 'property-placeholder.webp';
        } else {
            $rs[$i]['property_image'] = 'http://shamniestate.com/assets/extra/property/' . $rs[$i]['property_image'];
        }
        if ($rs[$i]['property_map'] == '') {
            $rs[$i]['property_map'] = 'http://shamniestate.com/assets/extra/property/' . 'property-placeholder.webp';
        } else {
            $rs[$i]['property_map'] = 'http://shamniestate.com/assets/extra/property_map/' . $rs[$i]['property_map'];
        }
    }
    if (count($rs) > 0) {
        echo  json_encode(["msg" => "Property Details", "code" => 200, "Count" => count($rs), "Data" => $rs]);
    } else {
        echo  json_encode(["msg" => "No Data Found", "code" => 400]);
    }
} elseif ($property_plan != "") {
    $where = "WHERE p.published=1 AND p.deleted=0 AND p.property_plan_type='" . $property_plan . "' ";
    $QU1 = "SELECT p.*,pa.amenities_id,(SELECT gallery_name FROM property_gallery WHERE property_id = p.property_id LIMIT 1) AS property_image,(SELECT city_name FROM admin_city WHERE city_id = p.property_city_id) AS city_name,(SELECT locality_name FROM admin_locality WHERE locality_id = p.property_locality_id) AS locality_name,(SELECT MAX(unit_size_price) FROM property_unit WHERE property_id = p.property_id) AS max_unit_area,(SELECT MIN(unit_size_price) FROM property_unit WHERE property_id = p.property_id) AS min_unit_area FROM " . TBL_PROPERTY . " AS p LEFT OUTER JOIN " . TBL_PROJECT_AMINITIES . " AS pa ON pa.property_id = p.property_id LEFT OUTER JOIN " . TBL_PROPERTY_TYPE . " AS pt ON pt.property_id = p.property_id  " . $where . " GROUP BY p.property_id ORDER BY p.property_plan_type DESC";
    $objDB->setQuery($QU1);
    $rs = $objDB->select();
    for ($i = 0; $i < count($rs); $i++) {

        $rs[$i]['amenities_id'] = get_project_amenities($rs[$i]['property_id']);
        if ($rs[$i]['property_possession'] == 1) {
            $rs[$i]['property_possession'] = 'READY TO MOVE';
        } else {
            $rs[$i]['property_possession'] = '';
        }
        if ($rs[$i]['property_rera_no'] != '') {
            $rs[$i]['property_rera_no'] = 'RERA';
        } else {
            $rs[$i]['property_rera_no'] = '';
        }
        if ($rs[$i]['property_image'] == '') {
            $rs[$i]['property_image'] = 'http://shamniestate.com/assets/extra/property/' . 'property-placeholder.webp';
        } else {
            $rs[$i]['property_image'] = 'http://shamniestate.com/assets/extra/property/' . $rs[$i]['property_image'];
        }
        if ($rs[$i]['property_map'] == '') {
            $rs[$i]['property_map'] = 'http://shamniestate.com/assets/extra/property/' . 'property-placeholder.webp';
        } else {
            $rs[$i]['property_map'] = 'http://shamniestate.com/assets/extra/property_map/' . $rs[$i]['property_map'];
        }
    }
    if (count($rs) > 0) {
        echo  json_encode(["msg" => "Property Details", "code" => 200, "Count" => count($rs), "Data" => $rs]);
    } else {
        echo  json_encode(["msg" => "No Data Found", "code" => 400]);
    }
} elseif ($amenities != "") {
    $where = "WHERE p.published=1 AND p.deleted=0 AND pa.amenities_id IN ('" . $amenities . "')";
    $QU1 = "SELECT p.*,pa.amenities_id,(SELECT gallery_name FROM property_gallery WHERE property_id = p.property_id LIMIT 1) AS property_image,(SELECT city_name FROM admin_city WHERE city_id = p.property_city_id) AS city_name,(SELECT locality_name FROM admin_locality WHERE locality_id = p.property_locality_id) AS locality_name,(SELECT MAX(unit_size_price) FROM property_unit WHERE property_id = p.property_id) AS max_unit_area,(SELECT MIN(unit_size_price) FROM property_unit WHERE property_id = p.property_id) AS min_unit_area FROM " . TBL_PROPERTY . " AS p LEFT OUTER JOIN " . TBL_PROJECT_AMINITIES . " AS pa ON pa.property_id = p.property_id LEFT OUTER JOIN " . TBL_PROPERTY_TYPE . " AS pt ON pt.property_id = p.property_id  " . $where . " GROUP BY p.property_id ORDER BY p.property_plan_type DESC";
    $objDB->setQuery($QU1);
    $rs = $objDB->select();
    for ($i = 0; $i < count($rs); $i++) {

        $rs[$i]['amenities_id'] = get_project_amenities($rs[$i]['property_id']);
        if ($rs[$i]['property_possession'] == 1) {
            $rs[$i]['property_possession'] = 'READY TO MOVE';
        } else {
            $rs[$i]['property_possession'] = '';
        }
        if ($rs[$i]['property_rera_no'] != '') {
            $rs[$i]['property_rera_no'] = 'RERA';
        } else {
            $rs[$i]['property_rera_no'] = '';
        }
        if ($rs[$i]['property_image'] == '') {
            $rs[$i]['property_image'] = 'http://shamniestate.com/assets/extra/property/' . 'property-placeholder.webp';
        } else {
            $rs[$i]['property_image'] = 'http://shamniestate.com/assets/extra/property/' . $rs[$i]['property_image'];
        }
        if ($rs[$i]['property_map'] == '') {
            $rs[$i]['property_map'] = 'http://shamniestate.com/assets/extra/property/' . 'property-placeholder.webp';
        } else {
            $rs[$i]['property_map'] = 'http://shamniestate.com/assets/extra/property_map/' . $rs[$i]['property_map'];
        }
    }
    if (count($rs) > 0) {
        echo  json_encode(["msg" => "Property Details", "code" => 200, "Count" => count($rs), "Data" => $rs]);
    } else {
        echo  json_encode(["msg" => "No Data Found", "code" => 400]);
    }
} elseif ($mip != '' && $mxp != '') {
    $where = "WHERE p.published=1 AND p.deleted=0 AND p.property_min_price >= '" . $mip . "' AND p.property_max_price <='" . $mxp . "'";
    $QU1 = "SELECT p.*,pa.amenities_id,(SELECT gallery_name FROM property_gallery WHERE property_id = p.property_id LIMIT 1) AS property_image,(SELECT city_name FROM admin_city WHERE city_id = p.property_city_id) AS city_name,(SELECT locality_name FROM admin_locality WHERE locality_id = p.property_locality_id) AS locality_name,(SELECT MAX(unit_size_price) FROM property_unit WHERE property_id = p.property_id) AS max_unit_area,(SELECT MIN(unit_size_price) FROM property_unit WHERE property_id = p.property_id) AS min_unit_area FROM " . TBL_PROPERTY . " AS p LEFT OUTER JOIN " . TBL_PROJECT_AMINITIES . " AS pa ON pa.property_id = p.property_id LEFT OUTER JOIN " . TBL_PROPERTY_TYPE . " AS pt ON pt.property_id = p.property_id  " . $where . " GROUP BY p.property_id ORDER BY p.property_plan_type DESC";
    $objDB->setQuery($QU1);
    $rs = $objDB->select();
    for ($i = 0; $i < count($rs); $i++) {

        $rs[$i]['amenities_id'] = get_project_amenities($rs[$i]['property_id']);
        if ($rs[$i]['property_possession'] == 1) {
            $rs[$i]['property_possession'] = 'READY TO MOVE';
        } else {
            $rs[$i]['property_possession'] = '';
        }
        if ($rs[$i]['property_rera_no'] != '') {
            $rs[$i]['property_rera_no'] = 'RERA';
        } else {
            $rs[$i]['property_rera_no'] = '';
        }
        if ($rs[$i]['property_image'] == '') {
            $rs[$i]['property_image'] = 'http://shamniestate.com/assets/extra/property/' . 'property-placeholder.webp';
        } else {
            $rs[$i]['property_image'] = 'http://shamniestate.com/assets/extra/property/' . $rs[$i]['property_image'];
        }
        if ($rs[$i]['property_map'] == '') {
            $rs[$i]['property_map'] = 'http://shamniestate.com/assets/extra/property/' . 'property-placeholder.webp';
        } else {
            $rs[$i]['property_map'] = 'http://shamniestate.com/assets/extra/property_map/' . $rs[$i]['property_map'];
        }
    }
    if (count($rs) > 0) {
        echo  json_encode(["msg" => "Property Details", "code" => 200, "Count" => count($rs), "Data" => $rs]);
    } else {
        echo  json_encode(["msg" => "No Data Found", "code" => 400]);
    }
} else {
    $where = "WHERE p.published=1 AND p.deleted=0 ";
    $QU1 = "SELECT p.*,pa.amenities_id,(SELECT gallery_name FROM property_gallery WHERE property_id = p.property_id LIMIT 1) AS property_image,(SELECT city_name FROM admin_city WHERE city_id = p.property_city_id) AS city_name,(SELECT locality_name FROM admin_locality WHERE locality_id = p.property_locality_id) AS locality_name,(SELECT MAX(unit_size_price) FROM property_unit WHERE property_id = p.property_id) AS max_unit_area,(SELECT MIN(unit_size_price) FROM property_unit WHERE property_id = p.property_id) AS min_unit_area FROM " . TBL_PROPERTY . " AS p LEFT OUTER JOIN " . TBL_PROJECT_AMINITIES . " AS pa ON pa.property_id = p.property_id LEFT OUTER JOIN " . TBL_PROPERTY_TYPE . " AS pt ON pt.property_id = p.property_id  " . $where . " GROUP BY p.property_id ORDER BY p.property_plan_type DESC";
    $objDB->setQuery($QU1);
    $rs = $objDB->select();
    for ($i = 0; $i < count($rs); $i++) {

        $rs[$i]['amenities_id'] = get_project_amenities($rs[$i]['property_id']);
        if ($rs[$i]['property_possession'] == 1) {
            $rs[$i]['property_possession'] = 'READY TO MOVE';
        } else {
            $rs[$i]['property_possession'] = '';
        }
        if ($rs[$i]['property_rera_no'] != '') {
            $rs[$i]['property_rera_no'] = 'RERA';
        } else {
            $rs[$i]['property_rera_no'] = '';
        }
        if ($rs[$i]['property_image'] == '') {
            $rs[$i]['property_image'] = 'http://shamniestate.com/assets/extra/property/' . 'property-placeholder.webp';
        } else {
            $rs[$i]['property_image'] = 'http://shamniestate.com/assets/extra/property/' . $rs[$i]['property_image'];
        }
        if ($rs[$i]['property_map'] == '') {
            $rs[$i]['property_map'] = 'http://shamniestate.com/assets/extra/property/' . 'property-placeholder.webp';
        } else {
            $rs[$i]['property_map'] = 'http://shamniestate.com/assets/extra/property_map/' . $rs[$i]['property_map'];
        }
    }
    if (count($rs) > 0) {
        echo  json_encode(["msg" => "Property Details", "code" => 200, "Count" => count($rs), "Data" => $rs]);
    } else {
        echo  json_encode(["msg" => "No Data Found", "code" => 400]);
    }
}
