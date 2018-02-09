<?php
		//include("../Project/dbConnect.php");
		include("../dbConnect.php");
		
		$username=$_POST["username"];
		$password=$_POST["password"];
		$email=$_POST["email"];
		$human=$_POST["human"];
		
		 //$password = md5($password);
	
		$dbQuery=$db->prepare("insert into users values (null,:user,:pass,:email,:human)");
		$dbParams=array('user'=>$username, 'pass'=>$password, 'email'=>$email, 'human'=>$human);
		$dbQuery->execute($dbParams);
		
		
   
		$_SESSION["message"] = "You have been registered";
		
		//if (isset($_SESSION["load"]) && $_SESSION["load"]=="buy")
		//{
			//unset($_SESSION["load"]);
			//header("Location: loginCheckout.php");
		//}

			//header("Location: login.php");
			echo "<script>window.location.href ='/Project/index.php'</script>";
		
	    //header("Location: registerKillSession.php");
		?>