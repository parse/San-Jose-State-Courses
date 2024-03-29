<?php
session_start();

$connection = pg_connect("host=localhost port=5432 dbname=socialdb user=abcd password=abcd");
if (!$connection) {
  die("An error occured.\n");
}

function get_username ($user_id) {
  global $connection;
  $result = pg_prepare($connection, "", 'SELECT * FROM profiles WHERE ID = $1');
  $result = pg_execute($connection, "", array( $user_id ) );
  $row    = pg_fetch_assoc($result);
  
  if (!empty($row['username']))
    return htmlentities($row['username']);
  else 
    return;
}

function user_already_liked ($user_id, $entry_id) {
  global $connection;
  $result = pg_prepare($connection, "", 'SELECT * FROM plusones WHERE user_id = $1 AND entry_id = $2');
  $result = pg_execute($connection, "", array( $user_id, $entry_id ) );
  $row    = pg_fetch_row($result);

  if ( $row[0] > 0 ) { 
    return true;
  } else {
    return false;
  }
}

function safe_html ($text) {
  return htmlentities($text);
}
