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
			<a class="active" href="/Home/Homepage">Home</a>
			<a href="/Profile/ModifyProfile">Profile</a>
			<a href="/Message/ViewMessages">Messages</a>
			<a href="/Appointment/viewAppointments">Appointments</a>
			<?php
				if (isset($_SESSION['client_id'])){
					echo "<a href='/Professional/viewProfessionals'>Professionals</a>
						<a href='/Logbook/viewLogbook'>Logbook</a>";
				}
				else
					echo "<a href='/Client/viewClients'>Clients</a>";
			?>
			
		</div>
		<?php 
			if (isset($_SESSION['client_id'])){
				echo "
				<form action='/Home/writePost' method='get'>
					<input class='b1' type='submit' name='Submit' value='Compose New Post'>
				</form>
				";
			}
		?>

		<table class="home">
			<th><u>Posted By:</th>
			<th><u>Question:</th>
		<?php
			if ($data!=null){
				foreach($data["posts"] as $posts){
					$client = $this->model('Client');
					$posterClient = $client->getClientClientId($posts->client_id);
					$profile = $this->model('Profile');
					$posterProfile = $profile->currentProfileProfileId($posterClient->profile_id);
					echo "<tr><td class='home' style='width: 20%'><b>$posterProfile->first_name $posterProfile->last_name</b></td>
						<td class='home'><b>$posts->post_content</b><br>";
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
										echo"<input class='smallButton' style='margin-left: 5px' type='submit' name='0+$comment->comment_id' value='Unverify'><br></t>";
									}
									else
										echo "<br>";
								}

								if ($comment->verified == 0){
									if (isset($_SESSION['professional_id'])){
										echo"<input class='smallButton' type='submit' name='1+$comment->comment_id' value='Verify' style='margin-left: 5px'><br></t>";	
									}
									else
										echo "<br>";
								}
							}
						}
						echo "</td>
						<td class='home'><input class='smallButton' type='submit' name='$posts->post_id' value='Comment'></td></tr>";

				}
			}
		?>
		</form>
		</table>
	</div>
	</body>
</html>