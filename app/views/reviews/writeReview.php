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
		<?php
			$profile = $this->model('Profile');
			$pro = $profile->currentProfileProfileId($data);
			echo "<h2>Review for: $pro->first_name $pro->last_name</h2>";
		?>
		Enter the review below:<br><textarea type="text" cols="50" rows="10" name="reviewContent" style="resize: none;" placeholder="Enter review content here..."></textarea><br><br>
		<input class="b1" type="submit" name="writeReview" value="Write Review">
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