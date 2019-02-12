<?php
function quadrant($x, $y) {
  $quadrant;
  if ($x == 0.0 || $y == 0.0) {
    $quadrant = "N/A";
  } elseif ($x > 0 && $y > 0) {
    $quadrant = 1;
  } elseif ($x < 0 && $y > 0) {
    $quadrant = 2;
  } elseif ($x < 0 && $y < 0) {
    $quadrant = 3;
  } else {
    $quadrant = 4;
  }
  return($quadrant);
}

// From https://www.movable-type.co.uk/scripts/latlong.html
function bearing($x1, $y1, $x2, $y2) {
  $x1Rad = deg2rad($x1);
  $y1Rad = deg2rad($y1);
  $x2Rad = deg2rad($x2);
  $y2Rad = deg2rad($y2);

  $y = sin($y2Rad - $y1Rad) * cos($x2Rad);
  $x = (cos($x1Rad) * sin($x2Rad)) - (sin($x1Rad) * cos($x2Rad) * cos($y2Rad - $y1Rad));
  return((rad2deg(atan2($y, $x)) + 360) % 360);
}

// https://www.movable-type.co.uk/scripts/gis-faq-5.1.html
function haversine($x1, $y1, $x2, $y2) {
  $x1Rad = deg2rad($x1);
  $y1Rad = deg2rad($y1);
  $x2Rad = deg2rad($x2);
  $y2Rad = deg2rad($y2);

  $x = $x2Rad - $x1Rad;
  $y = $y2Rad - $y1Rad;

  $a = (0.5 - (0.5 * cos($y))) + (cos($y1Rad) * cos($y2Rad) * (0.5 - (0.5 * cos($x))));
  $c = 2 * asin(min(1, sqrt($a)));
  return(6367 * $c);
}

function geomatics_things($x1, $y1, $x2, $y2) {
  $message = "";
  $valid = true;

  // Null & Number Check
  if (is_null($x1) || !is_numeric($x1)) {
    $message .= "<br/> Please provide a number for Point 1: x.";
    $valid = false;
  }

  if (is_null($y1) || !is_numeric($y1)) {
    $message .= "<br/> Please provide a number for Point 1: y.";
    $valid = false;
  }

  if (is_null($x2) || !is_numeric($x2)) {
    $message .= "<br/> Please provide a number for Point 2: x.";
    $valid = false;
  }

  if (is_null($y2) || !is_numeric($y2)) {
    $message .= "<br/> Please provide a number for Point 2: y.";
    $valid = false;
  }

  if (!$valid) {
    return($message);
  }

  // Make $x1, $y1, $x2, $y2 are usable
  $x1 = floatval($x1);
  $y1 = floatval($y1);
  $x2 = floatval($x2);
  $y2 = floatval($y2);

  // Bound Check
  if ($x1 < -180.0 || $x1 > 180.0) {
    $message .= "<br/> Please enter a number in the range -180.0 < x < 180.0 for Point 1: x.";
    $valid = false;
  }

  if ($y1 < -90.0 || $y1 > 90.0) {
    $message .= "<br/> Please enter a number in the range -90.0 < y < 90.0 for Point 1: y.";
    $valid = false;
  }

  if ($x2 < -180.0 || $x2 > 180.0) {
    $message .= "<br/> Please enter a number in the range -180.0 < x < 180.0 for Point 2: x.";
    $valid = false;
  }

  if ($y2 < -90.0 || $y2 > 90.0) {
    $message .= "<br/> Please enter a number in the range -90.0 < y < 90.0 for Point 2: y.";
    $valid = false;
  }

  if (!$valid) {
    return($message);
  }

  $message .= "<br/>Point 1 Quadrant: " . quadrant($x1, $y1);
  $message .= "<br/>Point 2 Quadrant: " . quadrant($x2, $y2);

  $message .= "<br/>Bearing: " . bearing($x1, $y1, $x2, $y2) . " degrees";
  $message .= "<br/>Great Circle Distance: " . haversine($x1, $y1, $x2, $y2) . "km";

  return($message);
}

exit(geomatics_things($_GET["x1"], $_GET["y1"], $_GET["x2"], $_GET["y2"]))
?>
