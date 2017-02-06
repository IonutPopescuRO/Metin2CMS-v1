<?php
  error_reporting(0);
  require("inc/current_version.php");
?>
<!DOCTYPE html>
<html lang="ro">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Instalare - Metin2 CMS</title>
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
        <a class="navbar-brand" rel="home" href="http://metin2cms.cf/"><span class="glyphicon glyphicon-home"></span> Metin2 CMS</a>
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		</button>
	</div>
	<div class="collapse navbar-collapse">
		<ul class="nav navbar-nav">
			<li><a href="http://metin2cms.cf/changelog">ChangeLog</a></li>
			<li><a href="http://metin2cms.cf/raport">Raportează erori</a></li>
		</ul>
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
				<span class="label label-success">Instalare</span>
			</li>
            <li class="list-group-item">
				Conturi create: 
				<span class="badge"><b>0</b></span>			</li>
            <li class="list-group-item">
				Caractere create: 
				<span class="badge"><b>0</b></span>			</li>
            <li class="list-group-item">
				Jucători online: 
				<span class="badge"><b>0</b></span>			</li>
          </ul>        </div>
        <hr>
        <div class="panel panel-default">
         	<div class="panel-heading">Echipa Serverului</div>
				         	<div class="panel-body">
			<table class="table table-striped">
			
<thead>
              <tr>
                <th>Nume</th>
                <th>Nivel</th>
                <th>Regat</th>
              </tr>
            </thead>			
            <tbody>

<tr><td><a href="http://metin2cms.cf/">Metin2 CMS</a></td><td>105</td><td><img src="images/regat/3.jpg"></td></tr>            </tbody>
          </table>
</div>
        </div>
			        <hr>
        <div class="panel panel-default">
         	<div class="panel-heading">Facebook - Fi sociabil!</div>
         	<div class="panel-body">
         	<div class="facebook">
         	    <iframe src="//www.facebook.com/plugins/likebox.php?href=http://facebook.com/IonutPopescu.Ro&amp;width=700&amp;height=250&amp;colorscheme=light&amp;show_faces=true&amp;border_color=%23ffffff&amp;stream=false&amp;header=false" style="overflow:hidden; width:700px; height:250px;"></iframe>
         	</div>
			</div>
        </div>			        <hr>
        <div class="panel panel-default">
         	<div class="panel-heading">Prezentare server</div>
         	<div class="panel-body">
         	<div class="facebook">
         	    <div class="video-container"><iframe src="http://www.youtube.com/embed/bkn3JM6_4cI" frameborder="0" width="560" height="315"></iframe></div>
         	</div>
			</div>
        </div>  </div><!--/left-->
  
  <!--center-->
  <div class="col-sm-6">
		<div class="well">
<?PHP
function createHpTables() {

  global $sqlHp;
  require('./inc/temp.php');
  echo'<p><b>Baza de date Site</b></p>';
  
  $cmdHp=array();
  $cmdHp[] = "CREATE TABLE IF NOT EXISTS `ban_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `time` text NOT NULL,
  `reason` text NOT NULL,
  `type` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
  );";
  
  $cmdHp[] = "CREATE TABLE IF NOT EXISTS `coupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) NOT NULL,
  `coupon` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
);";
  
  $cmdHp[] = "CREATE TABLE IF NOT EXISTS `coupons_validated` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` int(11) NOT NULL,
  `by_name` text NOT NULL,
  `coupon` text NOT NULL,
  `date` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
  );";
  
  $cmdHp[] = "CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `full_content` text NOT NULL,
  `date_added` text NOT NULL,
  PRIMARY KEY (`id`)
  );";  
  
  $cmdHp[] = "CREATE TABLE IF NOT EXISTS `presentation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `message` text NOT NULL,
  `date` text NOT NULL,
  PRIMARY KEY (`id`)
  );";    
  
  $cmdHp[] = "CREATE TABLE IF NOT EXISTS `ishop_categorii` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nume` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
);";  

  $cmdHp[] = "INSERT INTO `ishop_categorii` (`id`, `nume`) VALUES
