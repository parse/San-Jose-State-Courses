<?php 
require_once('inc/init.php');

$title = "Editing";

if (isset($_POST['title'])) {
  if (isset($_POST['entry_id'])) {
    $result = pg_prepare($connection, "update_query", "UPDATE blog SET title = $1, textentry = $2 WHERE ID = $3 AND user_id = $4");
    $result = pg_execute($connection, "update_query", array( $_POST['title'], $_POST['content'], $_POST['entry_id'], $_SESSION['user_id'] ) );
  } else {
    $result = pg_prepare($connection, "insert_query", "INSERT INTO blog (user_id, title, textentry, score) VALUES ($1, $2, $3, $4)");
    $result = pg_execute($connection, "insert_query", array( $_SESSION['user_id'], $_POST['title'], $_POST['content'], 0 ) );    
  }
  
  header("location: view.php");
  die();
  
} else if (isset($_GET['ID'])) {
  $result = pg_prepare($connection, "entry_query", 'SELECT * FROM blog WHERE ID = $1 AND user_id = $2 LIMIT 10');
  $result = pg_execute($connection, "entry_query", array( $_GET['ID'], $_SESSION['user_id'] ) );
  $row = pg_fetch_assoc($result);

  if (isset($row) && !is_array($row)) {
    $edit = false;
    require_once('inc/tpl/header.php'); 
    echo "Permission error";
    require_once('inc/tpl/footer.php'); 
    die();
  } else {
    $edit = true;
  }
} else {
  $edit = false;
}

require_once('inc/tpl/header.php'); 
?>

<?php if ($edit) :?>
  <h2>Edit entry</h2>
<?php else : ?>
  <h2>New entry</h2>
<?php endif; ?>

<form action="edit.php" method="post" id="entryform">
  <p><label for="title">Title</label> <input type="text" name="title" id="title" <?php if ($edit) echo "value=\"" . $row['title'] . "\""; ?>></p>
  <p><label for="content">Content</label> <textarea name="content" id="content"><?php if ($edit) echo $row['textentry']; ?></textarea></p>
  <?php if ($edit) :?>
    <input type="hidden" name="entry_id" value="<?php echo $row['id'];?>" />
  <?php endif; ?>
  <input type="submit" value="<?php if ($edit) :?>Edit entry<?php else: ?>Post entry<?php endif; ?>" />
</form>
<?php
require_once('inc/tpl/footer.php');