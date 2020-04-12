<html>
	<head>
		<title>Client Profile Page</title>	
	</head>

	<body style="background-color: violet">
		<center><h1>Welcome To KarenLetMeSeeTheKids</h1></center>
	<div style="background-color: lightblue">

		<?php 
				
			echo "<tr><td>$profile->first_name</td><td>$profile->last_name</td></tr>";
			
		?>

		<center><h2>Welcome enter the following details to create your profile.</h2>
		<form action="" method="post">
			<ul>First Name: <input type="text" name="first_name"></ul>
			<ul>Last Name: <input type="text" name="last_name"></ul>

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
	div {
		padding: 60px 80px;
		width: 400px;
		margin: auto;
		border: 4px solid black;
		position: relative;
		
	}
	h1 {
		font-size:40px;
		padding-top: 30px;
	}

	h2 {
		margin-top: 10px;
	}
	p {
		color: red;
	}
	ul {
		text-align: right;
		margin-right: auto;
		width: 70%;
	}
</style>
<?php
	unset($_SESSION["error"]);
?>