<?php	
		session_start();
		include("../../dbConnect.php");
		include("../../restrictionCheck.php");
		$userID =$_SESSION["currentUserID"];
		if(!has_Restriction("contractor:administrator",$userID))
		{
			echo "<script>window.location.href = '/Project/permissionDeniedMessage.php?permission=0'</script>";
		}
			
		$developmentID2=$_GET["id"];
		
		if (isset($_POST["submit"])) {
		
			include ("/Project/dbConnect.php");
				$developmentID2=$_GET["id"];
				$developmentName2=$_POST["developmentName"];
				$developmentAddress2=$_POST["developmentAddress"];
				$developmentPlots2=$_POST["developmentPlots"];
				$developmentStatus2=$_POST["developmentStatus"];
				$developmentCity2=$_POST["developmentCity"];
				$developmentState2=$_POST["developmentState"];
				$developmentPostcode2=$_POST["developmentPostcode"];
				
				echo $developmentName2;
				
				$dbQuery2=$db->prepare("UPDATE development SET developmentName = '$developmentName2', developmentAddress = '$developmentAddress2', developmentPlots = '$developmentPlots2', developmentCity = '$developmentCity2', developmentState = '$developmentState2', developmentPostcode = '$developmentPostcode2', developmentStatus = '$developmentStatus2' WHERE developmentID=:id");
				$dbParams2=array('id'=>$developmentID2);
				$dbQuery2->execute($dbParams2);
				
				echo "<script>window.location.href ='/Project/index.php'</script>";
			}

	?>

