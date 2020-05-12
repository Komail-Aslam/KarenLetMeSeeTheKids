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
			<a class='active' href="/Profile/ModifyProfile">Profile</a>
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
		<?php
			$review = $this->model('Review');
			$currReview = $review->getReviewReviewId($_SESSION['reviewCommentId']);
			echo "Review: $currReview->review_content<br>";
		?>
		Enter the comment below:<br><input type="text" name="reviewComment">
		<input type="submit" name="writeComment" value="Write Comment">
		<?php
			if (isset($_SESSION['error'])){
				$error = $_SESSION['error'];
				echo "<p>$error</p>";
			}			
		?>
	</div>
	</body>
</html>

<?php
	unset($_SESSION["error"]);
?>