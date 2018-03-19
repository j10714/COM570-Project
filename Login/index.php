<?php
   session_start();
   unset($_SESSION["currentUser"]);
   unset($_SESSION["currentUserID"]);

   if (isset($_POST["action"]) && $_POST["action"]=="login") 
   {
      $formUser=$_POST["username"];
      $formPass=$_POST["password"];

      include("../dbConnect.php");
	  
	  
	  $dbQuery1=$db->prepare("select * from users where user_username=:formUser OR user_email=:formEmail"); 
      $dbParams1 = array('formUser'=>$formUser,'formEmail'=>$formUser);
      $dbQuery1->execute($dbParams1);
	  while ($dbRow1 = $dbQuery1->fetch(PDO::FETCH_ASSOC))
		{ 
	  $user_status=$dbRow1["user_status"];
		  if($user_status!=1)
		  {
			   header("Location: index.php?failCode=3");
		  }
		else
		{
			  $dbQuery=$db->prepare("select * from users where user_username=:formUser OR user_email=:formEmail"); 
			  $dbParams = array('formUser'=>$formUser,'formEmail'=>$formUser);
			  $dbQuery->execute($dbParams);
			  
			  $dbRow=$dbQuery->fetch(PDO::FETCH_ASSOC);
			  
			  if ($dbRow["user_username"]==$formUser) 
			  {
				 if ($dbRow["user_password"]==$formPass) 
				 {
					$_SESSION["currentUser"]=$formUser;
					$_SESSION["currentUserID"]=$dbRow["user_id"];
					header("Location:account.php");    
				 }
				 else 
				 {
					$dbPassword=$dbRow["user_password"];
					$formPassHash=md5($formPass);
						if ($dbPassword==$formPassHash)
						{
							$_SESSION["currentUser"]=$formUser;
							$_SESSION["currentUserID"]=$dbRow["user_id"];
							header("Location:account.php"); 
						}
					else
					{
					header("Location: index.php?failCode=2");
					}
				 }
			  }
			  else if ($dbRow["user_username"]!=$formUser)
			  {
				  if ($dbRow["user_email"]==$formUser) 
					{
						 if ($dbRow["user_password"]==$formPass) 
						 {
							$_SESSION["currentUser"]=$formUser;
							$_SESSION["currentUserID"]=$dbRow["user_id"];
							header("Location:account.php");    
						 }
							 else 
							 {
								$dbPassword=$dbRow["user_password"];
								$formPassHash=md5($formPass);
									if ($dbPassword==$formPassHash)
									{
										$_SESSION["currentUser"]=$formUser;
										$_SESSION["currentUserID"]=$dbRow["user_id"];
										header("Location:account.php"); 
									}
								else
								{
								header("Location: index.php?failCode=2");
								}
							 }
					}
				else
				{
					header("Location: index.php?failCode=1");
				}
				  
			  }
			  else
			  {
					header("Location: index.php?failCode=1");
			  }
		}
		}
   }   
   else 
   {
?>
<!DOCTYPE html>
<html>
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
</head>
<body>
	<div class="container">

      <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->

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
			  </ul>
			</div>
		  </nav>
		</header>

		<?php
		   if (isset($_GET["failCode"])) 
		   {
				if ($_GET["failCode"]==1)
					echo "<h3>Bad username or email entered</h3>";
				if ($_GET["failCode"]==2)
					echo "<h3>Bad password entered</h3>";
				if ($_GET["failCode"]==3)
					echo "<h3>User Account has been made Inactive, please contact administrator to resolve</h3>";

		   }      
		?>         

		<table align="center" style="width:50%">  
		   <tr>
		   <td>
		   <h4>SIGN IN</h4>
		   </td>
		   </tr>
		   
		   <form name="login" method="post" action="/Project/Login/index.php">
		   <tr>
		   <td>
			<div id="loginInfo"class="form-group">
			<label for="exampleInputEmail1">Username or Email</label>
			<input type="text" class="form-control" name="username">
		  </div>
		  </td>
		  <td></td>
		  </tr>
		  
		  <tr>
		  <td>
		  <div id="loginInfo"class="form-group">
			<label for="exampleInputEmail1">Password</label>
			<input type="password" class="form-control" name="password">
		  </div>
		  </td>
		  <td></td>
		  </tr>
			 <br>
			 
			 <tr>
			 <td>
			 <input type="hidden" name="action" value="login">
			 <input type="submit" value="Login" class="btn btn-primary btn-lg active" role="button">
			 </td>
			 </form>
			 </tr>
		</table>
    </div> <!-- /container -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
<?php
   }
?>
</html>
