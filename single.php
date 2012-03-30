<?php
/**
 *Displays one selected museum, with latitude and longitude.
 *@package Ottawa Museums
 *@copyright 2012 Jen L Harris
 *@author Jen L Harris <jen_l_harris@yahoo.com>
 *@link https://github.com/JenLHarris/open-data-app
 *@license New BSD License <http://www.freebsd.org/>
 *@version 1.0.0
 */

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
	header('Location: index.php');
	exit;
}

require_once 'includes/db.php';

$sql = $db->prepare('
	SELECT id, name, longitude, latitude
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
    <p>Longitude: <?php echo $results['longitude']; ?></p>
	<p>Latitude: <?php echo $results['latitude']; ?></p>

        
</body>
</html>
