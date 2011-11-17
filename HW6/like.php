<?php
require_once('inc/init.php');

$result = pg_prepare($connection, "auth_query", 'SELECT * FROM likes WHERE user_id = $1 AND entry_id = $2');
$result = pg_execute($connection, "auth_query", array( $_SESSION['user_id'], $_GET['entry_id'] ) );
$row    = pg_fetch_row($result);

if ( $row[0] > 0 ) { 
  // User has already liked this entry, delete the old like and update score
  $result = pg_prepare($connection, "delete_query", "DELETE FROM likes WHERE entry_id = $1 AND user_id = $2");
  $result = pg_execute($connection, "delete_query", array( $_GET['entry_id'] , $_SESSION['user_id']) );    
  
  $result = pg_prepare($connection, "update_query", "UPDATE entries SET score = score - 1 WHERE ID = $1");
  $result = pg_execute($connection, "update_query", array( $_GET['entry_id'] ) );
} else {
  // User has not liked this entry, so add it to the score
  $result = pg_prepare($connection, "insert_query", "INSERT INTO likes (user_id, entry_id) VALUES ($1, $2)");
  $result = pg_execute($connection, "insert_query", array( $_SESSION['user_id'], $_GET['entry_id'] ) );    
  
  $result = pg_prepare($connection, "update_query", "UPDATE entries SET score = score + 1 WHERE ID = $1");
  $result = pg_execute($connection, "update_query", array( $_GET['entry_id'] ) );
}

header("location: " . $_SERVER['HTTP_REFERER']);
die();