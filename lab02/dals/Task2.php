<html>
<head>
<script>
function readJson() {
	var xmlhttp = new XMLHttpRequest();
	
	// Add trigger event before executing:
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
                document.getElementById("output").innerHTML = this.responseText;
		}
	}
	
	xmlhttp.open("GET", "Task1.php", true);
	xmlhttp.send();
}
</script>
</head>
<body>

<p><b>Press the button to read the CalgarySchhols.geojson file:</b></p>

<button onclick="readJson()">Read JSON</button>
	
<p>Output:</p>
<span id="output"></span>

</body>
</html>