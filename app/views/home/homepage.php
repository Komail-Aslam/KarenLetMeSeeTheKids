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
			<a href="/Profile/ModifyProfile">Profile</a>
			<a href="/Message/ViewMessages">Messages</a>
			<a href="/Home/ModifyProfile">Appointments</a>
			<?php
				if (isset($_SESSION['client_id'])){
					echo "<a href='/Professional/viewProfessionals'>Professionals</a>
						<a href='/Home/ModifyProfile'>Logbook</a>";
				}
				else
					echo "<a href='/Client/viewClients'>Clients</a>";
			?>
			
		</div>
		<?php 
			if (isset($_SESSION['client_id'])){
				echo "
				<form action='/Home/writePost' method='get'>
					<input class='button' type='submit' name='Submit' value='Compose New Post'>
				</form>
				";
			}
		?>

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
					echo "<tr><td style='width: 20%'><b>$posterProfile->first_name $posterProfile->last_name</b></td>
						<td><b>$posts->post_content</b><br>";
						$comment = $this->model('Comments');
						$comments = $comment->viewComments($posts->post_id);
						if ($comments != null){
							foreach($comments as $comment){
								$profile = $this->model('Profile');
								$commenter = $profile->currentProfileProfileId($comment->commenter_id);
								echo "<t><form action='' method='post'>$commenter->first_name $commenter->last_name: $comment->comment";
								
								if ($comment->verified == 1){
									echo"<b>✓</b>";
									if (isset($_SESSION['professional_id'])){
										echo"<input type='submit' name='0+$comment->comment_id' value='Unverify'><br></t>";
									}
									else
										echo "<br>";
								}

								if ($comment->verified == 0){
									if (isset($_SESSION['professional_id'])){
										echo"<input type='submit' name='1+$comment->comment_id' value='Verify'><br></t>";	
									}
									else
										echo "<br>";
								}
							}
						}
						echo "</td>
						<td><input type='submit' name='$posts->post_id' value='Comment'></td></form></tr>";

				}
			}
		?>
		</table>
	</div>
	</body>
</html>

<style type="text/css">
	t {
		font-size: 18px;
	}
	table {
		padding: 5px;
		font-size: 25px;
		width: 100%;
		text-align: center;
		border-spacing: 50px;
		border-collapse: collapse;	
	}
	th {
		font-size: 30px;
		//border-bottom: 1px solid black;
	}
	td {
		padding-top: 20px;
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