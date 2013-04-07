<?php
session_start();
require_once('bin/config.php');

/*

	Original author: Antti Sirkiä, sirkia.antti@gmail.com
	
*/

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title><?php echo $site_title;?></title>
<meta name="author" content="Antti Sirkiä"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="application-name" content="ASK" />
<link href="libraries/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<link rel="stylesheet" href="css/styles.css" media="screen" />
<script src="js/login_handler.js"></script>
</head>
<body>
<div id="container" class="main">
<div class="widget">
	<div class="widget-header">
		<i class="icon-lock"></i>
		<h3>Kirjaudu sisään</h3>
	
	</div>
</div>


</div> <!-- end of #container -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script src="libraries/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
