<?php 
require_once('inc/init.php');

$title = "Home";

require_once('inc/tpl/header.php'); 
?>

<div class="column grid-6">
  <h2>All latest posts</h2>
  <ul class="posts">

  <?php
  $result = pg_query($connection, "SELECT * FROM entries ORDER BY created_at DESC LIMIT 10"); 
  while ($row = pg_fetch_assoc($result)) : ?>
    <li class="post post_<?php echo $row['id'];?>">
      <h3><?php echo $row['title']; ?></h3>
      <div class="meta">
        <p>
          <small>Posted <?php echo date("Y-m-d H:i", strtotime($row['created_at']) );?> by <?php echo get_username($row['user_id']); ?></small> 
        </p>
      </div>
      <?php echo $row['content']; ?>
      <div class="meta2">
        <small>
          Score: <?php echo $row['score'];?> 
        <?php if ( !user_already_liked($_SESSION['user_id'], $row['id']) ) : ?>
          <a class="like notliked" href="like.php?entry_id=<?php echo $row['id'];?>">+1</a>
        <?php else : ?>
          <a class="like alreadyliked" href="like.php?entry_id=<?php echo $row['id'];?>">-1</a>
        <?php endif; ?> 
        
        <?php if ($row['user_id'] == $_SESSION['user_id']) : ?>
          <a href="edit.php?ID=<?php echo $row['id']; ?>">Edit entry</a>
        <?php endif; ?>
        </small>
      </div>
    </li>
  <?php endwhile; ?>

  </ul>
</div>

<div class="column grid-6">
  <h2>My 3 latest posts</h2>
  <ul class="posts">

  <?php 
  $result = pg_prepare($connection, "ownentries_query", 'SELECT * FROM entries WHERE user_id = $1 LIMIT 10');
  $result = pg_execute($connection, "ownentries_query", array( $_SESSION['user_id'] ) );

  while ($row = pg_fetch_assoc($result)) : ?>
    <li class="post post_<?php echo $row['id'];?>">
      <h3><?php echo $row['title']; ?></h3>
      <div class="meta">
        <p>
          <small>Posted <?php echo date("Y-m-d H:i", strtotime($row['created_at']) );?> by 
          <?php echo get_username($row['user_id']); ?> 
          </small> 
        </p>
      </div>
      <?php echo $row['content']; ?>
      <div class="meta2">
        <small>
          Score: <?php echo $row['score'];?> 
        <?php if ( !user_already_liked($_SESSION['user_id'], $row['id']) ) : ?>
          <a class="like notliked" href="like.php?entry_id=<?php echo $row['id'];?>">+1</a>
        <?php else : ?>
          <a class="like alreadyliked" href="like.php?entry_id=<?php echo $row['id'];?>">-1</a>
        <?php endif; ?> 
        
        <?php if ($row['user_id'] == $_SESSION['user_id']) : ?>
          <a href="edit.php?ID=<?php echo $row['id']; ?>">Edit entry</a>
        <?php endif; ?>
        </small>
      </div>
    </li>
  <?php endwhile; ?>
  
  </ul>
  <p><a href="entries.php">More entries</a></p>
</div>

<?php
require_once('inc/tpl/footer.php');