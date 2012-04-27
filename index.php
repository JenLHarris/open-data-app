<?php
/*
*This is the index page, or the homepage.
*The primary functions are to link up all of the elements included in the app.
*
*@package
*@copyright 2012 Jen Harris
*@author Jen Harris <jen_l_harris@yahoo.com>
*@link http://github.com/harr0475/open-data-app
*@version 1.0.0
*/


require_once 'includes/db.php';

$results = $db->query('
	SELECT id, name, longitude, latitude, rate_count, rate_total
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

<button id="geo">Find Me</button>
<form id="geo-form">
    <label for="adr">Address</label>
    <input id="adr">
</form>


<ol class="museums">
<?php foreach ($results as $museum) : ?>
	<?php
		if ($museum['rate_count'] > 0) {
			$rating = round($museum['rate_total'] / $museum['rate_count']);
		} else {
			$rating = 0;
		}
	?>
  <li itemscope itemtype="http://schema.org/TouristAttraction" data-id="<?php echo $museum['id']; ?>">
    	<strong class="distance"></strong>
		<a href="single.php?id=<?php echo $museum['id']; ?>" itemprop="name"><?php echo $museum['name']; ?></a>
		<span itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
			<meta itemprop="latitude" content="<?php echo $museum['latitude']; ?>">
			<meta itemprop="longitude" content="<?php echo $museum['longitude']; ?>">
		</span>
        
		<ol class="rater">
		<?php for ($i = 1; $i <= 5; $i++) : ?>
			<?php $class = ($i <= $rating) ? 'is-rated' : ''; ?>
			<li class="rater-level <?php echo $class; ?>">★</li>
		<?php endfor; ?>
		</ol>
	</li>
<?php endforeach; ?>
</ol>

<div id="map"></div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyB-EndoKVWgvLY22glz2Xh3CidARcvYQRU&sensor=false"></script>
    <script src="js/latlng.min.js"></script>
	<script src="js/museums.js"></script>
</body>
</html>
