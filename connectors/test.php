<?php
include "db.conf.php";
$conn = pg_connect("host=$hostname port=$port dbname=$database user=$username password=$password");
if (!$conn) {
  echo "An error occurred.\n";
  exit;
}

// Listen 'author_updated' message from other processes
pg_query($conn, 'LISTEN users;');
$notify = pg_get_notify($conn);
echo $notify;
if (!$notify) {
  echo "No messages\n";
} else {
  print_r($notify);
}
?>