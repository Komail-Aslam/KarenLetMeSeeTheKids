<html>
	<head>
		<style>
			<?php include '/xampp/app/views/styles.css'; ?>
		</style>
		<title>Messages</title>	
	</head>

	<body style="background-color: violet">
		<a href='/Home/Logout'>Logout</a>
		<h1>KarenLetMeSeeTheKids</h1>
		
	<div class="main" style="background-color: lightblue">
		<div class="topnav">
			<a href="/Home/Homepage">Home</a>
			<a href="/Profile/ModifyProfile">Profile</a>
			<a class="active" href="/Message/ViewMessages">Messages</a>
			<a href="/Appointment/viewAppointments">Appointments</a>
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
			<input class="b1" type="submit" name="create" value="Compose New Message">
		</form>
		<table>
			<th>From</th>
			<th>Message</th>
				<?php
				foreach($data["messages"] as $messages){
					$profile = $this->model('Profile');
					$sender = $profile->currentProfile($messages[2]);
					echo "<tr><td style='width: 20%'>$sender->first_name $sender->last_name</td>
					<td>$messages[1]</td></tr>";
				}
				?>
			
		</table> 
		
	</div>
	</body>
</html>