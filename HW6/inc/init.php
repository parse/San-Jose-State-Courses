<?php
session_start();

$connection = pg_connect("host=localhost port=5432 dbname=socialdb user=postgres password=testar");
if (!$connection) {
  die("An error occured.\n");
}

function get_username ($user_id) {
  global $connection;
  $result = pg_prepare($connection, "lookup_query", 'SELECT * FROM users WHERE ID = $1');
  $result = pg_execute($connection, "lookup_query", array( $user_id ) );
  $row    = pg_fetch_assoc($result);
  
  if (!empty($row['username']))
    return $row['username'];
  else 
    return;
}