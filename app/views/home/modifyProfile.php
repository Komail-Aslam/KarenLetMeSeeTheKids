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
			<a href="/Home/ViewMessages">Messages</a>
			<a href="/Home/ModifyProfile">Appointments</a>
			<a href="/Home/ModifyProfile">Professionals</a>
			<a href="/Home/ModifyProfile">Logbook</a>
		</div>
		
		<form action="" method="post">
			<ul>First Name: <input type="text" name="first_name" value="<?php echo$data->first_name?>"></ul>
			<ul>Last Name: <input type="text" name="last_name" value="<?php echo$data->last_name?>"></ul>
			<ul>Email: <input type="text" name="email" value="<?php echo$data->email?>"></ul>
			<ul>City: <input type="text" name="city" value="<?php echo$data->city?>"></ul>
			<ul>Country: <input type="text" name="country" value="<?php echo$data->country?>"></ul>
			<input type="submit" name="action" value="Save" style="margin-left: 75%;">
		</form>
	</div>
	</body>
</html>

<style type="text/css">
	input[type=text] {
	    border: 1px solid black;
	    border-radius: 3px;
	    padding: 6px 20px;
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