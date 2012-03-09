<?php

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
	header('Location: index.php');
	exit;
}

require_once 'includes/db.php';

$sql = $db->prepare('
	SELECT id, name, address, telephone, type, city_ward, french_name
	FROM museums
	WHERE id = :id
');

$sql->bindValue(':id', $id, PDO::PARAM_INT);
$sql->execute();
$results = $sql->fetch();

if (empty($results)) {
	header('Location: index.php');
	exit; 
}

?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $results['name']; ?> &middot; Museums - Open Data App</title>
</head>
<body>
	
	<h1><?php echo $results['name']; ?></h1>
    <h2>Type: <?php echo $results['type']; ?></h2>
	<p>Address: <?php echo $results['address']; ?></p>
	<p>Telephone: <?php echo $results['telephone']; ?></p>      
	<p>Area: <?php echo $results['city_ward']; ?></p>
	<p>French Name: <?php echo $results['french_name']; ?></p>
        
</body>
</html>
