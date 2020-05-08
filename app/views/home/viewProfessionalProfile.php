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
		<form action='' method='post'>
			<?php
				$professional = $this->model('Professional');
				$currentProfessional = $professional->getProfessional($data->profile_id);
				$req = $this->model('Request');
				$request = $req->getRequest($_SESSION['client_id'], $currentProfessional->professional_id);
				if ($request==null)
					echo "<input type='submit' name='request' value='Request Professional'>"; 
				else
					echo "<input type='submit' name='deleteRequest' value='Delete Request Professional'>"; 
			?>
		</form>
		<table style="padding-top: 30px;">
		<?php
			$professional = $this->model('Professional');
			$currentProfessional = $professional->getProfessional($data->profile_id);
			echo "<tr><td>Name: </td><td>$data->first_name $data->last_name</td></tr>
					<tr><td>Email: </td><td>$data->email</td></tr>
					<tr><td>Location: </td><td>$data->city, $data->country</td></tr>
					<tr><td>Profession: </td><td>$currentProfessional->profession</td></tr>
					<tr><td>Education: </td><td>$currentProfessional->education</td></tr>
					<tr><td>Experience: </td><td>$currentProfessional->years years</td></tr>";
		?>
		</table>
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