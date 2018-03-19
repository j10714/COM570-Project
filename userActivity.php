<?php
	function has_acitivity($userID) {
		
		include("dbConnect.php");
		
		date_default_timezone_set('Europe/London');
		$UserLastActive=date("Y-m-d H:i:s");
		$dbQuery1=$db->prepare("UPDATE users SET user_active = '$UserLastActive' WHERE user_id=:id");
		$dbParams1=array('id'=>$userID);
		$dbQuery1->execute($dbParams1);
	}
?>