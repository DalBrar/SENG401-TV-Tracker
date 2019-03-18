<?php
$host = 'localhost';
$port = 5432;
$dbname = 'seng_401';
$username = 'postgres';
$password = 'postgres';

$dsn = "pgsql:host=$host; port=$port; dbname=$dbname; user=$username; password=$password";

$searchText = $_POST['searchText'];
$searchTextWrapped = '%'.$searchText.'%';
$displayType = $_POST['displayType'];
$sector = $_POST['sector'];

try {
  $db = new PDO($dsn);
  if ($db) {
    if (!is_null($sector)) {
      $queryStatement = "SELECT type, COUNT(type) FROM CalgarySchools where sector = :sector GROUP BY type";
      $query = $db->prepare($queryStatement);
      $query->bindParam(':sector', $sector);
      $query->execute();
      $results = $query->fetchAll();

      switch ($displayType) {
        case 'json':
          echo json_encode($results);
        break;
        case 'xml':
          echo xmlrpc_encode($results);
        break;
        case 'csv':
          echo 'TYPE, COUNT<br>';
          foreach($results as $result) {
            echo $result['type'] . ',' . $result['count'];
          }
        break;
        case 'table':
          echo '<tr><th>Type</th><th>Count</th></tr>';
          foreach ($results as $result) {
            echo "<tr><td>{$result['type']}</td><td>{$result['count']}</td></tr>";
          }
        break;
      }
    } else {
      $queryStatement = "SELECT * FROM CalgarySchools WHERE name LIKE :searchText";
      $query = $db->prepare($queryStatement);
      $query->bindParam(':searchText', $searchTextWrapped);
      $query->execute();
      $results = $query->fetchAll();

      switch ($displayType) {
        case 'json':
          echo json_encode($results);
        break;
        case 'xml':
          echo xmlrpc_encode($results);
        break;
        case 'csv':
          echo 'NAME,TYPE,SECTOR,ADDRESS,CITY,PROVINCE,POSTAL_CODE,LONGITUDE,LATITUDE<br>';
          foreach ($results as $result) {
            echo $result['name'] . ',' . $result['type'] . ',' . $result['sector'] . ',' .$result['address'] . ',' . $result['city'] . ',' . $result['province'] . ',' . $result['postalcode'] . ',' . $result['longitude'] . ',' . $result['latitude'] . '<br>';
          }
        break;
        case 'table':
          echo '<tr><th>Name</th><th>Type</th><th>Sector</th><th>Address</th><th>City</th><th>Province</th><th>Postal Code</th><th>Longitude</th><th>Latitude</th></tr>';
          foreach ($results as $result) {
            echo "<tr><td>{$result['name']}</td><td>{$result['type']}</td><td>{$result['sector']}</td><td>{$result['address']}</td><td>{$result['city']}</td><td>{$result['province']}</td><td>{$result['postalcode']}</td><td>{$result['longitude']}</td><td>{$result['latitude']}</td></tr>";
          }
        break;
      }
    }
  }
} catch (PDOException $e) {
  echo $e->getMessage();
}
?>
