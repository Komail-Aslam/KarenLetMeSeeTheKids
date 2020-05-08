<html>
	<head>
		<title>Home Page</title>	
	</head>

	<body style="background-color: violet">
		<a href='/Home/Logout'>Logout</a>
		<h1>KarenLetMeSeeTheKids</h1>
		
	<div class="main" style="background-color: lightblue">
		<div class="topnav">
			<a href="/Home/Homepage">Home</a>
			<a href="/Home/ModifyProfile">Profile</a>
			<a href="/Home/ViewMessages">Messages</a>
			<a href="/Home/ModifyProfile">Appointments</a>
			<?php
				if (isset($_SESSION['client_id'])){
					echo "<a class='active' href='/Home/viewProfessionals'>Professionals</a>
						<a href='/Home/ModifyProfile'>Logbook</a>";
				}
				else
					echo "<a href='/Professional/viewClients'>Clients</a>";
			?>
		</div>
		<form action="" method="post">
		<table>
			<th>Professional Name:</th>
			<th>Profession:</th>
		<?php
			if ($data!=null){
				if (isset($data['profiles'])){
					foreach ($data["profiles"] as $profile) {
						$professional = $this->model('Professional');
						$currProfessional = $professional->getProfessional($profile->profile_id);
						if ($currProfessional != null){
							echo "<tr><td>$profile->first_name $profile->last_name</td>
										<td>$currProfessional->profession</td>
										<td><input type='submit' name='$profile->profile_id' value='View Profile'></td></tr>";
						}
					}
				}
				else {
					foreach ($data["professionals"] as $professional) {
						$profile = $this->model('Profile');
						$currProfile = $profile->currentProfileProfileId($professional->profile_id);
						if ($currProfile != null){
							echo "<tr><td>$currProfile->first_name $currProfile->last_name</td>
										<td>$professional->profession</td>
										<td><input type='submit' name='$currProfile->profile_id' value='View Profile'></td></tr>";
						}
					}
				}
			}
		?>
		</table>
		</form>
	</div>
	</body>
</html>

<style type="text/css">
	table {
		padding: 5px;
		font-size: 25px;
		width: 100%;
		text-align: center;	
	}
	th {
		font-size: 30px;
	}
	td {
		border: 1px solid black;
	}
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
		margin-right: 10px;
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