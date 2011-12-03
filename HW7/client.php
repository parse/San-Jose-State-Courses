<?php
session_start(); 

if (isset($_GET['login'])) {
  $_SESSION['username'] = $_POST['username'];
  header("location: client.php");
  die();
} elseif (!isset($_SESSION['username'])) {
  header("location: index.php?fail"); 
  die();
}

require_once('tpl/header.php'); ?>
  <form action="send.php" method="post" id="messageform">
  <input type="text" name="message" /><input type="submit" value="Send" />
  </form>
  
  <h3>Latest mood</h3>
  <div id="result"></div>
<div id="online"></div>
	</div>


  </div>
  
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <script src="http://js.pusherapp.com/1.9/pusher.min.js"></script>

  <script type="text/javascript">
     $("#messageform").submit(function(event) {
      event.preventDefault(); 

      var $form = $( this ),
        message = $form.find( 'input[name="message"]' ).val(),
        url = $form.attr( 'action' );

      $.post( url, { message: message },
        function( data ) {
          $( "#result" ).empty().append( thing.username + " says " + thing.message );
        }
      );
    });

    var pusher = new Pusher('e7d087b88621c29a3be6'); 
    var moodChannel = pusher.subscribe('mood-channel');
    
    moodChannel.bind('pusher:subscription_succeeded', function(members) {
      alert("oi");
      console.log(members);
       $( "#online" ).append(members.count );
    })
    
    moodChannel.bind('mood_create', function(mood) {
      $( "#result" ).empty().append( mood.username + " says " + mood.message );
    });
  </script>
</body>
</html>

