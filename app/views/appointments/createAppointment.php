<html>
	<head>
		<style>
		<?php include '/xampp/app/views/styles.css'; ?>
		</style>
		<title>Appointments Page</title>	
	</head>

	<body style="background-color: violet">
		<a href='/Home/Logout'>Logout</a>
		<h1>KarenLetMeSeeTheKids</h1>
		
	<div class="main" style="background-color: lightblue">
		<div class="topnav">
			<a href="/Home/Homepage">Home</a>
			<a href="/Profile/ModifyProfile">Profile</a>
			<a href="/Message/ViewMessages">Messages</a>
			<a class="active" href="/Appointment/viewAppointments">Appointments</a>
			<?php
				if (isset($_SESSION['client_id'])){
					echo "<a href='/Professional/viewProfessionals'>Professionals</a>
						<a href='/Home/ModifyProfile'>Logbook</a>";
				}
				else
					echo "<a href='/Client/viewClients'>Clients</a>";
			?>
		</div>
		<form action="" method="post">
			<ul>Appointment With: <?php echo "$data->first_name $data->last_name";?></ul>
			<ul>Location: <input type="text" name="appLocation"></ul>
			<ul>Date: <input type="date" name="appDate"></ul>
			<ul>Time: <input type="time" name="appTime" step="60" value="22:00"></ul>
			<ul><input type="submit" name="createAppointment" value="Create Appointment"></ul>
		</form>
	</div>
	</body>
</html>