(1, 'Iteme noi'),
(2, 'Iteme upgrade'),
(3, 'Arme'),
(4, 'Armuri'),
(5, 'Accesorii'),
(6, 'Animale de companie'),
(7, 'Animale de calarit'),
(8, 'Costume'),
(9, 'Frizuri'),
(10, 'Scuturi speciale'),
(11, 'Pietre speciale'),
(12, 'Altele');";  
  
  $cmdHp[] = "CREATE TABLE IF NOT EXISTS `item_ishop` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nume_item` varchar(255) NOT NULL,
  `categorie` int(11) DEFAULT NULL,
  `descriere` varchar(255) DEFAULT NULL,
  `pret` int(11) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `buc` int(11) DEFAULT NULL,
  `owner_id` int(11) unsigned NOT NULL DEFAULT '0',
  `window` enum('INVENTORY','EQUIPMENT','SAFEBOX','MALL') NOT NULL DEFAULT 'INVENTORY',
  `pos` smallint(5) unsigned NOT NULL DEFAULT '0',
  `count` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `vnum` int(11) unsigned NOT NULL DEFAULT '0',
  `socket0` int(10) unsigned NOT NULL DEFAULT '0',
  `socket1` int(10) unsigned NOT NULL DEFAULT '0',
  `socket2` int(10) unsigned NOT NULL DEFAULT '0',
  `socket3` int(10) unsigned NOT NULL DEFAULT '0',
  `socket4` int(10) unsigned NOT NULL DEFAULT '0',
  `socket5` int(10) unsigned NOT NULL DEFAULT '0',
  `attrtype0` tinyint(4) NOT NULL DEFAULT '0',
  `attrvalue0` smallint(6) NOT NULL DEFAULT '0',
  `attrtype1` tinyint(4) NOT NULL DEFAULT '0',
  `attrvalue1` smallint(6) NOT NULL DEFAULT '0',
  `attrtype2` tinyint(4) NOT NULL DEFAULT '0',
  `attrvalue2` smallint(6) NOT NULL DEFAULT '0',
  `attrtype3` tinyint(4) NOT NULL DEFAULT '0',
  `attrvalue3` smallint(6) NOT NULL DEFAULT '0',
  `attrtype4` tinyint(4) NOT NULL DEFAULT '0',
  `attrvalue4` smallint(6) NOT NULL DEFAULT '0',
  `attrtype5` tinyint(4) NOT NULL DEFAULT '0',
  `attrvalue5` smallint(6) NOT NULL DEFAULT '0',
  `attrtype6` tinyint(4) NOT NULL DEFAULT '0',
  `attrvalue6` smallint(6) NOT NULL DEFAULT '0',
  `img` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `owner_id_idx` (`owner_id`),
  KEY `item_vnum_index` (`vnum`)
);";  
  
  $cmdHp[] = "CREATE TABLE IF NOT EXISTS `log_buyishop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nume_cumparator` varchar(255) NOT NULL,
  `item_cumparat` varchar(255) NOT NULL,
  `data_cumpararii` datetime NOT NULL,
  PRIMARY KEY (`id`)
);";  
  
  $cmdHp[] = "INSERT INTO `presentation` (`id`, `title`, `message`, `date`) VALUES
(1, '', '', '');";  
  
  $cmdHp[] = "CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `value` text NOT NULL,
  UNIQUE KEY `id` (`id`)
  );";

  $cmdHp[] = "INSERT INTO `settings` (`id`, `name`, `value`) VALUES
