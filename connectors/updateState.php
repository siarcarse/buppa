<?php
include "db.conf.php";
$dbconn = pg_connect("host=$hostname port=$port dbname=$database user=$username password=$password") or die('NO HAY CONEXION: ' . pg_last_error());
$pk = $_REQUEST['pk'];
$sql = "UPDATE study set study_status = 4 where pk = $pk";
pg_query($sql) or die("SQL Error 1: " . pg_last_error());
?>