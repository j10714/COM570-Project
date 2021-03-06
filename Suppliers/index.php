<?php
	$userID=0;
	session_start();
	include("../dbConnect.php");
	include("../restrictionCheck.php");
	include("../imageUpload.php");
	include("../userActivity.php");
	include("../email.php");
	
	  if (!isset($_SESSION["currentUserID"]))
		{
			header("Location: index.php");
		}
	
	if (isset($_SESSION["currentUserID"]))
	{
	  $userID =$_SESSION["currentUserID"];
	  
	  	if(has_acitivity($userID))
		{
		}
	}
	$approved=0;
	$reject=0;
	$count=0;
	$phase_id=$_GET["phaseID"];
	
	if (isset($_GET["supplier_id0"])) 
	{
		$supplier_id=$_GET["supplier_id0"];
		$supplier_status=0;
		
		$dbQuery4=$db->prepare("UPDATE suppliers SET supplier_status = '$supplier_status' WHERE supplier_id=:id");
		$dbParams4=array('id'=>$supplier_id);
		//yellow is database field organge = form posting
		$dbQuery4->execute($dbParams4);
		
		$dbQuery5=$db->prepare("select * from suppliers WHERE supplier_id=:supplier_id");
		$dbParams5=array('supplier_id'=>$supplier_id);
		$dbQuery5->execute($dbParams5);
		while ($dbRow = $dbQuery5->fetch(PDO::FETCH_ASSOC)) 
			{
				$user_id2=$dbRow["user_id"];
				$role_id2=99;
				$user_status=0;
				
				$dbQuery6=$db->prepare("UPDATE user_roles_assign SET role_id = '$role_id2' WHERE user_id=:id");
				$dbParams6=array('id'=>$user_id2);
				$dbQuery6->execute($dbParams6);
				
				$dbQuery18=$db->prepare("UPDATE users SET user_status = '$user_status' WHERE user_id=:id");
				$dbParams18=array('id'=>$user_id2);
				$dbQuery18->execute($dbParams18);
				
			}
		echo "<script>window.location.href = '/Project/Suppliers/index.php'</script>";
		
	}//elseif
	
	else if (isset($_GET["supplier_id1"])) 
	{
		$supplier_id=$_GET["supplier_id1"];
		$supplier_status=1;
		$user_status=1;
		
		$dbQuery7=$db->prepare("UPDATE suppliers SET supplier_status = '$supplier_status' WHERE supplier_id=:id");
		$dbParams7=array('id'=>$supplier_id);
		//yellow is database field organge = form posting
		$dbQuery7->execute($dbParams7);
		
		
		$dbQuery8=$db->prepare("select * from suppliers WHERE supplier_id=:supplier_id");
		$dbParams8=array('supplier_id'=>$supplier_id);
		$dbQuery8->execute($dbParams8);
		while ($dbRow = $dbQuery8->fetch(PDO::FETCH_ASSOC)) 
			{
				$user_id3=$dbRow["user_id"];
				$role_id3=2;
				
				$dbQuery9=$db->prepare("UPDATE user_roles_assign SET role_id = '$role_id3' WHERE user_id=:id");
				$dbParams9=array('id'=>$user_id3);
				$dbQuery9->execute($dbParams9);
				
				$dbQuery19=$db->prepare("UPDATE users SET user_status = '$user_status' WHERE user_id=:id");
				$dbParams19=array('id'=>$user_id3);
				$dbQuery19->execute($dbParams19);
				
			}
		echo "<script>window.location.href = '/Project/Suppliers/index.php'</script>";
		
	}//elseif
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../../../../favicon.ico">

		<title>Dashboard Template for Bootstrap</title>

		<!-- Bootstrap core CSS -->
		<link href="../../../../dist/css/bootstrap.min.css" rel="stylesheet">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
		<!-- boostrap CSS code-->

		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

		<!-- boostrap JS code-->

		<!-- Custom styles for this template -->
		<link href="/Project/CSS/contractors.css" rel="stylesheet">
	</head>
	<body>
		<?php 
		if(has_Restriction("contractor:administrator",$userID))
		{
		//checks if user account has contractor administrator previllages and this will show supplier Setup
		?>
			<header>
				<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
					<a class="navbar-brand" href="#">Carousel</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarCollapse">
					  <ul class="navbar-nav mr-auto">
						<li class="nav-item">
						  <a class="nav-link" href="/Project/index.php">Home <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item">
						  <a class="nav-link" href="/Project/Contractors/Developments/index.php">Developments</a>
						</li>
						<li class="nav-item">
						  <a class="nav-link" href="/Project/Contractors/HouseTypes/houseType.php">House Types</a>
						</li>
						<li class="nav-item active">
						  <a class="nav-link" href="/Project/Suppliers/index.php">Supplier</a>
						</li>				
					  </ul>
						<ul class="navbar-nav px-3">
							<li class="nav-item text-nowrap">
								<?php 
								if (isset($_SESSION["currentUserID"]))						 
								{
								?>
									<a class="nav-link" href="/Project/Login/account.php"><?php echo $_SESSION["currentUser"];?>'s Account</a>
								<?php
								}
								else
								{
								?>
								<a class="nav-link" href="/Project/Login/account.php">Login</a>
								<?php
								}
								?>
							</li>
						</ul>
					</div>
				</nav>
			</header>

			<div class="container">
				<h1>Supplier Area</h1>
							<ul class="nav nav-tabs role="tablist">
								<li class="nav-item">
									<a class="nav-link active" href="index.php">Current Suppliers</a>
								</li>
								<li class="nav-item">
								  <a class="nav-link" href="selectionApproval.php">Selection Approval</a>
								</li>
								<li class="nav-item">
								  <a class="nav-link" href="/Project/Register/register.php?userRole=2">Add Supplier</a>
								</li>
								<li class="nav-item">
								  <a class="nav-link" href="assignPhaseToSupplier.php">Supplier Assign</a>
								</li>
							</ul>
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
									<tr>
									  <th>Supplier ID</th>
									  <th>Supplier Name</th>
									  <th>User Account ID</th>
									  <th>Supplier Status</th>
									</tr>
								</thead>
								<?php
								$dbQuery10=$db->prepare("select * from suppliers");
								$dbQuery10->execute();
								while ($dbRow = $dbQuery10->fetch(PDO::FETCH_ASSOC)) 
								{
									$supplierID=$dbRow["supplier_id"];
									$user_id4=$dbRow["user_id"];
									$supplierStatus=$dbRow["supplier_status"];
									
									$dbQuery11=$db->prepare("select * from users WHERE user_id=:user_id");
									$dbParams11=array('user_id'=>$user_id4);
									$dbQuery11->execute($dbParams11);
									
									while ($dbRow = $dbQuery11->fetch(PDO::FETCH_ASSOC)) 
									{
									
										$user_id5=$dbRow["user_id"];
										$user_title=$dbRow["user_title"];
										$user_firstname=$dbRow["user_firstname"];
										$user_lastname=$dbRow["user_lastname"];
										
										echo "<form method='post' action='index.php'>
										<tbody>
											<tr>
												<td>$supplierID</td>
												<td>$user_title $user_firstname $user_lastname</td>
												<td>$user_id5</td>";
												if($supplierStatus > 0 )
												{
													echo"<td><a class='btn btn-primary' href='index.php?supplier_id0=".$supplierID."'>Deactivate Supplier</a></td>";
												}
												else
												{
													echo"<td><a class='btn btn-primary' href='index.php?supplier_id1=".$supplierID."'>Activate Supplier</a></td>";
												}
											echo "</tr>
										</tbody>
										</form>";
									}
								}
							?>
							</table>
						</div>
			</div>
		<?php
		}//if for Contractor Admin view
		
		else if(has_Restriction("supplier:view",$userID))
		{
			echo "<script>window.location.href = '/Project/Suppliers/viewSuppliers.php'</script>";
			
		}//elseIF to check if current user account has supplier view permissions assigned and if accurate will show them another view	
	else
	{
		echo "<script>window.location.href = '/Project/permissionDeniedMessage.php?permission=0'</script>";
	}
	?>
		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>')</script>
		<script src="../../../../assets/js/vendor/popper.min.js"></script>
		<script src="../../../../dist/js/bootstrap.min.js"></script>
	</body>
</html>
<?php

?>
