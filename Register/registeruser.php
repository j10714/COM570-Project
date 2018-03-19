<?php
		session_start();
		//include("../Project/dbConnect.php");
		include("../dbConnect.php");
		include("../restrictionCheck.php");
		$userID =$_SESSION["currentUserID"];
		
		if(!has_Restriction("contractor:administrator",$userID))
		{
			echo "<script>window.location.href = '/Project/permissionDeniedMessage.php?permission=0'</script>";
		}
		
		$dbQuery7=$db->prepare("select * from human_random ORDER BY RAND() LIMIT 1");
		$dbQuery7->execute();
		while ($dbRow = $dbQuery7->fetch(PDO::FETCH_ASSOC)) 
		{
			$id=$dbRow["id"];
			$answer=$dbRow["answer"];
		}
		
		$username=$_POST["username"];
		$password=$_POST["password"];
		$email=$_POST["email"];
		$user_title=$_POST["title"];
		$user_firstname=$_POST["firstName"];
		$user_lastname=$_POST["lastName"];
		$user_address=$_POST["address"];
		$user_town=$_POST["town"];
		$user_postcode=$_POST["postcode"];
		$user_county=$_POST["county"];
		$user_phone=$_POST["phone"];
		$human=$_POST["human"];
		
		//user role
		$user_Role=$_POST["user_Role"];
		$password= md5($password);
		 //$password = md5($password);
		 
		$dbQuery6=$db->prepare("select * from users WHERE user_email=:user_email");
		$dbParams6=array('user_email'=>$email);
		$dbQuery6->execute($dbParams6);
		$dataRows6 = $dbQuery6->rowCount();
		
		if($dataRows6>0)
		{
			//echo "<script>window.location.href ='/Project/index.php'</script>";
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
	<!-- boostrap JS code-->

    <!-- Custom styles for this template -->
    <link href="/Project/CSS/index.css" rel="stylesheet">
	

<script>

function myFunction()
{
   document.getElementById("registerButton").style.visibility = "hidden";

}
function validate() {
	
	// get the form element
	var contactForm = document.getElementById("contactForm");

	/// var isCorrect will be set to false if an error is detected 
	var userIsCorrect=false;
	var emailIsCorrect=false;
	var passIsCorrect=false;
	var humanIsCorrect=false;
	var passCheckIsCorrect=false;
	var firstNameIsCorrect=false;
	var lastNameIsCorrect=false;
	var addressIsCorrect=false;
	var townsIsCorrect=false;
	var postcodeIsCorrect=false;
	var phoneIsCorrect=false;
	var Human="<?php echo $answer ?>";

	var goodColor = "#66cc66";
    var badColor = "#ff6666";
    var message = document.getElementById('confirmMessage');
    var valPass = document.getElementById('passwordValidation');
    var valEmail = document.getElementById('emailValidation');
    var valUser = document.getElementById('usernameValidation');
	var valFirstName = document.getElementById('firstNameValidation');
	var valLastName = document.getElementById('lastNameValidation');
	var valAddress = document.getElementById('addressValidation');
	var valTown = document.getElementById('townValidation');
	var valPostcode= document.getElementById('postcodeValidation');
	var valPhone= document.getElementById('phoneValidation');
	
	var x = document.forms["contactForm"]["email"].value;
	var EmailTest = contactForm.email.value;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
	
	//username Validation
	if (contactForm.username.value == "")  {
		userIsCorrect=false;	
		valUser.style.color = badColor;
        valUser.innerHTML = "Username (Blank)" 
	}
	
	else{
		
		valUser.style.color = goodColor;
        valUser.innerHTML = "Username Valid" 
	    userIsCorrect=true;}
		
	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
	{
		emailIsCorrect=false;		
		valEmail.style.color = badColor;
		valEmail.innerHTML = "Invalid Email" 
	}	
	else{
		valEmail.style.color = goodColor;
        valEmail.innerHTML = "Valid Email" 
		emailIsCorrect=true;}
		
	if (contactForm.human.value != Human) {
		humanIsCorrect=false;
	contactForm.human.style.background = 'yellow';
}
if(contactForm.human.value == Human){
	humanIsCorrect=true;
	contactForm.human.style.background = 'white';

}

if(userIsCorrect==true && emailIsCorrect==true && humanIsCorrect==true)
{
	document.getElementById("registerButton").style.visibility = "visible";
}
else{
	document.getElementById("registerButton").style.visibility = "hidden";
	
}

}	
	</script>
</head>
	<body onload="myFunction()">
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
				  <a class="nav-link" href="/Project/index.php">Home</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="/Project/Contractors/Developments/developments.php">Developments</a>
				</li>
				<li class="nav-item active">
				  <a class="nav-link" href="/Project/Register/register.php">Register <span class="sr-only">(current)</span></a>
				</li>
			  </ul>
			</div>
		  </nav>
		</header>
		<table class="table table-striped">  
			<tr>
			<td><h2>Welcome to Register</h2></td>

			</tr>
			<form id="contactForm" class="form-horizontal" role="form" method="post" action="/Project/Register/registeruser.php" onSubmit="return validate();">
				<tr>
					<td>
					<div id="loginInfo"class="form-group">
					<label for="username">Username</label>
					<input type="text" class="form-control" name="username" placeholder="Username" onkeyup="validate(); onclick=validate(); return false;">
					<span id="usernameValidation" class="usernameValidation"></span>
					</div>
					</td>
				</tr>

				<tr>
					<td>
					<div id="loginInfo"class="form-group">
					<label for="emaiIvalidl">Email Invalid</label>
					<input type="text" class="form-control" name="emaiIvalidl" placeholder="Email" value="<?php echo $email; ?>"readonly>
					</div>
					</td>

				</tr>
				<tr>
					<td>
					<div id="loginInfo"class="form-group">
					<label for="email">Email</label>
					<input type="text" class="form-control" name="email" placeholder="Email" onkeyup="validate(); onclick=validate(); return false;">
					<span id="emailValidation" class="emailValidation"></span>
					</div>
					</td>

				</tr>
				<tr>
				  <td>
				  <div id = "loginInfo"class="form-group">
						<span class="glyphicon glyphicon-eye-open"></span>
						<?php
						
							$dbQuery2=$db->prepare("select * from human_random WHERE id=:id");
							$dbParams2=array('id'=>$id);
							$dbQuery2->execute($dbParams2);
							while ($dbRow = $dbQuery2->fetch(PDO::FETCH_ASSOC)) 
							{
							$firstNumber=$dbRow["first_number"];
							$secondNumber=$dbRow["second_number"];
							$symbol=$dbRow["symbol"];
							echo"<label for='human'> $firstNumber $symbol $secondNumber = ?</label>"; 
							//echo "<option>$firstNumber</option>";
							}
										?>
						<!--<label for="human">2 + 3 = ?</label>--> 		
							<input type="text" class="form-control" id="human" name="human" placeholder="Answer" onkeyup="validate(); onclick=validate(); return false;">
							<span id="humanValidation" class="humanValidation"></span>
						</div>
				  </td>
				  <td>
				  </td>
				  </tr>				
			</form>
		</table>	  
		
		</div> <!-- /container -->


		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="assets/js/ie10-viewport-bug-workaround.js"></script>
	</body>
</html>
<?php	
		}
		else
		{
		$dbQuery=$db->prepare("insert into users values (null,:user_username,:user_password,:user_email,:user_title,:user_firstname,:user_lastname,:user_address,:user_town,:user_postcode,:user_county,:user_phone,:user_human)");
		$dbParams=array('user_username'=>$username, 'user_password'=>$password, 'user_email'=>$email, 'user_title'=>$user_title, 'user_firstname'=>$user_firstname, 'user_lastname'=>$user_lastname, 'user_address'=>$user_address, 'user_town'=>$user_town, 'user_postcode'=>$user_postcode, 'user_county'=>$user_county, 'user_phone'=>$user_phone, 'user_human'=>$human);
		$dbQuery->execute($dbParams);
		if(mysqli_query($db, $dbQuery))
		{
			echo "<script>('Registration Done')</script>";
		}
		
		
		
		
		$dbQuery2=$db->prepare("SELECT * FROM users ORDER BY user_id DESC LIMIT 1");
		$dbQuery2->execute();
		while ($dbRow = $dbQuery2->fetch(PDO::FETCH_ASSOC))
		{
			$user_id=$dbRow["user_id"];
		}
		$dbQuery3=$db->prepare("SELECT * FROM user_roles where role_name=:role_name");
		$dbParams3=array('role_name'=>$user_Role);
		$dbQuery3->execute($dbParams3);
		
		while ($dbRow = $dbQuery3->fetch(PDO::FETCH_ASSOC))
		{
			$role_id=$dbRow["role_id"];
		}
		
		$dbQuery4=$db->prepare("insert into user_roles_assign values (null,:user_id,:role_id)");
		$dbParams4=array('user_id'=>$user_id, 'role_id'=>$role_id);
		$dbQuery4->execute($dbParams4);
		
		if($user_Role == "Supplier")
		{
			$supplier_status=1;
			$dbQuery5=$db->prepare("insert into suppliers values (null,:user_id,:supplier_status)");
			$dbParams5=array('user_id'=>$user_id, 'supplier_status'=>$supplier_status);
			$dbQuery5->execute($dbParams5);
		}
		}
		
		
		
		
		
		//$_SESSION["message"] = "You have been registered";

			//
		
		?>