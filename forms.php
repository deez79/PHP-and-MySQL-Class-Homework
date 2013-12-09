<html>
<head>
	<title>HW Assignement 01 PHP and MySQL Class</title>
	<link rel="stylesheet" href="style/styles.css" type="text/css" /> 
	<script language="javascript" type="text/javascript" src="js/validation.js"></script>

	<?php //This is the php for gathering and submitting data to the DB

	###########################################################
	#
	#	These first 2 includes are to ensure the form is sticky
	#
	#
	#############################################################

	//include needed $_REQUEST calls
	include ('includes/request.php');
	//include php functions
	include ('includes/functions.php');

	###################################################
	#
	#	This IF Statement is going to check it anything was
	#		submitted.  If it was, it will Post to
	#		the DB.  
	#		(currently it only posts the info for the student table)
	#
	#
	###################################################

	//Check for Form Submission:
	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		//creates $dbc inorder to connect to database
		require ('database/mysqli_connect.php'); 

		//using examples from Larry Ullman PHP and MySQL for Dynamic Websites Fourth Edition 
		//	Chapter 9 Script 9.5 as basis for validation:

		$errors = array(); //Initializing error array

		//Check for a firstname:
		if (empty($firstname)){
			$errors[] = 'You forgot to enter a first name.';
		} else{
			$fn = mysqli_real_escape_string($dbc, trim($_POST['firstname']));
		}

		//Check for a lastname:
		if (empty($lastname)){
			$errors[] = 'You forgot to enter a last name.';
		} else{
			$ln = mysqli_real_escape_string($dbc, trim($_POST['lastname']));
		}

		//Check for a middle initial:
		if (empty($initial)){
			$mn = null;
		} else{
			$mn = mysqli_real_escape_string($dbc, trim($_POST['initial']));
		}

		//Check for a street address:
		if (empty($street)){
			$errors[] = 'You forgot to enter a street address.';
		} else{
			$st = mysqli_real_escape_string($dbc, trim($_POST['street']));
		}

		//Check for a city:
		if (empty($city)){
			$errors[] = 'You forgot to enter a city.';
		} else{
			$ct = mysqli_real_escape_string($dbc, trim($_POST['city']));
		}

		//Check for a state:
		if (empty($state)){
			$errors[] = 'You forgot to enter a state.';
		} else{
			$S = mysqli_real_escape_string($dbc, trim($_POST['state']));
		}

		//Check for a zip:
		if (empty($zip)){
			$errors[] = 'You forgot to enter a zipcode.';
		} else{
			$zp = mysqli_real_escape_string($dbc, trim($_POST['zip']));
		}

		//Check for a phone:
		if (empty($phone)){
			$errors[] = 'You forgot to enter a phone number.';
		} else{
			$ph = mysqli_real_escape_string($dbc, trim($_POST['phone']));
		}

		//Check for a major:
		if (empty($major)){
			$errors[] = 'You forgot to enter a major.';
		} else{
			$ma = mysqli_real_escape_string($dbc, trim($_POST['major']));
		}

		//Check for a minor:
			//may want to come back here to make null for blank instead of 'Select &#45 &#45 Minor'
		if (empty($minor)){
			$mi = null;
		} else{
			$mi = mysqli_real_escape_string($dbc, trim($_POST['minor']));
		}

		if (empty($errors)) { //if there are no errors

			//register user into database

			//check for duplicates:
			//create query:
			$qDup = "SELECT user_id FROM student WHERE last_name = '$ln' and first_name = '$fn' and middle_initial = '$mn' and street = '$st' and city = '$ct' and state = '$S' and zip = '$zp' and telephone = '$ph' and major = '$ma' and minor = '$mi' ";
				//echo 'This is the duplicate check query' . $qDup; //DEBUGING PURPOSES

			$rDupCheck = @mysqli_query($dbc, $qDup); //run the query
			//check to see if entry exists
			$num = mysqli_num_rows($rDupCheck); //create $num to see how many times data exist in DB.
			//if statement for how to treat results:
			if($num < 1){ //if there are no records that match the form yet insert into DB

				//create Insert query
				$q = "INSERT INTO student VALUES (null, '$ln', '$fn', '$mn', '$st', '$ct', '$S', '$zp', '$ph', '$ma', '$mi')";
				$r = @mysqli_query($dbc, $q); //run the query
				if ($r) {//If it ran ok
					
					##################################################################################
					#
					# 	Data from form is now submitted into student table.  What follows should 
					#		be an attempt to get and submit data into the stu_interest table.
					#		At this point, I haven't segmented the form into two steps, but that may 
					#		have to happen.
					#
					###################################################################################

					echo 'it worked!' . "\n" . "You have successfully inserted a user into DB" . "\n";

					//session_start data... store it for other pages.  Specifically for the success.php page
					session_start();
					$_SESSION['lastname']   = $_POST['lastname'];
					$_SESSION['firstname']   = $_POST['firstname'];

					//query database for user_id value that was just created
					$uID = "SELECT user_id, last_name, first_name FROM student WHERE first_name = '$fn' and last_name = '$ln' and middle_initial = '$mn' and street = '$st' and city = '$ct' and state = '$S' and zip = '$zp' and telephone = '$ph' ";
					//echo $uID;						//DEBUGING PURPOSES
					$r2 = @mysqli_query($dbc, $uID);
					while($stuUserId = mysqli_fetch_array($r2, MYSQLI_ASSOC)) {
						echo " \n" . 'The student id just entered is: ';
						echo $stuUserId['user_id'] . "\n";

						############################################
						#
						#	Now lets put rest of form data into
						#		stu_interst table
						#
						#
						################################################

	//  _   _  ___________ _____ 
	// | | | ||  ___| ___ \  ___|
	// | |_| || |__ | |_/ / |__  
	// |  _  ||  __||    /|  __| 
	// | | | || |___| |\ \| |___ 
	// \_| |_/\____/\_| \_\____/ 
	                          
						// //Create db values for plan array:
						if(!empty($_POST['plan'][0]) && !empty($_POST['plan'][1])) {
							$day = 1;
							$night = 1;
						} else if(!empty($_POST['plan'][0])) {
							$day = 1;
							if(!empty($_POST['plan'][1])) {
								$night = 1;
							} else {
								$night = 0;
							};
						} else{
							$day = 0;
							$night = 0;
						}

						//Create DB values for info array:
						//first create default values:
						$add = 0;
						$fin = 0;
						$ath = 0;
						$int = 0;
						$see = 0;
						$lib = 0;
						$art = 0;
						$hon = 0;
						$clu = 0;
						$aca = 0;
						$hou = 0;
						$sta = 0;
						$tra = 0;
						$deb = 0;

						//$infoDBvarriables = array('$add', '$fin' , '$ath', '$int', '$see', '$lib', '$art', '$hon', '$clu', '$aca', '$hou', '$sta', '$tra', '$deb');
						$boxValues = array('admissions' => $add, 'aid' => $fin, 'athletics' => $ath, 'interntional' => $int, 'seek' => $see, 'library' => $lib, 'arts' => $art, 'honors' => $hon, 'clubs' => $clu, 'academic' => $aca, 'housing' =>$hou, 'starr' => $sta , 'trading' => $tra, 'debate' => $deb);
						$value = array('admissions', 'aid', 'athletics', 'interntional', 'seek', 'library', 'arts', 'honors', 'clubs', 'academic', 'housing', 'starr', 'trading', 'debate' );
						
						//foreach loop to cycle through info checkboxes
						echo "\n" . 'foreach for checkbox info section' . "\n";
						foreach ($_POST['info'] as $boxName){//cycle through info array to see if any are clicked
							echo 'boxname= ' . $boxName . "\n";
							foreach($boxValues as $name => $on){
								$on = 0;
								echo 'boxName= ' . $boxName . ' and ' . 'name= ' . $name . "\n" . 'on=' . $on . "\n";
								if($boxName == $name){
									echo "it's changing?" ."\n";
									$on = 1;
									echo 'on value now equals= ' . $on . "\n";
								}
							}


							//for ($i=0; $i < 14 ; $i++) {
								// $i = 0; 
								// ($boxName == $value[$i]){
								// echo 'boxName ' . $boxName;
								// echo 'value[' .$i . '] ' . $value[$i];
								// echo 'dbVal' . $dbVal;
								// $dbVal = 1;
								// };
							//};

						};

						//change values if checked
						if(!empty($_POST['info'][0])){
							$add = 1;
						}


						//Check for a comment:
						if (empty($comments)){
							$cm = null;
						} else{
							$cm = mysqli_real_escape_string($dbc, trim($_POST['comments']));
						}

						#################################################################
						#
						# 	Debuging for stu_interest table
						#
						// echo $cm . "\n"; 					//DEBUGGING PURPOSES
						// echo $day . "\n"; 					//DEBUGGING PURPOSES
						// echo $night . "\n"; 					//DEBUGGING PURPOSES
						echo "add" . $add . "\n";						//DEBUGGING PURPOSES
						echo "fin" . $fin . "\n";						//DEBUGGING PURPOSES
						echo "ath" . $ath . "\n";						//DEBUGGING PURPOSES
						echo "int" . $int . "\n";						//DEBUGGING PURPOSES
						echo "see" . $see . "\n";						//DEBUGGING PURPOSES
						echo "lib" . $lib . "\n";						//DEBUGGING PURPOSES
						echo "art" . $art . "\n";						//DEBUGGING PURPOSES
						echo "hon" . $hon . "\n";						//DEBUGGING PURPOSES
						echo "clu" . $clu . "\n";						//DEBUGGING PURPOSES
						echo "aca" . $aca . "\n";						//DEBUGGING PURPOSES
						echo "hou" . $hou . "\n";						//DEBUGGING PURPOSES
						echo "sta" . $sta . "\n";						//DEBUGGING PURPOSES
						echo "tra" . $tra . "\n";						//DEBUGGING PURPOSES
						echo "deb" . $deb . "\n";						//DEBUGGING PURPOSES
						
						#
						#
						#
						#
						##################################################################

					}  //end While $stuUserId = user_id statement 
					
					//go to success.php
					#header('Location: success.php');
					#exit();
				} else { //The Query did not run OK
					echo 'system error';
					echo mysqli_error($dbc) . '\n' . $q; 	//DEBUGING PURPOSES
				} //end of if $r

				mysqli_close($dbc); //Close the DB connection
			} //end of no records match, insert new record
			else{ // if record has already been submitted
					//      _             _            _               _     _         
					//     | |           | |          | |             (_)   | |      _ 
					//  ___| |_ _   _  __| | ___ _ __ | |_    _____  ___ ___| |_ ___(_)
					// / __| __| | | |/ _` |/ _ \ '_ \| __|  / _ \ \/ / / __| __/ __|  
					// \__ \ |_| |_| | (_| |  __/ | | | |_  |  __/>  <| \__ \ |_\__ \_ 
					// |___/\__|\__,_|\__,_|\___|_| |_|\__|  \___/_/\_\_|___/\__|___(_)
				echo "\n" . "student exists!";
				//query database for user_id value that was just created
				$uID = "SELECT user_id, last_name, first_name FROM student WHERE first_name = '$fn' and last_name = '$ln' and middle_initial = '$mn' and street = '$st' and city = '$ct' and state = '$S' and zip = '$zp' and telephone = '$ph' ";
				//echo $uID;								//DEBUGING PURPOSES
				$r2 = @mysqli_query($dbc, $uID);
				while($stuUserId = mysqli_fetch_array($r2, MYSQLI_ASSOC)) {
					echo " \n" . 'The student id just entered is: ';
					echo $stuUserId['user_id'];
				}  //end While statement
			} //end else of if record has already been submitted

		}else {// if there are errors, report the errors
			echo 'Something is wrong!' . "\n";
			echo '<script language="javascript" type="text/javascript">window.onload = function(){validateform();}; </script>';
			echo 'These are the errors:';
			foreach ($errors as $msg) {
				echo "- $msg";   

			} //end foreach
			echo "\n" . 'Try again!';
		} //end of if(empty($errors)) IF.
		mysql_close($dbc); //close the connection to the DB
	}  //end of the main submit conditional

	?>
