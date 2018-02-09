<?php
  session_start();
  include("../dbConnect.php");
  
  if (!isset($_SESSION["currentUserID"])) 
     header("Location: login.php");
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

<br>
<div id="loginSuc" class="alert alert-info" role="alert">
<?php
		include("../dbConnect.php");
		$id=$_SESSION["currentUserID"];
		$dbQuery=$db->prepare("select * from users where user_id=:id");
		$dbParams=array('id'=>$id);
		$dbQuery->execute($dbParams);
   
		while ($dbRow = $dbQuery->fetch(PDO::FETCH_ASSOC)) 
		{
			$theUsername=$dbRow["user_username"];
			
			echo "$theUsername is logged in";
			$_SESSION["logedInUser"]=$theUsername;
		} 


?>
</div>
<?php
	echo $_SESSION["currentUserID"];
	echo $_SESSION["logedInUser"];
	?>
<p>This content should only be visible after a successful login</p>

<form method="post" action="/Project/killSession.php">
     <br>
     <input type="submit" value="Sign Out" class="btn btn-primary btn-lg active" role="button">
   </form>
   </div>

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

