<?php
if (!defined('__CONFIG__')) {
	header("location:" . SITE_URL);
	die();
}
// $enc_key = "Jordan72";
function access_token_gen()
{
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < 50; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

function verify_token($token)
{
	global $objDB;
	$val = '';
	if ($token != '') {
		$Query  = "SELECT * FROM " . TBL_ASSOCIATE_ACCOUNT . " WHERE access_token ='" . $token . "'";
		$objDB->setQuery($Query);
		$rsTotal = $objDB->select();
		if (count($rsTotal) > 0) {
			if ($rsTotal[0]['token_validity'] > date('Y-m-d')) {
				$val = true;
			} else {
				$val = false;
			}
		} else {
			$val = false;
		}
	} else {
		$val = false;
	}
	return $val;
}

function email_to_name($id)
{

	global $objDB;
	$val = '';

	$Query  = "SELECT * FROM " . TBL_ASSOCIATE_ACCOUNT . " WHERE associate_email ='" . $id . "'";
	$objDB->setQuery($Query);
	$rsTotal = $objDB->select();
	if ($rsTotal) {
		$val = $rsTotal[0]['associate_name'];
	} else {
		$val = "";
	}
	return $val;
}
function get_project_amenities($id)
{

	global $objDB;
	$val = '';

	$Query  = "SELECT pa.amenities_id FROM " . TBL_PROJECT_AMINITIES . " AS pa JOIN " . TBL_ADMIN_AMENITIES . " AS am ON pa.amenities_id=am.amenities_id WHERE pa.property_id='" . $id . "' ORDER BY pa.property_id ";
	// $Query  = "SELECT pa.amenities_id, am.amenities_name, am.amenities_icon FROM " . TBL_PROJECT_AMINITIES . " AS pa JOIN " . TBL_ADMIN_AMENITIES . " AS am ON pa.amenities_id=am.amenities_id WHERE pa.property_id='" . $id . "' ORDER BY pa.property_id ";
	$objDB->setQuery($Query);
	$rsTotal = $objDB->select();
	if ($rsTotal) {
		// $val = $rsTotal;
		$val = implode(",", array_column($rsTotal, 'amenities_id'));
	} else {
		$val = "";
	}
	return $val;
}
function getsponsorid($id)
{

	global $objDB;
	$val = '';

	$Query  = "SELECT * FROM " . TBL_ASSOCIATE_ACCOUNT . " WHERE associate_invite_code <>'' AND associate_invite_code = '" . $id . "'";
	$objDB->setQuery($Query);
	$rsTotal = $objDB->select();
	if ($rsTotal) {
		if ($rsTotal[0]['associate_account_status'] == 1) {
			$val = true;
		} else {
			$val = "Account Disabled for this Sponsor ID:" . $id . "";
		}
	} else {
		$val = "Invalid Sponsor ID";
	}
	return $val;
}

function get_assoc_spons_id($id)
{

	global $objDB;
	$val = '';

	$Query  = "SELECT * FROM " . TBL_ASSOCIATE_ACCOUNT . " WHERE associate_invite_code <>'' AND associate_id = '" . $id . "'";
	$objDB->setQuery($Query);
	$rsTotal = $objDB->select();
	if ($rsTotal) {
		if ($rsTotal[0]['associate_account_status'] == 1) {
			$val = $rsTotal[0]['associate_invite_code'];
		} else {
			$val = "Account Disabled for this Sponsor ID:" . $id . "";
		}
	} else {
		$val = "Invalid Associate ID";
	}
	return $val;
}

function get_city_name($id)
{

	global $objDB;
	$val = '';

	$Query  = "SELECT * FROM " . TBL_ADMIN_CITY . " WHERE city_id = '" . $id . "'";
	$objDB->setQuery($Query);
	$rsTotal = $objDB->select();
	if ($rsTotal) {

		$val = $rsTotal[0]['city_name'];
	} else {
		$val = "City Not Found";
	}
	return $val;
}
function get_locality_name($id)
{

	global $objDB;
	$val = '';

	$Query  = "SELECT * FROM " . TBL_ADMIN_LOCALITY . " WHERE locality_id = '" . $id . "'";
	$objDB->setQuery($Query);
	$rsTotal = $objDB->select();
	if ($rsTotal) {

		$val = $rsTotal[0]['locality_name'];
	} else {
		$val = "Locality Not Found";
	}
	return $val;
}
function get_property_type_name($id)
{

	global $objDB;
	$val = '';

	$Query  = "SELECT * FROM " . TBL_ADMIN_PROPERTY_TYPE . " WHERE id = '" . $id . "'";
	$objDB->setQuery($Query);
	$rsTotal = $objDB->select();
	if ($rsTotal) {

		$val = $rsTotal[0]['property_type_name'];
	} else {
		$val = "Property Type Name Not Found";
	}
	return $val;
}

function getlast_assoc_id()
{

	global $objDB;
	$val = '';

	$Query  = "SELECT associate_id FROM " . TBL_ASSOCIATE_ACCOUNT . " ORDER BY associate_id DESC LIMIT 1";
	$objDB->setQuery($Query);
	$rsTotal = $objDB->select();
	if ($rsTotal) {
		$new_uid = $rsTotal[0]['associate_id'] + 1;
		$len = strlen($new_uid);
		if ($len == 2) {
			$val = "Se000" . $new_uid;
		} elseif ($len == 3) {
			$val = "SE00" . $new_uid;
		} elseif ($len == 4) {
			$val = "SE0" . $new_uid;
		}
	} else {
		$val = 00000;
	}
	return $val;
}

function getassoc_invitecode($id)
{

	global $objDB;
	$val = [];

	$Query  = "SELECT * FROM " . TBL_ASSOCIATE_ACCOUNT . " WHERE associate_id='" . $id . "'";
	$objDB->setQuery($Query);
	$rsTotal = $objDB->select();
	if ($rsTotal) {
		$val = $rsTotal[0]['associate_invite_code'];
	} else {
		$val = "";
	}
	return $val;
}
function getteam_member($id)
{
	global $objDB;

	$val = '';
	$Query1  = "SELECT associate_invite_code FROM " . TBL_ASSOCIATE_ACCOUNT . " WHERE associate_id='" . $id . "'";
	$objDB->setQuery($Query1);
	$rsTotal1 = $objDB->select();
	$Query  = "SELECT associate_id FROM " . TBL_ASSOCIATE_ACCOUNT . " WHERE sponsor_id='" . $rsTotal1[0]['associate_invite_code'] . "' ORDER BY associate_id DESC";
	$objDB->setQuery($Query);
	$rsTotal = $objDB->select();
	if ($rsTotal) {
		$val = $rsTotal;
	} else {
		$val = [];
	}
	return $val;
}

function getteam_member_arr($id)
{
	global $objDB;

	$val = '';
	$Query1  = "SELECT associate_invite_code FROM " . TBL_ASSOCIATE_ACCOUNT . " WHERE associate_id='" . $id . "'";
	$objDB->setQuery($Query1);
	$rsTotal1 = $objDB->select();
	$Query  = "SELECT associate_id FROM " . TBL_ASSOCIATE_ACCOUNT . " WHERE sponsor_id='" . $rsTotal1[0]['associate_invite_code'] . "' ORDER BY associate_id DESC";
	$objDB->setQuery($Query);
	$rsTotal = $objDB->select();
	if ($rsTotal) {
		$cleanarray = array();
		foreach ($rsTotal as $key => $value) {
			array_push($cleanarray, $value['associate_id']);
		}
		$team_members = implode(",", $cleanarray);

		$val = $team_members;
	} else {
		$val = implode(",", array());
	}
	return $val;
}
function get_hold_property_count($ids = array(), $type)
{

	global $objDB;
	if (empty($ids)) {
		$str = "WHERE associate_id = " . $ids . " AND";
	} else {
		$str = "WHERE associate_id IN " . "(" . $ids . ")" . " AND";
	}

	$Query1  = "SELECT ps.*,p.property_code,p.property_title,p.area_unit_type, u.* FROM property_slot ps
	LEFT JOIN property p ON p.property_id=ps.property_id
	LEFT JOIN property_unit u ON u.unit_id=ps.unit_id AND u.property_id = ps.property_id
	" . $str . " slot_sell_type = " . $type . " ORDER BY slot_id DESC";
	$objDB->setQuery($Query1);
	$rsTotal1 = $objDB->select();
	if ($Query1) {
		$val = count($rsTotal1);
	} else {
		$val = 0;
	}
	return $val;
}
function get_booked_property_count($ids = array(), $type)
{
	global $objDB;

	$Query1  = "SELECT ps.*,p.property_code,p.property_title,p.area_unit_type, u.* FROM property_slot ps
	LEFT JOIN property p ON p.property_id=ps.property_id
	LEFT JOIN property_unit u ON u.unit_id=ps.unit_id AND u.property_id = ps.property_id
	WHERE associate_id IN " . "(" . $ids . ")" . " AND slot_sell_type = " . $type . " ORDER BY slot_id DESC";
	$objDB->setQuery($Query1);
	$rsTotal1 = $objDB->select();
	if ($Query1) {
		$val = count($rsTotal1);
	} else {
		$val = 0;
	}
	return $val;
}
