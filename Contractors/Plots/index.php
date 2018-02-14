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
	if(empty($developmentID1))
	{
		echo "No id"; 
		//print for to prompt use for development name/id
		
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
		<?php
			$dbQuery=$db->prepare("select * from plots WHERE development_id=:id");
			$dbParams=array('id'=>$developmentID1);
			$dbQuery->execute($dbParams);
			$dataRows = $dbQuery->rowCount();
			
			if ($dataRows>0)
			{
		?>
			<div class="container-fluid">
				<h1>Plot Area</h1>
				<ul class="nav nav-tabs role="tablist">
		
					<li class="nav-item">
						<?php
							echo "<a class='nav-link active' href='/Project/Contractors/Plots/index.php?id=$developmentID1'>Plot Area<span class='sr-only'></span></a>";
						?>
					</li>
					<li class="nav-item">
						<?php
							echo "<a class='nav-link' href='/Project/Contractors/Plots/plotsAdd.php?id=$developmentID1'>Add Plot<span class='sr-only'></span></a>";
						?>
					</li>
				</ul><br>
			  
			  
				<div class="table-responsive">
					<table class="table table-striped">
						  <thead>
							<tr>
							  <th>Plot ID</th>
							  <th>Plot Name</th>
							  <th>Plot House Type</th>
							  <th>Plot Square Foot</th>
							  <th>Plot Phase</th>
							  <th>Plot Status</th>
							  <th>Development ID</th>
							  
							  
							</tr>
						  </thead>
					  <?php
						while ($dbRow = $dbQuery->fetch(PDO::FETCH_ASSOC)) 
						{
							$plotID=$dbRow["plot_id"];
							$plotName=$dbRow["plot_name"];
							$houseType=$dbRow["house_type"];
							$squareFoot=$dbRow["square_foot"];
							$phase=$dbRow["phase"];
							$status=$dbRow["status"];
							$developmentID=$dbRow["development_id"];

							//echo "<form method='post' action='developmentsEdit.php?id=$developmentID'>
								echo "<form method='post' action='index.php?id=$developmentID'>
									<tbody>
										<tr>
											<td>$plotID</td>
											<td>$plotName</td>
											<td>$houseType</td>
											<td>$squareFoot</td>
											<td>$phase</td>
											<td>$status</td>
											<td>$developmentID</td>
											<td><button name='editDev' type='submit' class='btn btn-primary'>Edit</button></td>
										</tr>
									</tbody>
								</form>";

						}
					?>
					</table>
				</div>
			</div>
	<?php 
			}
	
	else
	{
		
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

