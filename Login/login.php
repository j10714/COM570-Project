<?php
   session_start();
   
   unset($_SESSION["currentUser"]);
   unset($_SESSION["currentUserID"]);

   if (isset($_POST["action"]) && $_POST["action"]=="login") {

      $formUser=$_POST["username"];
      $formPass=$_POST["password"];

      include("../dbConnect.php");
      $dbQuery=$db->prepare("select * from users where user_username=:formUser"); 
      $dbParams = array('formUser'=>$formUser);
      $dbQuery->execute($dbParams);
      $dbRow=$dbQuery->fetch(PDO::FETCH_ASSOC);
      if ($dbRow["user_username"]==$formUser) {       
         if ($dbRow["user_password"]==$formPass) {
            $_SESSION["currentUser"]=$formUser;
            $_SESSION["currentUserID"]=$dbRow["user_id"];
            header("Location: loginB.php");    
         }
         else {
            header("Location: login.php?failCode=2");
         }
      } else {
            header("Location: login.php?failCode=1");
      }

   } else {
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
   if (isset($_GET["failCode"])) {
      if ($_GET["failCode"]==1)
         echo "<h3>Bad username entered</h3>";
      if ($_GET["failCode"]==2)
         echo "<h3>Bad password entered</h3>";
   }      
?>         

<table align="center" style="width:50%">  
   <tr>
   <td>
   <h4>SIGN IN</h4>
   </td>
   </tr>
   
   <form name="login" method="post" action="/Project/Login/login.php">
   <tr>
   <td>
	<div id="loginInfo"class="form-group">
    <label for="exampleInputEmail1">Username</label>
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
