// this function is called by the onSubmit method in the form

<!--
function validateform()
{
	var error = "";

if(document.testform.lastname.value == "")
   {
	error = error + "Please enter your last name\n";
   }

if(document.testform.firstname.value == "")
   {
	error = error + "Please enter your first name\n";
   }
   
if(document.testform.street.value == "")
   {
	error = error + "Please enter your street address\n";
   }
   
if(document.testform.city.value == "")
   {
	error = error + "Please enter the city where you live\n";
   }
   
if(document.testform.state.value == "")
   {
	error = error + "Please enter the state where you live\n";
   }

if(document.testform.zip.value == "")
   {
	error = error + "Please enter your zip\n";
   }
   
if(document.testform.phone.value == "")
   {
	error = error + "Please enter your telephone number\n";
   }
   
if(error == "")
   {
	return true;
   } 
else 
   {
	alert(error);
	return false;
   }
}
// -->