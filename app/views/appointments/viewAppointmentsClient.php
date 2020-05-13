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
						<a href='/Logbook/viewLogbook'>Logbook</a>";
				}
				else
					echo "<a href='/Client/viewClients'>Clients</a>";
			?>
		</div>
		<form action="" method="post">
		<table>
			<caption class="tableHeader">Pending Requests</caption>
		<?php
			if ($data["requests"]!=null){
				foreach ($data["requests"] as $request) {
					$pro = $this->model('Professional');
					$receiver = $pro->getProfessionalProfessionalId($request->receiver_id);
					$profile = $this->model('Profile');
					$senderProfile=$profile->currentProfileProfileId($receiver->profile_id);
					echo "<tr><td style='width: 70%'>$senderProfile->first_name $senderProfile->last_name</td>
							<td><input class='smallButton' class='smallButton' type='submit' name='0+$receiver->profile_id' value='View Profile'>
							<input class='smallButton' type='submit' name='2+$request->sender_id' value='Delete'></td></tr>";
				}
			}
		?>
		</table>
		<table>
			<caption class="tableHeader">Appointments</caption>
			<?php
			if ($data["appointments"]!=null){
				foreach ($data["appointments"] as $app) {
					$p = $this->model('Professional');
					$pro = $p->getProfessionalProfessionalId($app->professional_id);
					$profile = $this->model('Profile');
					$proProfile=$profile->currentProfileProfileId($pro->profile_id);
					echo "<tr><td style='width: 70%'>$proProfile->first_name $proProfile->last_name | $app->appLocation | $app->appDate | $app->appTime</td>
							<td><input class='smallButton' type='submit' name='$pro->profile_id' value='View Profile'>
							<input class='smallButton' type='submit' name='$app->appointment_id' value='Cancel'></td></tr>";
				}
			}
			?>
		</table>
	</form>
	</div>
	</body>
</html>