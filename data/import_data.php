<?php

require_once '../includes/db.php';

$places_xml = simplexml_load_file('2010_museums.kml');

$sql = $db->prepare('
	INSERT INTO museums (name, longitude, latitude)
	VALUES (:name, :longitude, :latitude)
');

foreach ($places_xml->Document->Folder[0]->Placemark as $place) {
	$coords = explode(',', trim($place->Point->coordinates));
	$adr = '';
	

	$sql->bindvalue(':name', $place->name, PDO::PARAM_STR);
	$sql->bindvalue(':longitude', $coords[0], PDO::PARAM_STR);
	$sql->bindvalue(':latitude', $coords[1], PDO::PARAM_STR);
	
	$sql->execute();
}

var_dump($sql->errorInfo());
