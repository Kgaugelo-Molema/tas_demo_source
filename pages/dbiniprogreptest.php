<?php
//require_once('/dbinitialisation.php');
$servername = "gaea.sadomain.com";
//$servername = "localhost";
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

$sqltext = "DELETE FROM $mysql_table ";

echo "$sqltext<br>";
				   
if (!$conn->query($sqltext)) {
	die( "Error: Failed to insert data into table '$mysql_table' ".$conn->error."<br>");
}

$sqltext = "INSERT INTO $mysql_table (`DATESTAMP`, `TIME`, `IP`, `BROWSER`, `PROVINCE`, `REGISTERED`, `OPEN`, `CLOSED`)
                   VALUES ('".date("Y-m-d")."',
                   '".date("G:i:s")."',
                   '".$_SERVER['REMOTE_ADDR']."',
                   '".$_SERVER['HTTP_USER_AGENT']."','GAUTENG',45,21,1)";
				   
echo "$sqltext<br>";
				   
if (!$conn->query($sqltext)) {
	die( "Error: Failed to insert data into table '$mysql_table' ".$conn->error."<br>");
}

$sqltext = "INSERT INTO $mysql_table (`DATESTAMP`, `TIME`, `IP`, `BROWSER`, `PROVINCE`, `REGISTERED`, `OPEN`, `CLOSED`)
                   VALUES ('".date("Y-m-d")."',
                   '".date("G:i:s")."',
                   '".$_SERVER['REMOTE_ADDR']."',
                   '".$_SERVER['HTTP_USER_AGENT']."','Limpopo',19,8,4)";

echo "$sqltext<br>";
				   
if (!$conn->query($sqltext)) {
	die( "Error: Failed to insert data into table '$mysql_table' ".$conn->error."<br>");
}
				   
$sqltext = "INSERT INTO $mysql_table (`DATESTAMP`, `TIME`, `IP`, `BROWSER`, `PROVINCE`, `REGISTERED`, `OPEN`, `CLOSED`)
                   VALUES ('".date("Y-m-d")."',
                   '".date("G:i:s")."',
                   '".$_SERVER['REMOTE_ADDR']."',
                   '".$_SERVER['HTTP_USER_AGENT']."','Mpumalanga',45,21,1)";
				   
echo "$sqltext<br>";
				   
if (!$conn->query($sqltext)) {
	die( "Error: Failed to insert data into table '$mysql_table' ".$conn->error."<br>");
}
				   
$sqltext = "INSERT INTO $mysql_table (`DATESTAMP`, `TIME`, `IP`, `BROWSER`, `PROVINCE`, `REGISTERED`, `OPEN`, `CLOSED`)
                   VALUES ('".date("Y-m-d")."',
                   '".date("G:i:s")."',
                   '".$_SERVER['REMOTE_ADDR']."',
                   '".$_SERVER['HTTP_USER_AGENT']."','North West',30,12,3)";
				   
echo "$sqltext<br>";
				   
if (!$conn->query($sqltext)) {
	die( "Error: Failed to insert data into table '$mysql_table' ".$conn->error."<br>");
}
				   
$sqltext = "INSERT INTO $mysql_table (`DATESTAMP`, `TIME`, `IP`, `BROWSER`, `PROVINCE`, `REGISTERED`, `OPEN`, `CLOSED`)
                   VALUES ('".date("Y-m-d")."',
                   '".date("G:i:s")."',
                   '".$_SERVER['REMOTE_ADDR']."',
                   '".$_SERVER['HTTP_USER_AGENT']."','Free State',8,4,5)";
				   
echo "$sqltext<br>";
				   
if (!$conn->query($sqltext)) {
	die( "Error: Failed to insert data into table '$mysql_table' ".$conn->error."<br>");
}
				
$sqltext = "INSERT INTO $mysql_table (`DATESTAMP`, `TIME`, `IP`, `BROWSER`, `PROVINCE`, `REGISTERED`, `OPEN`, `CLOSED`)
                   VALUES ('".date("Y-m-d")."',
                   '".date("G:i:s")."',
                   '".$_SERVER['REMOTE_ADDR']."',
                   '".$_SERVER['HTTP_USER_AGENT']."','KwaZulu Natal',39,27,4)";
				   
echo "$sqltext<br>";
				   
if (!$conn->query($sqltext)) {
	die( "Error: Failed to insert data into table '$mysql_table' ".$conn->error."<br>");
}
				   
$sqltext = "INSERT INTO $mysql_table (`DATESTAMP`, `TIME`, `IP`, `BROWSER`, `PROVINCE`, `REGISTERED`, `OPEN`, `CLOSED`)
                   VALUES ('".date("Y-m-d")."',
                   '".date("G:i:s")."',
                   '".$_SERVER['REMOTE_ADDR']."',
                   '".$_SERVER['HTTP_USER_AGENT']."','Eastern Cape',13,16,2)";
				   
echo "$sqltext<br>";
				   
if (!$conn->query($sqltext)) {
	die( "Error: Failed to insert data into table '$mysql_table' ".$conn->error."<br>");
}
				   
$sqltext = "INSERT INTO $mysql_table (`DATESTAMP`, `TIME`, `IP`, `BROWSER`, `PROVINCE`, `REGISTERED`, `OPEN`, `CLOSED`)
                   VALUES ('".date("Y-m-d")."',
                   '".date("G:i:s")."',
                   '".$_SERVER['REMOTE_ADDR']."',
                   '".$_SERVER['HTTP_USER_AGENT']."','Western Cape',27,9,5)";
				   
echo "$sqltext<br>";
				   
if (!$conn->query($sqltext)) {
	die( "Error: Failed to insert data into table '$mysql_table' ".$conn->error."<br>");
}
				   
$sqltext = "INSERT INTO $mysql_table (`DATESTAMP`, `TIME`, `IP`, `BROWSER`, `PROVINCE`, `REGISTERED`, `OPEN`, `CLOSED`)
                   VALUES ('".date("Y-m-d")."',
                   '".date("G:i:s")."',
                   '".$_SERVER['REMOTE_ADDR']."',
                   '".$_SERVER['HTTP_USER_AGENT']."','Northern Cape',11,6,2)";

echo "$sqltext<br>";
				   
if (!$conn->query($sqltext)) {
	die( "Error: Failed to insert data into table '$mysql_table' ".$conn->error."<br>");
}

$labels = "labels: [";

$sql = "SELECT PROVINCE, REGISTERED, OPEN, CLOSED FROM $mysql_table";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$rowsremaining = $result->num_rows;
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo $row["PROVINCE"]. " | " . $row["REGISTERED"]. " | " . $row["OPEN"]. " | " . $row["CLOSED"]. " | " . "<br>";
		$labels .= "'".$row["PROVINCE"]."'";
		$rowsremaining--;
		if ($rowsremaining > 0) {
			$labels .= ",";
		}
		echo "Num_rows: ".$rowsremaining."<br>";
    }
	$labels .= "]";
} else {
    echo "0 results";
}
echo "<br><br>";


echo $labels;

$result->free();
$conn->close();
?>