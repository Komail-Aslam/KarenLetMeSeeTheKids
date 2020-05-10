<html>
	<head>
		<style>
			<?php include '/xampp/app/views/styles.css'; ?>
		</style>
		<title>Welcome Page</title>	
	</head>

	<body style="background-color: violet">
		<a href='/Home/Logout'>Logout</a>
		<center><h1>Welcome To KarenLetMeSeeTheKids</h1></center>
	<div class="login" style="background-color: lightblue">
		<center><h2>Please enter the following details to create your profile.</h2>
		<form action="" method="post">
			<ul>First Name: <input type="text" name="first_name"></ul>
			<ul>Last Name: <input type="text" name="last_name"></ul>
			<ul>Email: <input type="text" name="email"></ul>
			<ul>City: <input type="text" name="city"></ul>
			<ul>Country: <input type="text" name="country"></ul>
			<label style="margin-left: 20px">Type of profile: </label><br>
			 Client: <input type="radio" name="clientOrProfessional" value="client" style="margin-right: 35px">
			 Professional: <input type="radio" name="clientOrProfessional" value="professional">
			<br /><br>
			<input type="submit" name="action" value="Proceed">
			<?php 
				if (isset($_SESSION["error"])){
					$error = $_SESSION["error"];
					echo "<p>$error</p>";
				}
			?>
		</form>
	</center>
	</div>
	</body>
</html>

<style type="text/css">
	ul {
		text-align: right;
		margin-right: auto;
		width: 70%;
	}
</style>
<?php
	unset($_SESSION["error"]);
?>