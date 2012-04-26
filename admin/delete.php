<?php

/*
*This is the Delete page.
*The primary function is for admin to remove an item from the list.
*
*@package
*@copyright 2012 Jen Harris
*@author Jen Harris <jen_l_harris@yahoo.com>
*@link http://github.com/harr0475/open-data-app
*@version 1.0.0
*/

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
	header('Location: index.php');
	exit;
}

require_once '../includes/db.php';

$sql = $db->prepare('
	DELETE FROM museums
	WHERE id = :id
	LIMIT 1
');

$sql->bindValue(':id', $id, PDO::PARAM_INT);

$sql->execute();

header('Location: index.php');
exit;
