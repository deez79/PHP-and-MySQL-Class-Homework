<html>
<head>

<title>HW Assignement 01 PHP and MySQL Class</title>
<link rel="stylesheet" href="style/styles.css" type="text/css" /> 
<script language="javascript" type="text/javascript" src="js/validation.js"></script>

<?php
//include needed $_REQUEST calls
include ('includes/request.php');
//include php functions
include ('includes/functions.php');

//Check for Form Submission:
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	//test to see if required input is satisfied. (some validation)  If yes, go to success.php
	if( !empty($lastname) && !empty($firstname) && !empty($street) && !empty($city) && !empty($state) && !empty($zip) && !empty($phone)) {//if valid:

		//session_start data... store it for other pages.  Specifically for the success.php page
		session_start();
		$_SESSION['lastname']   = $_POST['lastname'];
		$_SESSION['firstname']   = $_POST['firstname'];

		//go to success.php
		header('Location: success.php');
		exit;
	} else {
		echo '<script language="javascript" type="text/javascript">window.onload = function(){validateform();}; </script>';
	}

}
?>

</head>


<body>
<div id="container">


<h1>Homework  01</h1>
<p style="font-style: italic; font-size: 0.7em"><span>&#42 fields marked with red asterisk are required</span></p>
<form action="forms.php" method="post" name="testform" id="testform">
 

<fieldset>
<legend>Information Request Form</legend>

<div id="left_top_box">
	<p><label for="lastname">Last Name:<span> &#42 </span></label></p>
	<p><label for="firstname">First Name:<span> &#42 </span></label></p>
</div>

<div id="center_left_top_box">
	<p><input type="text" name="lastname" tabindex="1" value="<?php echo $lastname; ?>" /></p>
	<p><input type="text" name="firstname" tabindex="10" value="<?php echo $firstname; ?>" /></p>
</div>

<div id="center_right_top_box">
	<p> &nbsp </p>
	<p><label for="initial">Middle Initial:</label></p>
</div>

<div id="right_top_box">
	<p> &nbsp </p>
	<p><input type="text" name="initial" value="<?php echo $initial; ?>" tabindex="20" /></p>
</div>

<div id="under_top_box">
	<p>
	<label for="street">Street Address:<span> &#42 </span><input type="text" name="street" tabindex="30" size="70" value="<?php echo $street; ?>" /></label>
	</p>
</div>

<div id="left_center_box">
	<p><label for="city">City:<span> &#42 </span></label></p>
	<p><label for="state">State:<span> &#42 </span></label></p>
	<p><label for="phone">Telephone:<span> &#42 </span></label></p>
	<p><label for="major">Proposed Major:</label></p>
</div>

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
</div>

<div id="center_r_box">
	<p> &nbsp </p>
	<p><label for="zip">Zip Code:<span> &#42 </span> </label></p>
	<p> &nbsp </p>
	<p><label for="minor">Proposed Minor:</label></p>
</div>

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
</div>

<div id="upper_bottom_box">
<fieldset>
	<p><legend>My Plan</legend></p>
		<fieldset>
		<legend id="spaceit">I intend to attend classes:</legend>
		<label>Mostly in the day <input type="checkbox" name="plan[]" value="day" tabindex="100" <?php checkedBoxFunc("plan", "day"); ?> /></label>
		 &nbsp  &nbsp  &nbsp  &nbsp  &nbsp  &nbsp 
		<label>Mostly in the evening<input type="checkbox" name="plan[]" value="evening" <?php checkedBoxFunc("plan", "evening"); ?> /></label>
		</fieldset>
	<fieldset>
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
	
   </fieldset>
</p>

</fieldset>

</fieldset>

<fieldset>
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
</div>

<div id="right_bottom_box">
<p><label>Honors Program<input type="checkbox" name="info[]" value="honors" <?php checkedBoxFunc("info", "honors"); ?> /></label></p>
<p><label>Clubs and Organizations<input type="checkbox" name="info[]" value="clubs" <?php checkedBoxFunc("info", "clubs"); ?> /></label></p>
<p><label>Academic Advisement<input type="checkbox" name="info[]" value="academic" <?php checkedBoxFunc("info", "academic"); ?> /></label></p>
<p><label>Housing<input type="checkbox" name="info[]" value="housing" <?php checkedBoxFunc("info", "housing"); ?> /></label></p>
<p><label>STARR Career Development Center<input type="checkbox" name="info[]" value="starr" <?php checkedBoxFunc("info", "starr"); ?> /></label></p>
<p><label>Wasserman Trading Floor/Subotnick Financial Services Center<input type="checkbox" name="info[]" value="trading" <?php checkedBoxFunc("info", "trading"); ?> /></label></p>
<p><label>Debate Team<input type="checkbox" name="info[]" value="debate" <?php checkedBoxFunc("info", "debate"); ?> /></label></p>
</div>

</fieldset>
</p>

<fieldset>
<legend>Other Information</legend>
<p>
<label>Comments:<br />
<textarea name="comments" rows="5" cols="74" tabindex="130" ><?php echo $comments; ?></textarea>
</label>
</p>
</fieldset>
</p>

<p id="notation">
Please check the information you keyed in and press <br />
&#34Submit&#34 when you are done or &#34Reset&#34 the information <br />
<input type="submit" value="submit" /> <input type="reset" />

</p>


</div>

</form>

</div>
</body>

</html>