(1, 'Titlu', '".$webTemp['titlu']."'),
(2, 'Cate noutati se afiseaza pe pagina?', '".$webTemp['news']."'),
(3, 'Modul Serverului', '".$webTemp['mod_sv']."'),
(4, 'Link! Descarcare Client Web', '".$webTemp['download_web']."'),
(5, 'Link! Descarcare Client Torrent', '".$webTemp['download_torrent']."'),
(6, 'Link! Facebook', '".$webTemp['facebook']."'),
(7, 'Cod Prezentare YouTube', '".$webTemp['youtube']."'),
(8, 'Inregistrare activa?', '".$webTemp['reg']."'),
(9, 'Link Forum.', '".$webTemp['forum']."'),
(10, 'Pozitie chat.', '".$webTemp['chat_location']."'),
(11, 'Pagina de donatii', '');";
 
  foreach($cmdHp AS $blub) {
    echo '<p style="font-size:11px;">'.$blub;
    $aktQry = mysqli_query($sqlHp, $blub);
    if($aktQry) 
    {
      echo '<div class="alert alert-success" role="alert">
				<strong>Gata</strong>.
			</div>';    }
    else
    {
      echo '<div class="alert alert-danger" role="alert">
				<strong>Deja existent</strong>.
			</div>';
      echo ((is_object($sqlHp)) ? mysqli_error($sqlHp) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false));
      echo'</a>';
    }
    echo'</p>';
  }
}

function createGsTables() {

  echo'<p><b>Bază de date - Joc</b></p>';
  
  global $sqlServ;

  $cmdGS=array();

  $cmdGS[]="ALTER TABLE account.account 
    ADD `coins` int(11) NOT NULL DEFAULT '0';";
    
  $cmdGS[]="ALTER TABLE account.account 
    ADD `web_admin` int(1) NOT NULL DEFAULT '0';";
   
  $cmdGS[]="ALTER TABLE account.account 
    ADD `real_name` varchar(15) NOT NULL;";
    
  $cmdGS[]="ALTER TABLE account.account
    ADD `passlost_token` varchar(32) NOT NULL;";
	
  $cmdGS[]="ALTER TABLE account.account
    ADD `passchange_token` varchar(32) NOT NULL;";
	
  $cmdGS[]="ALTER TABLE account.account
    ADD `new_email_change` varchar(64) NOT NULL;";
	
  $cmdGS[]="ALTER TABLE account.account
    ADD `new_email_change2` varchar(32) NOT NULL;";
  
  foreach($cmdGS AS $blub) {
    echo '<p style="font-size:11px;">'.$blub;
    $aktQry = mysqli_query($sqlServ, $blub);
    if($aktQry) 
    {
      echo '<div class="alert alert-success" role="alert">
				<strong>Gata</strong>.
			</div>';
    }
    else
    {
      echo '<div class="alert alert-danger" role="alert">
				<strong>Deja existent</strong>.
			</div>';
      echo'</a>';
    }
    echo'</p>';
  }
}

