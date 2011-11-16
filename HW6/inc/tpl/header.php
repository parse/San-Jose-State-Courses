<!DOCTYPE html>
<!--[if lt IE 7 ]> <html dir="ltr" lang="sv-SE" class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html dir="ltr" lang="sv-SE" class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html dir="ltr" lang="sv-SE" class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html dir="ltr" lang="sv-SE" class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html dir="ltr" lang="sv-SE"> <!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php if (isset($title)) { echo $title . " - "; } ?>Homework #6</title>
    <link rel="stylesheet" href="static/stylesheets/normalize.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="static/stylesheets/style.css" type="text/css" media="screen" />
</head>
<body>
		<div id="wrapper">

			<div id="header">
				<h1>Homework 6</h1>
				<?php if (isset($_SESSION['user_id'])) :?>
				<ul id="navigation">
				  <li><a href="view.php">Home</a></li>
				  <li><a href="new.php">New entry</a></li>
				  <li><a href="index.php?logout">Sign out</a></li>
				</ul>
				<?php endif; ?>
			</div>

			<div id="content" class="clearfix">