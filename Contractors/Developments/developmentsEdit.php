<?php	
	session_start();
	include("../../dbConnect.php");
	include("../../restrictionCheck.php");
	$userID =$_SESSION["currentUserID"];	
	if(!has_Restriction("contractor:administrator",$userID))
	{
		echo "<script>window.location.href = '/Project/permissionDeniedMessage.php?permission=0'</script>";
	}	
	$developmentID1=$_GET["id"];
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
			<div class="row">
				<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
					<h1>Development Edit</h1>

					<h2>Section title</h2>
						<form method="post" action="/Project/Contractors/Developments/developmentsEdit2.php?id=<?php echo$developmentID1?>">
						<?php
							$dbQuery=$db->prepare("select * from development WHERE development_id=:id");
							$dbParams=array('id'=>$developmentID1);
							$dbQuery->execute($dbParams);

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
							}

						?>


							<div class="form-group col-md-6">
								<label for="inputEmail4">Development ID</label>
								<input name="developmentName" type="text" class="form-control" id="inputEmail4" value="<?php echo $developmentID; ?>" placeholder="Development Name"readonly>
							</div>

							<div class="form-group col-md-6">
								<label for="inputEmail4">Development Name</label>
								<input name="developmentName" type="text" class="form-control" id="inputEmail4" value="<?php echo $developmentName; ?>" placeholder="Development Name">
							</div>

							<div class="form-group col-md-6">
								<label for="inputAddress">Address</label>
								<input name="developmentAddress" type="text" class="form-control" id="inputAddress" value="<?php echo $developmentAddress; ?>" placeholder="Address">
							</div>

							<div class="form-group col-md-6">
								<label for="inputCity">City</label>
								<input name="developmentCity" type="text" class="form-control" value="<?php echo $developmentCity; ?>" id="inputCity">
							</div>

							<div class="form-group col-md-4">
								<label for="inputState">State</label>
								<select id="inputState" name="developmentState" class="form-control">
									<option selected><?php echo $developmentState; ?></option>
									<option>Antrim</option>
									<option>Armagh</option>
								</select>
							</div>

							<div class="form-group col-md-2">
								<label for="inputPostcode">Postcode</label>
								<input name="developmentPostcode" type="text" class="form-control" value="<?php echo $developmentPostcode; ?>" id="inputPostcode">
							</div>

							<div class="form-group col-md-4">
								<label for="inputPlots">Plots</label>
								<input name="developmentPlots" type="text" class="form-control" id="inputPlots" value="<?php echo $developmentPlots; ?>" placeholder="Number of Plots">
							</div>				

							<div class="form-group">
								<div class="form-check">
									<label class="form-check-label">
										<input class="form-check-input" type="checkbox"> Check me out
									</label>
								</div>
							</div>
							<button name="submit" type="submit" class="btn btn-primary">Apply Changes</button>
						</form>
				</main>
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

