<html>
<head>
	<style>
		<?php include '/xampp/app/views/styles.css'; ?>
	</style>
	<title>Register</title>
</head>
<body style="background-color: pink">
	<center><h1>Karen Let Me See The Kids</h1></center>
	<div class="login" style="background-color: lightblue"><center>
		<h2><b><u>Register</u></b></h2>
		<form action='' method="post">
			<ul>Username: <input type='text' name='username' /></ul>
			<ul>Password: <input type='password' name='password' /></ul>
			<ul>Confirm Password: <input type='password' name='password_confirmation' /></ul><br />
			<input type="submit" name="action" value="Register">
		</form>

		<a href='/Home/Login'>Already have an account? Login here!</a>
	</div>
</body>
</html>
<style type="text/css">
	a {
		margin-right: 45px;
		font-size: 20px;
	}
</style>