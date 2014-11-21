<?php
/**
 * Template Name: Registration
 */
get_header();
/* Only if a patient is logged in, the following content will be displayed */
$profile = new UpdateDatabaseOptions('hpusers');
$patients = new UpdateDatabaseOptions('patients');
if(isset($_POST['rpsubmit'])) {
	$error = 0;
	$username = mysql_real_escape_string($_POST['runame']);
	$name = mysql_real_escape_string($_POST['rpname']);
	$contact = mysql_real_escape_string($_POST['rcontact']);
	$address = mysql_real_escape_string($_POST['raddress']);
	$email = mysql_real_escape_string($_POST['remail']);
	$age = mysql_real_escape_string($_POST['rage']);
	$gender = mysql_real_escape_string($_POST['rgender']);
	$password = mysql_real_escape_string($_POST['rpnpwd']);
	echo $age . ' ';
	echo $gender;
	if($name != '' && $contact != '' && $address != '' && $email != '' && $gender != '' && $age != '') {
		if(!$profile->insertRow(
			array('userid' => $username, 'password' => $password, 'name' => $name,
									'contact' => $contact, 
									'addr' => $address, 
									'emailid' => $email, 'type' => 2),
			array('%s', '%s', '%s', '%d', '%s', '%s', '%d')))
			$error++;
		if(!$patients->updateRow(
			array('age' => $age, 'gender' => $gender),
			array('userid' => $username),
			array('%d', '%d'),
			array('%s')))
			$error++;
	}
	else {
		echo "'Name', 'Contact Number', 'Address', 'Email ID', 'Age' and 'Gender' cannot be left blank";
	}
	if($error != 0) {
		echo 'Sorry! Please try again.';
	}
	else {
		echo 'Registration done! Please continue to login';
	}
}
?>
<h1>Register here</h1>
<form name="patientRegister" action="" method="post">
	<p>
		<label for="runame">User Name *</label> <input type="text" name="runame"
			id="runame" />
	</p>
	<p>Enter Password</p>
	<p>
		<label for="rpnpwd">Password *</label> <input type="password"
			name="rpnpwd" id="rpnpwd" />
	</p>
	<p>
		<label for="rpcnpwd">Confirm Password *</label> <input type="password"
			name="rpcnpwd" id="rpcnpwd" />
	</p>
	<p>Details:</p>
	<p>
		<label for="rpname">Name *</label> <input type="text" name="rpname"
			id="rpname" />
	</p>
	<p>
		<label for="rcontact">Contact Number *</label> <input type="text"
			name="rcontact" id="rcontact" />
	</p>
	<p>
		<label for="raddress">Address *</label> <input type="text"
			name="raddress" />
	</p>
	<p>
		<label for="remail">Email ID *</label> <input type="text" name="remail" />
	</p>
	<p>
		<label for="rage">Age *</label> <input type="text" name="rage" id="rage" />
	</p>
	<p>
		<label for="rgender">Gender *</label> <input type="radio" name="rgender"
			value="1" id="rfemale" /> Female <input type="radio" name="rgender"
			value="0" id="rmale" /> Male
	</p>
	<p>
		<input type="submit" name="rpsubmit" id="rpsubmit" value="Register" />
	</p>
</form>
