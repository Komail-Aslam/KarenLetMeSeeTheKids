<html>
<head><title>User index</title>
</head>
<body>
	This is the list of people.
	<table><tr><th>username</th><th>password_hash</th></tr>

	<?php 
	foreach($data["profiles"] as $profile){
		echo "<tr><td>$profile->first_name</td><td>$profile->last_name</td></tr>";
	}
	?>
</table>



</body>
</html>