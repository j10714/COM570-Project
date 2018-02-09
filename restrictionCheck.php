<?php

function has_Restriction($permission, $userID) {
	
	include("dbConnect.php");
	
	$dbQuery=$db->prepare("select role_id from user_roles_assign where user_id=:user_id");
	$dbParams=array('user_id'=>$userID);
    $dbQuery->execute($dbParams);

	while ($dbRow = $dbQuery->fetch(PDO::FETCH_ASSOC))
	{
		$roleID = $dbRow["role_id"];
		
		$dbQuery2=$db->prepare("select * from user_roles_cap where role_id=:role_id and role_permission=:permission");
		$dbParams2=array('role_id'=>$roleID,'permission'=>$permission);
		$dbQuery2->execute($dbParams2);
		$dataRows=$dbQuery2->rowCount();
		
		if ($dataRows > 0)
		{
			return true;
		}
	}
	return false;
}


?>