<?php

require_once '../includes/db.php';

$results = $db->query('
	SELECT id, name
	FROM museums
	ORDER BY name ASC
');

?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin - Museums - Open Data App</title>
    <link href="../css/admin.css">
    <script src="../js/modernizr-2.5.3.js"></script>
</head>
<body>

<a href="add.php">Add a Museum</a>


	<?php foreach ($results as $museum) : ?>
		<h2><?php echo $museum['name']; ?></h2>
        <a href="edit.php?id=<?php echo $museum['id']; ?>">Edit</a>
		<a href="delete.php?id=<?php echo $museum['id']; ?>">Delete</a>	
	<?php endforeach; ?>
	
</body>
</html>
