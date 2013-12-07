<?php 
	
	/*
	//saved variable names for log on at caps:
	DEFINE ('DB_USER', 'root');
	DEFINE ('DB_PASSWORD', 'capsroot');
	DEFINE ('DB_HOST', 'localhost');
	DEFINE ('DB_NAME', 'college');
	*/

	
	//saved variable names for log on at home:
	DEFINE ('DB_USER', 'collegeApp');
	DEFINE ('DB_PASSWORD', 'p4ssw0rd');
	DEFINE ('DB_HOST', 'localhost');
	DEFINE ('DB_NAME', 'college');
	
	
	// mysql_connect format:
	//mysql_connect("hostname", "user", "password", "database");
	
	// Connects to your Database 
	$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error( ) );
	
	// Set the encoding...
	mysqli_set_charset($dbc, 'utf8');
	
 
######################################################
#
#	Everything after here is for testing
#	none of this will make it past one commit
#
######################################################



//select databse
//		$dataBaseName = mysql_select_db($dbc, 'college');

//create variable for select query 
//		$data = mysqli_query($dbc, "SELECT * FROM student") or die(mysql_error()); 

/*
//test connection:
 	$info = mysql_fetch_array( $data );
 	echo $info;
 	echo "this is something";

*/


//from class example.  not needed.  
/*
 Print "<table border cellpadding=3>"; 
 while($info = mysql_fetch_array( $data )) 
 { 
 Print "<tr>"; 
 Print "<th>Name:</th> <td>".$info['first_name'] . ' ' . $info['last_name'] . "</td> "; 
 Print "<th> Telephone:</th> <td>".$info['telephone'] . " </td></tr>"; 
 } 
 Print "</table>";
 */
 
 ?>
