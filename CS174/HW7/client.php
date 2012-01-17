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
<div class="column grid-10">
  <h2>Welcome <?php echo $_SESSION['username']; ?></h2>
  
  <form action="send.php" method="post" id="messageform">
    <select name="message">
      <option value="Happy">:-)</option>
      <option value="Neutral">:-|</option>
      <option value="Sad">:-(</option>
    </select>
    <input type="submit" value="Send" />
  </form>
  
  <h3>Latest mood</h3>
  
  <div id="result"></div>
   
</div>

<div class="column grid-2">
  <h2>Online</h2>
  <div id="online"></div> <br />
  <div id="count"></div> 
</div>

</div></div>
  
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <script src="http://js.pusherapp.com/1.9/pusher.min.js"></script>

  <script type="text/javascript">
  $().ready(function(){
     $("#messageform").submit(function(event) {
      event.preventDefault(); 

      var $form = $( this ),
        message = $form.find( 'select[name="message"]' ).val(),
        url = $form.attr( 'action' ),
        username = '<?php echo $_SESSION['username']; ?>';

      $.post( url, { message: message },
        function( data ) {
          $( "#result" ).empty().append( username + " is " + message );
        }
      );
    });

    var pusher = new Pusher('e7d087b88621c29a3be6'); 
    Pusher.channel_auth_endpoint = 'pusher_auth.php';
    var moodChannel = pusher.subscribe('presence-channel-1');
    
    moodChannel.bind('pusher:subscription_succeeded', function(members){
      $('#online').empty()
      members.each(add_member);
      $('#count').empty().append( members.count + " users online" );
    })

    moodChannel.bind('pusher:member_removed', function(member){
      $('#presence_' + member.id).remove();
      $('#count').empty().append( moodChannel.members.count + " users online" );
    })

    moodChannel.bind('pusher:member_added', function(member){
      add_member(member);
      $('#count').empty().append( moodChannel.members.count + " users online" );
    })

    moodChannel.bind('mood_create', function(mood) {
      $('#result').empty().append( mood.username + " is " + mood.message );
      $('#presence_' + mood.username).empty().append('<strong>' + mood.username + '</strong><br /><em>' + mood.message + '</em>');
    })
  });
  
  function add_member(member) {
    var content
    var container = $("<div>", {
      "class": "member",
      id: "presence_" + member.id
    })
    content = '<strong>' + member.id + '</strong><br /><em>' + member.info.status + '</em>';

    if (member.username == '<?php echo $_SESSION['username']; ?>') container.addClass("me")
    $('#online').append(container.html(content))
  }
  
  </script>
</body>
</html>

