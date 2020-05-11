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
					echo "<a href='/Client/viewClients'>Clients</a>";
			?>
		</div>
		<form action="" method="post">
		<?php
			$profile = $this->model('Profile');
			$pro = $profile->currentProfileProfileId($data);
			echo "Review for: $pro->first_name $pro->last_name<br>";
		?>
		Enter the review below:<br><input type="text" name="reviewContent">
		<input type="submit" name="writeReview" value="Write Review">
		<?php
			if (isset($_SESSION['error'])){
				$error = $_SESSION['error'];
				echo "<p>$error</p>";
			}
		?>
	</div>
	</body>
</html>
<?php
	unset($_SESSION['error'])
?>