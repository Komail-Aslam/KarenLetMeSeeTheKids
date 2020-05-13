<html>
	<head>
		<style>
			<?php include '/xampp/app/views/styles.css'; ?>
		</style>
		<title>Home Page</title>	
	</head>

	<body style="background-color: pink">
		<a href='/Home/Logout'>Logout</a>
		<h1>KarenLetMeSeeTheKids</h1>
		
	<div class="main" style="background-color: lightblue">
		<div class="topnav">
			<a href="/Home/Homepage">Home</a>
			<a href="/Profile/ModifyProfile">Profile</a>
			<a class="active" href="/Message/ViewMessages">Messages</a>
			<a href="/Appointment/viewAppointments">Appointments</a>
			<?php
				if (isset($_SESSION['client_id'])){
					echo "<a href='/Professional/viewProfessionals'>Professionals</a>
						<a href='/Logbook/viewLogbook'>Logbook</a>";
				}
				else
					echo "<a href='/Client/viewClients'>Clients</a>";
			?>
		</div>

		<?php
			echo "<h2 style='padding-top: 50px'>Send to: $data->first_name $data->last_name</h2>";
		?>

		<form action="" method="post">
			Message: <input type="text" name="message"><br><br>
			<input type="submit" name="send_message" value="Send Message">
			<?php
			if (isset($_SESSION['error'])){
				$error = $_SESSION['error'];
				echo "<p>$error</p>";
			}
			?>
		</form>

	</div>
	</body>
</html>
<?php
	unset($_SESSION["error"]);
?>