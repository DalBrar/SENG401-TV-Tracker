<?php
echo("<br/>");
$calgarySchoolsGeoJsonFile = file_get_contents("CalgarySchools.geojson");
$calgarySchoolsAssocArray = json_decode($calgarySchoolsGeoJsonFile, true);
echo("GeoJSON Loaded From File:<br/><br/>");
var_dump($calgarySchoolsAssocArray);

$calgarySchoolsJson = json_encode($calgarySchoolsAssocArray);
file_put_contents("apache_output/CalgarySchools-fromArray.geojson", $calgarySchoolsJson);
echo("<br/><br/>Array written to file can be found in the file: apache_output/CalgarySchools-fromArray.geojson");
?>
