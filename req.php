<?php
session_start();
if (isset($_POST['deco']))
{
	session_unset();
	session_destroy();
	session_start();
}
$sql = mysql_connect("localhost","root","");
mysql_select_db("agenda",$sql);
?>