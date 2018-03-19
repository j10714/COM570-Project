<?php
	$userID=0;
	$phase_id=0;
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
	
		$phase_id=$_GET["phaseID"];
		$developmentID=$_GET["DevelopmentID"];
	if (isset($_POST["approve"])) 
	{
	
		if(!empty($_POST['checkSupplier'])) 
		{
			$reject=99;
			//echo '<h3>You have selected the following</h3>';
			foreach($_POST["checkSupplier"] as $checkSupplier)
			{
				//$dbQuery4=$db->prepare("insert into phase_supplier values(null,:phase_id,:supplier_id)");
				//$dbParams4=array('phase_id'=>$phase_id, 'supplier_id'=>$checkSupplier);
				//yellow is database field organge = form posting
				//$dbQuery4->execute($dbParams4);
				//echo '<p>'.$checkSupplier.'</p>';
			}
			//echo "<script>window.location.href = '/Project/Suppliers/index.php'</script>";
		}
		
	}
	if($phase_id==null)
		{
			//echo "<script>window.location.href = '/Project/Contractors/Developments/index.php'</script>";	   
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
				<h1>Supplier Assign</h1>
							<ul class="nav nav-tabs role="tablist">
								<li class="nav-item">
									<a class="nav-link" href="index.php">Current Suppliers</a>
								</li>
								<li class="nav-item">
								  <a class="nav-link" href="selectionApproval.php">Selection Approval</a>
								</li>
								<li class="nav-item">
								  <a class="nav-link" href="/Project/Register/register.php?userRole=2">Add Supplier</a>
								</li>
								<li class="nav-item">
								 <?php echo "<a class='nav-link active' href='/Project/Suppliers/assignPhaseToSupplier.php?DevelopmentID=$developmentID&phaseID=$phase_id'>Supplier Assign</a>";?>
								</li>
							</ul>
						<div class="table-responsive">
						<?php
						if($phase_id!=null)
						{
							?>
							<table class="table table-striped">
								<thead>
									<tr>
									  <th></th>
									  <th>phase ID</th>
									  <th>supplier ID</th>
									  <th>Status</th>
									</tr>
								</thead>
								
							<?php
							$count=0;
					echo"<form method='post' action='assignPhaseToSupplier.php?phaseID=$phase_id'>";
					$dbQuery1=$db->prepare("select * from phase_supplier WHERE phase_id=:id");
					$dbParams1=array('id'=>$phase_id);
					$dbQuery1->execute($dbParams1);
					$dataRows1 = $dbQuery1->rowCount();
					while ($dbRow = $dbQuery1->fetch(PDO::FETCH_ASSOC)) 
					{
						$id=$dbRow["id"];
						$phase_id1=$dbRow["phase_id"];
						$supplier_id=$dbRow["supplier_id"];
						echo "<tbody>
							<tr>
								<td></td>
								<td>$id</td>
								<td>$phase_id1</td>
								<td>$supplier_id</td>
								<td>Active</td>
								<td><label class='form-check-label'><input type='checkbox' name='checkPhase[]' class='form-check-input' id='checkboxSuccess' value='$phase_id1' checked></label></td>";
								$items[$count] = $supplier_id;
							echo"	
							</tr>
						</tbody>";
						
						$count=$count+1;
					
					$count2=$count;
					?>
					<button name='approve' type='submit' class='btn btn-primary'>Activate</button>
					</form>
							</table>
							<table class="table table-striped">
							<?php
							
						$dbQuery2=$db->prepare("select * from suppliers WHERE supplier_id!=:id");
						$dbParams2=array('id'=>$supplier_id);
						$dbQuery2->execute($dbParams2);
						$dataRows1 = $dbQuery1->rowCount();
						
						if($dataRows1>0)
						{
							$supplier_id1=$dbRow["supplier_id"];
							echo "<tbody>
								<tr>
									<td>  
										<label class='form-check-label'><input type='checkbox' name='checkSupplier[]' class='form-check-input' id='checkboxSuccess' value='$supplier_id1'></label>
									</td>
									<td>$supplier_id1</td>
									<td>$count2</td>
									<td>$items[0]</td>";
									echo "<td>".count($items)."</td>
									<td>$count2</td>
								</tr>
							</tbody>";
						}
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
