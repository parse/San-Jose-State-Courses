<?php
/*
 * Landing page for homework 6
 * @author: Anders Hassis
 * @date: 2011-11-15
 */
 
require_once('inc/init.php');

if ( isset($_GET['login']) ) {
  $result = pg_prepare($connection, "auth_query", 'SELECT * FROM profiles WHERE username = $1 AND password = $2');
  $result = pg_execute($connection, "auth_query", array( $_POST['username'], sha1($_POST['password']) ) );
  $row    = pg_fetch_row($result);
  
  if ( $row[0] > 0 ) { 
    $_SESSION['user_id']  = $row[0];
    $_SESSION['username'] = $row[1];
    header("location: view.php");
  } else {
    header("location: index.php?fail");
  }
  
  die();
  
} else if ( isset($_GET['logout']) ) {
  session_destroy();
  header("location: index.php?loggedout");
  die();
}

require_once('inc/tpl/header.php'); ?>
  <h3>Login</h3>
  <?php if ( isset($_GET['fail']) ) : ?>
    <strong>Wrong credentials, try again</strong>
  <?php elseif ( isset($_GET['loggedout']) ) : ?>
    <strong>Successfully signed out</strong>
  <?php elseif ( isset($_GET['register']) ) : ?>
    <strong>Successfully signed up, please login below</strong>
  <?php endif; ?>
  
  <form action="index.php?login" method="post" id="login">
    <p><label for="username">Username</label> <input type="text" name="username" id="username"></p>
    <p><label for="password">Password</label> <input type="password" name="password" id="password"></p>
    <input type="submit" value="Login" />
  </form>

  <p><a href="register.php">Register</a></p>
<?php require_once('inc/tpl/footer.php'); ?>