<?php #functions to be used with making special input types sticky


function checkedBoxFunc($inputName, $value){
	/**************************************
	*	$inputName is the string name for the checkbox input
	*	ex: <input type="checkbox" name="foo" value="bar" <?php checkedBoxFunc("plan", "day"); ?> />
	*
	***************************************/
	foreach ($_REQUEST[$inputName] as $inputValues){
		if ($inputValues == $value){
			echo checked;
		};
	};
}

function dropdownSelected($dropdownName, $value){ //dropdowns selected will stay selected on submit 
	/*********************************
	*	$dropdownName is string name of the name of the select function is working within
	*	ex: <select name="foo"> 
	*			<option value="bar" <?php dropdownSelected("foo","bar"); ?> >
	**********************************/
	if ($_REQUEST[$dropdownName] == $value){ 
		echo 'selected="selected"';
	};
}


function valid($var){
	if(!isset($var)){
		echo '<p class="error"> You must enter ' . $var . "!";
	};
}



?>