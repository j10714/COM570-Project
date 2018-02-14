<!DOCTYPE html>
<?php
include("../dbConnect.php");
?>
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
	var cardNumIsCorrect=false; 
	var holderIsCorrect=false;
	var dateIsCorrect=false;
	var cardIsCorrect=false;
	var securityIsCorrect=false;

	var goodColor = "#66cc66";
    var badColor = "#ff6666";
    var message = document.getElementById('confirmMessage');
    var valPass = document.getElementById('passwordValidation');
    var valEmail = document.getElementById('emailValidation');
    var valUser = document.getElementById('usernameValidation');
	var valCardNum = document.getElementById('cardNumValidation');
	var valHolder = document.getElementById('holderValidation');
	var valDate = document.getElementById('dateValidation');
	var valCard = document.getElementById('cardsValidation');
	var valSecurity = document.getElementById('securityValidation');
	

	 var x = document.forms["contactForm"]["email"].value;
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
	
	//email Validation
	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
        emailIsCorrect=false;		
		valEmail.style.color = badColor;
        valEmail.innerHTML = "Invalid Email" 
    }
	
	else{
		valEmail.style.color = goodColor;
        valEmail.innerHTML = "Valid Email" 
		emailIsCorrect=true;}
	
	//password Validation
    if (contactForm.password.value == "") {
		passIsCorrect=false;
        contactForm.password.style.background = 'Red';
        valPass.style.color = badColor;
        valPass.innerHTML = "Password (Blank)" 
       	

    } else if ((contactForm.password.value.length < 7) || (contactForm.password.value.length > 15)) {
		passIsCorrect=false;
        contactForm.password.style.background = 'Red';
        valPass.style.color = badColor;
        valPass.innerHTML = "The password is the wrong length. (Must be 7-15 in length)" 
        
 
    } else if ( (contactForm.password.value.search(/[a-zA-Z]+/)==-1) || (contactForm.password.value.search(/[0-9]+/)==-1) ) {
		passIsCorrect=false;
        contactForm.password.style.background = 'Red';
         valPass.style.color = badColor;
        valPass.innerHTML = "The password must contain at least one Letter Or Number." 
        
 
    }

    else {
		valPass.style.color = goodColor;
        valPass.innerHTML = "Valid Password" 
        contactForm.password.style.background = 'White';
		passIsCorrect=true;
    }
    if(contactForm.password.value != contactForm.password2.value)
    	{
		passCheckIsCorrect=false;
        message.style.color = badColor;
        message.innerHTML = "Passwords Do Not Match!" 
        }
		
     if(contactForm.password.value == "" && contactForm.password2.value == "")
     {
		passCheckIsCorrect=false;
     	message.style.color = badColor;
        message.innerHTML = "Passwords Are Blank!!!!"
     }
	 

    else if (contactForm.password2.value == contactForm.password.value || contactForm.password.value == contactForm.password2.value ){
		passCheckIsCorrect=true;
    	message.style.color = goodColor;
        message.innerHTML = "Passwords Match!" 
    }

	if (contactForm.human.value != 5) {
		humanIsCorrect=false;
	contactForm.human.style.background = 'yellow';
}
if(contactForm.human.value == 5){
	humanIsCorrect=true;
	contactForm.human.style.background = 'white';

}

if(userIsCorrect==true && emailIsCorrect==true && passIsCorrect==true && humanIsCorrect==true)
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

      <table align="center" style="width:50%">  
    <tr>
   <td><h2>Welcome to Register</h2></td>
  
   </tr>


	<form id="contactForm" class="form-horizontal" role="form" method="post" action="/Project/Register/registeruser.php" onSubmit="return validate();">
	<?php
		if (isset($_GET["userRole"])) 
		   {
			  if ($_GET["userRole"]==2)
				 echo "<tr><td><div class='alert alert-info' role='alert'>
					<strong>Heads up!</strong>Please Register Supplier Account Below
				</div></td></tr>";
		   } 
	?>		   
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
    <label for="email">Email</label>
    <input type="text" class="form-control" name="email" placeholder="Email" onkeyup="validate(); onclick=validate(); return false;">
    <span id="emailValidation" class="emailValidation"></span>
  </div>
  </td>
  <td>
  <td>
  </tr>
		
<tr>
	<td>
		<div id="loginInfo"class="form-group">
			<label for="title">Title</label>
			<select id="title" class="form-control" name="title" placeholder="Title"  onkeyup="validate();  onclick=validate(); return false;">
				<option>Mr</option>
				<option>Mrs</option>
				<option>Ms</option>
				<option>Miss</option>
			</select>
			<span id="titleValidation" class="titleValidation"></span>
		</div>
	</td>
</tr>

