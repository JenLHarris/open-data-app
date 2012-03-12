<?php

require_once 'includes/db.php';

$results = $db->query('
	SELECT id, name, longitude, latitude
	FROM museums
	ORDER BY name ASC
');

?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Museums - Open Data App</title>
    <link href="css/public.css">
    <script src="js/modernizr-2.5.3.js"></script>
</head>
<body>

	<?php foreach ($results as $museum) : ?>
		<h2><a href="single.php?id=<?php echo $museum['id']; ?>"><?php echo $museum['name']; ?></a></h2>	
	<?php endforeach; ?>

</body>
</html>
