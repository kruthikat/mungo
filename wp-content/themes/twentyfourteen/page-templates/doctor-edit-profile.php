<?php
/**
 * Template Name: Doctor Edit Profile
 */
get_header();
/* Only if a doctor is logged in, the following content will be displayed */
if(isset($_SESSION['userid'])) {
	$profile = new UpdateDatabaseOptions('hpusers');
	$doctors = new UpdateDatabaseOptions('doctors');
	if(isset($_POST['dsubmit'])) {
		$error = 0;
		$name = mysql_real_escape_string($_POST['dname']);
		$contact = mysql_real_escape_string($_POST['contact']);
		$address = mysql_real_escape_string($_POST['address']);
		$email = mysql_real_escape_string($_POST['email']);
		$qualification = mysql_real_escape_string($_POST['qualification']);
		$experience = mysql_real_escape_string($_POST['experience']);
		$newPassword = mysql_real_escape_string($_POST['dnpwd']);
		if($name != '' && $contact != '' && $address != '' && $email != '' && $gender != '' && $age != '') {
			if(!$profile->updateRow(
							array('name' => $name,
									'contact' => $contact, 
									'addr' => $address, 
									'emailid' => $email), 
							array('userid' => $_SESSION['userid']),
							array('%s', '%d', '%s', '%s'),
							array('%s')))
				$error++;
			if(!$doctors->updateRow(
								array('qualification' => $qualification,
									'experience' => $experience),
								array('userid' => $_SESSION['userid']),
								array('%s', '%f'),
								array('%s')))
				$error++;
		}
		else {
			echo "'Name', 'Contact Number', 'Address', 'Email ID', 'Age' and 'Gender' cannot be left blank";
		}
		if($newPassword != '') {
			if(!$profile->updateRow(
							array('password' => $newPassword), 
							array('userid' => $_SESSION['userid']),
							array('%s'),
							array('%s')))
				$error++;
		}
		if($error != 0) {
			echo 'Sorry! Please try again.';
		}
		else {
			echo 'Changes successfully saved.';
		}
	}
	$profileDetails = $profile->selectValue(array('name', 'contact', 'addr', 'emailid'), array('userid' => $_SESSION['userid']));
	$doctorDetails = $doctors->selectValue(array('qualification', 'experience'), array('userid' => $_SESSION['userid']));
	?>
<h1>Edit Profile</h1>
<form name="patientEditProfile" action="" method="post">
	<p>
		<label for="pname">Name</label> <input type="text" name="pname"
			id="pname" value="<?php echo $profileDetails[0]['name'];?>" />
	</p>
	<p>
		<label for="contact">Contact Number</label> <input type="text"
			name="contact" id="contact"
			value="<?php echo $profileDetails[0]['contact'];?>" />
	</p>
	<p>
		<label for="address">Address</label> <input type="text" name="address"
			id="address" value="<?php echo $profileDetails[0]['addr'];?>" />
	</p>
	<p>
		<label for="email">Email ID</label> <input type="text" name="email"
			id="email" value="<?php echo $profileDetails[0]['emailid'];?>" />
	</p>
	<p>
		<label for="qualification">Qualification</label> <input type="text" name="qualification" id="qualification"
			value="<?php echo $doctorDetails[0]['qualification'];?>" />
	</p>
	<p>
		<label for="experience">Experience</label> <input type="text" name="experience" id="experience"
			value="<?php echo $doctorDetails[0]['experience'];?>" />
	</p>
	<p>Change Password</p>
	<p>
		<label for="dopwd">Old Password</label> <input type="password"
			name="dopwd" id="dopwd" />
	</p>
	<p>
		<label for="dnpwd">New Password</label> <input type="password"
			name="dnpwd" id="dnpwd" />
	</p>
	<p>
		<label for="dcnpwd">Confirm New Password</label> <input
			type="password" name="dcnpwd" id="dcnpwd" />
	</p>
	<p>
		<input type="submit" name="dsubmit" id="dsubmit" value="Save Changes" />
	</p>
</form>
<?php }?>