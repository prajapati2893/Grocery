<?php
include('admin/inc/inc.php'); 
require_once "functions.php";

	if (isset($_GET['email']) && isset($_GET['token'])) {
		

		$email = $conn->real_escape_string($_GET['email']);
		$token = $conn->real_escape_string($_GET['token']);

		$sql = $conn->query("SELECT user_id FROM tbl_user WHERE
			user_email='$email' AND token='$token' AND token<>'' AND token_expire > NOW()
		");

		if ($sql->num_rows > 0) {
			$newPassword = generateNewString();
			$newPasswordEncrypted = password_hash($newPassword, PASSWORD_BCRYPT);
			$conn->query("UPDATE tbl_user SET token='', password = '$newPasswordEncrypted'
				WHERE user_email='$email'
			");

			echo "Your New Password Is $newPassword<br><a href='http://localhost/grocery/login.php'>Click Here To Log In</a>";
		} else
			redirectToLoginPage();
	} else {
		redirectToLoginPage();
	}
?>
