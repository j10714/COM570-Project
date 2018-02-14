<?php
	session_start();
	include("../dbConnect.php");
	include("../restrictionCheck.php");
	$userID =$_SESSION["currentUserID"];
	
	if (isset($_POST["submit"])) 
	{
		$supplier_userid=$userID;
		$categoryName=$_POST["categorySelection"];
		
		$dbQuery14=$db->prepare("select * from selection_category where category_name=:category_name");
		$dbParams14=array('category_name'=>$categoryName);
		$dbQuery14->execute($dbParams14);
		while ($dbRow = $dbQuery14->fetch(PDO::FETCH_ASSOC))
			{
				$category_id2=$dbRow["category_id"];
			}				
		$dbQuery10=$db->prepare("select * from suppliers where user_id=:user_id");
		$dbParams10=array('user_id'=>$supplier_userid);
		$dbQuery10->execute($dbParams10);
		$dataRows2 = $dbQuery10->rowCount();
		
		if ($dataRows2 > 0)
		{
		while ($dbRow = $dbQuery10->fetch(PDO::FETCH_ASSOC))
			{	
				$supplier_id=$dbRow["supplier_id"];
				$sel_opt_name=$_POST["selectionColour"];
				$sel_opt_details=$_POST["selectionDetails"];
				$sel_opt_price=$_POST["selectionPrice"];
				$sel_type_name1=$_POST["selectionTypes"];

				$dbQuery9=$db->prepare("insert into selection_options values(null,:sel_opt_name,:sel_opt_details,:sel_opt_price,:supplier_id)");
				$dbParams9=array('sel_opt_name'=>$sel_opt_name, 'sel_opt_details'=>$sel_opt_details, 'sel_opt_price'=>$sel_opt_price, 'supplier_id'=>$supplier_id);
				$dbQuery9->execute($dbParams9);
				
				
				$dbQuery11=$db->prepare("SELECT sel_opt_id FROM selection_options ORDER BY sel_opt_id DESC LIMIT 1");
				$dbQuery11->execute($dbParams11);
				while ($dbRow = $dbQuery11->fetch(PDO::FETCH_ASSOC))
				{
					$sel_opt_id1=$dbRow["sel_opt_id"];
				}
				
				$dbQuery12=$db->prepare("SELECT * FROM selection_types WHERE sel_type_name=:sel_type_name ");
				$dbParams12=array('sel_type_name'=>$sel_type_name1);
				$dbQuery12->execute($dbParams12);
				while ($dbRow = $dbQuery12->fetch(PDO::FETCH_ASSOC))
				{
					$sel_type_id4=$dbRow["sel_type_id"];
				}
				
				$dbQuery13=$db->prepare("insert into selection_link values(null,:sel_type_id,:sel_opt_id,:category_id)");
				$dbParams13=array('sel_type_id'=>$sel_type_id4, 'sel_opt_id'=>$sel_opt_id1, 'category_id'=>$category_id2);
				$dbQuery13->execute($dbParams13);
				
				echo "<script>window.location.href ='index.php'</script>";
			}
		}
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
		if(has_Restriction("supplier:view",$userID))
		{
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
						<a class="nav-link active" data-toggle="tab" href="#supplierArea">Current Selections</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" data-toggle="tab" href="#supplierAdd">Add Selections</a>
					</li>
					
				</ul><br> 
				<div class="tab-content">
					<div id="supplierArea" class="container tab-pane active">
						<div class="table-responsive">
						
						
						
							<table class="table table-striped">
								<thead>
									<tr>
									  <th>Catrgory Name</th>
									  <th>Selection Type</th>
									  <th>Selection Colour</th>
									  <th>Selection Details</th>
									  <th>Selection Price</th>
									  <th>sel_type_id</th>
									  <th>CAT ID</th>
									</tr>
								</thead>
								
				<?php
				$dbQuery1=$db->prepare("select * from suppliers where user_id=:user_id");
				$dbParams1=array('user_id'=>$userID);
				$dbQuery1->execute($dbParams1);
		
				while ($dbRow = $dbQuery1->fetch(PDO::FETCH_ASSOC))
				{
					$supplierID=$dbRow["supplier_id"];
					
					$dbQuery2=$db->prepare("select * from selection_options where supplier_id=:supplier_id");
					$dbParams2=array('supplier_id'=>$supplierID);
					$dbQuery2->execute($dbParams2);
					
					while ($dbRow = $dbQuery2->fetch(PDO::FETCH_ASSOC))
					{
						$sel_opt_id=$dbRow["sel_opt_id"];
						$sel_opt_name=$dbRow["sel_opt_name"];
						$sel_opt_details=$dbRow["sel_opt_details"];
						$sel_opt_price=$dbRow["sel_opt_price"];
						
						$dbQuery3=$db->prepare("select * from selection_link where sel_opt_id=:sel_opt_id");
						$dbParams3=array('sel_opt_id'=>$sel_opt_id);
						$dbQuery3->execute($dbParams3);
						
						while ($dbRow = $dbQuery3->fetch(PDO::FETCH_ASSOC))
						{
							$sel_type_id=$dbRow["sel_type_id"];
							$category_id=$dbRow["category_id"];
							
							$dbQuery4=$db->prepare("select * from selection_types where sel_type_id=:sel_type_id");
							$dbParams4=array('sel_type_id'=>$sel_type_id);
							$dbQuery4->execute($dbParams4);
							
							while ($dbRow = $dbQuery4->fetch(PDO::FETCH_ASSOC))
							{
								$sel_type_id2=$dbRow["sel_type_id"];
								$sel_type_name=$dbRow["sel_type_name"];
									
										$dbQuery6=$db->prepare("select * from selection_category where category_id=:category_id ");
										$dbParams6=array('category_id'=>$category_id);
										$dbQuery6->execute($dbParams6);
										$dataRows = $dbQuery6->rowCount();
										
										while ($dbRow = $dbQuery6->fetch(PDO::FETCH_ASSOC))
										{
												$category_name=$dbRow["category_name"];
												
												echo "<form method='post' action='index.php'>
													<tbody>
														<tr>
															<td>$category_name</td>
															<td>$sel_type_name</td>
															<td>$sel_opt_name</td>
															<td>$sel_opt_details</td>
															<td>$sel_opt_price</td>
															<td>$sel_type_id2</td>
															<td>$sel_opt_id</td>
															<td>$category_name</td>
														</tr>
													</tbody>
												</form>";
										}
							}
						}
					}
				}
		
				?>
							</table>
						</div>
					</div>
					
					<div id="supplierAdd" class="container tab-pane fade">
						<h2>Selection Add</h2>
									<?php
				echo "<form method='post' action='viewSuppliers.php'>";
			?>
						
					<div class="form-group col-md-4">
						<label for="categorySelection">Category Selection</label>
						<select id="categorySelection" name="categorySelection" class="form-control">
							<?php
								$dbQuery7=$db->prepare("select * from selection_category");
								$dbQuery7->execute();
								while ($dbRow = $dbQuery7->fetch(PDO::FETCH_ASSOC)) 
								{
									$category_name=$dbRow["category_name"];
									echo "<option>$category_name</option>";
								}//while
							?>
						</select>
					</div>

					<div class="form-group col-md-4">
						<label for="selectionTypes">Selection Types</label>
						<select id="selectionTypes" name="selectionTypes" class="form-control">
							<?php
								$dbQuery8=$db->prepare("select * from selection_types");
								$dbQuery8->execute();
								while ($dbRow = $dbQuery8->fetch(PDO::FETCH_ASSOC)) 
								{
									$sel_type_name=$dbRow["sel_type_name"];
									echo "<option>$sel_type_name</option>";
								}//while
							?>
						</select>
					</div>
					
					<div class="form-group col-md-4">
						<label for="selectionColour">Selection Colour/Material</label>
						<div class="input-group">
							<input type="text" name = "selectionColour"class="form-control" id="selectionColour" aria-label="Text input with radio button">
						</div>
					</div>
					
					<div class="form-group col-md-4">
						<label for="selectionDetails">Selection Details</label>
						<div class="input-group">
							<input type="text" name = "selectionDetails"class="form-control" id="selectionDetails" aria-label="Text input with radio button">
						</div>
					</div>
					
					<div class="form-group col-md-4">
						<label for="selectionPrice">Selection Price</label>
						<div class="input-group">
							<span class="input-group-addon">£</span>
							<input type="text" name = "selectionPrice"class="form-control" id="selectionPrice" aria-label="Text input with radio button">
						</div>
					</div>
					
					<button name="submit" type="submit" class="btn btn-primary">Submit</button>
				</form>
					</div>
				</div>
			</div>
			<?php
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
