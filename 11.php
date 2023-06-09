<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Login</title>
</head>

<body>
	<div class="login-page">
		<div>
			<?php
			session_start();

			// Check if the user is already logged in
			if (isset($_SESSION['userName'])) {
				// Redirect to the home page or any other authorized page
				header("Location: index.php");
				exit();
			}

			// Display a message for non-logged-in users
			echo "<p>You must be logged in to access the admin page.</p>";
			?>
		</div>

		<div class="form">
			<h1>Log In</h1>
			<form action="processLogin.php" method="post" name="login">
				<input type="text" name="userName" placeholder="Username" required />
				<input type="password" name="password" placeholder="Password" required />
				<input name="submit" type="submit" value="Login" />
			</form>
		</div>
		<p> <a href="index.php">Return to Home</a></p>


	</div>

</body>

</html>