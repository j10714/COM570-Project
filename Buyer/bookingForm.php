<!doctype html>
<html lang="en">
<?php
		include("../dbConnect.php");
		include("../restrictionCheck.php");
		
		
		//$_SESSION["username"];

		
			
		if(!has_Restriction("contractor:administrator",$userID))
		{
			echo "<script>window.location.href = '/Project/permissionDeniedMessage.php?permission=0'</script>";
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
  <body class="bg-light">
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
              <a class="nav-link" href="/Project/Buyer/bookingForm.php">Booking Form</a>
            </li>
          </ul>
		  <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
				<?php 
					 if (isset($_SESSION["user_id"]))						 
					{
						?>
						<a class="nav-link" href="/Project/Login/loginB.php"><?php echo ?> Account</a>
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
<br><br><br>
<div class="container">
  <h2>Dynamic Tabs</h2>
  <ul class="nav nav-tabs role="tablist">
	
	<li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#tab1">Personal Details</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#tab2">Plot Details</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#tab3">Payment</a>
    </li>
	<li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#tab4">Selections Kitchen</a>
    </li>
	<li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#tab5">Selections Bathroom</a>
    </li>
	<li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#tab6">Other Selections</a>
    </li>
	

  </ul>
  
<form method="post" action="tabTest.php">
  <div class="tab-content">
    <div id="tab1" class="container tab-pane active">
      <h3>Personal Details</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
	  <div class="form-group col-md-6">
				  <label for="inputEmail4">Development Name1</label>
				  <input name="name1" type="text" class="form-control" id="inputEmail4" placeholder="Development Name">
				</div>
		<div class="row">
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Buyer Information</h4>
          <form class="needs-validation" novalidate>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">First name</label>
                <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
                <div class="invalid-feedback">
                  Valid last name is required.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="username">Username</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">@</span>
                </div>
                <input type="text" class="form-control" id="username" placeholder="Username" required>
                <div class="invalid-feedback" style="width: 100%;">
                  Your username is required.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="email">Email <span class="text-muted">(Optional)</span></label>
              <input type="email" class="form-control" id="email" placeholder="you@example.com">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="mb-3">
              <label for="address">Address</label>
              <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>

            <div class="mb-3">
              <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
              <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
            </div>

            <div class="row">
              <div class="col-md-5 mb-3">
                <label for="country">Country</label>
                <select class="custom-select d-block w-100" id="country" required>
                  <option value="">Choose...</option>
                  <option>United States</option>
                </select>
                <div class="invalid-feedback">
                  Please select a valid country.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="state">State</label>
                <select class="custom-select d-block w-100" id="state" required>
                  <option value="">Choose...</option>
                  <option>California</option>
                </select>
                <div class="invalid-feedback">
                  Please provide a valid state.
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" id="zip" placeholder="" required>
                <div class="invalid-feedback">
                  Zip code required.
                </div>
              </div>
            </div>
            <hr class="mb-4">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="same-address">
              <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="save-info">
              <label class="custom-control-label" for="save-info">Save this information for next time</label>
            </div>
            <hr class="mb-4">

            <h4 class="mb-3">Payment</h4>

            <div class="d-block my-3">
              <div class="custom-control custom-radio">
                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                <label class="custom-control-label" for="credit">Credit card</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                <label class="custom-control-label" for="debit">Debit card</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                <label class="custom-control-label" for="paypal">Paypal</label>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="cc-name">Name on card</label>
                <input type="text" class="form-control" id="cc-name" placeholder="" required>
                <small class="text-muted">Full name as displayed on card</small>
                <div class="invalid-feedback">
                  Name on card is required
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="cc-number">Credit card number</label>
                <input type="text" class="form-control" id="cc-number" placeholder="" required>
                <div class="invalid-feedback">
                  Credit card number is required
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">Expiration</label>
                <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                <div class="invalid-feedback">
                  Expiration date required
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">CVV</label>
                <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                <div class="invalid-feedback">
                  Security code required
                </div>
              </div>
            </div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
          </form>
        </div>
      </div>
		
	</div>
    <div id="tab2" class="container tab-pane fade">
      <h3>Plot Details</h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
	  <div class="form-group col-md-6">
				  <label for="inputEmail4">Development Name2</label>
				  <input name="name2" type="text" class="form-control" id="inputEmail4" placeholder="Development Name">
				</div>
    </div>
    <div id="tab3" class="container tab-pane fade">
      <h3>Payment</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
	  <div class="form-group col-md-6">
				  <label for="inputEmail4">Development Name3</label>
				  <input name="name3" type="text" class="form-control" id="inputEmail4" placeholder="Development Name">
				</div>
    </div>
    <div id="tab4" class="container tab-pane fade">
      <h3>Selections Kitchen</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
	  <div class="form-group col-md-6">
				  <label for="inputEmail4">Development Name4</label>
				  <input name="name4" type="text" class="form-control" id="inputEmail4" placeholder="Development Name">
				</div>
		<button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
    <div id="tab5" class="container tab-pane fade">
      <h3>Selections Bathroom</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
	  <div class="form-group col-md-6">
				  <label for="inputEmail4">Development Name4</label>
				  <input name="name4" type="text" class="form-control" id="inputEmail4" placeholder="Development Name">
				</div>
		<button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
    <div id="tab6" class="container tab-pane fade">
      <h3>Selections Bathroom</h3>
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
