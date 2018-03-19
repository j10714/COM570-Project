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
	$approved=0;
	$reject=0;
	$count=0;
	// if (isset($_GET["id"])) 
	// {	
		// $user_identification=$_GET["id"];
		// $supplier_status=1;
		
		// $dbQuery1=$db->prepare("insert into suppliers values(null,:user_id,:supplier_status)");
		// $dbParams1=array('user_id'=>$user_identification, 'supplier_status'=>$supplier_status);
		// //yellow is database field organge = form posting
		// $dbQuery1->execute($dbParams1);
		
		// $dbQuery2=$db->prepare("select * from suppliers WHERE user_id=:user_id");
		// $dbParams2=array('user_id'=>$user_identification);
		// $dbQuery2->execute($dbParams2);
		// while ($dbRow = $dbQuery2->fetch(PDO::FETCH_ASSOC)) 
			// {
				// $user_id1=$dbRow["user_id"];
				// $role_id1=2;
				
				// $dbQuery3=$db->prepare("insert into user_roles_assign values(null,:user_id,:role_id)");
				// $dbParams3=array('user_id'=>$user_id1, 'role_id'=>$role_id1);
				// $dbQuery3->execute($dbParams3);
				
			// }
		// echo "<script>window.location.href = '/Project/Suppliers/index.php'</script>";
		
	// }//if
	
	if (isset($_GET["supplier_id0"])) 
	{
		$supplier_id=$_GET["supplier_id0"];
		$supplier_status=0;
		
		$dbQuery4=$db->prepare("UPDATE suppliers SET supplier_status = '$supplier_status' WHERE supplier_id=:id");
		$dbParams4=array('id'=>$supplier_id);
		//yellow is database field organge = form posting
		$dbQuery4->execute($dbParams4);
		
		$dbQuery5=$db->prepare("select * from suppliers WHERE supplier_id=:supplier_id");
		$dbParams5=array('supplier_id'=>$supplier_id);
		$dbQuery5->execute($dbParams5);
		while ($dbRow = $dbQuery5->fetch(PDO::FETCH_ASSOC)) 
			{
				$user_id2=$dbRow["user_id"];
				$role_id2=99;
				
				$dbQuery6=$db->prepare("UPDATE user_roles_assign SET role_id = '$role_id2' WHERE user_id=:id");
				$dbParams6=array('id'=>$user_id2);
				$dbQuery6->execute($dbParams6);
				
			}
		echo "<script>window.location.href = '/Project/Suppliers/index.php'</script>";
		
	}//elseif
	
	else if (isset($_GET["supplier_id1"])) 
	{
		$supplier_id=$_GET["supplier_id1"];
		$supplier_status=1;
		
		$dbQuery7=$db->prepare("UPDATE suppliers SET supplier_status = '$supplier_status' WHERE supplier_id=:id");
		$dbParams7=array('id'=>$supplier_id);
		//yellow is database field organge = form posting
		$dbQuery7->execute($dbParams7);
		
		
		$dbQuery8=$db->prepare("select * from suppliers WHERE supplier_id=:supplier_id");
		$dbParams8=array('supplier_id'=>$supplier_id);
		$dbQuery8->execute($dbParams8);
		while ($dbRow = $dbQuery8->fetch(PDO::FETCH_ASSOC)) 
			{
				$user_id3=$dbRow["user_id"];
				$role_id3=2;
				
				$dbQuery9=$db->prepare("UPDATE user_roles_assign SET role_id = '$role_id3' WHERE user_id=:id");
				$dbParams9=array('id'=>$user_id3);
				$dbQuery9->execute($dbParams9);
				
			}
		echo "<script>window.location.href = '/Project/Suppliers/index.php'</script>";
		
	}//elseif
	
	else if (isset($_POST["approve"])) 
	{
	
		if(!empty($_POST['checkAccount'])) 
		{
			$approved=1;
			//echo '<h3>You have selected the following</h3>';
			foreach($_POST["checkAccount"] as $checkAccount)
			{
				//echo '<p>'.$checkAccount.'</p>';
				
				$dbQuery16=$db->prepare("UPDATE selection_options SET approved = '$approved', sel_opt_price = sel_opt_price2 WHERE sel_opt_id=:id");
				$dbParams16=array('id'=>$checkAccount);
				//yellow is database field organge = form posting
				$dbQuery16->execute($dbParams16);
			}
			//echo "<script>window.location.href = '/Project/Suppliers/index.php'</script>";
		}
		
	}
	
		else if (isset($_POST["reject"])) 
	{
	
		if(!empty($_POST['checkAccount'])) 
		{
			$reject=99;
			//echo '<h3>You have selected the following</h3>';
			foreach($_POST["checkAccount"] as $checkAccount)
			{
				//echo '<p>'.$checkAccount.'</p>';
				
				$dbQuery16=$db->prepare("UPDATE selection_options SET approved = '$reject' WHERE sel_opt_id=:id");
				$dbParams16=array('id'=>$checkAccount);
				//yellow is database field organge = form posting
				$dbQuery16->execute($dbParams16);
			}
			//echo "<script>window.location.href = '/Project/Suppliers/index.php'</script>";
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
				<h1>Supplier Area</h1>
				  
				<ul class="nav nav-tabs role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#supplierArea">Current Suppliers</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" data-toggle="tab" href="#selectionApproval">Selection Approval</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" href="/Project/Register/register.php?userRole=2">Add Supplier</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" data-toggle="tab" href="#assignPhaseToSupplier">Supplier Assign</a>
					</li>

				</ul>
				<div class="tab-content">
					<div id="supplierArea" class="container tab-pane active">
							<table class="table table-striped">
								<thead>
									<tr>
									  <th>Supplier ID</th>
									  <th>Supplier Name</th>
									  <th>User Account ID</th>
									  <th>Supplier Status</th>
									</tr>
								</thead>
								<?php
								$dbQuery10=$db->prepare("select * from suppliers");
								$dbQuery10->execute();
								while ($dbRow = $dbQuery10->fetch(PDO::FETCH_ASSOC)) 
								{
									$supplierID=$dbRow["supplier_id"];
									$user_id4=$dbRow["user_id"];
									$supplierStatus=$dbRow["supplier_status"];
									
									$dbQuery11=$db->prepare("select * from users WHERE user_id=:user_id");
									$dbParams11=array('user_id'=>$user_id4);
									$dbQuery11->execute($dbParams11);
									
									while ($dbRow = $dbQuery11->fetch(PDO::FETCH_ASSOC)) 
									{
									
										$user_id5=$dbRow["user_id"];
										$user_title=$dbRow["user_title"];
										$user_firstname=$dbRow["user_firstname"];
										$user_lastname=$dbRow["user_lastname"];
										
										echo "<form method='post' action='index.php'>
										<tbody>
											<tr>
												<td>$supplierID</td>
												<td>$user_title $user_firstname $user_lastname</td>
												<td>$user_id5</td>";
												if($supplierStatus > 0 )
												{
													echo"<td><a class='btn btn-primary' href='index.php?supplier_id0=".$supplierID."'>Deactivate Supplier</a></td>2";
												}
												else
												{
													echo"<td><a class='btn btn-primary' href='index.php?supplier_id1=".$supplierID."'>Activate Supplier</a></td>2";
												}
											echo "</tr>
										</tbody>
										</form>";
									}
								}
							?>
							</table>
					</div>
					
					<div id="selectionApproval" class="container tab-pane fade">
					<div class="table-responsive">
							<table class="table table-striped">
								<?php
								$pending=0;
								$dbQuery12=$db->prepare("select * from selection_options where approved=:approved");
								$dbParams12=array('approved'=>$pending);
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
															echo "<form method='post'>";
															$count=$count+1;
															if ($count==1)
															{
																echo "<thead>
																	<tr>
																		<th></th>
																		<th>Category Name</th>
																		<th>Selection Type</th>
																		<th>Selection Colour</th>
																		<th>Selection Price</th>
																		<th>Selection Price Pending</th>
																	</tr>
																</thead>";
																
	
															}
															
															
																echo "<tbody>
																	<tr>
																		<td>  
																			<label class='form-check-label'><input type='checkbox' name='checkAccount[]' class='form-check-input' id='checkboxSuccess' value='$sel_opt_id'></label>
																		</td>
																		<td>$category_name</td>
																		<td>$sel_type_name</td>
																		<td>$sel_opt_details</td>
																		<td>$sel_opt_price</td>
																		<td>$sel_opt_price2</td>
																	</tr>
																</tbody>";
																
																if ($count==1)
																{
																	echo "<tfoot>
																		 <button name='approve' type='submit' class='btn btn-primary'>Approve</button>&nbsp
																		 <button name='reject' type='submit' class='btn btn-primary'>Reject</button>
																	 </tfoot>
																	 ";
																}
																
															
															
													}
										}
									}
								}
								?>
								</form>
							</table>
						</div>
					</div>
					
					<div id="selectionApproval" class="container tab-pane fade">
					<div class="table-responsive">
							<table class="table table-striped">
							</table>
						</div>
					</div>
				</div>
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
