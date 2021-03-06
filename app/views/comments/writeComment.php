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
			<a class="active" href="/Home/Homepage">Home</a>
			<a href="/Profile/ModifyProfile">Profile</a>
			<a href="/Message/ViewMessages">Messages</a>
			<a href="/Appointment/viewAppointments">Appointments</a>
			<?php
				if (isset($_SESSION['client_id'])){
					echo "<a href='/Professional/viewProfessionals'>Professionals</a>
						<a href='/Logbook/viewLogbook'>Logbook</a>";
				}
				else
					echo "<a href='/Client/viewClients'>Clients</a>";
			?>
		</div>

		<?php
			$client = $this->model('Client');
			$poster = $client->getClientClientId($data->client_id);
			$profile = $this->model('Profile');
			$poster = $profile->currentProfileProfileId($poster->profile_id);

			echo "<h2>Poster: $poster->first_name $poster->last_name</h2><h2>Post: $data->post_content</h2>";
		?>

		<form action="" method="post">
			Comment: <input type="text" name="comment"><br><br>
			<input class="b1" type="submit" name="write_comment" value="Post Comment">
			<?php
				if (isset($_SESSION['error'])){
					$error = $_SESSION['error'];
					echo "<p>$error</p>";
				}
			?>
		</form>

	</div>
	</body>
</html>
<?php
	unset($_SESSION["error"]);
?>