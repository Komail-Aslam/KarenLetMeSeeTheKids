<html>
<head><title>Login</title>
</head>
<body style="background-color: violet">
	<center><h1>Karen Let Me See The Kids</h1></center>
	<div style="background-color: lightblue"><center>
		
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

		<a href='/Home/Register'>Don't have an account? Register here!</a>
	</div>
</body>

<style type="text/css">
	div {
		padding: 60px 80px;
		width: 400px;
		margin: auto;
		border: 4px solid black;
		position: relative;
		
	}

	h1 {
		font-size:40px;
		padding-top: 100px;
	}

	h2 {
		margin-top: 10px;
	}

	p {
		color: red;
	}
</style>
</html>
<?php
	unset($_SESSION["error"]);
?>