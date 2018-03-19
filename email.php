<?php
	function has_Password_Reset($userIDAccount) 
	{
		include("dbConnect.php");
		$dbQuery1=$db->prepare("select * FROM users WHERE user_id=:id");
		$dbParams1=array('id'=>$userIDAccount);
		$dbQuery1->execute($dbParams1);
		while ($dbRow = $dbQuery1->fetch(PDO::FETCH_ASSOC)) 
		{
			$user_email=$dbRow["user_email"];
		}
		$subject = "Password Reset";

		$message = "
		<html>
			<head>
			<title>HTML email</title>
			</head>
			<body>
			<p>This email contains HTML Tags!</p>
				<table>
					<tr>
						<th>Firstname</th>
						<th>Lastname</th>
					</tr>
					<tr>
						<td>John</td>
						<td>Doe</td>
					</tr>
				</table>
			</body>
		</html>
		";

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <jason.boal@jboal.co.uk>' . "\r\n";
		$headers .= 'Cc: jboal406@gmail.com' . "\r\n";

		mail($user_email,$subject,$message,$headers);
		//echo "<script>window.location.href = '/Project/Login/account.php?id=$user_email'</script>";
	}
?>