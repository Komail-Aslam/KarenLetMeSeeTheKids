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
			<input type="text" name="search_professional">
			<input type="submit" name="search" value="Search for Professional">
			<?php
				if (isset($_SESSION['error'])){
					$error = $_SESSION['error'];
					echo "$error";
				}
			?>
			<table>
			<th>Professionals</th>
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
						echo "<tr><td>$professionalProfile->first_name $professionalProfile->last_name</td>
								<td><input type='submit' name='4+$currProfessional->professional_id' value='View Profile'>
								<input type='submit' name='$currProfessional->professional_id' value='End Interaction'>
								<input type='submit' name='0+$currProfessional->professional_id' value='Message'>
								<input type='submit' name='1+$currProfessional->professional_id' value='Write Review'>";
						$request = $this->model('Request');
						$checkRequest = $request->getRequest($_SESSION['client_id'], $relation->professional_id, "appointment");
						if ($checkRequest==null)
							echo "<input type='submit' name='2+$currProfessional->professional_id' value='Request Appointment'></td></tr>";
						else
							echo "<input type='submit' name='3+$currProfessional->professional_id' value='Unrequest Appointment'></td></tr>";
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