if(isset($_GET['step']) && !empty($_GET['step'])) {

  if($_GET['step']==1) {
    ?>
	<div style="text-align:left;" class="page-header">
		<h1>Datele serverului</h1>
	</div>
   
    <form action="install.php?step=2" method="POST">
	<div class="alert alert-info" role="alert">
        <strong>Informație!</strong> Dacă nu vreți să puneți acum linkurile de descărcare / FaceBook-ul sau prezentarea youtube, lăsați necompletat! Acestea nu vor apărea!
      </div>
	<div class="alert alert-info" role="alert">
        <strong>Informație!</strong> La pagina de facebook postați numai ce urmează după <strong>http://facebook.com/</strong> ex: http://facebook.com/IonutPopescu.RO , punem: <strong>IonutPopescu.RO</strong>.
      </div>
	<div class="alert alert-info" role="alert">
        <strong>Informație!</strong> La prezentare YouTuve puneți doar codul video. Exemplu: <strong>https://www.youtube.com/watch?v=bkn3JM6_4cI</strong>, punem: <strong>bkn3JM6_4cI</strong>.
      </div>
	<div class="alert alert-warning" role="alert">
		<strong>Atenție!</strong> Nu mai folosiși ca bază de date pentru CMS 'account'. Creați altă bază de date! Indicat o bază de date de la webhost-ul site-ului.</strong>.
	  </div>
      <table>
        <tr>
          <td>Numele serverului</td>
          <td><input type="text" size="20" maxlength="50" placeholder="Metin2..." class="form-control" name="titlu"/></td>
        </tr>	  
        <tr>
          <td>Număr noutăți pe pagină</td>
          <td><input type="number" size="20" maxlength="50" value="5" placeholder="Noutăți pe pagină..." class="form-control" name="news"/></td>
        </tr>	  
        <tr>
          <td>Mod Server</td>
          <td><input type="text" size="20" maxlength="50" placeholder="PvP / PvM..." class="form-control" name="mod_sv"/></td>
        </tr>	  
        <tr>
          <td>Link descărcare Web</td>
          <td><input type="text" size="20" maxlength="50" placeholder="Link..." class="form-control" name="download_web"/></td>
        </tr>	  
        <tr>
          <td>Link descărcare Torrent</td>
          <td><input type="text" size="20" maxlength="50" placeholder="Link..." class="form-control" name="download_torrent"/></td>
        </tr>	  
        <tr>
          <td>Pagină de facebook</td>
          <td><input type="text" size="20" maxlength="50" placeholder="FaceBook..." class="form-control" name="facebook"/></td>
        </tr>	  
        <tr>
          <td>Prezentare youtube</td>
          <td><input type="text" size="20" maxlength="50" placeholder="YouTube..." class="form-control" name="youtube"/></td>
        </tr>	  
        <tr>
          <td>Înregistrare activă?</td>
          <td><select name="reg" class="form-control">
				<option selected="selected" value="da">DA</option>
				<option value="nu">NU</option>
			  </select>
		  </td>
        </tr>
        <tr>
          <td>Link forum</td>
          <td><input type="text" size="20" maxlength="50" placeholder="http://..." class="form-control" name="forum"/></td>
        </tr>	
        <tr>
			<th style="text-align:left;" class="page-header">
				<h1>Chat</h1>
			</th>
        </tr>
        <tr>
          <td>Doriți chat?</td>
          <td><select name="chat_location" id="chat_location" class="form-control">
				<option selected="selected" value="0">Dezactivat</option>
				<option value="1">Prima pagină - SUS</option>
				<option value="2">Prima pagină - JOS</option>
				<option value="3">Pe pagina de chat</option>
			  </select>
		  </td>
        </tr>
        <tr>
          <td>Numărul de mesaje care să apară</td>
          <td><input type="number" class="form-control" size="20" maxlength="50" value="5" name="postlimit"/></td>
        </tr>
        <tr>
          <td>Câte secunde se așteaptă între postări?</td>
          <td><input type="number" class="form-control" size="20" maxlength="50" value="6" name="timelimit"/></td>
        </tr>
        <tr>
          <td>Numărul maxim de caractere în postări</td>
          <td><input type="number" class="form-control" size="20" maxlength="50" value="100" name="maxline"/></td>
        </tr>
        <tr>
          <td>În câte secunde se reîmprospatează chat-ul?</td>
          <td><input type="number" class="form-control" size="20" maxlength="50" value="5" name="refresh"/></td>
        </tr>
        <tr>
			<th style="text-align:left;" class="page-header">
				<h1>Bază de date server</h1>
			</th>
        </tr>
        <tr>
          <td>SQL-Server (Server Joc)</td>
          <td><input type="text" class="form-control" size="20" maxlength="50" name="sqlserver_game"/></td>
        </tr>
        <tr>
          <td>SQL-Utilizator (Server Joc)</td>
          <td><input type="text" class="form-control" size="20" maxlength="50" name="sqluser_game"/></td>
        </tr>
        <tr>
          <td>SQL-Parolă (Server Joc)</td>
          <td><input type="text" class="form-control" size="20" maxlength="50" name="sqlpass_game"/></td>
        </tr>
        <tr>
			<th style="text-align:left;" class="page-header">
				<h1>Bază de date CMS</h1>
			</th>
        </tr>
        <tr>
          <td>SQL-Server (CMS)</td>
          <td><input type="text" class="form-control" size="20" maxlength="50" name="sqlserver_hp"/></td>
        </tr>
        <tr>
          <td>SQL-Utilizator (CMS)</td>
          <td><input type="text" class="form-control" size="20" maxlength="50" name="sqluser_hp"/></td>
        </tr>
        <tr>
          <td>SQL-Parolă (CMS)</td>
          <td><input type="text" class="form-control" size="20" maxlength="50" name="sqlpass_hp"/></td>
        </tr>
        <tr>
          <td>SQL-Bază de date (CMS)</td>
          <td><input type="text" class="form-control" size="20" maxlength="50" name="sqldb_hp"/></td>
        </tr>
        <tr>
          <td><input type="submit" class="btn btn-success" name="weiter" value="Continuă"/></td>
        </tr>
      </table>
    </form>
    <?PHP
  }
  elseif($_GET['step']==2) {
    
	echo '<div style="text-align:left;" class="page-header">
			<h1>Configurare - Verificare</h1>
		</div>';
	
	$errors = 0;

    $checkGS = new mysqli($_POST['sqlserver_game'], $_POST['sqluser_game'], $_POST['sqlpass_game']);
	
	if ($checkGS->connect_errno) {
		$errors++;
		echo "Nu mă pot conecta la baza de date a serverului.</br>";
		echo '</br><div class="alert alert-danger" role="alert">
				<strong>'.$checkGS->connect_error.'</strong>.
			</div>';
	}
	mysqli_close($checkGS);
	
    $checkCMS = new mysqli($_POST['sqlserver_hp'], $_POST['sqluser_hp'], $_POST['sqlpass_hp'], $_POST['sqldb_hp']);
	
	if ($checkCMS->connect_errno) {
		$errors++;
		echo "Nu mă pot conecta la baza de date a CMS-ului.</br>";
		echo '</br><div class="alert alert-danger" role="alert">
				<strong>'.$checkCMS->connect_error.'</strong>.
			</div>';
	}
	mysqli_close($checkCMS);
	
	if($errors) echo'</br><a href="javascript: history.go(-1)" class="btn btn-warning" role="button">&#171; &Icirc;napoi</a>';
	else {
		foreach($_POST AS $bla=>$bla2)
		{
		  $_POST[$bla]=str_replace('"','\"',$_POST[$bla]);
		  $_POST[$bla]=str_replace("'","\'",$_POST[$bla]);
		}
	  
		$cfgContent ='<?PHP
		
		  DEFINE(\'SQL_HOST\', \''.$_POST['sqlserver_game'].'\'); //Server DB joc
		  DEFINE(\'SQL_USER\', \''.$_POST['sqluser_game'].'\'); //Utilizator DB joc
		  DEFINE(\'SQL_PASS\', \''.$_POST['sqlpass_game'].'\'); //Parola DB joc
		  
		  DEFINE(\'SQL_HP_HOST\', \''.$_POST['sqlserver_hp'].'\'); //Server DB CMS
		  DEFINE(\'SQL_HP_USER\', \''.$_POST['sqluser_hp'].'\'); //Utilizator DB CMS
		  DEFINE(\'SQL_HP_PASS\', \''.$_POST['sqlpass_hp'].'\'); //Parola DB CMS
		  DEFINE(\'SQL_HP_DB\', \''.$_POST['sqldb_hp'].'\'); //Nume DB CMS
		  
		  $serverSettings[\'page_entries\']=10; // Intrari pe pagina
		  
		?>';

		$cfgFile = fopen('./inc/config.php','w+');
		
		$writeCfg = fwrite($cfgFile,$cfgContent);
		
		$cfgTemp ='<?PHP
	   
		  $webTemp[\'titlu\']="'.$_POST['titlu'].'";
		  $webTemp[\'news\']="'.$_POST['news'].'";
		  $webTemp[\'mod_sv\']="'.$_POST['mod_sv'].'";
		  $webTemp[\'download_web\']="'.$_POST['download_web'].'";
		  $webTemp[\'download_torrent\']="'.$_POST['download_torrent'].'";
		  $webTemp[\'facebook\']="'.$_POST['facebook'].'";
		  $webTemp[\'youtube\']="'.$_POST['youtube'].'";
		  $webTemp[\'reg\']="'.$_POST['reg'].'";
		  $webTemp[\'forum\']="'.$_POST['forum'].'";
		  $webTemp[\'chat_location\']="'.$_POST['chat_location'].'";
				
		?>';
		
		$cfgFileTemp = fopen('./inc/temp.php','w+');
		
		$writeTemp = fwrite($cfgFileTemp,$cfgTemp);
		
		$cfgChat ='<?PHP
	  
		$chat_datafile = "chat.dat";
		$chat_postlimit = "'.$_POST['postlimit'].'";	// Numarul de mesaje care sa apara
		$chat_timelimit = "'.$_POST['timelimit'].'";	// Cate secunde se asteapta intre postari?
		$chat_maxline = "'.$_POST['maxline'].'";	// Numarul maxim de caractere in postari
		$chat_refresh = "'.$_POST['refresh'].'";		// In cate secunde se reimprospateaza chat-ul?

		?>';
		
		$cfgFileChat = fopen('./chat/chatconfig.php','w+');
		
		$writeChat = fwrite($cfgFileChat,$cfgChat);
		
		if($writeCfg && $writeTemp && $writeChat)
		{
		  echo'<p>
			<b>Configurația a fost scrisă!</b><br></br>
			<a href="install.php?step=3" class="btn btn-success">Continuă</a>
		  </p>';
		}
	  }
  }
  elseif($_GET['step']==3) {
	echo '<div style="text-align:left;" class="page-header">
			<h1>Adăugare tabele</h1>
		</div>';
    require_once('./inc/config.php');
    
    $sqlHp = new mysqli(SQL_HP_HOST,  SQL_HP_USER,  SQL_HP_PASS);
    $sqlServ = new mysqli(SQL_HOST,  SQL_USER,  SQL_PASS);
    $selectHpDb = ((bool)mysqli_query($sqlHp, "USE " . constant('SQL_HP_DB')));
    
    createHpTables();
    createGsTables();
    
	
$fileArray = array(
    "install.php",
    "inc/temp.php",
);

foreach ($fileArray as $value) {
    if (file_exists($value)) {
        unlink($value);
    }
}
    ?>
   
<div class="alert alert-success" role="alert">
        <strong>Felicitări!</strong> Ai reușit să instalezi cu succes Metin2 CMS!
      </div>
<div class="alert alert-info" role="alert">
        Fișierele install.php și temp.php au fost <strong>șterse</strong>!
      </div>
<a id="submitBtn" class="btn btn-success" type="submit" href="index.php">Pagina principală!</a>
	
<?php } ?>    
    <?PHP
}
else {
?>
  <h2><b>Instalare Metin2 CMS!</b></h2></br>
  
  <p><a id="submitBtn" class="btn btn-success" type="submit" href="install.php?step=1">Începe instalarea!</a>
  </p>
<?PHP
}
?>
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
      <p><b>
        <span class="glyphicon glyphicon-copyright-mark"></span> Powered by <a href="http://metin2cms.cf/">Metin2CMS</a> V <?php echo $current_version ?>
      </b></p>
    </div><!--/FOOTER-->
	
	 </div>

 </div>
	</body>
</html>