<html>
	<head>
		<style>
			<?php include '/xampp/app/views/styles.css'; ?>
		</style>
		<title>Home Page</title>	
	</head>

	<body style="background-color: violet">
		<a class="logout" href='/Home/Logout'>Logout</a>
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
		<h2>Who would you like to message?</h2>
			<form action="" method="post">
				<ul>Send to: <input type='text' name='receiver' /></ul>
				<input type="submit" name="search" value="Search">
			</form>
			<form action="" method="post">
				<?php
					if ($data != null){
						foreach($data["profiles"] as $profile){
							echo "$profile->first_name $profile->last_name<input type='radio' name='search_select' value=$profile->user_id>";
						}
					}
				?>
				<br /><br />
				<input type="submit" name="proceed" value="Write Message">
		</form>

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
	unset($_SESSION["error"]);
?>