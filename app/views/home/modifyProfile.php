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
			<a class="active" href="#profile">Profile</a>
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
		
		<form action="" method="post">
			<ul><b>First Name: <input type="text" name="first_name" value="<?php echo$data->first_name?>"></ul>
			<ul>Last Name: <input type="text" name="last_name" value="<?php echo$data->last_name?>"></ul>
			<ul>Email: <input type="text" name="email" value="<?php echo$data->email?>"></ul>
			<ul>City: <input type="text" name="city" value="<?php echo$data->city?>"></ul>
			<ul>Country: <input type="text" name="country" value="<?php echo$data->country?>"></ul>
			<?php
				if(isset($_SESSION["client_id"])){
					echo "<input type='submit' name='action' value='Save' style='margin-left: 75%'>";
					if (isset($_SESSION['error'])){
						$error = $_SESSION['error'];
						echo "<p>$error</p>";
					}
				}
			
				if (isset($_SESSION["professional_id"])){
					$professional = $this->model('Professional');
					$pro = $professional->getProfessionalProfessionalId($_SESSION["professional_id"]);
					$profession = $pro->profession;
					echo "<ul style='margin-right:50px'>Profession:</b>
							<t>Psychologist: <input type='radio' name='professional_type' value='Psychologist'"; if ($profession=="Psychologist"){echo "checked";} echo"></t></ul><ul>
							Psychiatrist: <input type='radio' name='professional_type' value='Psychiatrist'"; if ($profession=="Psychiatrist"){echo "checked";} echo">
							Child Therapist: <input type='radio' name='professional_type' value='Child Therapist'"; if ($profession=="Child Therapist"){echo "checked";} echo"></ul>
							<ul><b>Education: <input type='text' name='education' value='$pro->education'><br></ul>
							<ul>Years of Experience: <input type='text' name='years' value='$pro->years'><br></ul>
							<input type='submit' name='action' value='Save'>";

						if (isset($_SESSION['error'])){
							$error = $_SESSION['error'];
							echo "<p>$error</p>";
						}
			
					?>
					<?php
					$review = $this->model('Review');
					$reviews = $review->getReviews($pro->professional_id);
					if ($reviews!=null){
						echo "<table><th>Reviews</th>";
						foreach ($reviews as $review) {
							$client = $this->model('client');
							$currClient = $client->getClientClientId($review->client_id);
							$profile = $this->model('Profile');
							$clientProfile = $profile->currentProfileProfileId($currClient->profile_id);
							echo "<tr><td><b>$clientProfile->first_name $clientProfile->last_name: $review->review_content</b>";
							$reviewComment = $this->model('ReviewComment');
							$comments = $reviewComment->getComments($review->review_id);
							if ($comments!=null){
								$proProfile = $profile->currentProfileProfileId($_SESSION['profile_id']);
								foreach ($comments as $comment) {
									echo "<br>$proProfile->first_name $proProfile->last_name: $comment->comment";	
								}
							}
							echo "</td><td><input type='submit' name='$review->review_id' value='Comment'></td></tr>";
						}
						echo "</table>";
					}
				}
			?>	
		</form>
		
	</div>
	</body>
</html>

<?php
	unset($_SESSION["error"]);
?>

<style type="text/css">
	form {
		margin-top: 70px;
		margin-right: 25%;
	}
	input[type=text] {
	    border: 1px solid black;
	    border-radius: 3px;
	    padding: 6px 20px;
	}
	form input[type=submit] {
	    border: 1px solid black;
	    border-radius: 3px;
	    padding: 6px 20px;
	    margin-right: 100px;
	}
</style>