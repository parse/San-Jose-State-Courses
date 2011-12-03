<?php
session_start();
error_reporting(E_ALL);
require('Pusher-PHP/lib/Pusher.php');

$pusher = new Pusher('e7d087b88621c29a3be6', '286b08d1bf25fde2319c', '11647');
$pusher->trigger('mood-channel', 'mood_create', array('username' => $_SESSION['username'], 'message' => $_POST['message']) ) ;