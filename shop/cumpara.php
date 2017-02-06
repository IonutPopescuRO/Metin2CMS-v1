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
	$id_username = $info['id'];
	$coins = $info['coins'];
	$jcoins = $info['jcoins'];

	$id = isset($_GET['id']) ? $_GET['id'] : null;
	if ($id==null) {
		die("Trebuie sa alegi un item.");  
	}
	if (!is_numeric($id))
		header('Location: index.php');
	$get_iteme = mysqli_query($sqlHp, "SELECT * FROM ".SQL_HP_DB.".item_ishop where id='$id'");
	$item = mysqli_fetch_array($get_iteme);
	if(!count($item))
	{
		echo 'ERROR 404';
		die();
	}
	$items = $item['nume_item'];
	$pret = $item['pret'];
	$buc = $item['buc'];
	$window = $item['window'];
	$pos = $item['pos'];
	$count = $item['count'];
	$vnum_item = $item['vnum'];
	
	//Pozitie obiect
	$sql_pos = mysqli_query($sqlServ, "SELECT MAX(pos) AS max FROM player.item WHERE owner_id='$id_username' AND `window` = 'MALL'");
	$row_pos = mysqli_fetch_assoc($sql_pos);

	$last_pos = $row_pos['max'];

	if ($last_pos < 48) {
		$add_poss = $last_pos + 1;
?>
<div id="fancybox-content" style="border-width: 0px; width: 540px; height: 500px;">
<div style="width:540px;height:500px;overflow: hidden;position:relative;"><h1>
      Achizitionare <?echo $items; ?>
    </h1>
<?php

	$itemscount = mysqli_query($sqlServ, "SELECT count(*) \"total\" from player.item where owner_id='$id_username' AND `window` = 'MALL'");
	$icount =  mysqli_fetch_row($itemscount);

   if($coins >= $pret){
	if($icount[0] <= 6){
	
	$data = date('Y-m-d H:i:s');
	
	// LOG
	mysqli_query($sqlHp, "INSERT INTO ".SQL_HP_DB.".log_buyishop (nume_cumparator, item_cumparat, data_cumpararii) VALUES ('$user_id', '$items', '$data')");
	// Scădem Coins
	mysqli_query($sqlServ, "UPDATE account.account SET `coins` = `coins` - ".$pret." WHERE `login` = '$user_id'");
	// Adăugăm JD
	mysqli_query($sqlServ, "UPDATE account.account SET `jcoins` = `jcoins` + ".$pret." WHERE `login` = '$user_id'");
	// Insertăm Item-ul
	mysqli_query($sqlServ, "INSERT INTO player.item
				(owner_id,window,pos,count,vnum,attrtype0, attrvalue0, attrtype1, attrvalue1, attrtype2, attrvalue2, attrtype3, attrvalue3, attrtype4, attrvalue4, attrtype5, attrvalue5, attrtype6, attrvalue6, socket0, socket1, socket2)
				VALUES 
				('$id_username','MALL','$add_poss','1','".$vnum_item."','".$item['attrtype0']."', '".$item['attrvalue0']."', '".$item['attrtype1']."', '".$item['attrvalue1']."', '".$item['attrtype2']."', '".$item['attrvalue2']."', '".$item['attrtype3']."', '".$item['attrvalue3']."', '".$item['attrtype4']."', '".$item['attrvalue4']."', '".$item['attrtype5']."', '".$item['attrvalue5']."', '".$item['attrtype6']."', '".$item['attrvalue6']."', '".$item['socket0']."', '".$item['socket1']."', '".$item['socket2']."')");
?>
<div class="dynContent"><div id="confirmBox" class="item"><div class="itemDesc confirmDesc"><div class="thumbnailBgSmall"><img width="63px" height="63px" src="http://gf1.geo.gfsrv.net/cdnc7/7227be80292ec244a17496ca9b2528.png"></img></div><p><span class="confirmTitle">
      Achiziționare completă
    </span><br />
                Obiectul a fost adăugat în contul tău.
	</p><br class="clearfloat"></br></div></div>
	</div>	
	<div class="hint"><div class="itemDesc messageDesc"><p><span class="hintTitle">
      Informație
    </span><br></br>
      
                Vei găsi acum obiectul achiziționat în Depozitul Item-Shop (care poate fi localizat prin butonul din inventar).            
    </p><br class="clearfloat"></br></div></div>
<?php
} else {
?>
<div class="dynContent"><div id="confirmBox" class="item"><div class="itemDesc confirmDesc"><div class="thumbnailBgSmall"><img width="63px" height="63px" src="http://gf1.geo.gfsrv.net/cdnc7/7227be80292ec244a17496ca9b2528.png"></img></div><p><span class="confirmTitle">
      Achiziționare a eșuat.
    </span><br />
    <strong>Nu ai suficient loc în depozit</strong>, limita este de 7 obiecte.<br/>
	<strong>Te rugăm să eliberezi depozitul!</strong>
	</p><br class="clearfloat"></br></div></div>
	</div>
<?php
} }
else {
?>
<div class="dynContent"><div id="confirmBox" class="item"><div class="itemDesc confirmDesc"><div class="thumbnailBgSmall"><img width="63px" height="63px" src="http://gf1.geo.gfsrv.net/cdnc7/7227be80292ec244a17496ca9b2528.png"></img></div><p><span class="confirmTitle">
      Achiziționare a eșuat.
    </span><br />
    Nu ai suficiente Monede Dragon.<br/>
	<strong>Pentru a putea cumpăra acest obiect, te rugăm să donezi pentru Monede Dragon.</strong>
	</p><br class="clearfloat"></br></div></div>
	</div>
<?php
}

}
else{
?>
<div class="dynContent"><div id="confirmBox" class="item"><div class="itemDesc confirmDesc"><div class="thumbnailBgSmall"><img width="63px" height="63px" src="http://gf1.geo.gfsrv.net/cdnc7/7227be80292ec244a17496ca9b2528.png"></img></div><p><span class="confirmTitle">
      Achiziționare a eșuat.
    </span><br />
    Nu ai suficiente loc în depozit.<br/>
	<strong>Pentru a putea cumpăra acest obiect, te rugăm să îți golești inventarul.</strong>
	</p><br class="clearfloat"></br></div></div>
	</div>
	<?php } ?>
	<div class="box suggestions"><h3>
      Alte iteme:
    </h3><ol id="suggestions">
	<?php
		$get_recomandare = mysqli_query($sqlHp, "SELECT * FROM ".SQL_HP_DB.".item_ishop 
		ORDER BY rand()
		LIMIT 7");
		while($itemes = mysqli_fetch_object($get_recomandare)) {
?>
	<li class="thumbnailBgSmall">
	<a id="suggestion11979" class="suggestion" title="<?php echo $itemes->nume_item;?>" href="detalii.php?id=<?php echo $itemes->id;?>">
	<img width="63" height="63" alt="<?php echo $itemes->nume_item;?>" onerror="this.src='img/error.png';" src="img/items/<?php echo $itemes->img;?>.png">
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
	<a id="fancybox-close" style="display: inline;"></a>
	<div id="fancybox-title" style="display: block;">
	</div>
<?php
}
?>