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
		echo "<script>window.location.href ='/Project/Contractors/Plots/index.php?id=$developmentID1'</script>";
	}
		else if (isset($_POST["viewPhase"])) 
	{
		$developmentID1=$_GET["id"];
		echo "<script>window.location.href ='/Project/Contractors/Developments/developmentPhases.php?viewPhase=$developmentID1'</script>";
	}
	else if (isset($_POST["addPhase"])) 
	{
		$developmentID1=$_GET["id"];
		echo "<script>window.location.href ='/Project/Contractors/Developments/developmentPhases.php?addPhase=$developmentID1'</script>";
	}
		else if (isset($_POST["phaseSubmit"])) 
	{
		$developmentID2=$_GET["id"];
		$plotsNumber=$_POST["number_plots"];
		$plotStatus=4;
		$dbQuery7=$db->prepare("insert into development_phase values(null,:development_id,:plots_number,:phase_status)");
		$dbParams7=array('development_id'=>$developmentID2,'plots_number'=>$plotsNumber,'phase_status'=>$plotStatus);
		//yellow is database field organge = form posting
		$dbQuery7->execute($dbParams7);
		echo "<script>window.location.href ='/Project/Contractors/Developments/index.php?id=$developmentID2'</script>";
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

		if (isset($_GET["viewPhase"])||($_GET["addPhase"])) 
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
				$developmentID1=$_GET["viewPhase"];
				if($developmentID1==null)
				{
					$developmentID1=$_GET["addPhase"];
				}
				//echo "<script>window.location.href ='/Project/index.php'</script>";
				?>
						<div id="phaseArea" class="container tab-pane active">
								<table class="table table-striped">
									<thead>
										<tr>
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
										echo "<form method='post' action='index.php'>
										<tbody>
											<tr>
												<td>$phase_id</td>
												<td>$development_id</td>
												<td>$phase_Number</td>
												<td>$plots_number</td>
												<td>$phase_status</td>
											</tr>
										</tbody>
										</form>";
									}
								?>
								</table>
						</div>
					<div id="phaseAdd" class="container tab-pane fade">
						<div class="table-responsive">
								<table class="table table-striped">
								<?php
									echo"<form method='post' action='index.php?id=$developmentID1'>";
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
				</div>
			</div>
			<?php
		}
		else{
		?>       
		
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
							  <th>Development Plots</th>
							  <th>Development Status</th>
							  <th>Development City</th>
							  <th>Development State</th>
							  <th>Development Postcode</th>
							  <th>Development Image Name</th>
							  <th>Development Image</th>
							  <th>Development Edit</th>
							  <th>Development Plots</th>
							  <th>Development Phases</th>
							</tr>
						  </thead>
						<?php
						while ($dbRow = $dbQuery->fetch(PDO::FETCH_ASSOC)) 
						{
							$developmentID=$dbRow["development_id"];
							$developmentName=$dbRow["development_name"];
							$developmentAddress=$dbRow["development_address"];
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
											<td>$developmentAddress</td>";
											$dbQuery5=$db->prepare("select SUM(plots_number)from development_phase WHERE development_id=:id");
											$dbParams5=array('id'=>$developmentID);
											$dbQuery5->execute($dbParams5);
											while ($dbRow = $dbQuery5->fetch(PDO::FETCH_ASSOC)) 
											{
												$phasePlots=$dbRow['SUM(plots_number)'];
												$developmentID2=$dbRow["development_id"];
												$dbQuery6=$db->prepare("UPDATE development SET development_plots = '$phasePlots' WHERE development_id=:id");
												$dbParams6=array('id'=>$developmentID);
												$dbQuery6->execute($dbParams6);								
												echo "<td>$phasePlots</td>";	
											}
											echo"
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
											$dbQuery3=$db->prepare("select * from development_phase WHERE development_id=:id");
											$dbParams3=array('id'=>$developmentID);
											$dbQuery3->execute($dbParams3);
											$dataRows3 = $dbQuery3->rowCount();
											if ($dataRows3 >0)
											{
												echo "<td><button name='viewPhase' type='submit' class='btn btn-primary'>View Phase</button></td>";
											}
											else
											{
												echo "<td><button name='addPhase' type='submit' class='btn btn-primary'>Add Phase</button></td>";
											}
										echo "</tr>
									</tbody>
								</form>";
						}
						?>
					</table>
			  </div>
		</div>
		<?php
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
