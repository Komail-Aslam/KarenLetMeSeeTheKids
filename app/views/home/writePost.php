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
			<a class="active" href="/Home/Homepage">Home</a>
			<a href="/Profile/ModifyProfile">Profile</a>
			<a href="/Message/ViewMessages">Messages</a>
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

		<form action="" method="post" style="padding-top: 25px">
			<h2> Enter the question below:</h2> <input type="text" name="post_content" placeholder="Enter Question.." style="width: 260px"><br><br>
			<input class="b1" type="submit" name="post" value="Post">
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