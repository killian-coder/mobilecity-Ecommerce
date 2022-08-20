 <?php
	require_once $_SERVER['DOCUMENT_ROOT'] . '/mobilecity-Ecommerce/core/init.php';
	if (!is_logged_in()) {
		login_error_redirect();
	}
	include 'includes/head.php';

	$hashed = $user_data['password'];
	$old_password = ((isset($_POST['old_password'])) ? sanitize($_POST['old_password']) : '');
	$old_password = trim($old_password);
	$password = ((isset($_POST['password'])) ? sanitize($_POST['password']) : '');
	$password = trim($password);
	$comfirm = ((isset($_POST['comfirm'])) ? sanitize($_POST['comfirm']) : '');
	$comfirm = trim($comfirm);
	$new_hashed = password_hash($password, PASSWORD_DEFAULT);
	$user_id = $user_data['id'];
	$errors = array();
	?>

 <div id="login-form">
 	<div>

 		<?php
			if ($_POST) {
				//Form Validation
				if (empty($_POST['old_password']) || empty($_POST['password']) || empty($_POST['comfirm'])) {
					$errors[] = ' All  fields must be not be left blank.';
				}

				// password is more than 6 characters
				if (strlen($password) < 6) {
					$errors[] = 'Password must be atleast 6 characters.';
				}
				// Check if new password match the comfirm
				if ($password != $comfirm) {
					$errors[] = 'New password doesnt match.';
				}
				if (!password_verify($old_password, $hashed)) {
					$errors[] = 'Your old password Doesnot match with our records.';
				}

				// Check for errors 
				if (!empty($errors)) {
					echo  display_errors($errors);
				} else {
					// change password
					$db->query("UPDATE users SET password = '$new_hashed' WHERE id ='$user_id'");
					$_SESSION['pwd'] = 'Your password has been updated!.';
					header('Location: index.php');
				}
			}

			?>
 	</div>
 	<h2 class="text-center">Change password</h2>
 	<hr>
 	<form action="change_password.php" method="post">
 		<div class="form-group">
 			<label for="old_password">Old password:</label>
 			<input type="password" name="old_password" id="old_password" class="form-control" value="<?= $old_password; ?>">
 		</div>
 		<div class="form-group">
 			<label for="password">New Password:</label>
 			<input type="password" name="password" id="password" class="form-control" value="<?= $password; ?>">
 		</div>

 		<div class="form-group">
 			<label for="comfirm">Comfirm New Password:</label>
 			<input type="password" name="comfirm" id="comfirm" class="form-control" value="<?= $comfirm; ?>">
 		</div>
 		<div class="form-group">
 			<a href="index.php" class="btn btn-default">cancel</a>
 			<input type="submit" value="Login" class="btn btn-primary">
 		</div>
 	</form>
 	<p class="text-right"><a href="/mobilecity-Ecommerce/index.php" alt="home">Vist Site</a></p>
 </div>
 <?php include 'includes/footer.php'; ?>