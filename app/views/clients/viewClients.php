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
			<input type="text" name="search_client">
			<input class='smallButton' type="submit" name="search" value="Search for Client">
			<?php
				if (isset($_SESSION['error'])){
					$error = $_SESSION['error'];
					echo "$error";
				}
			?>
		<table style="margin-top: 15px">
		<caption class="tableHeader">Requests</caption>
		<?php
			if ($data["requests"]!=null){
				foreach ($data["requests"] as $request) {
					$client = $this->model('Client');
					$sender = $client->getClientClientId($request->sender_id);
					$profile = $this->model('Profile');
					$senderProfile = $profile->currentProfileProfileId($sender->profile_id);
					echo "<tr><td>$senderProfile->first_name $senderProfile->last_name</td>
							<td><input class='smallButton' type='submit' name='0+$senderProfile->profile_id' value='View Profile'>
							<input class='smallButton' type='submit' name='1+$request->sender_id' value='Accept'>
							<input class='smallButton' type='submit' name='2+$request->sender_id' value='Decline'</td></tr>";
				}
			}
		?>
	</table>
	<table>
		<caption class="tableHeader">Clients</caption>
		<?php
			if (isset($data["relations"])){
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
							<td><input class='smallButton' type='submit' name='$currClient->client_id' value='End Interaction'>
							<input class='smallButton' type='submit' name='0+$currClient->client_id' value='Message'>
							<input class='smallButton' type='submit' name='1+$currClient->client_id' value='Logbook'></td></tr>";
				}
			}
		?>
	</table>
	</form>
	</div>
	</body>
</html>
<?php
	unset($_SESSION['error']);
?>