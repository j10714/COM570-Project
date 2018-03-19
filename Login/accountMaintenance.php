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
	
	if (isset($_GET["user_id"])) 
	{
		$userIDAccount=$_GET["user_id"];
		if(has_Password_Reset($userIDAccount))
		{
			//echo "<script>window.location.href = '/Project/Login/account.php?id=$userIDAccount'</script>";
		}
		
		
	}//if		
	else if (isset($_GET["user_id0"])) 
	{
		$userIDAccount=$_GET["user_id0"];
		$supplier_status=0;
				
		$dbQuery18=$db->prepare("UPDATE users SET user_status = '$user_status' WHERE user_id=:id");
		$dbParams18=array('id'=>$userIDAccount);
		$dbQuery18->execute($dbParams18);
				
		echo "<script>window.location.href = '/Project/Login/account.php'</script>";
		
	}//elseif
	
	else if (isset($_GET["user_id1"])) 
	{
		$userIDAccount=$_GET["user_id1"];
		$user_status=1;
				
		$dbQuery18=$db->prepare("UPDATE users SET user_status = '$user_status' WHERE user_id=:id");
		$dbParams18=array('id'=>$userIDAccount);
		$dbQuery18->execute($dbParams18);
				
		echo "<script>window.location.href = '/Project/Login/account.php'</script>";
		
	}//elseif
	
     
		//echo " and the session has been registered for: ".$username;
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../../../../favicon.ico">

		<title>Carousel Template for Bootstrap</title>

		<!-- Bootstrap core CSS -->
		<link href="../../../../dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
		<!-- boostrap CSS code-->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

		<!-- Custom styles for this template -->
		<link href="/Project/CSS/index.css" rel="stylesheet">
		
		<style>
			.demo-container {
				width: 100%;
				max-width: 350px;
				margin: 50px auto;
			}

			form {
				margin: 30px;
			}
			input {
				width: 200px;
				margin: 10px auto;
				display: block;
			}

		</style>
	</head>
	<body>
		<div class="container">
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
						  <a class="nav-link disabled" href="/Project/Register/register.php">Register</a>
						</li>
					  </ul>
						<ul class="navbar-nav px-3">
							<li class="nav-item text-nowrap active">
							<?php 
								 if (isset($_SESSION["currentUserID"]))						 
								{
									?>
									<a class="nav-link" href="/Project/Login/account.php.php"><?php echo $_SESSION["currentUser"];?>'s Account</a>
									<?php
								}
								else
								{
									?>
									<a class="nav-link" href="/Project/Login/account.php.php">Login</a>
									<?php
									
								}
							?>
							</li>
						</ul>
					</div>
				</nav>
			</header>
		<br>
		
		<ul class="nav nav-tabs id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link" href="/Project/Login/account.php">My Account</a>
				</li>
				

		<?php
		
		if(has_Restriction("contractor:administrator",$userID))
		{
			?>
			<li class="nav-item">
				  <a class="nav-link active" href="/Project/Login/accountMaintenance.php">User Account Management</a>
			</li>
			
			<?php
		}
		else
		{
		}
			?>
		</ul>
	<?php
	if(has_Restriction("contractor:administrator",$userID))
	{
		?>
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
									<tr>
									  <th>User ID</th>
									  <th>User Name</th>
									  <th>Name</th>
									  <th>User Email</th>
									  <th>User Role</th>
									  <th>User Last Active</th>
									  <th>User Status</th>
									  <th>Reset Password</th>
									</tr>
								</thead>
								<?php
									$dbQuery11=$db->prepare("select * from users WHERE user_id!=:user_id");
									$dbParams11=array('user_id'=>$userID);
									$dbQuery11->execute($dbParams11);
									
									while ($dbRow = $dbQuery11->fetch(PDO::FETCH_ASSOC)) 
									{
										$user_id=$dbRow["user_id"];
										$user_username=$dbRow["user_username"];
										$user_title=$dbRow["user_title"];
										$user_firstname=$dbRow["user_firstname"];
										$user_lastname=$dbRow["user_lastname"];
										$user_email=$dbRow["user_email"];
										$user_active=$dbRow["user_active"];
										$user_status=$dbRow["user_status"];
										
										$dbQuery12=$db->prepare("select * from user_roles_assign WHERE user_id=:user_id");
										$dbParams12=array('user_id'=>$user_id);
										$dbQuery12->execute($dbParams12);
										while ($dbRow = $dbQuery12->fetch(PDO::FETCH_ASSOC)) 
										{
											$role_id=$dbRow["role_id"];
											
											$dbQuery13=$db->prepare("select * from user_roles WHERE role_id=:role_id");
											$dbParams13=array('role_id'=>$role_id);
											$dbQuery13->execute($dbParams13);
											while ($dbRow2 = $dbQuery13->fetch(PDO::FETCH_ASSOC)) 
											{
												$role_name=$dbRow2["role_name"];
												
												echo "<form method='post' action='index.php'>
												<tbody>
													<tr>
														<td>$user_id</td>
														<td>$user_username</td>
														<td>$user_title $user_firstname $user_lastname</td>
														<td>$user_email</td>
														<td>$role_name</td>
														<td>$user_active</td>
														";
														if($user_status > 0 )
														{
															echo"<td><a class='btn btn-primary' href='accountMaintenance.php?user_id0=".$user_id."'>Deactivate User</a></td>";
														}
														else
														{
															echo"<td><a class='btn btn-primary' href='accountMaintenance.php?user_id1=".$user_id."'>Activate User</a></td>";
														}
														echo"<td><a class='btn btn-primary' href='accountMaintenance.php?user_id=".$user_id."'>Reset Password</a></td>";
													echo "</tr>
												</tbody>
												</form>";
											}
										}
									}
							?>
							</table>
						</div>
	<?php
	}
	?>
		</div> <!-- /container -->
		
		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>')</script>
		<script src="../../../../assets/js/vendor/popper.min.js"></script>
		<script src="../../../../dist/js/bootstrap.min.js"></script>
		
	</body>
</html>

