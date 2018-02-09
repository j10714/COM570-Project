<?php
    session_start();
	include("dbConnect.php");	
?>
<!doctype html>
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

	<!-- boostrap JS code-->

	<!-- Custom styles for this template -->
	<link href="/Project/CSS/index.css" rel="stylesheet">
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
            <li class="nav-item active">
              <a class="nav-link" href="/Project/index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/Project/Contractors/Developments/index.php">Developments</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/Project/Contractors/HouseTypes/index.php">House Types</a>
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
      <div class="album py-5 bg-light">
        <div class="container">
          <div class="row">
		  
            <div class="col-md-6">
              <div class="card mb-4 box-shadow">
			  <div class="card-body">
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                      <button type="button" class="btn btn-sm btn-outline-secondary">View Plots</button>
					  <button type="button" class="btn btn-sm btn-outline-secondary">View Brochure</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Enquire</button>
					  <button type="button" class="btn btn-sm btn-outline-secondary">Map</button>
                </div>
                <img class src="/Project/images/5312237.jpg" width = 100% alt="Smiley face">
                <div class="card-body">
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                      <button type="button" class="btn btn-sm btn-outline-secondary">View Plots</button>
					  <button type="button" class="btn btn-sm btn-outline-secondary">View Brochure</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Enquire</button>
					  <button type="button" class="btn btn-sm btn-outline-secondary">Map</button>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card mb-4 box-shadow">
                <img class src="/Project/images/5312237.jpg" width = 100% alt="Smiley face">
                <div class="card-body">
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                      <button type="button" class="btn btn-sm btn-outline-secondary">View Plots</button>
					  <button type="button" class="btn btn-sm btn-outline-secondary">View Brochure</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Enquire</button>
					  <button type="button" class="btn btn-sm btn-outline-secondary">Map</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>      

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../../../../dist/js/bootstrap.min.js"></script>
    <script src="../../../../assets/js/vendor/holder.min.js"></script>
  </body>
</html>
