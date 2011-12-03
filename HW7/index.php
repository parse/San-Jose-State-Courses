<?php require_once('tpl/header.php'); ?>
<h3>Login</h3>
<?php if ( isset($_GET['fail']) ) : ?>
  <strong>Wrong credentials, try again</strong>
<?php elseif ( isset($_GET['loggedout']) ) : ?>
  <strong>Successfully signed out</strong>
<?php endif; ?>

<form action="client.php?login" method="post" id="login">
  <p><label for="username">Nickname</label> <input type="text" name="username" id="username"></p>
  <input type="submit" value="Login" />
</form>
<?php require_once('tpl/footer.php'); ?>