<?php
session_start();

require('Pusher-PHP/lib/Pusher.php');

$socket_id = $_POST['socket_id'];
$channel_name = $_POST['channel_name'];

if (!isset($_SESSION['username'])) {
  header('', true, 403);
	echo( "Not authorized" );
	exit();
}

$pusher = new Pusher(
	'e7d087b88621c29a3be6', //APP KEY
	'286b08d1bf25fde2319c', //APP SECRET
	'11647' //APP ID
);

$presence_data = array(
	'username' => $_SESSION['username'],
	'status' => 'n/a'
);

echo $pusher->presence_auth(
	$channel_name, //the name of the channel the user is subscribing to
	$socket_id, //the socket id received from the Pusher client library
	$_SESSION['username'],  //a UNIQUE USER ID which identifies the user
	$presence_data //the data about the person
);
exit();
