<?php

// set up connection parameters
$dbHost 		= 'db703195889.db.1and1.com';
$databaseName 	= 'db703195889';
$username 		= 'dbo703195889';
$password 		= 'M1lk123!!!';

// make the database connection
$db = new PDO("mysql:host=$dbHost;dbname=$databaseName;charset=utf8", "$username", "$password");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 	// enable error handling
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 			// turn off emulation mode

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

//echo "Connected successfully";

?>