<?php

/*
*This is the Add page.
*The primary function is for admin to add a new museum to the list.
*
*@package
*@copyright 2012 Jen Harris
*@author Jen Harris <jen_l_harris@yahoo.com>
*@link http://github.com/harr0475/open-data-app
*@version 1.0.0
*/


require_once '../includes/users.php';

if (!user_signed_in()) {
	header('Location: sign-in.php');
	exit;
}

$errors = array();

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$longitude = filter_input(INPUT_POST, 'longitude', FILTER_SANITIZE_STRING);
$latitude = filter_input(INPUT_POST, 'latitude', FILTER_SANITIZE_STRING);



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (empty($name)) {
		$errors['name'] = true;
	}
	
	if (empty($longitude)) {
		$errors['longitude'] = true;
	}
	
	if (empty($latitude)) {
		$errors['latitude'] = true;
	}
	

	
	if (empty($errors)) {
		require_once '../includes/db.php';
		
		$sql = $db->prepare('
			INSERT INTO museums (name, longitude, latitude)
			VALUES (:name, :longitude, :latitude)
		');
		$sql->bindValue(':name', $name, PDO::PARAM_STR);
		$sql->bindValue(':longitude', $longitude, PDO::PARAM_STR);
		$sql->bindValue(':latitude', $latitude, PDO::PARAM_STR);
		
		$sql->execute();
		
		header('Location: index.php');
		exit;
	}
}

?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Add a Museum</title>
</head>
<body>
	
	<form method="post" action="add.php">
		<div>
			<label for="name">Museum Name<?php if (isset($errors['name'])) : ?> <strong>is required</strong><?php endif; ?></label>
			<input id="name" name="name" value="<?php echo $name; ?>" required>
		</div>
		<div>
			<label for="longitude">Longitude<?php if (isset($errors['longitude'])) : ?> <strong>is required</strong><?php endif; ?></label>
			<input id="longitude" name="longitude" value="<?php echo $longitude; ?>" required>
		</div>
		<div>
			<label for="latitude">Latitude<?php if (isset($errors['latitude'])) : ?> <strong>is required</strong><?php endif; ?></label>
			<input id="latitude" name="latitude" value="<?php echo $latitude; ?>" required>
		</div>
		<button type="submit">Add</button>
	</form>
	
</body>
</html>
