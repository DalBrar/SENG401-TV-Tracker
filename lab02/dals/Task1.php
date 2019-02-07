<?php
// Read CalgarySchools.geojson and convert to array:
$calgaryschools = file_get_contents('CalgarySchools.geojson');
$arr = json_decode($calgaryschools, true);

// Print array:
echo "<pre>";
print_r($arr);
echo "</pre>";

// Save array as output.geojson
$output = json_encode($arr);
file_put_contents('output.geojson', $output);
?>