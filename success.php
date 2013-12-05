<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Success</title>
		<link rel="stylesheet" href="styles.css" type="text/css" /> 
		<?php
		//include "request.php"; #nolonger needed
		
		//use $_SESSION to receive passed variables from form
		session_start();
		$firstname   = $_SESSION['firstname'];
		$lastname   = $_SESSION['lastname'];
		?>

	</head>
	<body>
		<?php
		echo "<p>Thank you " . $firstname . $lastname . "for sucessfully submitting your form. </p>";
		?>
				
	</body>

</html>
