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
	
 