<tr>
	<td>
		<div id="loginInfo"class="form-group">
			<label for="firstName">First Name</label>
			<input type="text" class="form-control" name="firstName" placeholder="First Name" onkeyup="validate(); onclick=validate(); return false;">
			<span id="usernameValidation" class="usernameValidation"></span>
		</div>
	</td>
</tr>

<tr>
	<td>
		<div id="loginInfo"class="form-group">
			<label for="lastName">Last Name</label>
			<input type="text" class="form-control" name="lastName" placeholder="Last Name" onkeyup="validate(); onclick=validate(); return false;">
			<span id="usernameValidation" class="usernameValidation"></span>
		</div>
	</td>
</tr>

<tr>
	<td>
		<div id="loginInfo"class="form-group">
			<label for="address">Address</label>
			<input type="text" class="form-control" name="address" placeholder="Address" onkeyup="validate(); onclick=validate(); return false;">
			<span id="usernameValidation" class="usernameValidation"></span>
		</div>
	</td>
</tr>

<tr>
	<td>
		<div id="loginInfo"class="form-group">
			<label for="town">Town</label>
			<input type="text" class="form-control" name="town" placeholder="Town" onkeyup="validate(); onclick=validate(); return false;">
			<span id="usernameValidation" class="usernameValidation"></span>
		</div>
	</td>
</tr>

<tr>
	<td>
		<div id="loginInfo"class="form-group">
			<label for="postcode">Postcode</label>
			<input type="text" class="form-control" name="postcode" placeholder="Postcode" onkeyup="validate(); onclick=validate(); return false;">
			<span id="usernameValidation" class="usernameValidation"></span>
		</div>
	</td>
</tr>

<tr>
	<td>
		<div id="loginInfo"class="form-group">
			<label for="county">County</label>
			<select id="county" class="form-control" name="county" placeholder="County"  onkeyup="validate();  onclick=validate(); return false;">
				<option>Antrim</option>
				<option>Armagh</option>
				<option>Down</option>
				<option>Fermanagh</option>
				<option>Londonderry</option>
				<option>Tyrone</option>
			</select>
			<span id="titleValidation" class="titleValidation"></span>
		</div>
	</td>
</tr>

<tr>
	<td>
		<div id="loginInfo"class="form-group">
			<label for="phone">Phone</label>
			<input type="text" class="form-control" name="phone" placeholder="Contact Number" onkeyup="validate(); onclick=validate(); return false;">
			<span id="usernameValidation" class="usernameValidation"></span>
		</div>
	</td>
</tr>



<tr>
	<td>
		<div id="loginInfo"class="form-group">
			<label for="exampleInputEmail1">Password</label>
			<input type="password" class="form-control" name="password" placeholder="Password" onkeyup="validate();  onclick=validate(); return false;">
			<span id="passwordValidation" class="passwordValidation"></span>
		</div>
	</td>
</tr>

  
		<tr>
  <td>
  <div id="loginInfo"class="form-group">
    <label for="password2">Confirm Password</label>
    <input type="password" class="form-control" name="password2" placeholder="Confirm Password" onkeyup="validate(); onclick=validate(); return false;">
    <span id="confirmMessage" class="confirmMessage"></span>
  </div>
  </td>
  <td>
  </td>
  </tr>
  
  <tr>
	<td>
		<div id="loginInfo"class="form-group">
			<label for="user_Role">User Role</label>
			<select id="user_Role" class="form-control" name="user_Role" placeholder="User Role"  onkeyup="validate();  onclick=validate(); return false;">
				<?php $dbQuery1=$db->prepare("select * from user_roles");
				$dbQuery1->execute();
				while ($dbRow = $dbQuery1->fetch(PDO::FETCH_ASSOC)) 
				{
					$role_name=$dbRow["role_name"];
					
				echo "<option>$role_name</option>";
				}
				?>
			</select>
			
			
			<span id="titleValidation" class="titleValidation"></span>
		</div>
	</td>
</tr>
		
<tr>
  <td>
  <div id = "loginInfo"class="form-group">
		<span class="glyphicon glyphicon-eye-open"></span>
        <label for="human">2 + 3 = ?</label> 		
            <input type="text" class="form-control" id="human" name="human" placeholder="Answer" onkeyup="validate(); onclick=validate(); return false;">
            <span id="humanValidation" class="humanValidation"></span>
        </div>
  </td>
  <td>
  </td>
  </tr>

  <br>
	 
	 <tr>
	 <td>
	 <div>
	 <p><input type="checkbox" required name="terms"> I accept the <u>Terms and Conditions</u></p>
     <input type="submit" id = "registerButton" value="Register" class="btn btn-primary">
	 </div>
	 </td>
	 </form>
	 </tr>
		</table>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
</body>

</html>

<?php

?>
