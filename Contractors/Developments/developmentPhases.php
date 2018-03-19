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
		if (isset($_POST["phaseSubmit"])) 
	{
		$developmentID2=$_GET["id"];
		$plotsNumber=$_POST["number_plots"];
		$plotStatus=4;
		$dbQuery7=$db->prepare("insert into development_phase values(null,:development_id,:plots_number,:phase_status)");
		$dbParams7=array('development_id'=>$developmentID2,'plots_number'=>$plotsNumber,'phase_status'=>$plotStatus);
		//yellow is database field organge = form posting
		$dbQuery7->execute($dbParams7);
		echo "<script>window.location.href ='/Project/Contractors/Developments/developmentPhases.php?id=$developmentID2'</script>";
	}
	// else if (isset($_POST["assignPhaseToSupplier"])) 
	// {
		// echo "<script>window.location.href ='/Project/Suppliers/assignPhaseToSupplier.php?phaseID=$phaseID'</script>";
	// }
	
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
		
		
		<?php
		if (isset($_GET["viewPhase"])||($_GET["addPhase"])||$developmentID1!=null) 
		{
			?>
			<div class="container">
					<h1>Phase Area</h1>
					  
					<ul class="nav nav-tabs role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#phaseArea">Phase Area</a>
						</li>
						<li class="nav-item">
						  <a class="nav-link" data-toggle="tab" href="#phaseAdd">Phase Add</a>
						</li>
					</ul>
					<div class="tab-content">
					<?php
					if($developmentID1==null)
					{
						$developmentID1=$_GET["viewPhase"];
						if($developmentID1==null)
						{
							$developmentID1=$_GET["addPhase"];
						}
					}
				//echo "<script>window.location.href ='/Project/index.php'</script>";
				?>
						<div id="phaseArea" class="container tab-pane active">
								<table class="table table-striped">
									<thead>
										<tr>
											<th></th>
											<th>Phase ID</th>
											<th>Development ID</th>
											<th>Phase Number</th>
											<th>Number of Plots</th>
											<th>Phase Status</th>
										</tr>
									</thead>
									<?php
									$dbQuery4=$db->prepare("select * from development_phase WHERE development_id=:id");
									$dbParams4=array('id'=>$developmentID1);
									$dbQuery4->execute($dbParams4);
									$phase_Number=0;
									
									while ($dbRow = $dbQuery4->fetch(PDO::FETCH_ASSOC)) 
									{ 
										$development_id=$dbRow["development_id"];
										$plots_number=$dbRow["plots_number"];
										$phase_status=$dbRow["phase_status"];
										$phase_id=$dbRow["phase_id"];
										$phase_Number=$phase_Number+1;
										
										echo "<form method='post' action='/Project/Suppliers/assignPhaseToSupplier.php?DevelopmentID=$development_id&phaseID=$phase_id'>
											<tbody>
												<tr>
													<td>$phase_id</td>
													<td>$development_id</td>
													<td>$phase_Number</td>
													<td>$plots_number</td>
													<td>$phase_status</td>
													<td><button name='assignPhaseToSupplier' type='submit' class='btn btn-primary'>Assign Suppiers</button></td>
												</tr>
											</tbody>";
										echo "</form>";
									}
									
								?>
								</table>
						</div>
					<div id="phaseAdd" class="container tab-pane fade">
						<div class="table-responsive">
								<table class="table table-striped">
								<?php
									echo"<form method='post' action='developmentPhases.php?id=$developmentID1'>";
									?>
										<div class="form-group col-md-6">
											<label for="number_plots">Number of Plots</label>
											<input name="number_plots" type="text" class="form-control" id="number_plots" placeholder="Number of Plots">
										</div>
										<div class="form-group">
											<div class="form-check">
											  <label class="form-check-label">
												<input class="form-check-input" type="checkbox"> Check me out
											  </label>
											</div>
										</div>
										<button name="phaseSubmit" type="submit" class="btn btn-primary">Add Phase</button>
									</form>
								
								</table>
						</div>
					</div>
					<div id="phaseAddSupplier" class="container tab-pane fade">
						<div class="table-responsive">
								<table class="table table-striped">
								</table>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
		else{
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
