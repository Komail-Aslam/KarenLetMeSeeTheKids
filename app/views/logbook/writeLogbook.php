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
			<a href="/Message/ViewMessages">Messages</a>
			<a href="/Appointment/viewAppointments">Appointments</a>
			<?php
				if (isset($_SESSION['client_id'])){
					echo "<a href='/Professional/viewProfessionals'>Professionals</a>
						<a class='active' href='/Logbook/viewLogbook'>Logbook</a>";
				}
				else
					echo "<a href='/Client/viewClients'>Clients</a>";
			?>
		</div>
		<form class="logbookCreate" action="" method="post">
			<ul>Log Title: <input type="text" name="log_title"></ul>
			<ul>Log Entry: <input type="text" name="log_content"></ul>
			<input style="margin-left: 65%" type="submit" name="writeLog" value="Write Log">
			<?php
			if (isset($_SESSION['error'])){
				$error = $_SESSION['error'];
				echo "<p style='margin-left: 55%'>$error</p>";
			}
			?>
		</form>
	</div>
	</body>
</html>
<?php
	unset($_SESSION['error']);
?>