<?php
   $dbhost = 'localhost';
   $dbuser = 'root';
   $dbpass = '';
   
   $conn = mysql_connect($dbhost, $dbuser, $dbpass);
   
   if(! $conn ) {
      die('Could not connect: ' . mysql_error());
   }
   
   $sql = 'SELECT USERNAME FROM user';
   mysql_select_db('tas');
   $retval = mysql_query( $sql, $conn );
   
   if(! $retval ) {
      die('Could not get data: ' . mysql_error());
   }
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
   while($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
   ?>
		<input name="NAME" type="text" value="<?php echo( htmlspecialchars( $row['USERNAME'] ) ); ?>" /><br/><br/>
<?php
   }
   
   echo "Fetched data successfully\n";
   
   mysql_close($conn);
?>
	<br/>
	<div id="buttons">
		<input type="reset" value="Clear" /> <input type="submit" value="Save" name="updatebtn" />
	</div>
    </form>

</body>
</html>