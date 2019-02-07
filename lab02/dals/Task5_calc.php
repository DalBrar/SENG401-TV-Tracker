<?php
function checkLat($p, $lat) {
	$isGood = true;
	if ($lat != 0 && (empty($lat) || is_null($lat))) {
		echo "<p>Point $p: Latitude cannot be empty.</p>";
		$isGood = false;
	}
	elseif (!is_numeric($lat) || $lat < -90 || $lat > 90) {
		echo "<p>Point $p: $lat is not a valid Latitude value. Latitude must be a number between -90 and +90.</p>";
		$isGood = false;
	}
	return $isGood;
}

function checkLon($p, $lon) {
	$isGood = true;
	if ($lon != 0 && (empty($lon) || is_null($lon))) {
		echo "<p>Point $p: Longitude cannot be empty.</p>";
		$isGood = false;
	}
	elseif (!is_numeric($lon) || $lon < -180 || $lon > 180) {
		echo "<p>Point $p: $lon is not a valid Longitude value. Longitude must be a number between -180 and +180.</p>";
		$isGood = false;
	}
	return $isGood;
}

function getQuadrant($x, $y) {
	if ($x == 0 && $y == 0)
		return "Origin";
	else if ($x == 0) {
		if ($y > 0)
			return "North";
		else
			return "South";
	}
	else if ($y == 0) {
		if ($x > 0)
			return "East";
		else
			return "West";
	}
	else if ($x > 0) {
		if ($y > 0)
			return "NE";
		else
			return "SE";
	} else {
		if ($y > 0)
			return "NW";
		else
			return "SW";
	}
}

function getBearing($x1, $y1, $x2, $y2) {
  $y = sin($y2 - $y1) * cos($x2);
  $x = (cos($x1) * sin($x2)) - (sin($x1) * cos($x2) * cos($y2 - $y1));
  return((rad2deg(atan2($y, $x)) + 360) % 360);
}

function getCircleDistance($lon1, $lat1, $lon2, $lat2) {
	$dlon = $lon2 - $lon1;
	$dlat = $lat2 - $lat1;
	$a = sin($dlat/2) * sin($dlat/2) + cos($lat1) * cos($lat2) * sin($dlon/2) * sin($dlon/2);
	$c = 2 * asin(min(1, sqrt($a)));
	return (6367 * $c);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	echo "<p><b>Results:</b></p>";
	
	// collect value of input
	$lat1 = $_REQUEST['lat1'];
	$lon1 = $_REQUEST['lon1'];
	$lat2 = $_REQUEST['lat2'];
	$lon2 = $_REQUEST['lon2'];
	
	$c1 = checkLat(1, $lat1);
	$c2 = checkLon(1, $lon1);
	$c3 = checkLat(2, $lat2);
	$c4 = checkLon(2, $lon2);
	
	if ($c1 && $c2 && $c3 && $c4) {
		echo "Point 1 Quadrant: ".getQuadrant($lon1, $lat1)."<br>";
		echo "Point 2 Quadrant: ".getQuadrant($lon2, $lat2)."<br><br>";
		
		echo "Bearing between the two points: ".getBearing($lon1, $lat1, $lon2, $lat2)."<br><br>";
		
		echo "Great Circle Distance (Geodesic Distance): ".getCircleDistance($lon1, $lat1, $lon2, $lat2);
	}
}
?>