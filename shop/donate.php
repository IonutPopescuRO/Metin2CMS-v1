<?php
	error_reporting(0);
	session_start();
	include("../inc/config.php");
	include("../inc/functions.php");
			
	$sqlHp = new mysqli(SQL_HP_HOST,  SQL_HP_USER,  SQL_HP_PASS);
	$sqlServ = new mysqli(SQL_HOST,  SQL_USER,  SQL_PASS);
	if(!empty($_SESSION['id']))
		if ($_SESSION['fingerprint'] != md5($_SERVER['HTTP_USER_AGENT'] . 'x' . $_SERVER['REMOTE_ADDR']))
			session_destroy();
if(empty($_SESSION['id'])) {
header("Location: login.php");
				} else {
	$user_id = $_SESSION['id'];
	$get_info = mysqli_Query($sqlServ, "SELECT * from account.account where login='$user_id'");
	$info = mysqli_fetch_Array($get_info);
	$username = $info['login'];
	$coins = $info['coins'];
	$jcoins = $info['jcoins'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<title>Item-Shop</title>
		<link href="css/style.css" rel="stylesheet" type="text/css" />
		<link href="css/start.css" rel="stylesheet" type="text/css" />
		<link href="css/options.css" rel="stylesheet" type="text/css" />
		<link href="css/discount.css" rel="stylesheet" type="text/css" />
		<link href="css/tiptip.css" rel="stylesheet" type="text/css" />
		<link href="css/fancybox.css" rel="stylesheet" type="text/css" />
		<link href="css/jScrollPane.css" rel="stylesheet" type="text/css" />
		<link href="css/promoted.css" rel="stylesheet" type="text/css" />
		<link href="css/usermenu.css" rel="stylesheet" type="text/css" />
		<link href="css/purchase.css" rel="stylesheet" type="text/css" />
		<link href="css/wheel.css" rel="stylesheet" type="text/css" />

		<!--[if IE]>
		<style type="text/css">@import url(http://gf1.geo.gfsrv.net/cdn9a/6ea1bf4927ebc189a9ad0a0e2d7140.css);</style>
		<style type="text/css">@import url(http://gf1.geo.gfsrv.net/cdn3e/8a0cdb2c5a2e9c5af58e1dcdee50e7.css);</style>
		<![endif]-->

		<!--[if lte IE 6]>
		<style type="text/css">@import url(http://gf1.geo.gfsrv.net/cdn9b/5338b6f852df99e7b508f046cc25ad.css);</style>
		<style type="text/css">@import url(http://gf3.geo.gfsrv.net/cdnb6/f0c4e2637ede70860c1a273ed38241.css);</style>
		<style type="text/css">@import url(http://gf3.geo.gfsrv.net/cdn58/97c61e083f066422a1ccf00b7e6a02.css);</style>
		<![endif]-->
		<script type="text/javascript" src="http://gf1.geo.gfsrv.net/cdnc8/b5150cf60c980d685b66eb5826dc1d.js"></script>
		<script type="text/javascript" src="http://gf2.geo.gfsrv.net/cdndc/521e7b8821399457f8d2c96bd4d764.js"></script>
		<script type="text/javascript" src="http://gf3.geo.gfsrv.net/cdnbf/7ef645db9fe9c2161d57e2a9684f8c.js"></script>
		<script type="text/javascript" src="http://gf3.geo.gfsrv.net/cdne1/74a2472b07741e6900b40d529efc36.js"></script>
		<script type="text/javascript" src="http://gf1.geo.gfsrv.net/cdn06/c121d2d644f8b6d54b747e69dc319c.js"></script>
		<script type="text/javascript" src="http://gf1.geo.gfsrv.net/cdn92/7b66d958092f8cc1e863c2880d8da6.js"></script>
		<script type="text/javascript" src="http://gf2.geo.gfsrv.net/cdn7e/497adc02ec310555ca02b97c5e5b8a.js"></script>
		<script type="text/javascript" src="http://gf3.geo.gfsrv.net/cdne0/06fa17217edda4ff4898e5e9c27303.js"></script>
		<script type="text/javascript" src="http://gf1.geo.gfsrv.net/cdn99/ae1c0d191bffe28d878d7ec7062da2.js"></script>
</head>
<body class="twoColFixLtHdr" scroll="no" ondblclick="return false;">
	<div id="container">
						<div id="header">
			<div class="boxSigns">
				<span class="heading">Jetoane Dragon (JD):</span>
				<span class="marksValue"><?php echo $jcoins;?></span>
			</div>
			<div class="boxCoins">
				<span class="heading">Monede Dragon (MD):</span>
				<span class="coinsValue"><?php echo $coins;?></span>
				<a href="donate.php" class="purchaseButton" title="Acasă">Prima Pagină</a>
			</div>
		</div>
	
						<ul id="breadcrumb">
						<li><a href="index.php">Acasă</a> » </li><li>Donație<li>
						</ul>
		<div id="sidebar1">
		<ul id="mainMenu">
		<?php
		$get_categorii = mysqli_query($sqlHp, "SELECT * FROM ".SQL_HP_DB.".ishop_categorii");
		while($categorie = mysqli_fetch_object($get_categorii)) {
          echo '<li><a href="categorie.php?id='.$categorie->id.'" title="'.$categorie->nume.'">'.$categorie->nume.'</a></li>';
		}
		?>
			</ul>		
			</div>	
			<div id="mainContent">
						<h1>Detalii despre cum poți face donații</h1>
			<div class="dynContent" style="position:relative">
<?php
	$query = mysqli_query($sqlHp, 'SELECT * FROM '.SQL_HP_DB.'.settings WHERE id="11" ');
	$output = mysqli_fetch_assoc($query);
	if ($output['value'] == "")
	{ echo'Momentan nu a fost creată o paginî pentru donații!'; }
	else {
	echo $output['value']; }
?>
			
					</div>
			<div class="endContent"></div>
			</div>
		</div>	</body>
</html>
<?php
}
?>