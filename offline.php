<?php
  error_reporting(0);
  require("inc/current_version.php");
?>
<!DOCTYPE html>
<html lang="ro">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title><?php echo $_SERVER['SERVER_NAME']; ?> Offline</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
		<!-- Favicon -->
		<link rel="shortcut icon" href="images/favicon.ico" />
		<link rel="icon" type="image/gif" href="images/favicon.ico" />
	</head>
	<body>
		Metin2CMS
	 <div id="btop">
 <div id="bbtm">
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="navbar-header">
        <a class="navbar-brand" rel="home" href="index.php"><span class="glyphicon glyphicon-home"></span> <?php echo $_SERVER['SERVER_NAME']; ?></a>
	</div>

</nav>
<div id="wrapper">
	 	<!-- header -->
		<div id="header">
			<!-- logo -->
			<a id="logo" href="index.php" title="metin2"><img src="images/logo.png" alt="Metin2" /></a>
		</div></div>

<div class="container-fluid">
  
  <!--left-->
<div class="col-sm-3">
        <div class="panel panel-default">
         	<div class="panel-heading">Statistici</div>
				           <ul class="list-group">
            <li class="list-group-item">
				Modul serverului:
				<span class="label label-success">Offline</span>
			</li>
            <li class="list-group-item">
				Conturi create: 
				<span class="badge"><b>-</b></span>			</li>
            <li class="list-group-item">
				Caractere create: 
				<span class="badge"><b>-</b></span>			</li>
            <li class="list-group-item">
				Jucători online: 
				<span class="badge"><b>-</b></span>			</li>
          </ul>        </div>
  </div><!--/left-->
  
  <!--center-->
  <div class="col-sm-6">
		<div class="well">
			<center><img src="images/offline.png"></center></br>
			<div class="alert alert-danger" role="alert">
				<strong>Momentan serverul nostru este offline! Vă rugăm să așteptați pâna revenim.</strong>
			</div>
			<?php
			if (!filesize("mesaj-offline.php") == 0) { 
				echo '<div class="alert alert-info" role="alert"><strong>';
						include 'messages-offline.php';
				echo '</strong></div>';
			} ?>
		</div>
  </div><!--/center-->

  <!--right-->
<div class="col-sm-3">
    	<div class="panel panel-default">
         	<div class="panel-heading">Logare</div>
         	<div class="panel-body">
         	    <center>
		   
			   
						<form name="loginForm" id="loginForm" action="#" method="post">
							<div>
								<label for="username">Nume de utilizator: *</label>
								<input autocomplete="off" class="form-control -webkit-transition" placeholder="Nume" readonly>
							</div>
							<div>
								<label for="password">Parolă: *</label>
								<input autocomplete="off" class="form-control -webkit-transition" placeholder="Parola" readonly>
							</div>

							<br>
							<input id="submitBtn" class="btn btn-success" type="submit" value="Logare">
							<script type="text/javascript">
							</script>
						</form>		
	</center>
  			</div>
        </div>
        <hr>
		
              <div class="panel panel-default">
         	<div class="panel-heading">Clasament</div>
         	<div class="panel-body">

<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
  <li class="active"><a href="#players" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-user"></span>Jucători</a></li>
  <li><a href="#guilds" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-tower"></span>Bresle</a></li>
  <li><a href="#yang" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-star"></span>Yang</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="players">
			<table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Nume</th>
                <th>Nivel</th>
              </tr>
            </thead>
          </table>
  </div>
  <div class="tab-pane" id="guilds">
			<table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Nume</th>
                <th>Nivel</th>
              </tr>
            </thead>
          </table>
  </div>
  <div class="tab-pane" id="yang">
			<table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Nume</th>
              </tr>
            </thead>
          </table>
  </div>
</div>


</div>
        </div>		

  </div><!--/right-->
  <hr>
</div><!--/container-fluid-->
	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		
		</br></br>
		<!--FOOTER-->
	<div class="mt2cms-footer">
      <p>
        <span class="glyphicon glyphicon-copyright-mark"></span> Powered by <a href="http://metin2cms.cf/">Metin2CMS</a> V <?php echo $current_version ?>
      </p>
    </div><!--/FOOTER-->
	
	 </div>

 </div>
	</body>
</html>