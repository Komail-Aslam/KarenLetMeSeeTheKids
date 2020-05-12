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
		<table style="padding-top: 30px;">
		<?php
			$client = $this->model('client');
			$currentClient = $client->getClient($data->profile_id);
			echo "<tr><td>Name: </td><td>$data->first_name $data->last_name</td></tr>
					<tr><td>Email: </td><td>$data->email</td></tr>
					<tr><td>Location: </td><td>$data->city, $data->country</td></tr>
					<tr><td>Seeking Profession: </td><td>$currentClient->professional_type</td></tr>";
		?>
		</table>
	</div>
	</body>
</html>