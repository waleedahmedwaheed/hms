<?php

 $link = mysql_connect('127.0.0.1:3388', 'root', '');
if (!$link) 
{
    die('Could not connect: ' . mysql_error());
}
else
{
	echo 'Connected successfully';
}
 
/* $connection= mysqli_connect("127.0.0.1:3388", "root@127.0.0.1", "", "hms");
//or die(mysqli_error("error connecting to database"));

if (!$connection) 
{
    die('Could not connect: ' . mysqli_error());
}
else
{
	echo 'Connected successfully';
}
 */
?>