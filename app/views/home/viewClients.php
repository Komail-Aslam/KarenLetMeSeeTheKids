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
						<a href='/Home/ModifyProfile'>Logbook</a>";
				}
				else
					echo "<a class='active' href='/Client/viewClients'>Clients</a>";
			?>
		</div>

		<form action="" method="post">
			<input type="text" name="search_client">
			<input type="submit" name="search" value="Search for Client">
		<table>
		<th>Requests</th>
		<?php
			if ($data["requests"]!=null){
				foreach ($data["requests"] as $request) {
					$client = $this->model('Client');
					$sender = $client->getClientClientId($request->sender_id);
					$profile = $this->model('Profile');
					$senderProfile = $profile->currentProfileProfileId($sender->profile_id);
					echo "<tr><td>$senderProfile->first_name $senderProfile->last_name</td>
							<td><input type='submit' name='0+$senderProfile->profile_id' value='View Profile'>
							<input type='submit' name='1+$request->sender_id' value='Accept'>
							<input type='submit' name='2+$request->sender_id' value='Decline'</td></tr>";
				}
			}
		?>
	</table>
	<table>
		<th>Clients</th>
		<?php
			if ($data["relations"]!=null){
				$client = $this->model('Client');
				$profile = $this->model('Profile');
				foreach ($data["relations"] as $relation) {
					$currClient = $client->getClientClientId($relation->client_id);
					$clientProfile = $profile->currentProfileProfileId($currClient->profile_id);
					// $client = $this->model('Client');
					// $sender = $client->getClientClientId($request->sender_id);
					// $profile = $this->model('Profile');
					// $senderProfile = $profile->currentProfileProfileId($sender->profile_id);
					echo "<tr><td>$clientProfile->first_name $clientProfile->last_name</td>
							<td><input type='submit' name='$currClient->client_id' value='End Interaction'>
							<input type='submit' name='0+$currClient->client_id' value='Message'></td></tr>";
				}
			}
		?>
	</table>
	</form>
	</div>
	</body>
</html>