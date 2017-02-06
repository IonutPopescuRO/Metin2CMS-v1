<?php
	error_reporting (0);
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
	
	if (!isset($_GET['id'])) {
		die("Trebuie sa alegi un item.");  
	}

	$id = isset($_GET['id']) ? $_GET['id'] : null;
	if (!is_numeric($id))
		header('Location: index.php');
	
	$get_iteme = mysqli_query($sqlHp, "SELECT * FROM ".SQL_HP_DB.".item_ishop where id='$id'");
	$item = mysqli_fetch_array($get_iteme);
	if(!count($item))
	{
		echo 'ERROR 404';
		die();
	}
	$pret = $item['pret'];
	$id_item = $item['vnum'];
	$img_item = $item['img']

?>
<div id="fancybox-content" style="border-width: 0px; width: 540px; height: 500px;">
<div style="width:540px;height:500px;overflow: hidden;position:relative;"><h1 class="mainHeadline">
      <?php echo $item['nume_item']; ?>
    </h1><div class="dynContent detail"><div class="box boxLeft visual"><img onerror="this.src='img/error.png';" src="img/items/<?= $img_item ?>.png"></img></div><div class="box desc descOnlyItem"><div class="detailBadge"><div class="detailBadgeInner"> … </div></div><h2>
      <?php echo $item['nume_item']; ?>
    </h2><div class="scrollpane scrollpaneOnlyItem" style="overflow: hidden; padding: 0px; width: 351px;"><div class="jspContainer" style="width: 351px; height: 140px;"><div class="jspPane" style="padding: 0px; top: 0px; width: 351px;"><p>
<?php
	if (empty($item['descriere']))
	{
?>
	Acest obiect nu are descriere.
<?php
	} else { 
?>
<?php echo $item['descriere']; }?>
								</p></div></div></div></div><div class="box boxRight buy onlyItem"><div class="priceSelect"><div class="sprice">
      Preţ: 
    <span id="priceAmount">
      <?php echo $pret; ?>
    </span>
       MD
    </div></div>
	<?php
	if($coins >= $pret){
	?>
<a id="buyItemLink" class="tip assignMarks" href="cumpara.php?id=<?php echo $id; ?>">
      Cumpără!
    </a>
	<?php 
	} else {
	?>
	<a id="buyItemLink" class="blank" style="cursor: default">
      MD insuficient
    </a>
	<?php
	}
	?>
	<div class="buyInfo">
      
				Primeşti 
    <span id="mileageAmount">
      <?php echo $pret; ?>
    </span>
       JD la cumpărarea acestui Item!
			
    </div></div><div class="box suggestions"><h2>
      Recomandări de cumpărare:
    </h2><ol id="suggestions">
	<?php
		$get_recomandare = mysqli_query($sqlHp, "SELECT * FROM ".SQL_HP_DB.".item_ishop 
		ORDER BY rand()
		LIMIT 7");
		while($itemes = mysqli_fetch_object($get_recomandare)) {
?>
	<li class="thumbnailBgSmall">
	<a id="suggestion11979" class="suggestion" title="<?= $itemes->nume_item;?>" href="detalii.php?id=<?= $itemes->id;?>">
	<img width="63" height="63" alt="<?= $itemes->nume_item;?>" onerror="this.src='img/error.png';" src="img/items/<?= $itemes->img;?>.png">
	</img>
	</a>
	</li>
<?php
}
?>
	</ol>
	</div>
	</div>
	</div>
	</div>
	<a id="fancybox-close" style="display: inline;"></a>
	<div id="fancybox-title" style="display: block;">
	</div>
<?php
}
?>