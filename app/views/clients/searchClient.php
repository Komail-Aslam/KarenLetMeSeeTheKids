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
						<a href='/Logbook/viewLogbook'>Logbook</a>";
				}
				else
					echo "<a class='active' href='/Client/viewClients'>Clients</a>";
			?>
		</div>
		<form action="" method="post">
		<table>
			<th>Client Name:</th>
			<th>Looking For:</th>
		<?php
			if ($data!=null){
				if (isset($data['profiles'])){
					foreach ($data["profiles"] as $profile) {
						$client = $this->model('Client');
						$currClient = $client->getClient($profile->profile_id);
						if ($currClient != null){
							echo "<tr><td>$profile->first_name $profile->last_name</td>
										<td>$currClient->professional_type</td>
										<td><input class='smallButton' type='submit' name='$profile->profile_id' value='View Profile'></td></tr>";
						}
					}
				}
				else {
					foreach ($data["clients"] as $client) {
						$profile = $this->model('Profile');
						$currProfile = $profile->currentProfileProfileId($client->profile_id);
						if ($currProfile != null){
							echo "<tr><td>$currProfile->first_name $currProfile->last_name</td>
										<td>$client->professional_type</td>
										<td><input type='submit' name='$currProfile->profile_id' value='View Profile'></td></tr>";
						}
					}
				}
			}
		?>
		</table>
		</form>
	</div>
	</body>
</html>