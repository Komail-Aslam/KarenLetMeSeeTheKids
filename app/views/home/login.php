<html>
<head>
	<style>
		<?php include '/xampp/app/views/styles.css'; ?>
	</style>
	<title>Login</title>
</head>
<body style="background-color: violet">
	<center><h1>Karen Let Me See The Kids</h1></center>
	<div class='login' style="background-color: lightblue"><center>
		
		<h2><b><u>Login</u></b></h2>
		<form action='' method="post">
			Username: <input type='text' name='username' /><br /> <br />
			Password: <input type='password' name='password' /><br /><br />
			<input type="submit" name="action" value="Login"><br />
			<?php 
				if (isset($_SESSION["error"])){
					$error = $_SESSION["error"];
					echo "<p>$error</p>";
				}
			?>
		</form>

		<a class ='login' href='/Home/Register'>Don't have an account? Register here!</a>
	</div>
</body>

<?php
	unset($_SESSION["error"]);
?>