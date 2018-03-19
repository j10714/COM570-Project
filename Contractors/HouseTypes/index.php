<?php
	$userID=0;
	session_start();
	include("../../dbConnect.php");
	include("../../restrictionCheck.php");
	include("../../imageUpload.php");
	include("../../userActivity.php");
	include("../../email.php");
	
	if (isset($_SESSION["currentUserID"]))
	{
	  $userID =$_SESSION["currentUserID"];
	  
	  	if(has_acitivity($userID))
		{
		}
	}
	
	if(!has_Restriction("contractor:administrator",$userID))
	{
		echo "<script>window.location.href = '/Project/permissionDeniedMessage.php?permission=0'</script>";
	}
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
						<li class="nav-item active">
						  <a class="nav-link" href="/Project/Contractors/HouseTypes/index.php">House Types</a>
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

		<div class="container-fluid">
		  
			<?php
			$dbQuery=$db->prepare("select * from house_types");
			$dbQuery->execute();
			$dataRows = $dbQuery->rowCount();
			?>
			
			<h1>House Type Area</h1>
			  
			<ul class="nav nav-tabs role="tablist">
	
				<li class="nav-item">
				  <a class="nav-link active" href="/Project/Contractors/Developments/index.php">House Type Area</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="/Project/Contractors/Developments/developmentsAdd.php">Add House Type</a>
				</li>
			</ul><br>
			  
			<h3>House Types Total: <?php echo $dataRows ?></h3>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>House Type ID</th>
							<th>House Type Name</th>
							<th>House Description</th>
							<th>Number of Bedrooms</th>
							<th>Number of Bathrooms</th>
							<th>Number of Reception Rooms</th>
							<th>Square Foot House</th>
							<th>Floor Plan Image</th>
							<th>House Image</th>						  
						</tr>
					</thead>
					<?php
					while ($dbRow = $dbQuery->fetch(PDO::FETCH_ASSOC)) 
					{
						$house_type_id=$dbRow["house_type_id"];
						$house_type_name=$dbRow["house_type_name"];
						$house_description=$dbRow["house_description"];
						$num_bedrooms=$dbRow["num_bedrooms"];
						$num_bathrooms=$dbRow["num_bathrooms"];
						$num_receptions=$dbRow["num_receptions"];
						$square_foot_house=$dbRow["square_foot_house"];
						$floor_plan=$dbRow["floor_plan"];
						$house_image=$dbRow["house_image"];
					
						echo "<form method='post' action='index.php?id=$house_type_id'>
							<tbody>
								<tr>
									<td>$house_type_id</td>
									<td>$house_type_name</td>
									<td>$house_description</td>
									<td>$num_bedrooms</td>
									<td>$num_bathrooms</td>
									<td>$num_receptions</td>
									<td>$square_foot_house</td>
									<td><img src='images/$floor_plan' alt='No Image Found' width = '380' height = '320'></td>
									<td><img src='images/$house_image' alt='No Image Found' width = '380' height = '320'></td>
									<td><button name='editDev' type='submit' class='btn btn-primary'>Edit</button></td>
								</tr>
							</tbody>
						</form>";
					}
					?>
				</table>
			</div>
		</div>

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>')</script>
		<script src="../../../../assets/js/vendor/popper.min.js"></script>
		<script src="../../../../dist/js/bootstrap.min.js"></script>
	</body>
</html>
