<?php 
	// you have to open the session first 
	
	
	//removes all the variables in the session 
	session_unset(); 
	
	// destroy the session 
	session_destroy();  
	
	//back to Login
	//header("Location: /Project/Login/login.php");
	echo "<script>window.location.href ='/Project/Login/index.php'</script>";
?> 