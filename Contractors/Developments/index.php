<?php
	session_start();
	include("../../dbConnect.php");
	include("../../restrictionCheck.php");
	$userID =$_SESSION["currentUserID"];
	
	if(!has_Restriction("contractor:administrator",$userID))
	{
		echo "<script>window.location.href = '/Project/permissionDeniedMessage.php?permission=0'</script>";
	}
	
	if (isset($_POST["editDev"])) 
	{
		$developmentID1=$_GET["id"];
		echo "<script>window.location.href ='/Project/Contractors/Developments/developmentsEdit.php?id=$developmentID1'</script>";
	}
	else if (isset($_POST["viewPlot"])) 
	{
		$developmentID1=$_GET["id"];
		echo "<script>window.location.href ='/Project/Contractors/Plots/index.php?id=$developmentID1'</script>";
	}
	else if (isset($_POST["addPlot"])) 
	{
		$developmentID1=$_GET["id"];
		echo "<script>window.location.href ='/Project/Contractors/Plots/plotsAdd.php?id=$developmentID1'</script>";
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
				<li class="nav-item active">
				  <a class="nav-link" href="/Project/Contractors/Developments/index.php">Developments</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="/Project/Contractors/HouseTypes/houseType.php">House Types</a>
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
			$dbQuery=$db->prepare("select * from development");
			$dbQuery->execute();
			$dataRows = $dbQuery->rowCount();
			?>
			
			<h1>Development Area</h1>
			  
				<ul class="nav nav-tabs role="tablist">
		
					<li class="nav-item">
					  <a class="nav-link active" href="/Project/Contractors/Developments/index.php">Development Area</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" href="/Project/Contractors/Developments/developmentsAdd.php">Add Development</a>
					</li>
				</ul><br>
			  
			<h3>Developments Total: <?php echo $dataRows ?></h3>
				<div class="table-responsive">
					<table class="table table-striped">
						  <thead>
							<tr>
							  <th>Development ID</th>
							  <th>Development Name</th>
							  <th>Development Address</th>
							  <th>Devlopment Plots</th>
							  <th>Devlopment Status</th>
							  <th>Development City</th>
							  <th>Development State</th>
							  <th>Development Postcode</th>
							  <th>Development Image Name</th>
							  <th>Development Image</th>
							  <th>Development Edit</th>
							  <th>Development Plots</th>
							</tr>
						  </thead>
						<?php
						while ($dbRow = $dbQuery->fetch(PDO::FETCH_ASSOC)) 
						{
							$developmentID=$dbRow["development_id"];
							$developmentName=$dbRow["development_name"];
							$developmentAddress=$dbRow["development_address"];
							$developmentPlots=$dbRow["development_plots"];
							$devlopmentStatus=$dbRow["development_status"];
							$developmentCity=$dbRow["development_city"];
							$developmentState=$dbRow["development_state"];
							$developmentPostcode=$dbRow["development_postcode"];
							$developmentImageName=$dbRow["development_imagename"];
							$developmentImageFile=$dbRow["development_imagefile"];
							//echo "<form method='post' action='developmentsEdit.php?id=$developmentID'>
							
							echo "<form method='post' action='index.php?id=$developmentID'>
									<tbody>
										<tr>
											<td>$developmentID</td>
											<td>$developmentName</td>
											<td>$developmentAddress</td>
											<td>$developmentPlots</td>
											<td>$devlopmentStatus</td>
											<td>$developmentCity</td>
											<td>$developmentState</td>
											<td>$developmentPostcode</td>
											<td>$developmentImageName</td>
											<td><a href='/Project/Contractors/Developments/images/$developmentImageFile'>Image Link</a></td>
											<td><button name='editDev' type='submit' class='btn btn-primary'>Edit</button></td>";

											$dbQuery2=$db->prepare("select * from plots WHERE development_id=:id");
											$dbParams2=array('id'=>$developmentID);
											$dbQuery2->execute($dbParams2);
											$dataRows2 = $dbQuery2->rowCount();

											if ($dataRows2 >0)
											{
												echo "<td><button name='viewPlot' type='submit' class='btn btn-primary'>View Plots</button></td>";
											}
											else
											{
												echo "<td><button name='addPlot' type='submit' class='btn btn-primary'>Add Plots</button></td>";
											}

										echo "</tr>
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
