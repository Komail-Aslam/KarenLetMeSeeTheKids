<html>
	<head>
		<title>Home Page</title>	
	</head>

	<body style="background-color: violet">
		<a href='/Home/Logout'>Logout</a>
		<h1>KarenLetMeSeeTheKids</h1>
		
	<div class="main" style="background-color: lightblue">
		<div class="topnav">
			<a class="active" href="/Home/Homepage">Home</a>
			<a href="/Home/ModifyProfile">Profile</a>
			<a href="/Home/ViewMessages">Messages</a>
			<a href="/Home/ModifyProfile">Appointments</a>
			<a href="/Home/ModifyProfile">Professionals</a>
			<a href="/Home/ModifyProfile">Logbook</a>
		</div>
		<form action="/Home/writePost" method="get">
			<input class="button" type="submit" name="Submit" value="Compose New Post">
		</form>

		<table>
			<th>Posted By:</th>
			<th>Question:</th>
		<?php
			if ($data!=null){
				foreach($data["posts"] as $posts){
					$client = $this->model('Client');
					$posterClient = $client->getClientClientId($posts->client_id);
					$profile = $this->model('Profile');
					$posterProfile = $profile->currentProfileProfileId($posterClient->profile_id);
					echo "<tr><td style='width: 20%'>$posterProfile->first_name $posterProfile->last_name</td>
						<td>$posts->post_content</td>
						<form action='' method='post'>
						<td><input type='submit' name='$posts->post_id' value='Comment'></td></form></tr>";
				}
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
		border-spacing: 40px;
		border-collapse: collapse;	
	}
	th {
		font-size: 30px;
		//border-bottom: 1px solid black;
	}
	td {
		padding-top: 8px;
		border-bottom: 1px solid black;
	}
	.main {
		padding: 60px 80px;
		width: 70%;
		height: auto;
		min-height: 400px;
		margin: auto;
		border: 4px solid black;
		position: relative;
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
		 margin-top: 20px;
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