</head>

<body>
	<div id="container">

		<h1>Homework  01</h1>
		<p style="font-style: italic; font-size: 0.7em"><span>&#42 fields marked with red asterisk are required</span></p>
		<form action="forms.php" method="post" name="testform" id="testform">
	 
<?php
##############################
#
#
#	______            _             _             _            _     _        _     _      
#	| ___ \          (_)           | |           | |          | |   | |      | |   | |     
#	| |_/ / ___  __ _ _ _ __    ___| |_ _   _  __| | ___ _ __ | |_  | |_ __ _| |__ | | ___ 
#	| ___ \/ _ \/ _` | | '_ \  / __| __| | | |/ _` |/ _ \ '_ \| __| | __/ _` | '_ \| |/ _ \
#	| |_/ /  __/ (_| | | | | | \__ \ |_| |_| | (_| |  __/ | | | |_  | || (_| | |_) | |  __/
#	\____/ \___|\__, |_|_| |_| |___/\__|\__,_|\__,_|\___|_| |_|\__|  \__\__,_|_.__/|_|\___|
#	             __/ |                                                                     
#	            |___/                                                                      
#
#	Begin student table
#
?>

		<fieldset> <!-- Start Info Request Form Fieldset Box-->
			<legend>Information Request Form</legend>
			<div id="left_top_box">
				<p><label for="lastname">Last Name:<span> &#42 </span></label></p>
				<p><label for="firstname">First Name:<span> &#42 </span></label></p>
			</div> <!--end left_top_box -->
			<div id="center_left_top_box">
				<p><input type="text" name="lastname" tabindex="1" value="<?php echo $lastname; ?>" /></p>
				<p><input type="text" name="firstname" tabindex="10" value="<?php echo $firstname; ?>" /></p>
			</div> <!--end center_left_top_box -->
			<div id="center_right_top_box">
				<p> &nbsp </p>
				<p><label for="initial">Middle Initial:</label></p>
			</div> <!--end center_right_top_box -->
			<div id="right_top_box">
				<p> &nbsp </p>
				<p><input type="text" name="initial" value="<?php echo $initial; ?>" tabindex="20" /></p>
			</div> <!--end right_top_box -->
			<div id="under_top_box">
				<p>
				<label for="street">Street Address:<span> &#42 </span><input type="text" name="street" tabindex="30" size="70" value="<?php echo $street; ?>" /></label>
				</p>
			</div> <!--end under_top_box -->
			<div id="left_center_box">
				<p><label for="city">City:<span> &#42 </span></label></p>
				<p><label for="state">State:<span> &#42 </span></label></p>
				<p><label for="phone">Telephone:<span> &#42 </span></label></p>
				<p><label for="major">Proposed Major:</label></p>
			</div> <!--end left_center_box -->
			<div id="center_l_box">
				<p><input type="text" name="city" tabindex="40" value="<?php echo $city; ?>" /></p>
				<p><input type="text" name="state" tabindex="50" value="<?php echo $state; ?>" /></p>
				<p><input type="text" name="phone" tabindex="70" value="<?php echo $phone; ?>" /></p>
					<p>
					<select name="major" tabindex="80">
						<option >Select &#45 &#45 Major</option>
						<optgroup label="Anthropology">
							<option value="ANT" <?php dropdownSelected("major", "ANT") ?> >Anthropology</option>
							<option value="GEO" <?php dropdownSelected("major", "GEO") ?> >Geography</option>
							<option value="SOC" <?php dropdownSelected("major", "SOC") ?> >Sociology</option>
						</optgroup>
						<optgroup label="Economics">
							<option value="ECO" <?php dropdownSelected("major", "ECO") ?> >Economics</option>
							<option value="FIN" <?php dropdownSelected("major", "FIN") ?> >Finance</option>
							<option value="INS" <?php dropdownSelected("major", "INS") ?> >Insurance</option>
						</optgroup>
						<optgroup label="English">
							<option value="AAS" <?php dropdownSelected("major", "AAS") ?> >Asian/American Studies</option>
							<option value="ENG" <?php dropdownSelected("major", "ENG") ?> >English</option>
							<option value="FLM" <?php dropdownSelected("major", "FLM") ?> >Film</option>
						</optgroup>
					</select>
					</p>
			</div> <!--end center_l_box -->
			<div id="center_r_box">
				<p> &nbsp </p>
				<p><label for="zip">Zip Code:<span> &#42 </span> </label></p>
				<p> &nbsp </p>
				<p><label for="minor">Proposed Minor:</label></p>
			</div> <!--end center_r_box -->
			<div id="right_center_box">
				<p> &nbsp </p>
				<p><input type="text" name="zip" tabindex="60" value="<?php echo $zip; ?>" /></label></p>
				<p> &nbsp </p>
					<p> 
						<select name="minor" tabindex="90">
							<option selected="<?php echo $minor; ?>">Select &#45 &#45 Minor</option>
							<optgroup label="Anthropology">
							<option value="ANT" <?php dropdownSelected("minor", "ANT") ?> >Anthropology</option>
							<option value="GEO" <?php dropdownSelected("minor", "GEO") ?> >Geography</option>
							<option value="SOC" <?php dropdownSelected("minor", "SOC") ?> >Sociology</option>
						</optgroup>
						<optgroup label="Economics">
							<option value="ECO" <?php dropdownSelected("minor", "ECO") ?> >Economics</option>
							<option value="FIN" <?php dropdownSelected("minor", "FIN") ?> >Finance</option>
							<option value="INS" <?php dropdownSelected("minor", "INS") ?> >Insurance</option>
						</optgroup>
						<optgroup label="English">
							<option value="AAS" <?php dropdownSelected("minor", "AAS") ?> >Asian/American Studies</option>
							<option value="ENG" <?php dropdownSelected("minor", "ENG") ?> >English</option>
							<option value="FLM" <?php dropdownSelected("minor", "FLM") ?> >Film</option>
						</optgroup>
						</select>
					</p>
			</div> <!--end right_center_box -->
