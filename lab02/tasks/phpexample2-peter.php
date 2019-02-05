<?php
$calgarySchoolsGeoJsonFile = file_get_contents("CalgarySchools.geojson");
$calgarySchoolsAssocArray = json_decode($calgarySchoolsGeoJsonFile, true);
var_dump($calgarySchoolsAssocArray);
?>
