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
					echo "<a class='active' href='/Professional/viewProfessionals'>Professionals</a>
						<a href='/Logbook/viewLogbook'>Logbook</a>";
				}
				else
					echo "<a href='/Client/viewClients'>Clients</a>";
			?>
		</div>
		<form action="" method="post">
			<input style="margin-left: 8px" type="text" name="search_professional" placeholder="Search name or profession..">
			<input class="smallButton" type="submit" name="search" value="Search for Professional">
			<?php
				if (isset($_SESSION['error'])){
					$error = $_SESSION['error'];
					echo "$error";
				}
			?>
			<table>
		<caption class="tableHeader" style="padding-top: 10px">Pending Requests</caption>
		<?php
			if ($data["requests"]!=null){
				foreach ($data["requests"] as $request) {
					$professional = $this->model('Professional');
					$receiver = $professional->getProfessionalProfessionalId($request->receiver_id);
					$profile = $this->model('Profile');
					$receiverProfile = $profile->currentProfileProfileId($receiver->profile_id);
					echo "<tr><td style='width: 40%'>$receiverProfile->first_name $receiverProfile->last_name</td>
							<td><input class='smallButton' type='submit' name='4+$receiverProfile->profile_id' value='View Profile'>
							<input type='submit' class='smallButton' name='5+$request->receiver_id' value='Delete'>";
				}
			}
		?>
	</table>
			<table>
			<caption class="tableHeader">My Professionals</caption>
			<?php
				if ($data["relations"]!=null){
					$professional = $this->model('Professional');
					$profile = $this->model('Profile');
					foreach ($data["relations"] as $relation) {
						$currProfessional = $professional->getProfessionalProfessionalId($relation->professional_id);
						$professionalProfile = $profile->currentProfileProfileId($currProfessional->profile_id);
						// $client = $this->model('Client');
						// $sender = $client->getClientClientId($request->sender_id);
						// $profile = $this->model('Profile');
						// $senderProfile = $profile->currentProfileProfileId($sender->profile_id);
						echo "<tr><td style='width: 40%'>$professionalProfile->first_name $professionalProfile->last_name</td>
								<td><input class='smallButton' type='submit' name='4+$currProfessional->professional_id' value='View Profile'>
								<input class='smallButton' type='submit' name='$currProfessional->professional_id' value='End Interaction'>
								<input class='smallButton' type='submit' name='0+$currProfessional->professional_id' value='Message'>
								<input class='smallButton' type='submit' name='1+$currProfessional->professional_id' value='Write Review'>";
						$request = $this->model('Request');
						$checkRequest = $request->getRequest($_SESSION['client_id'], $relation->professional_id, "appointment");
						if ($checkRequest==null)
							echo "<input class='smallButton' type='submit' name='2+$currProfessional->professional_id' value='Request Appointment'></td></tr>";
						else
							echo "<input class='smallButton' type='submit' name='3+$currProfessional->professional_id' value='Unrequest Appointment'></td></tr>";
					}
				}
			?>
	</table>
	</form>
		</form>
	</div>
	</body>
</html>
<?php
	unset($_SESSION["error"]);
?>