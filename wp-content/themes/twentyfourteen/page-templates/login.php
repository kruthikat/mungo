<?php
/**
 * Template Name: Login Page
 */
get_header();
if(isset($_POST['log'])) {
	$username = $_POST['uname'];
	$password = $_POST['pwd'];
	if($username != '' && $password != '') {
		$loginCheck = new UpdateDatabaseOptions('hpusers');
		$validateLogin = $loginCheck->selectValue(array('userid', 'type'), array('userid' => $username, 'password' => $password));
		if(count($validateLogin) != 0) {
			foreach($validateLogin as $login) {
				if($login['userid'] != '' && $login['userid'] == $username) {
					session_regenerate_id(true);
					$_SESSION['userid'] = $login['userid'];
					$_SESSION['usertype'] = $login['type'];
					echo $_SESSION['userid'];
					echo $_SESSION['usertype'];
					if($login['type'] == 1) {
						header('Location:' . get_permalink(27));
					}
					else if($login['type'] == 2) {
						header('Location:' . get_permalink(9));
					}
					else if($login['type'] == 3) {
						header('Location:' . get_permalink(19));
					}
					else {
						echo 'Can\'t redirect as of now';
					}
				}
				else {
					echo 'login failed';
				}
			}
		}
		else {
			echo 'login failed';
		}
	}
}
?>
<form name="login" action="" method="post">
	<label for="uname">Username</label> <input type="text" id="uname"
		name="uname" /> <br /> <label for="password">Password</label> <input
		type="password" id="pwd" name="pwd" /> <br /> <input type="submit"
		value="Log In" name="log" id="log" />
</form>
