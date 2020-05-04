<html>
	<head>
		<title>Client Profile Page</title>	
	</head>

	<body style="background-color: violet">
		<center><h1>Welcome To KarenLetMeSeeTheKids</h1></center>
	<div style="background-color: lightblue">

		<?php 
		echo "<center><h2>Welcome $data->first_name, please answer the following question to finish creating your profile.</h2>";
			//echo var_dump();
			//echo "<tr><td>$profile->first_name</td><td>$profile->last_name</td></tr>";
			
		?>

		<form action="" method="post">
			What type of professional are you looking for? <br> 
			Psychologist: <input type="radio" name="professional_type" value="psychologist">
			Psychiatrist: <input type="radio" name="professional_type" value="psychiatrist">
			Child Therapist: <input type="radio" name="professional_type" value="child_therapist">

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
		width: 80%;
	}
</style>
<?php
	unset($_SESSION["error"]);
?>