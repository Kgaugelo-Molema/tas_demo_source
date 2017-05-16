<?php
$servername = "gaea.sadomain.com";
$username = "gateway1_tasuser";
$password = "tasuser123";
$dbname = "gateway1_tas";
$mysql_table = "PROGRESSREPORT";

$conn = new mysqli($servername, $username, $password, '');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error."<br>");
} 
if (!$conn->select_db($dbname)) {
	die( "Error: Failed to select database '$dbname' ".$conn->error."<br>");
}

$sql = "SELECT PROVINCE, REGISTERED, OPEN, CLOSED FROM $mysql_table";

?>
<html>
	<head>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
	</head>
	<body>
		<h5 style="text-align: center;">Registered Projects</h5>
		<canvas id="myChart" width="200px" height="100px"></canvas>
		<script>
			var ctx = document.getElementById("myChart").getContext('2d');
			var myChart = new Chart(ctx, {
				type: 'line',
				data: {

<?php
$labels = "labels: [";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$rowsremaining = $result->num_rows;
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //echo $row["PROVINCE"]. " | " . $row["REGISTERED"]. " | " . $row["OPEN"]. " | " . $row["CLOSED"]. " | " . "<br>";
		$labels .= "'".$row["PROVINCE"]."'";
		$rowsremaining--;
		if ($rowsremaining > 0) {
			$labels .= ",";
		}
		//echo "Num_rows: ".$rowsremaining."<br>";
    }
	$labels .= "],";
} else {
    echo "0 results";
}
//echo "<br><br>";


echo $labels;
?>
					datasets: [{
						label: 'Registered Projects',
						
<?php

						//data: [8,21,7,12,4,27],
$data = "data: [";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$rowsremaining = $result->num_rows;
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //echo $row["PROVINCE"]. " | " . $row["REGISTERED"]. " | " . $row["OPEN"]. " | " . $row["CLOSED"]. " | " . "<br>";
		$data .= $row["REGISTERED"];
		$rowsremaining--;
		if ($rowsremaining > 0) {
			$data .= ",";
		}
		//echo "Num_rows: ".$rowsremaining."<br>";
    }
	$data .= "],";
} else {
    echo "0 results";
}
echo $data;

?>						
						
						backgroundColor: [
							'rgba(255, 99, 132, 0.2)',
							'rgba(54, 162, 235, 0.2)',
							'rgba(255, 206, 86, 0.2)',
							'rgba(75, 192, 192, 0.2)',
							'rgba(153, 102, 255, 0.2)',
							'rgba(255, 159, 64, 0.2)'
						],
						borderColor: [
							'rgba(255,99,132,1)',
							'rgba(54, 162, 235, 1)',
							'rgba(255, 206, 86, 1)',
							'rgba(75, 192, 192, 1)',
							'rgba(153, 102, 255, 1)',
							'rgba(255, 159, 64, 1)'
						],
						borderWidth: 1
					}]
				},
				options: {
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero:true
							}
						}]
					}
				}
			});
		</script>
	</body>
</html>