<?php 
#	                _          __       _             _            _     _        _     _      _ 
#	               | |        / _|     | |           | |          | |   | |      | |   | |    | |
#	  ___ _ __   __| |   ___ | |_   ___| |_ _   _  __| | ___ _ __ | |_  | |_ __ _| |__ | | ___| |
#	 / _ \ '_ \ / _` |  / _ \|  _| / __| __| | | |/ _` |/ _ \ '_ \| __| | __/ _` | '_ \| |/ _ \ |
#	|  __/ | | | (_| | | (_) | |   \__ \ |_| |_| | (_| |  __/ | | | |_  | || (_| | |_) | |  __/_|
#	 \___|_| |_|\__,_|  \___/|_|   |___/\__|\__,_|\__,_|\___|_| |_|\__|  \__\__,_|_.__/|_|\___(_)
#	                                                                                             
#	end of student table!		                                                                                             
#
#########################################

#########################################
#
#	 _                _       _                      __       _           _       _                     _     _        _     _        
#	| |              (_)     (_)                    / _|     | |         (_)     | |                   | |   | |      | |   | |     _ 
#	| |__   ___  __ _ _ _ __  _ _ __   __ _    ___ | |_   ___| |_ _   _   _ _ __ | |_ ___ _ __ ___  ___| |_  | |_ __ _| |__ | | ___(_)
#	| '_ \ / _ \/ _` | | '_ \| | '_ \ / _` |  / _ \|  _| / __| __| | | | | | '_ \| __/ _ \ '__/ _ \/ __| __| | __/ _` | '_ \| |/ _ \  
#	| |_) |  __/ (_| | | | | | | | | | (_| | | (_) | |   \__ \ |_| |_| | | | | | | ||  __/ | |  __/\__ \ |_  | || (_| | |_) | |  __/_ 
#	|_.__/ \___|\__, |_|_| |_|_|_| |_|\__, |  \___/|_|   |___/\__|\__,_| |_|_| |_|\__\___|_|  \___||___/\__|  \__\__,_|_.__/|_|\___(_)
#	             __/ |                 __/ |                         ______                                                           
#	            |___/                 |___/                         |______|                                                          
#
#	begin of stu_interest table:
#
?>

			<div id="upper_bottom_box">
				<fieldset> <!--start My Plan fieldset box-->
					<p><legend>My Plan</legend></p>
					<fieldset> <!--start attend classes fieldset box-->
						<legend id="spaceit">I intend to attend classes:</legend>
						<label>Mostly in the day <input type="checkbox" name="plan[]" value="day" tabindex="100" <?php checkedBoxFunc("plan", "day"); ?> /></label>
						 &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp 
						<label>Mostly in the evening<input type="checkbox" name="plan[]" value="evening" <?php checkedBoxFunc("plan", "evening"); ?> /></label>
					</fieldset> <!--end attend classes fieldset box-->
					<fieldset> <!--start register fieldset box-->
					   <legend>I intend to register for:</legend>
						<p>
						<label>
							<select name="number" tabindex="110" value="<?php echo $number; ?>">
								<option value="one" <?php dropdownSelected("number", "one") ?> >1</option>
								<option value="two" <?php dropdownSelected("number", "two") ?> >2</option>
								<option value="three" <?php dropdownSelected("number", "three") ?> >3</option>
								<option value="four" <?php dropdownSelected("number", "four") ?> >4</option>
							</select>
							&nbsp course&#40s&#41 per semester
						</label>
						</p>
				   </fieldset> <!--End register fieldset box-->
	</p><!--
								 _    _ _           _     _       _   _     _           __   ___  
								| |  | | |         | |   (_)     | | | |   (_)         / /  |__ \ 
								| |  | | |__   __ _| |_   _ ___  | |_| |__  _ ___     / / __   ) |
								| |/\| | '_ \ / _` | __| | / __| | __| '_ \| / __|   / / '_ \ / / 
								\  /\  / | | | (_| | |_  | \__ \ | |_| | | | \__ \  / /| |_) |_|  
								 \/  \/|_| |_|\__,_|\__| |_|___/  \__|_| |_|_|___/ /_/ | .__/(_)  
								                                                       | |        
								                                                       |_|        -->

				</fieldset> <!--end My Plan fieldset box-->

			</fieldset> <!--End Info Request Form Fieldset Box-->

			<fieldset> <!--Start Request More Info Fieldset Box-->
				<legend>Request More Information</legend>
				<p>I would like information on the following areas:</p>
					<div id="left_bottom_box">
						<p> &nbsp <label>Admissions<input type="checkbox" name="info[]" value="admissions" tabindex="120" <?php checkedBoxFunc("info", "admissions"); ?> /></label></p>
						<p> &nbsp <label>Financial Aid & Scholarships<input type="checkbox" name="info[]" value="aid" <?php checkedBoxFunc("info", "aid"); ?> /></label></p>
						<p> &nbsp <label>Athletics<input type="checkbox" name="info[]" value="athletics" <?php checkedBoxFunc("info", "athletics"); ?> /></label></p>
						<p> &nbsp <label>International Student Services Center<input type="checkbox" name="info[]" value="interntional" <?php checkedBoxFunc("info", "interntional"); ?> /></label></p>
						<p> &nbsp <label>SEEK Educational Opportunity Program<input type="checkbox" name="info[]" value="seek" <?php checkedBoxFunc("info", "seek"); ?> /></label></p>
						<p> &nbsp <label>William and Anita Newman Library<input type="checkbox" name="info[]" value="library" <?php checkedBoxFunc("info", "library"); ?> /></label></p>
						<p> &nbsp <label>Baruch Performing Arts Center <input type="checkbox" name="info[]" value="arts" <?php checkedBoxFunc("info", "arts"); ?> /></label></p>
					</div> <!--End left_bottom_box-->

					<div id="right_bottom_box">
						<p><label>Honors Program<input type="checkbox" name="info[]" value="honors" <?php checkedBoxFunc("info", "honors"); ?> /></label></p>
						<p><label>Clubs and Organizations<input type="checkbox" name="info[]" value="clubs" <?php checkedBoxFunc("info", "clubs"); ?> /></label></p>
						<p><label>Academic Advisement<input type="checkbox" name="info[]" value="academic" <?php checkedBoxFunc("info", "academic"); ?> /></label></p>
						<p><label>Housing<input type="checkbox" name="info[]" value="housing" <?php checkedBoxFunc("info", "housing"); ?> /></label></p>
						<p><label>STARR Career Development Center<input type="checkbox" name="info[]" value="starr" <?php checkedBoxFunc("info", "starr"); ?> /></label></p>
						<p><label>Wasserman Trading Floor/Subotnick Financial Services Center<input type="checkbox" name="info[]" value="trading" <?php checkedBoxFunc("info", "trading"); ?> /></label></p>
						<p><label>Debate Team<input type="checkbox" name="info[]" value="debate" <?php checkedBoxFunc("info", "debate"); ?> /></label></p>
					</div> <!--End right_bottom_box-->

			</fieldset> <!--End Request More Info Fieldset Box-->
	</p><!--
								 _    _ _           _     _       _   _     _           __   ___  
								| |  | | |         | |   (_)     | | | |   (_)         / /  |__ \ 
								| |  | | |__   __ _| |_   _ ___  | |_| |__  _ ___     / / __   ) |
								| |/\| | '_ \ / _` | __| | / __| | __| '_ \| / __|   / / '_ \ / / 
								\  /\  / | | | (_| | |_  | \__ \ | |_| | | | \__ \  / /| |_) |_|  
								 \/  \/|_| |_|\__,_|\__| |_|___/  \__|_| |_|_|___/ /_/ | .__/(_)  
								                                                       | |        
								                                                       |_|        -->
			<fieldset> <!--Start Other Info Fieldset Box-->
				<legend>Other Information</legend>
				<p>
					<label>Comments:<br />
						<textarea name="comments" rows="5" cols="74" tabindex="130" ><?php echo $comments; ?></textarea>
					</label>
				</p>
			</fieldset> <!--End Other Info Fieldset Box-->
	</p> <!--
								 _    _ _           _     _       _   _     _           __   ___  
								| |  | | |         | |   (_)     | | | |   (_)         / /  |__ \ 
								| |  | | |__   __ _| |_   _ ___  | |_| |__  _ ___     / / __   ) |
								| |/\| | '_ \ / _` | __| | / __| | __| '_ \| / __|   / / '_ \ / / 
								\  /\  / | | | (_| | |_  | \__ \ | |_| | | | \__ \  / /| |_) |_|  
								 \/  \/|_| |_|\__,_|\__| |_|___/  \__|_| |_|_|___/ /_/ | .__/(_)  
								                                                       | |        
								                                                       |_|        -->
			<p id="notation">
			Please check the information you keyed in and press <br />
			&#34Submit&#34 when you are done or &#34Reset&#34 the information <br />
			<input type="submit" value="submit" /> <input type="reset" />
			</p>

			</div> <!--End upper_bottom_box-->
		</form>  <!--end ALL FORM-->
	</div> <!-- End of Container div-->
</body>
</html>
