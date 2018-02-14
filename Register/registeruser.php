<?php
		//include("../Project/dbConnect.php");
		include("../dbConnect.php");
		
		$username=$_POST["username"];
		$password=$_POST["password"];
		$email=$_POST["email"];
		$user_title=$_POST["title"];
		$user_firstname=$_POST["firstName"];
		$user_lastname=$_POST["lastName"];
		$user_address=$_POST["address"];
		$user_town=$_POST["town"];
		$user_postcode=$_POST["postcode"];
		$user_county=$_POST["county"];
		$user_phone=$_POST["phone"];
		$human=$_POST["human"];
		
		//user role
		$user_Role=$_POST["user_Role"];
		
		 //$password = md5($password);
	
		$dbQuery=$db->prepare("insert into users values (null,:user_username,:user_password,:user_email,:user_title,:user_firstname,:user_lastname,:user_address,:user_town,:user_postcode,:user_county,:user_phone,:user_human)");
		$dbParams=array('user_username'=>$username, 'user_password'=>$password, 'user_email'=>$email, 'user_title'=>$user_title, 'user_firstname'=>$user_firstname, 'user_lastname'=>$user_lastname, 'user_address'=>$user_address, 'user_town'=>$user_town, 'user_postcode'=>$user_postcode, 'user_county'=>$user_county, 'user_phone'=>$user_phone, 'user_human'=>$human);
		$dbQuery->execute($dbParams);
		
		$dbQuery2=$db->prepare("SELECT * FROM users ORDER BY user_id DESC LIMIT 1");
		$dbQuery2->execute();
		while ($dbRow = $dbQuery2->fetch(PDO::FETCH_ASSOC))
		{
			$user_id=$dbRow["user_id"];
		}
		$dbQuery3=$db->prepare("SELECT * FROM user_roles where role_name=:role_name");
		$dbParams3=array('role_name'=>$user_Role);
		$dbQuery3->execute($dbParams3);
		
		while ($dbRow = $dbQuery3->fetch(PDO::FETCH_ASSOC))
		{
			$role_id=$dbRow["role_id"];
		}
		
		$dbQuery4=$db->prepare("insert into user_roles_assign values (null,:user_id,:role_id)");
		$dbParams4=array('user_id'=>$user_id, 'role_id'=>$role_id);
		$dbQuery4->execute($dbParams4);
		
		if($user_Role == "Supplier")
		{
			$supplier_status=1;
			$dbQuery5=$db->prepare("insert into suppliers values (null,:user_id,:supplier_status)");
			$dbParams5=array('user_id'=>$user_id, 'supplier_status'=>$supplier_status);
			$dbQuery5->execute($dbParams5);
		}
		
		
		
		
		
		//$_SESSION["message"] = "You have been registered";

			echo "<script>window.location.href ='/Project/index.php'</script>";
		
		?>