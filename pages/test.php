<?php

//Database initialization
//require_once("db_handler.php");

//$conn = iniCon();
//$db = selectDB($conn);

//if(isset($_POST["loadbtn"]))
//{
    $dbhost = 'localhost';
    $mysql_database = 'tas';
    $mysql_table = 'user';
    $dbuser = 'root';
    $conn = new mysqli($dbhost, $dbuser, '', $mysql_database);

    if(! $conn ) {
       die('Could not connect: ' . mysql_error());
    //}
   
    //$sql = 'SELECT USERNAME FROM user';
    //mysql_select_db($mysql_database);
    //$retval = mysqli_query( $sql, $conn );
   
    //if(! $retval ) {
       //die('Could not get data: ' . mysql_error());
    //}
	
	  //$id = (integer) $_POST["codes"];
	
	//mysql_connect($mysql_server, $mysql_username, $mysql_password) or die('Failed to connect to database server!<br>'.mysql_error());
	//mysql_query("CREATE DATABASE IF NOT EXISTS $mysql_database");
	//mysql_select_db($mysql_database) or die('Failed to select database<br>'.mysql_error());
	//mysql_query("CREATE TABLE IF NOT EXISTS $mysql_table (ID int(9) NOT NULL auto_increment, `DATESTAMP` DATE, `TIME` VARCHAR(8), `IP` VARCHAR(15), `BROWSER` TINYTEXT, PRIMARY KEY (id))");

    $query = "SELECT USERNAME FROM user WHERE ID = 1 ";
    $result = mysqli_query($conn, $query);
    if(! $result ) {
       die('Could not get data: ' . mysql_error());
    }
    //$details = mysqli_fetch_array($result);

    //$savedName = $details["Name"];
    //$savedCost = $details["Cost"];
    //$savedActive = $details["Active"];
//}

?>

<html>
<head>
</head>
<body>
	<div id="upserv">
	<b id="caption2">Update location</b>
	<br/><br/>
	<form name="upServForm" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post" >
		<?php
		while( $row = mysqli_fetch_array($result,MYSQLI_ASSOC) ) {
		?>
			<input name="NAME" type="text" value="<?php echo( htmlspecialchars( $row['USERNAME'] ) ); ?>" />
		<?php
		}
	?>
	<br/>
	<div id="buttons">
		<input type="reset" value="Clear" /> <input type="submit" value="Save" name="updatebtn" />
	</div>
    </form>

</body>
</html>