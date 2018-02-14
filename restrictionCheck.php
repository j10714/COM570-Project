<?php
	function has_Restriction($permission, $userID) {
		
		include("dbConnect.php");
		//connects to DB Connect File
		
		$dbQuery=$db->prepare("select role_id from user_roles_assign where user_id=:user_id");
		$dbParams=array('user_id'=>$userID);
		$dbQuery->execute($dbParams);
		//DB query searching user roles assign table for matching user id in the table to the one passed from page user attempting to access
		
		while ($dbRow = $dbQuery->fetch(PDO::FETCH_ASSOC))
		{
			$roleID = $dbRow["role_id"];
			
			$dbQuery2=$db->prepare("select * from user_roles_cap where role_id=:role_id and role_permission=:permission");
			$dbParams2=array('role_id'=>$roleID,'permission'=>$permission);
			$dbQuery2->execute($dbParams2);
			$dataRows=$dbQuery2->rowCount();
			//taking the role id from query 1 and checking for match in roles capabilities table and if row count greater than 0 returns true as shown above
			
			if ($dataRows > 0)
			{
				return true;
			}//if
		}//while DBQuery 1
		return false;
		//returns false if passed user account doesnt have the passed permission
	}
?>