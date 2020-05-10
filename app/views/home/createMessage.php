<html>
	<head>
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

<style type="text/css">
	.main {
		padding: 60px 80px;
		width: 70%;
		height: 70%;
		margin: auto;
		border: 4px solid black;
		position: relative;
		
	}
	a {
		float: right;
		margin-top: 10px;
		font-size: 20px;
	}
	
	h1 {
		font-size:40px;
		padding-top: 30px;
		text-align: center;
		margin-left: 30px;
	}
	.topnav {
	  	overflow: hidden;
	  	margin-top: -40px;
	  	margin-left: 15%;

	}
	.topnav a {
		float: left;
		color: black;
		text-align: center;
		padding: 14px 16px;
		text-decoration: none;
		font-size: 17px;
	}
	.topnav a:hover {
	    background-color: #ddd;
	    color: black;
	}
	.topnav a.active {
	    background-color: violet;
	    border-style: solid;
	    color: black;
	}
</style>