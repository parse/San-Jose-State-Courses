<?php
/*
 * Landing page for homework 6
 * @author: Anders Hassis
 * @date: 2011-11-15
 */
 
require_once('inc/init.php');

if ( isset($_GET['register']) ) {
  $result = pg_prepare($connection, "auth_query", 'SELECT * FROM users WHERE username = $1');
  $result = pg_execute($connection, "auth_query", array( $_POST['username'] ) );
  $row    = pg_fetch_row($result);
  
  if ( $row[0] > 0 ) { 
    header("location: register.php?fail");
  } else {
    $password = sha1($_POST['password']);
    $result = pg_prepare($connection, "insert_query", "INSERT INTO users (username, password) VALUES ($1, $2)");
    $result = pg_execute($connection, "insert_query", array($_POST['username'], $password ) );
    header("location: index.php?register");
  }
  
  die();
  
}

$title = "Register";

require_once('inc/tpl/header.php'); ?>

  <h3>Registration</h3>
  <?php if ( isset($_GET['fail']) ) : ?>
    <strong>Username already taken, try again</strong>
  <?php endif; ?>
  
  <p>Please enter your desired username and password below</p>
  <form action="register.php?register" method="post" id="login">
    <p><label for="username">Username</label> <input type="text" name="username" id="username"></p>
    <p><label for="password">Password</label> <input type="password" name="password" id="password"></p>
    <input type="submit" value="Register" />
  </form>
  
  <p><a href="index.php">Back to home</a></p>

<?php require_once('inc/tpl/footer.php'); ?>