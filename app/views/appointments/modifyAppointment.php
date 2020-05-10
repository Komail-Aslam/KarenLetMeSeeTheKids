<html>
	<head>
		<style>
		<?php include '/xampp/app/views/styles.css'; ?>
		</style>
		<title>Appointments Page</title>	
	</head>

	<body style="background-color: pink">
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
			<?php
				$client = $this->model('Client');
				$thisClient = $client->getClientClientId($data->client_id);
				$profile = $this->model('Profile');
				$clientProfile=$profile->currentProfileProfileId($thisClient->profile_id);
			echo "<ul>Appointment With: $clientProfile->first_name $clientProfile->last_name</ul>
			<ul>Location: <input type='text' name='appLocation' value='$data->appLocation'></ul>
			<ul>Date: <input type='date' name='appDate' value='$data->appDate'></ul>
			<ul>Time: <input type='time' name='appTime' step='60' value='$data->appTime'></ul>
			<ul><input type='submit' name='modifyAppointment' value='Modify Appointment'></ul>";
			?>
		</form>
	</div>
	</body>
</html>