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
	$developmentID1=$_GET["id"];
	$phaseID=$_GET["phaseID"];
	
	if (isset($_POST["submit"])) 
	{
		$plotName=$_POST["PlotName"];
		$houseType=$_POST["HouseType"];
		$squareFoot=$_POST["PlotSquareFoot"];
		$phase=$_POST["PlotPhase"];
		$status=$_POST["PlotStatus"];
		$developmentID=$_GET["id"];
		$phaseID1=$_GET["phaseID"];
		
		if($phaseID1==null)
		{
		$phaseID1=$_POST["phases"];
		}
		
		$dbQuery=$db->prepare("insert into plots values(null,:plot_name,:house_type,:square_foot,:status,:development_id,:phase_id)");
		$dbParams=array('plot_name'=>$plotName, 'house_type'=>$houseType, 'square_foot'=>$squareFoot, 'status'=>$status, 'development_id'=>$developmentID, 'phase_id'=>$phaseID1);
		//yellow is database field organge = form posting
		$dbQuery->execute($dbParams);

		echo "<script>window.location.href ='/Project/Contractors/Plots/index.php?id=$developmentID1&phaseID=$phaseID1'</script>";
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
						  <a class="nav-link disabled" href="#">Disabled</a>
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
			<h1>Plot Area</h1>
			<ul class="nav nav-tabs role="tablist">
				<li class="nav-item">
					<?php
						echo "<a class='nav-link' href='/Project/Contractors/Plots/index.php?id=$developmentID1&phaseID=$phaseID'>Plot Area<span class='sr-only'></span></a>";
					?>
				</li>
				<li class="nav-item">
					<?php
						echo "<a class='nav-link active' href='/Project/Contractors/Plots/plotsAdd.php?id=$developmentID1&phaseID=$phaseID'>Add Plot<span class='sr-only'></span></a>";
					?>
				</li>
			</ul><br>

			<h2>Plot Add</h2>
			<?php echo "<h2>$phaseID</h2>";?>
			<?php
				echo "<form method='post' action='plotsAdd.php?id=$developmentID1&phaseID=$phaseID'>";
			?>
					<div class="form-group col-md-6">
						<label for="inputEmail4">Plot Name</label>
						<input name="PlotName" type="text" class="form-control" id="inputEmail4" placeholder="Plot Name">
					</div>
						
					<div class="form-group col-md-4">
						<label for="HouseType">House Type</label>
						<select id="HouseType" name="HouseType" class="form-control">
							<?php
								$dbQuery2=$db->prepare("select * from house_types");
								$dbQuery2->execute();
								while ($dbRow = $dbQuery2->fetch(PDO::FETCH_ASSOC)) 
								{
									$house_description=$dbRow["house_description"];
									echo "<option>$house_description</option>";
								}//while
							?>
						</select>
					</div>
						
					<div class="form-group col-md-6">
						<label for="inputCity">Plot Square Foot</label>
						<input name="PlotSquareFoot" type="text" class="form-control" id="PlotSquareFoot">
					</div>
						
					<div class="form-group col-md-4">
						<label for="inputPlots">Plot Status</label>
						<input name="PlotStatus" type="text" class="form-control" id="PlotStatus" placeholder="Plot Status">
					</div>
					<?php
					if($phaseID==null)
					{
						//echo "<script>window.location.href = '/Project/permissionDeniedMessage.php?permission=0'</script>";
						$dbQuery3=$db->prepare("select * from development_phase WHERE development_id=:id");
						$dbParams3=array('id'=>$developmentID1);
						$dbQuery3->execute($dbParams3);
						$dataRows3 = $dbQuery3->rowCount();
							?>
							<div class="form-group col-md-4">
								<label for="PhaseType">Phase</label>
								<?php
									echo "<select name='phases' class='form-control'>";
									$phaseID2=1;
										for ($phaseCount = 1; $phaseCount <= $dataRows3; $phaseCount++) {
											$phaseID2=$phaseID2+1;
											echo"<option value='$phaseCount'>Phase $phaseCount</option>";
										} 
									echo"</select>";
								?>
							</div>
							<?php
						
					}
					?>					
						
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
								<input class="form-check-input" type="checkbox"> Check me out
							</label>
						</div>
					</div>
					<button name="submit" type="submit" class="btn btn-primary">Submit</button>
				</form>
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

