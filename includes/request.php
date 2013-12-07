<?php #$_REQUEST needed for forms.php

//First required fields
if(!empty($_REQUEST['lastname'])){
	$lastname = $_REQUEST['lastname'];
} else {
	$lastname = null;
}

if(!empty($_REQUEST['firstname'])){
	$firstname = $_REQUEST['firstname'];
} else{
	$firstname = null;
}

if(!empty($_REQUEST['street'])){
	$street = $_REQUEST['street'];
} else{
	$street = null;
}

if(!empty($_REQUEST['city'])){
	$city = $_REQUEST['city'];
} else{
	$city = null;
}

if(!empty($_REQUEST['state'])){
	$state = $_REQUEST['state'];
} else{
	$state = null;
}

if(!empty($_REQUEST['phone'])){
	$phone = $_REQUEST['phone'];
} else{
	$phone = null;
}

if(!empty($_REQUEST['zip'])){
	$zip = $_REQUEST['zip'];
} else{
	$zip = null;
}



$initial = $_REQUEST['initial'];
$major = $_REQUEST['major'];
$minor = $_REQUEST['minor'];
$number = $_REQUEST['number'];
$comments = $_REQUEST['comments'];


//make plan an array
$plan[] = $_REQUEST['plan'];
    
//make info an array
$info[] = $_REQUEST['info'];




?>