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
		<table>
			<th>Requests</th>
		<?php
			if ($data["requests"]!=null){
				foreach ($data["requests"] as $request) {
					$client = $this->model('Client');
					$sender = $client->getClientClientId($request->sender_id);
					$profile = $this->model('Profile');
					$senderProfile=$profile->currentProfileProfileId($sender->profile_id);
					echo "<tr><td>$senderProfile->first_name $senderProfile->last_name</td>
							<td><input type='submit' name='0+$sender->profile_id' value='View Profile'>
							<input type='submit' name='1+$request->sender_id' value='Accept'>
							<input type='submit' name='2+$request->sender_id' value='Decline'></td></tr>";
				}
			}
		?>
		</table>
		<table>
			<th>Appointments</th>
			<?php
			if ($data["appointments"]!=null){
				foreach ($data["appointments"] as $app) {
					$c = $this->model('Client');
					$client = $c->getClientClientId($app->client_id);
					$profile = $this->model('Profile');
					$clientProfile=$profile->currentProfileProfileId($client->profile_id);
					echo "<tr><td>$clientProfile->first_name $clientProfile->last_name | $app->appLocation | $app->appDate | $app->appTime</td>
							<td><input type='submit' name='3+$client->profile_id' value='View Profile'>
							<input type='submit' name='$app->appointment_id' value='Modify'>
							<input type='submit' name='1+$app->appointment_id' value='Cancel'></td></tr>";
				}
			}
			?>
		</table>
	</form>
	</div>
	</body>
</html>