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
			<a class="active" href="/Home/ViewMessages">Messages</a>
			<a href="/Home/ModifyProfile">Appointments</a>
			<a href="/Home/ModifyProfile">Professionals</a>
			<a href="/Home/ModifyProfile">Logbook</a>
		</div>
		<form action="/Home/CreateMessage" method="get">
			<input class="button" type="submit" name="Submit" value="Compose New Message">
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
	.button {
		  background-color: violet; /* Green */
		  border: 3px solid black;
		  color: black;
		  padding: 15px 32px;
		  text-align: center;
		  text-decoration: none;
		 display: inline-block;
		 font-size: 16px;
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