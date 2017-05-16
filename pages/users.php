<?php
   function ValidateEmail($email)
   {
      $pattern = '/^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i';
      return preg_match($pattern, $email);
   }

   if ($_SERVER['REQUEST_METHOD'] == 'POST')
   {
      $mailto = '';
      $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
      $subject = '';
      $message = '';
      $success_url = '';
      $error_url = '';
      $error = '';
      $mysql_server = 'localhost';
      $mysql_database = 'tas';
      $mysql_table = 'user';
      $mysql_username = 'root';
      $mysql_password = '';
      $eol = "\n";
      $max_filesize = isset($_POST['filesize']) ? $_POST['filesize'] * 1024 : 1024000;
      $boundary = md5(uniqid(time()));

      $header  = 'From: '.$mailfrom.$eol;
      $header .= 'Reply-To: '.$mailfrom.$eol;
      $header .= 'MIME-Version: 1.0'.$eol;
      $header .= 'Content-Type: multipart/mixed; boundary="'.$boundary.'"'.$eol;
      $header .= 'X-Mailer: PHP v'.phpversion().$eol;
      if (!empty($error))
      {
         $errorcode = file_get_contents($error_url);
         $replace = "##error##";
         $errorcode = str_replace($replace, $error, $errorcode);
         echo $errorcode;
         exit;
      }

      $internalfields = array ("submit", "reset", "send", "captcha_code");
      $message .= $eol;
      $message .= "IP Address : ";
      $message .= $_SERVER['REMOTE_ADDR'];
      $message .= $eol;
      foreach ($_POST as $key => $value)
      {
         if (!in_array(strtolower($key), $internalfields))
         {
            if (!is_array($value))
            {
               $message .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $eol;
            }
            else
            {
               $message .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $eol;
            }
         }
      }

      $body  = 'This is a multi-part message in MIME format.'.$eol.$eol;
      $body .= '--'.$boundary.$eol;
      $body .= 'Content-Type: text/plain; charset=ISO-8859-1'.$eol;
      $body .= 'Content-Transfer-Encoding: 8bit'.$eol;
      $body .= $eol.stripslashes($message).$eol;
      if (!empty($_FILES))
      {
          foreach ($_FILES as $key => $value)
          {
             if ($_FILES[$key]['error'] == 0 && $_FILES[$key]['size'] <= $max_filesize)
             {
                $body .= '--'.$boundary.$eol;
                $body .= 'Content-Type: '.$_FILES[$key]['type'].'; name='.$_FILES[$key]['name'].$eol;
                $body .= 'Content-Transfer-Encoding: base64'.$eol;
                $body .= 'Content-Disposition: attachment; filename='.$_FILES[$key]['name'].$eol;
                $body .= $eol.chunk_split(base64_encode(file_get_contents($_FILES[$key]['tmp_name']))).$eol;
             }
         }
      }
      $body .= '--'.$boundary.'--'.$eol;
      if ($mailto != '')
      {
         mail($mailto, $subject, $body, $header);
      }
      $search = array("ä", "Ä", "ö", "Ö", "ü", "Ü", "ß", "!", "§", "$", "%", "&", "/", "\x00", "^", "°", "\x1a", "-", "\"", " ", "\\", "\0", "\x0B", "\t", "\n", "\r", "(", ")", "=", "?", "`", "*", "'", ":", ";", ">", "<", "{", "}", "[", "]", "~", "²", "³", "~", "µ", "@", "|", "<", "+", "#", ".", "´", "+", ",");
      $replace = array("ae", "Ae", "oe", "Oe", "ue", "Ue", "ss");
      foreach($_POST as $name=>$value)
      {
         $name = str_replace($search, $replace, $name);
         $name = strtoupper($name);
         $form_data[$name] = $value;
      }
      mysql_connect($mysql_server, $mysql_username, $mysql_password) or die('Failed to connect to database server!<br>'.mysql_error());
      mysql_query("CREATE DATABASE IF NOT EXISTS $mysql_database");
      mysql_select_db($mysql_database) or die('Failed to select database<br>'.mysql_error());
      mysql_query("CREATE TABLE IF NOT EXISTS $mysql_table (ID int(9) NOT NULL auto_increment, `DATESTAMP` DATE, `TIME` VARCHAR(8), `IP` VARCHAR(15), `BROWSER` TINYTEXT, PRIMARY KEY (id))");
      foreach($form_data as $name=>$value)
      {
         mysql_query("ALTER TABLE $mysql_table ADD $name VARCHAR(255)");
      }
      mysql_query("INSERT INTO $mysql_table (`DATESTAMP`, `TIME`, `IP`, `BROWSER`)
                   VALUES ('".date("Y-m-d")."',
                   '".date("G:i:s")."',
                   '".$_SERVER['REMOTE_ADDR']."',
                   '".$_SERVER['HTTP_USER_AGENT']."')")or die('Failed to insert data into table!<br>'.mysql_error()); 
      $id = mysql_insert_id();
      foreach($form_data as $name=>$value)
      {
         mysql_query("UPDATE $mysql_table SET $name='".mysql_real_escape_string($value)."' WHERE ID=$id") or die('Failed to update table!<br>'.mysql_error());
      }
      mysql_close();
      header('Location: '.$success_url);
      exit;
   }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Users</title>
<meta name="generator" content="WYSIWYG Web Builder 9 - http://www.wysiwygwebbuilder.com">
<style type="text/css">
body
{
   background-color: #FFFFFF;
   color: #000000;
   font-family: Arial;
   font-size: 13px;
   margin: 0;
   padding: 0;
}
</style>
<style type="text/css">
a
{
   color: #0000FF;
   text-decoration: underline;
}
a:visited
{
   color: #800080;
}
a:active
{
   color: #FF0000;
}
a:hover
{
   color: #0000FF;
   text-decoration: underline;
}
</style>
<style type="text/css">
#wb_Form1
{
   background-color: #FAFAFA;
   border: 0px #000000 solid;
}
#wb_Text1 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text1 div
{
   text-align: left;
}
#Editbox1
{
   border: 1px #A9A9A9 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
#Button1
{
   border: 1px #A9A9A9 solid;
   background-color: #F0F0F0;
   color: #000000;
   font-family: Arial;
   font-size: 13px;
}
</style>
</head>
<body>
<div id="wb_Form1" style="position:absolute;left:4px;top:3px;width:314px;height:302px;z-index:3;">
<form name="UsersForm" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" id="Form1">
<div id="wb_Text1" style="position:absolute;left:10px;top:15px;width:74px;height:16px;z-index:0;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">User Name:</span></div>
<input type="text" id="Editbox1" style="position:absolute;left:94px;top:15px;width:198px;height:23px;line-height:23px;z-index:1;" name="username" value="" placeholder="User Name">
<input type="submit" id="Button1" name="" value="Submit" style="position:absolute;left:75px;top:74px;width:96px;height:25px;z-index:2;">
</form>
</div>
</body>
</html>