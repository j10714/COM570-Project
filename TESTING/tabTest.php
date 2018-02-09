<!DOCTYPE html>
<html lang="en">
<?php
		include("../dbConnect.php");
		include("../restrictionCheck.php");
		
		
		//$_SESSION["username"];

		
		
		if(!has_Restriction("contractor:administrator",$userID))
		{
			echo "<script>window.location.href = '/Project/permissionDeniedMessage.php?permission=0'</script>";
		}
		
			if (isset($_POST["submit"])) {
				
				//fields from form to add to Database
				$name1=$_POST["name1"];
				$name2=$_POST["name2"];
				$name3=$_POST["name3"];
				$name4=$_POST["name4"];
				
				$dbQuery=$db->prepare("insert into test values(null,:name1,:name2,:name3,:name4)");
				$dbParams=array('name1'=>$name1, 'name2'=>$name2, 'name3'=>$name3, 'name4'=>$name4);
				//yellow is database field organge = form posting
				$dbQuery->execute($dbParams);
				
				//header("Location: index.php");
				echo "<script>window.location.href ='/Project/index.php'</script>";
			}
	?>
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Dynamic Tabs</h2>
  <ul class="nav nav-tabs role="tablist">
	
	<li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu1">Menu 1</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu2">Menu 2</a>
    </li>
	<li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu3">Menu 2</a>
    </li>

  </ul>
  
<form method="post" action="tabTest.php">
  <div class="tab-content">
    <div id="home" class="container tab-pane active">
      <h3>HOME</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
	  <div class="form-group col-md-6">
				  <label for="inputEmail4">Development Name1</label>
				  <input name="name1" type="text" class="form-control" id="inputEmail4" placeholder="Development Name">
				</div>
		
	</div>
    <div id="menu1" class="container tab-pane fade">
      <h3>Menu 1</h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
	  <div class="form-group col-md-6">
				  <label for="inputEmail4">Development Name2</label>
				  <input name="name2" type="text" class="form-control" id="inputEmail4" placeholder="Development Name">
				</div>
    </div>
    <div id="menu2" class="container tab-pane fade">
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
	  <div class="form-group col-md-6">
				  <label for="inputEmail4">Development Name3</label>
				  <input name="name3" type="text" class="form-control" id="inputEmail4" placeholder="Development Name">
				</div>
    </div>
    <div id="menu3" class="container tab-pane fade">
      <h3>Menu 3</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
	  <div class="form-group col-md-6">
				  <label for="inputEmail4">Development Name4</label>
				  <input name="name4" type="text" class="form-control" id="inputEmail4" placeholder="Development Name">
				</div>
		<button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
	<hr>
    <p class="act"><b>Active Tab</b>: <span></span></p>
    <p class="prev"><b>Previous Tab</b>: <span></span></p>
  </div>
  </form>
</div>

</body>
</html>
