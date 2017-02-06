<?PHP
	error_reporting(0);
	session_start();
	require 'inc/config.php';
	require 'inc/rights.php';
	require 'inc/functions.php';
	require 'inc/current_version.php';
	require 'inc/security.php';
	require 'inc/email.php';
?>
<!DOCTYPE html>
<html lang="ro">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title><?php include("user/name_sv.php"); echo " - Page "; page_name(); ?></title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		
<?php
	$adm = isset($_GET['a']) ? sanitize($_GET['a']) : null;
	if($adm) { 
	if($_GET['a'] == "news" or $_GET['a'] == "news_edit" or $_GET['a'] == "presentation" or $_GET['a'] == "donate") { ?>
		<script src="ckeditor/ckeditor.js"></script>
		<script src="ckeditor/build-config.js"></script>
<?php
} }
?>
<?php
	$adm = isset($_GET['a']) ? sanitize($_GET['a']) : null;
	if($adm) { 
	if($_GET['a'] == "add_shop" or $_GET['a'] == "news_edit" or $_GET['a'] == "presentation") { ?>
        <link href="css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="js/fileinput.js" type="text/javascript"></script>
<?php
} }
?>
		<!-- Favicon -->
		<link rel="shortcut icon" href="images/favicon.ico" />
		<link rel="icon" type="image/gif" href="images/favicon.ico" />
	
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
	</head>
	<body>
		Metin2CMS
	 <div id="btop">
 <div id="bbtm">
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="navbar-header">
        <a class="navbar-brand" rel="home" href="index.php"><span class="glyphicon glyphicon-home"></span> <?php include("user/name_sv.php"); ?></a>
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		</button>
	</div>
		<?php include("user/navbar.php"); ?>
</nav>
<div id="wrapper">
	 	<!-- header -->
		<div id="header">
			<!-- logo -->
			<a id="logo" href="index.php" title="metin2"><img src="images/logo.png" alt="Metin2" /></a>
		</div></div>


<div class="container-fluid">
  
  <!--left-->
  
  <?php include("user/sidebar_left.php"); ?>
  
  <!--/left-->
  
  <!--center-->
  <div class="col-sm-6">
  <?php include("user/pages.php"); ?>
  </div><!--/center-->

  <!--right-->
  
  <?php include("user/sidebar_right.php"); ?>

  <!--/right-->
  <hr>
  
</div><!--/container-fluid-->
	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		
		</br></br>
		<!--FOOTER-->
	<div class="mt2cms-footer">
      <p><span class="glyphicon glyphicon-copyright-mark"></span> Copyright <?php echo date('Y');?> <?php include("user/name_sv.php"); ?></p>
      <p>
        Powered by <a href="http://metin2cms.cf/">Metin2CMS</a> V <?php echo $current_version ?>
      </p>
    </div><!--/FOOTER-->
	
	 </div>

 </div>
	</body>
</html>