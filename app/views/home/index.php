<html>
<head><title>User index</title>
</head>
<body>
	This is the list of people.
	<table><tr><th>username</th><th>password_hash</th></tr>

	<?php 
	foreach($data["users"] as $user){
		echo "<tr><td>$user->username</td><td>$user->password_hash</td></tr>";
	}
	?>
</table>



</body>
</html>