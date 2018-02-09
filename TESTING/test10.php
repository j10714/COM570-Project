
<!DOCTYPE html>
<html>
<body>

<?php
function valid_URL($filename) {
	
	include("dbConnect.php");
	
	if (file_exists($filename)) {
    return true;
} else {
    return false;
}
}
?>

</body>
</html>