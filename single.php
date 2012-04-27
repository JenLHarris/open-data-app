<?php

/*
*This is the Single page.
*The primary function is to provide info and ratings for a single museum when selected from the map or list.
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

require_once 'includes/db.php';
require_once 'includes/functions.php';

$sql = $db->prepare('
	SELECT id, name, longitude, latitude, rate_count, rate_total
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

$title = $results['name'];

if ($results['rate_count'] > 0) {
$rating = round($results['rate_total'] / $results['rate_count']);
} else {
$rating = 0;
}

$cookie = get_rate_cookie();

?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $results['name']; ?> &middot; Museums - Open Data App</title>
    <link href="css/public.css" rel="stylesheet">
</head>
<body>
	
	<div id="wrapper">
<h1><?php echo $results['name']; ?></h1>

<dl>
<dt>Average Rating</dt><dd><meter value="<?php echo $rating; ?>" min="0" max="5"><?php echo $rating; ?> out of 5</meter></dd>
<dt>Longitude</dt><dd><?php echo $results['longitude']; ?></dd>
<dt>Latitude</dt><dd><?php echo $results['latitude']; ?></dd>
</dl>

<?php if (isset($cookie[$id])) : ?>

<h2>Your rating</h2>
<ol class="rater rater-usable">
<?php for ($i = 1; $i <= 5; $i++) : ?>
<?php $class = ($i <= $cookie[$id]) ? 'is-rated' : ''; ?>
<li class="rater-level <?php echo $class; ?>">★</li>
<?php endfor; ?>
</ol>

<?php else : ?>

<h2>Rate</h2>
<ol class="rater rater-usable">
<?php for ($i = 1; $i <= 5; $i++) : ?>
<li class="rater-level"><a href="rate.php?id=<?php echo $results['id']; ?>&rate=<?php echo $i; ?>">★</a></li>
<?php endfor; ?>
</ol>

<?php endif; ?>
   </div>     
</body>
</html>
