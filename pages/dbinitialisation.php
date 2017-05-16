<?php
$servername = "gaea.sadomain.com";
$username = "gateway1_tasuser";
$password = "tasuser123";
$dbname = "gateway1_tas";
$mysql_table = "TASUSER";

// Create connection
$conn = new mysqli($servername, $username, $password, '');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error."<br>");
} 
if ($conn->query("CREATE DATABASE IF NOT EXISTS $dbname")) {
	echo "Database '$dbname' created successfully.<br>";
}	
else {
	die( "Error: Failed to create database '$dbname' ".$conn->error."<br>");
}

if (!$conn->select_db($dbname)) {
	die( "Error: Failed to select database '$dbname' ".$conn->error."<br>");
}

$sql = "CREATE TABLE IF NOT EXISTS $mysql_table (ID int(9) NOT NULL auto_increment, `DATESTAMP` DATE, `TIME` VARCHAR(8), `IP` VARCHAR(15), `BROWSER` TINYTEXT, `USERNAME` VARCHAR(255), PRIMARY KEY (id))";
if ($conn->query($sql)) {
	echo "Table $mysql_table created successfully"."<br>";
} else {
	echo $sql."<br>";
	die( "Error: Failed to create table '$mysql_table' ".$conn->error."<br>");
}

//$sql = "SHOW TABLES";
//$result = $conn->query($sql);

//if ($result->num_rows > 0) {
    // output data of each row
    //while($row = $result->fetch_assoc()) {
        //echo "id: " . $row["USERNAME"]. " - Name: " . "<br>";
		//echo "<input name='NAME' type='text' value=" . $row['USERNAME'] . "><br>";

    //}
//} else {
    //echo "0 results";
//}
$conn->close();
?>