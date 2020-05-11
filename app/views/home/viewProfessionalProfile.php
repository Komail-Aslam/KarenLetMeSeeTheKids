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
			<a href="/Profile/ModifyProfile">Profile</a>
			<a href="/Message/ViewMessages">Messages</a>
			<a href="/Appointment/viewAppointments">Appointments</a>
			<?php
				if (isset($_SESSION['client_id'])){
					echo "<a class='active' href='/Professional/viewProfessionals'>Professionals</a>
						<a href='/Home/ModifyProfile'>Logbook</a>";
				}
				else
					echo "<a href='/Client/viewClients'>Clients</a>";
			?>
		</div>
		<form action='' method='post'>
			<?php
				$pro = $data["currentProfile"];
				$professional = $this->model('Professional');
				$currentProfessional = $professional->getProfessional($pro->profile_id);
				$req = $this->model('Request');
				$request = $req->getRequest($_SESSION['client_id'], $currentProfessional->professional_id, "relation");
				$relation = $this->model('Relation');
				$checkRelation = $relation->getRelation($_SESSION['client_id'], $currentProfessional->professional_id);
				if ($checkRelation != null)
					$disabledStatus = "disabled";
				else
					$disabledStatus = "enabled";
				if ($request==null)
					echo "<input class='b1' type='submit' name='request' value='Request Professional' $disabledStatus>"; 
				else
					echo "<input class='b1' type='submit' name='deleteRequest' value='Delete Request'>"; 
			?>
		</form>
		<table style="padding-top: 30px;">
		<?php
			$pro = $data["currentProfile"];
			$professional = $this->model('Professional');
			$currentProfessional = $professional->getProfessional($pro->profile_id);
			echo "<tr><td>Name: </td><td>$pro->first_name $pro->last_name</td></tr>
					<tr><td>Email: </td><td>$pro->email</td></tr>
					<tr><td>Location: </td><td>$pro->city, $pro->country</td></tr>
					<tr><td>Profession: </td><td>$currentProfessional->profession</td></tr>
					<tr><td>Education: </td><td>$currentProfessional->education</td></tr>
					<tr><td>Experience: </td><td>$currentProfessional->years years</td></tr>";
		?>
		</table>
		<table>
			<th>Reviews</th>
			<?php
				if ($data["reviews"]!=null){
					foreach($data["reviews"] as $review){
					$client = $this->model('client');
					$currClient = $client->getClientClientId($review->client_id);
					$profile = $this->model('Profile');
					$clientProfile = $profile->currentProfileProfileId($currClient->profile_id);

					$proProfile = $profile->currentProfileProfileId($_SESSION['viewProfessionalProfileId']);
					$reviewComment = $this->model('reviewComment');
					$comments = $reviewComment->getComments($review->review_id);
					
					echo "<tr><td>$clientProfile->first_name $clientProfile->last_name: $review->review_content";
					if ($comments!=null){
						foreach ($comments as $comment) {
							echo "<br>$proProfile->first_name $proProfile->last_name: $comment->comment";	
						}
					}
					echo "</td></tr>";
				}
			}
			?>
		</table>
	</div>
	</body>
</html>