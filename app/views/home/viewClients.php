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
					echo "<a href='/Home/ModifyProfile'>Professionals</a>
						<a href='/Home/ModifyProfile'>Logbook</a>";
				}
				else
					echo "<a class='active' href='/Professional/viewClients'>Clients</a>";
			?>
		</div>

		<form action="" method="post">
			<input type="text" name="search_client">
			<input type="submit" name="search" value="Search for Client">
		<table>
		<th>Requests</th>
		<?php
			if ($data["requests"]!=null){
				foreach ($data["requests"] as $request) {
					$client = $this->model('Client');
					$sender = $client->getClientClientId($request->sender_id);
					$profile = $this->model('Profile');
					$senderProfile = $profile->currentProfileProfileId($sender->profile_id);
					echo "<tr><td>$senderProfile->first_name $senderProfile->last_name</td>
							<td><input type='submit' name='0+$senderProfile->profile_id' value='View Profile'>
							<input type='submit' name='1+$request->sender_id' value='Accept'>
							<input type='submit' name='2+$request->sender_id' value='Decline'</td></tr>";
				}
			}
		?>
	</table>
	<table>
		<th>Clients</th>
		<?php
			if ($data["relations"]!=null){
				$client = $this->model('Client');
				$profile = $this->model('Profile');
				foreach ($data["relations"] as $relation) {
					$currClient = $client->getClientClientId($relation->client_id);
					$clientProfile = $profile->currentProfileProfileId($currClient->profile_id);
					// $client = $this->model('Client');
					// $sender = $client->getClientClientId($request->sender_id);
					// $profile = $this->model('Profile');
					// $senderProfile = $profile->currentProfileProfileId($sender->profile_id);
					echo "<tr><td>$clientProfile->first_name $clientProfile->last_name</td>
							<td><input type='submit' name='$currClient->client_id' value='End Interaction'></td></tr>";
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