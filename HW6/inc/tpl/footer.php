</div>

<div id="footer">
	<p><?php if (isset($_SESSION['user_id'])) :?>
	Signed in as <strong><?php echo $_SESSION['username']; ?></strong>, 
	<?php endif; ?>
	built with love by Anders Hassis</p>
</div>

</div>
</body>
</html>