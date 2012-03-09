<?php

$errors = array();

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
	header('Location: index.php');
	exit;
}

require_once '../includes/db.php';

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
$telephone = filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_STRING);
$type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
$city_ward = filter_input(INPUT_POST, 'city_ward', FILTER_SANITIZE_STRING);
$french_name = filter_input(INPUT_POST, 'french_name', FILTER_SANITIZE_STRING);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (empty($name)) {
		$errors['name'] = true;
	}
	
	if (empty($address)) {
		$errors['address'] = true;
	}
	
	if (empty($telephone)) {
		$errors['telephone'] = true;
	}
	
	if (empty($type)) {
		$errors['type'] = true;
	}
	
	if (empty($city_ward)) {
		$errors['city_ward'] = true;
	}
	
	if (empty($french_name)) {
		$errors['french_name'] = true;
	}	
	
	if (empty($errors)) {
		$sql = $db->prepare('
			UPDATE museums
			SET name = :name, address = :address, telephone = :telephone, type = :type, city_ward = :city_ward, french_name = :french_name
			WHERE id = :id
		');
		$sql->bindValue(':name', $name, PDO::PARAM_STR);
		$sql->bindValue(':address', $address, PDO::PARAM_STR);
		$sql->bindValue(':telephone', $telephone, PDO::PARAM_STR);
		$sql->bindValue(':type', $type, PDO::PARAM_STR);
		$sql->bindValue(':city_ward', $city_ward, PDO::PARAM_STR);
		$sql->bindValue(':french_name', $french_name, PDO::PARAM_STR);	
		$sql->bindValue(':id', $id, PDO::PARAM_INT);
		$sql->execute();
		
		header('Location: index.php');
		exit;
	}
} else {
	$sql = $db->prepare('
		SELECT id, name, address, telephone, type, city_ward, french_name
		FROM museums
		WHERE id = :id
	');
	$sql->bindValue(':id', $id, PDO::PARAM_INT);
	$sql->execute();
	$results = $sql->fetch();
	
	$name = $results['name'];
	$address = $results['address'];
	$telephone = $results['telephone'];
	$type = $results['type'];
	$city_ward = $results['city_ward'];
	$french_name = $results['french_name'];			
}

?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $name; ?> &middot; Edit Museum</title>
</head>
<body>
	
	<form method="post" action="edit.php?id=<?php echo $id; ?>">
		<div>
			<label for="name">Museum Name<?php if (isset($errors['name'])) : ?> <strong>is required</strong><?php endif; ?></label>
			<input id="name" name="name" value="<?php echo $name; ?>" required>
		</div>
		<div>
			<label for="address">Address<?php if (isset($errors['address'])) : ?> <strong>is required</strong><?php endif; ?></label>
			<input id="address" name="address" value="<?php echo $address; ?>" required>
		</div>
		<div>
			<label for="telephone">Telephone<?php if (isset($errors['telephone'])) : ?> <strong>is required</strong><?php endif; ?></label>
			<input id="telephone" name="telephone" value="<?php echo $telephone; ?>" required>
		</div>
		<div>
			<label for="type">Museum Type<?php if (isset($errors['type'])) : ?> <strong>is required</strong><?php endif; ?></label>
			<input id="type" name="type" value="<?php echo $type; ?>" required>
		</div>
		<div>
			<label for="city_ward">Area<?php if (isset($errors['city_ward'])) : ?> <strong>is required</strong><?php endif; ?></label>
			<input id="city_ward" name="city_ward" value="<?php echo $city_ward; ?>" required>
		</div>
		<div>
			<label for="french_name">French Name<?php if (isset($errors['french_name'])) : ?> <strong>is required</strong><?php endif; ?></label>
			<input id="french_name" name="french_name" value="<?php echo $french_name; ?>" required>
		</div>  
		<button type="submit">Save</button>
	</form>
	
</body>
</html>
