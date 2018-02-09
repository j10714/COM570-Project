<?php
	session_start();
	include("../../dbConnect.php");
	include("../../restrictionCheck.php");
	$userID =$_SESSION["currentUserID"];
		
		//$file = $_FILES['file'];
		
		//file properties
		//$file_name = $file['name'];
		//$file_tmp = $file['tmp_name'];
		//$file_size = $file['size'];
		//$file_error = $file['error'];
		
		$fileDes=$_GET["fileName"];
	
		//extension
		$file_ext = explode('.', $file_name);
		$file_ext = strtolower(end($file_ext));

		$allowed = array('jpg', 'png', 'jpeg');

		if(in_array($file_ext, $allowed))
		{
			if($file_error === 0)
			{
				if($file_size <= 5242880)
				{
					$file_destination = '$fileDes'. $file_name .'';
					//$file_destination = '/kunden/homepages/11/d703192015/htdocs/Project/Contractors/Developments/images/'. $file_name .'';
					if(move_uploaded_file($file_tmp, $file_destination))
					{
						echo "<script>window.location.href ='/Project/index.php'</script>";
					}
				}
			}
		}
		//header("Location: index.php");
		//echo "<script>window.location.href ='/Project/index.php'</script>";
	}
	?>