<?php
//require_once('/dbinitialisation.php');
$servername = "gaea.sadomain.com";
$username = "gateway1_tasuser";
$password = "tasuser123";
$dbname = "gateway1_tas";
$mysql_table = "TASUSER";

$sqltext = "INSERT INTO $mysql_table (`DATESTAMP`, `TIME`, `IP`, `BROWSER`, `USERNAME`)
                   VALUES ('".date("Y-m-d")."',
                   '".date("G:i:s")."',
                   '".$_SERVER['REMOTE_ADDR']."',
                   '".$_SERVER['HTTP_USER_AGENT']."','KKK')";
				   //'"'KKK)'";
echo "$sqltext<br>";
				   
$conn = new mysqli($servername, $username, $password, '');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error."<br>");
} 
if (!$conn->select_db($dbname)) {
	die( "Error: Failed to select database '$dbname' ".$conn->error."<br>");
}

if (!$conn->query($sqltext)) {
	die( "Error: Failed to insert data into table '$mysql_table' ".$conn->error."<br>");
}

$sql = "SELECT USERNAME FROM $mysql_table";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["USERNAME"]. " - Name: " . "<br>";
		echo "<input name='NAME' type='text' value=" . $row['USERNAME'] . "><br>";
    }
} else {
    echo "0 results";
}

$result->free();
$conn->close();
?>