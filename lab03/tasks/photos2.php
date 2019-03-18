<html>
<body>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Link: <br><input type="text" name="link" style="width:750px"> </br></br>
  Comment: <br><textarea type="text" name="comment" rows="4" cols="50"> </textarea></br></br>
  <input type="submit">
</form>


<?php

$host='localhost';
$db = 'seng_401';
$username = 'postgres';
$password = 'postgres';

$dsn = "pgsql:host=$host;port=5432;dbname=$db;user=$username;password=$password";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $link = $_REQUEST['link'];
    $comment = $_REQUEST['comment'];
    if (empty($link)) {
        echo "Link is empty";
    } else {
        try{
			// create a PostgreSQL database connection
			$conn = new PDO($dsn);

			// display a message if connected to the PostgreSQL successfully
			if($conn){
				//echo "Connected to the <strong>$db</strong> database successfully!";
				$queryStatement = "INSERT INTO photos (link, comment, created) VALUES ('$link', '$comment', '" . date("Y-m-d g:i:s") . "')";
				//$query = $conn->query($queryStatement);
				//echo $queryStatement;

				$stmt = $conn->prepare($queryStatement);
				$stmt->execute();

			}
		}catch (PDOException $e){
			// report error message
			echo $e->getMessage();
		}
    }
}



try{
	// create a PostgreSQL database connection
	$conn = new PDO($dsn);

	// display a message if connected to the PostgreSQL successfully
	if($conn){
		//echo "Connected to the <strong>$db</strong> database successfully!";
		$queryStatement = "SELECT * FROM photos ORDER BY id DESC";
		$query = $conn->query($queryStatement);



		//$results = Array();
		$results = $query->fetchAll();

		$output = "";

		foreach($results as $result)
		{
			$output .= '<div id="' . $result[0] . '" style="margin:15px; width:500px; background-color:lightgray; padding:15px; display: inline-block;">';
			$output .= '<img src="'. $result[1] . '" width=400px; >';
			$output .= '<p>' . $result[2] . '</p>';
			$output .= '<br>';
			$output .= '<span style="font-size:9px; color:navy;">' . $result[4] . '</span>';
			$output .= '<hr>';
			$output .= '</div>';
		}

		echo $output;
	}
}catch (PDOException $e){
	// report error message
	echo $e->getMessage();
}

?>

</body>
</html>
