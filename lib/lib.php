<?php
if (!defined('__CONFIG__')) {
	header("location:" . SITE_URL);
	die();
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
