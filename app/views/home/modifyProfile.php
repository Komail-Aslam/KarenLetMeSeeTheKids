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
			<a class="active" href="#profile">Profile</a>
			<a href="/Message/ViewMessages">Messages</a>
			<a href="/Profile/ModifyProfile">Appointments</a>
			<?php
				if (isset($_SESSION['client_id'])){
					echo "<a href='/Professional/viewProfessionals'>Professionals</a>
						<a href='/Home/ModifyProfile'>Logbook</a>";
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
				if(isset($_SESSION["client_id"]))
					echo "<input type='submit' name='action' value='Save' style='margin-left: 75%'>";
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
							<input type='submit' name='action' value='Save' style='margin-left: 75%'>";
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

<style type="text/css">
	table {
		padding: 5px;
		font-size: 25px;
		width: 170%;
		text-align: center;	
	}
	th {
		font-size: 30px;
	}
	td {
		border: 1px solid black;
	}
	t {
		padding-left: 50px;
	}
	input[type=text] {
	    border: 1px solid black;
	    border-radius: 3px;
	    padding: 6px 20px;
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
	ul {
		text-align: right;
	}
	form {
		margin-top: 70px;
		margin-right: 40%;
	}
</style>