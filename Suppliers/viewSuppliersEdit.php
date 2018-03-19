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
	if(!has_Restriction("supplier:view",$userID))
	{
		echo "<script>window.location.href = '/Project/permissionDeniedMessage.php?permission=0'</script>";
	}
	$selOptID=$_GET["optID"];
	
	if (isset($_POST["submit"])) 
		{
				$selOptID2=$_GET["selOptID2"];
				$sel_opt_price2=$_POST["selectionPriceNew"];
				$approved=0;
				
				
				$dbQuery2=$db->prepare("UPDATE selection_options SET sel_opt_price2 = '$sel_opt_price2', approved = '$approved' WHERE sel_opt_id=:id");
				$dbParams2=array('id'=>$selOptID2);
				$dbQuery2->execute($dbParams2);
				
				echo "<script>window.location.href ='index.php'</script>";
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
			
			<div class="container-fluid">
			<h2>Selection Edit</h2>
			
			<?php
				echo "<form method='post' action='viewSuppliersEdit.php?selOptID2=$selOptID'>";
			?>
			
			<?php
			$dbQuery12=$db->prepare("select * from selection_options where sel_opt_id=:sel_opt_id");
			$dbParams12=array('sel_opt_id'=>$selOptID);
			$dbQuery12->execute($dbParams12);
		
			while ($dbRow = $dbQuery12->fetch(PDO::FETCH_ASSOC))
			{
				$sel_opt_id=$dbRow["sel_opt_id"];
				$sel_opt_name=$dbRow["sel_opt_name"];
				$sel_opt_details=$dbRow["sel_opt_details"];
				$sel_opt_price=$dbRow["sel_opt_price"];
				$sel_opt_price2=$dbRow["sel_opt_price2"];
				$supplier_id=$dbRow["supplier_id"];
				
				$dbQuery13=$db->prepare("select * from selection_link where sel_opt_id=:sel_opt_id");
				$dbParams13=array('sel_opt_id'=>$sel_opt_id);
				$dbQuery13->execute($dbParams13);
				
				while ($dbRow = $dbQuery13->fetch(PDO::FETCH_ASSOC))
				{
					$sel_type_id=$dbRow["sel_type_id"];
					$category_id=$dbRow["category_id"];
					
					$dbQuery14=$db->prepare("select * from selection_types where sel_type_id=:sel_type_id");
					$dbParams14=array('sel_type_id'=>$sel_type_id);
					$dbQuery14->execute($dbParams14);
					
					while ($dbRow = $dbQuery14->fetch(PDO::FETCH_ASSOC))
					{
						$sel_type_id2=$dbRow["sel_type_id"];
						$sel_type_name=$dbRow["sel_type_name"];
							
								$dbQuery15=$db->prepare("select * from selection_category where category_id=:category_id ");
								$dbParams15=array('category_id'=>$category_id);
								$dbQuery15->execute($dbParams15);
								$dataRows = $dbQuery15->rowCount();
								
								while ($dbRow = $dbQuery15->fetch(PDO::FETCH_ASSOC))
								{
										$category_name=$dbRow["category_name"];
								}
					}
				}
			}
			?>
						
					<div class="form-group col-md-6">
						<label for="category_name">Category Name</label>
						<input name="category_name" type="text" class="form-control" id="category_name" value="<?php echo $category_name; ?>" placeholder="Category Name"readonly>
					</div>
					
					<div class="form-group col-md-4">
						<label for="selectionColour">Selection Colour/Material</label>
						<input type="text" name = "selectionColour"class="form-control" id="selectionColour" value="<?php echo $sel_type_name; ?>" placeholder="Selection Colour/Material"readonly>
					</div>
					
					<div class="form-group col-md-4">
						<label for="selectionDetails">Selection Details</label>
							<input type="text" name = "selectionDetails"class="form-control" id="selectionDetails" value="<?php echo $sel_opt_details; ?>" placeholder="Selection Details"readonly>
					</div>
					
					<div class="form-group col-md-4">
						<label for="selectionPriceCurrent">Selection Price</label>
						<div class="input-group">
							<span class="input-group-addon">£</span>
							<input type="text" name = "selectionPriceCurrent"class="form-control" id="selectionPriceCurrent" value="<?php echo $sel_opt_price; ?>" placeholder="Selection Price Currrent"readonly>
						</div>
					</div>
					
					<div class="form-group col-md-4">
						<label for="selectionPriceNew">Selection Price New</label>
						<div class="input-group">
							<span class="input-group-addon">£</span>
							<input type="text" name = "selectionPriceNew"class="form-control" id="selectionPriceNew" placeholder="Selection Price">
						</div>
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