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
						<a class='active' href='/Logbook/viewLogbook'>Logbook</a>";
				}
				else
					echo "<a class='active' href='/Client/viewClients'>Clients</a>";
			?>
		</div>
		<form method="post" action="">
			<?php
				if (isset($_SESSION["client_id"])){
					echo "<input class='b1' type='submit' name='writeLogbook' value='Write New Entry'>";
				}
			?>
			<table>
				<th>Title</th>
				<th>Entry</th>
			<?php
				foreach($data["logbook"] as $log){
				echo "<tr><td style='width: 30%'>$log->log_title</td><td>$log->log_content</td></tr>";
			}
			?>
			</table>
		</form>
	</div>
	</body>
</html>