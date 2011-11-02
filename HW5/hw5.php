<?php
/*
 * This file is separated into two parts:
 * 1) The AJAX response generating a JSON string
 * 2) The HTML output that requests the JSON data
 *
 * You can access the raw JSON response by adding the querystring 'raw' to the http query, for example:
 * http://cs174.dev/hw5.php?rand_id=abc&code=coffee17&raw
 */
 
$rand_id = $_GET['rand_id'];
$code = $_GET['code'];

/* Check if we go into AJAX mode  */
if (
    !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' || 
    isset($_GET['raw']) 
  ) {
    
  if (!isset($_GET['raw'])) sleep(0); // To emulate delay
  $physical_file_code = file_get_contents('./magic.txt');

  // Authorize
  if ($physical_file_code !== $code) {
    header('HTTP/1.1 403 Forbidden');
    die();
  }
  
  // Open handle
  $row = 1;
  $pseudo = array();
  $pseudo_grade_data = array();
  $users = array();
  
  if (($handle = fopen("grades.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    
      // Construct headers
      if ($row == 1) $headers = $data;
    
      if ( ($row != 1 && substr($data[0], 0, 1) !== "$") )
        $users[] = $data[0];
      
      // Construct student record
      if ( ($row != 1 && substr($data[$row], 0, 1) !== "$") && $data[0] == $rand_id)
        $relevant_row = $data;
    
      // Construct pseudo records, find all starting with '$'    
      if (substr($data[0], 0, 1) == "$") {
        foreach ($data as $key => $value) {
          // Ignore the header
          if ($key != $data[0]) 
            $pseudo_grade_data[$key] = $value;
        }
      
        $pseudo[substr($data[0],1)] = $pseudo_grade_data;
      }
      
      $row++;
    }
  
    fclose($handle);
  }

  // Check if user is found or not
  if (!in_array($rand_id, $users)) {
    header("HTTP/1.1 404 Not Found");
    die();
  }
  
  
  // Construct array for the students grade
  $grade = array();
  foreach ($headers as $key => $value) {
    $grade[$value] = $relevant_row[$key];
  }

  // Construct finished JSON array to encode
  $json_array = array('grade' => $grade, 'pseudo' => $pseudo);
  $json_string = json_encode($json_array);

  if (!isset($_GET['raw'])) header("content-type: text/json");
  die($json_string);
}
?><!DOCTYPE html>
<!--[if lt IE 7 ]> <html dir="ltr" lang="sv-SE" class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html dir="ltr" lang="sv-SE" class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html dir="ltr" lang="sv-SE" class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html dir="ltr" lang="sv-SE" class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html dir="ltr" lang="sv-SE"> <!--<![endif]-->
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Homework #5</title>
  
  <link rel="stylesheet" href="style.css" type="text/css">
  
  <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js'></script>
  <script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js"></script>
  
  <script type="text/javascript">
  $(document).ready(function() {    
    // Fire away JSON request
    var jqxhr = $.getJSON('hw5.php?code=<?php echo $code; ?>&rand_id=<?php echo $rand_id; ?>', function(data) {
      // Add data to template that we're sure of, ugly way to do it. Should use a templating system
        // such as mustache.js (https://github.com/janl/mustache.js/)
        $('#first').html(data.grade.FIRST);
        $('#last').html(data.grade.LAST);
        $('#q1').html(data.grade.Q1);
        $('#q2').html(data.grade.Q2);
        $('#q3').html(data.grade.Q3);
        $('#m1').html(data.grade.M1);

        // Map up and add all the other items we're not sure the format of
        var items = [];
        var temp_items = [];

        $.each(data.pseudo, function(key, val) {
          $.each(val, function(key, val) {
            temp_items.push(val);
          });

          items.push('<strong>' + key + '</strong>: ' + temp_items.join(", ") + '<br />');

          // Reset array for pseudo data
          temp_items = [];
        });

        $('<ul/>', {
          'class': 'pseudo-list',
          html: items.join('')
        }).appendTo('#pseudo_placeholder');
        
        // Hide loading bar
        $('#loading').hide();
        $('#ajax_data').show();  
    })
    .error(function(x,y) { 
      if (x.status == 403) {
        $('#loading').html('You\'re not authorized to view this record');
      } else if (x.status == 404) {
        $('#loading').html('The id you requested does not exist');
      }
    });
  });
    
  </script>
</head>
<body>
  <div id="wrapper">

    <div id="header">
      <h1>Homework 5</h1>
    </div>

    <div id="content" class="clearfix">  
      <div id="loading">Please wait while we fetch your JSON data.<br />This is slowed down on purpose by a sleep in the JSON respose.</div>
      
      <div id="ajax_data">
        <div id="grade_box" class="column grid-12">
          <div id="profile">
            <h2>Profile</h2>
            <strong>Firstname:</strong> <div id="first"></div><br />
            <strong>Lastname:</strong> <div id="last"></div>
          </div>
        
          <div id="grades">
            <h2>Grades</h2>
            <strong>Q1: </strong> <div id="q1"></div><br />
            <strong>Q2: </strong> <div id="q2"></div><br />
            <strong>Q3: </strong> <div id="q3"></div><br />
            <strong>M1: </strong> <div id="m1"></div>
          </div>
        
          <div id="pseudo">
            <h2>Pseudo values</h2>
            <p>(Scores can be empty when student <br />was absent or a grade wasn't scored)</p>
            <div id="pseudo_placeholder"></div>
          </div>
        </div>
      </div>

    </div>

    <div id="footer">
      <p>Built with love by Anders Hassis</p>
    </div>

  </div>
</body>
</html>