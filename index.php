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
    <link href="css/public.css" rel="stylesheet">
    <script src="js/modernizr-2.5.3.js"></script>
</head>
<body>


<ol class="museums">
<?php foreach ($results as $museum) : ?>
	<li itemscope itemtype="http://schema.org/TouristAttraction">
		<a href="single.php?id=<?php echo $museum['id']; ?>" itemprop="name"><?php echo $museum['name']; ?></a>
		<span itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
			<meta itemprop="latitude" content="<?php echo $museum['latitude']; ?>">
			<meta itemprop="longitude" content="<?php echo $museum['longitude']; ?>">
		</span>
	</li>
<?php endforeach; ?>
</ol>

<div id="map"></div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyB-EndoKVWgvLY22glz2Xh3CidARcvYQRU&sensor=false"></script>
	<script src="js/museums.js"></script>
</body>
</html>