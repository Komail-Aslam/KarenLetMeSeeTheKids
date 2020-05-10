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
		<table>
			<caption>Pending Requests</caption>
		<?php
			if ($data["requests"]!=null){
				foreach ($data["requests"] as $request) {
					$client = $this->model('Client');
					$sender = $client->getClientClientId($request->sender_id);
					$profile = $this->model('Profile');
					$senderProfile=$profile->currentProfileProfileId($sender->profile_id);
					echo "<tr><td>$senderProfile->first_name $senderProfile->last_name</td>
							<td><input type='submit' name='0+$sender->profile_id' value='View Profile'>
							<input type='submit' name='2+$request->sender_id' value='Delete'></td></tr>";
				}
			}
		?>
		</table>
		<table>
			<th>Appointments</th>
			<?php
			if ($data["appointments"]!=null){
				foreach ($data["appointments"] as $app) {
					$p = $this->model('Professional');
					$pro = $p->getProfessionalProfessionalId($app->professional_id);
					$profile = $this->model('Profile');
					$proProfile=$profile->currentProfileProfileId($pro->profile_id);
					echo "<tr><td>$proProfile->first_name $proProfile->last_name | $app->appLocation | $app->appDate | $app->appTime</td>
							<td><input type='submit' name='$pro->profile_id' value='View Profile'>
							<input type='submit' name='$app->appointment_id' value='Cancel'></td></tr>";
				}
			}
			?>
		</table>
	</form>
	</div>
	</body>
</html>