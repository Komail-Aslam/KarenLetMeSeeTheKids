<html>
	<head>
		<style>
		<?php include '/xampp/app/views/styles.css'; ?>
		</style>
		<title>Client Profile Page</title>	
	</head>

	<body style="background-color: pink">
		<center><h1>Welcome To KarenLetMeSeeTheKids</h1></center>
	<div class="login" style="background-color: lightblue">

		<?php 
		echo "<center><h2>Welcome $data->first_name, please answer the following question to finish creating your profile.</h2>";
			
		?>

		<form action="" method="post">
			What type of professional are you looking for? <br> 
			Psychologist: <input type="radio" name="professional_type" value="Psychologist">
			Psychiatrist: <input type="radio" name="professional_type" value="Psychiatrist">
			Child Therapist: <input type="radio" name="professional_type" value="Child Therapist">

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
<?php
	unset($_SESSION["error"]);
?>