<?php
$hostname = "192.168.0.10";
$database = "newbiopacs";
$username = "postgres";
$password = "justgoon";
$port = "5432";
$dbconn = pg_connect("host=$hostname port=$port dbname=$database user=$username password=$password") or die('NO HAY CONEXION: ' . pg_last_error());

$sql = "SELECT users.id, users.realname AS name FROM users";


$result = pg_query($sql) or die("SQL Error 1: " . pg_last_error());
while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
	$id = $row['id'];
	$name = $row['name'];
	$doctors['data'][] = array($id,$name);
}
echo json_encode($doctors);
?>