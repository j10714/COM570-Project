<?php
	session_start();
	include("../../dbConnect.php");
	include("../../restrictionCheck.php");
	$userID =$_SESSION["currentUserID"];
  
	if(!has_Restriction("contractor:administrator",$userID))
	{
		echo "<script>window.location.href = '/Project/permissionDeniedMessage.php?permission=0'</script>";
	}
	
		if (isset($_POST["submit"])) {
			
			$file = $_FILES['file'];
			
			//file properties
			$file_name = $file['name'];
			$file_tmp = $file['tmp_name'];
			$file_size = $file['size'];
			$file_error = $file['error'];
			
			//fields from form to add to Database
			$developmentName=$_POST["developmentName"];
			$developmentAddress=$_POST["developmentAddress"];
			$developmentPlots=$_POST["developmentPlots"];
			$developmentStatus=$_POST["developmentStatus"];
			$developmentCity=$_POST["developmentCity"];
			$developmentState=$_POST["developmentState"];
			$developmentPostcode=$_POST["developmentPostcode"];
			$developmentImageName=$_POST["name"];
			
			$dbQuery=$db->prepare("insert into development values(null,:developmentName,:developmentAddress,:developmentPlots,:developmentStatus,:developmentCity,:developmentState,:developmentPostcode, :developmentImageName, :developmentImageFile)");
			$dbParams=array('developmentName'=>$developmentName, 'developmentAddress'=>$developmentAddress, 'developmentPlots'=>$developmentPlots, 'developmentStatus'=>$developmentStatus, 'developmentCity'=>$developmentCity, 'developmentState'=>$developmentState, 'developmentPostcode'=>$developmentPostcode, 'developmentImageName'=>$developmentImageName, 'developmentImageFile'=>$file_name);
			//yellow is database field organge = form posting
			$dbQuery->execute($dbParams);
			
			//extension
			$file_ext = explode('.', $file_name);
			$file_ext = strtolower(end($file_ext));

			$allowed = array('jpg', 'png', 'jpeg');

			if(in_array($file_ext, $allowed))
			{
				if($file_error === 0)
				{
					if($file_size <= 5242880)
					{
						$file_destination = '/kunden/homepages/11/d703192015/htdocs/Project/Contractors/Developments/images/'. $file_name .'';
						if(move_uploaded_file($file_tmp, $file_destination))
						{
							echo "<script>window.location.href ='/Project/index.php'</script>";
						}
					}
				}
			}
			//header("Location: index.php");
			//echo "<script>window.location.href ='/Project/index.php'</script>";
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
          </ul>
		  <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
					<?php 
							 if (isset($_SESSION["currentUserID"]))						 
							{
								?>
								<a class="nav-link" href="/Project/Login/loginB.php"><?php echo $_SESSION["currentUser"];?>'s Account</a>
								<?php
							}
							else
							{
								?>
								<a class="nav-link" href="/Project/Login/loginB.php">Login</a>
								<?php
								
							}
						?>
                </li>
            </ul>
        </div>
      </nav>
    </header>

    <div class="container-fluid">
          <h1>Development Area</h1>
		  
			<ul class="nav nav-tabs role="tablist">
	
				<li class="nav-item">
				  <a class="nav-link" href="/Project/Contractors/Developments/index.php">Development Area</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link active" href="/Project/Contractors/Developments/developmentsAdd.php">Add Development</a>
				</li>
			</ul><br>
			
          <h2>Development Add</h2>
			<form method="post" action="developmentsAdd.php" enctype="multipart/form-data">
				<div class="form-group col-md-6">
				  <label for="inputEmail4">Development Name</label>
				  <input name="developmentName" type="text" class="form-control" id="inputEmail4" placeholder="Development Name">
				</div>
				
				<div class="form-group col-md-6">
					<label for="inputAddress">Address</label>
					<input name="developmentAddress" type="text" class="form-control" id="inputAddress" placeholder="Address">
				</div>
				
				<div class="form-group col-md-6">
					<label for="inputCity">City</label>
					<input name="developmentCity" type="text" class="form-control" id="inputCity">
				</div>
				
				<div class="form-group col-md-4">
					<label for="inputState">State</la bel>
					<select id="inputState" name="developmentState" class="form-control">
						<option selected>Choose...</option>
						<option>Antrim</option>
						<option>Armagh</option>
					</select>
				</div>
				
				<div class="form-group col-md-2">
					<label for="inputPostcode">Postcode</label>
					<input name="developmentPostcode" type="text" class="form-control" id="inputPostcode">
				</div>
				
				<div class="form-group col-md-4">
					<label for="inputPlots">Plots</label>
					<input name="developmentPlots" type="text" class="form-control" id="inputPlots" placeholder="Number of Plots">
				</div>
				
				<input type="text" name="name" placeholder="Meme name"><br>
				<input type="file" name="file"><br>
				
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

