<?PHP
  if(!isset($_SESSION)){session_start();}
  if(isset($_GET['page'])) {
  if(isset($_GET['a'])) {
  if (isset($_SESSION['user_admin'])) { 
  if($_SESSION['user_admin']>=$adminRights['stats']) {
?>
<div class="page-header">
        <h1>Administrare - Statistici</h1>
      </div>
<div class="well">
<?php
	function GetServerStatus($site, $port) 
	{$status = array('<font color="red">Offline</font>', '<font color="gren">Online</font>'); 
	$fp = @fsockopen($site, $port, $errno, $errstr, 2); 
	if (!$fp) { return $status[0]; } else 
	{ return $status[1];} 
	} 
//Total Inregistrati:
((bool)mysqli_query($sqlServ, "USE account"));
$query = mysqli_query($sqlServ, "SELECT * FROM account");
$iscritti = mysqli_num_rows($query);
//Total Jucatori:
((bool)mysqli_query($sqlServ, "USE player"));
$query1 = mysqli_query($sqlServ, "SELECT * FROM player");
$player = mysqli_num_rows($query1);
//Total Bresle:
$query2 = mysqli_query($sqlServ, "SELECT * FROM guild");
$gilde = mysqli_num_rows($query2);
//Regatul Shinsoo:
$query3 = mysqli_query($sqlServ, "SELECT * FROM player_index where empire='1'");
$shinsoo = mysqli_num_rows($query3);
//Regatul Chungjo:
$query4 = mysqli_query($sqlServ, "SELECT * FROM player_index where empire='2'");
$chungjo = mysqli_num_rows($query4);
//Regatul Jinno:
$query5 = mysqli_query($sqlServ, "SELECT * FROM player_index where empire='3'");
$jinno = mysqli_num_rows($query5);

//Statistici Jucatori
//PV:
$query6 = mysqli_query($sqlServ, "SELECT name,hp FROM player ORDER by hp DESC limit 1");
$hp = mysqli_fetch_row($query6);
//PM:
$query7 = mysqli_query($sqlServ, "SELECT name,mp FROM player ORDER by mp DESC limit 1");
$mp = mysqli_fetch_row($query7);
//Timp joc:
$query8 = mysqli_query($sqlServ, "SELECT name,playtime FROM player ORDER by playtime DESC limit 1");
$anziano = mysqli_fetch_row($query8);
//Nivel:
$query9 = mysqli_query($sqlServ, "SELECT name,level FROM player ORDER by level DESC limit 1");
$lvl = mysqli_fetch_row($query9);
//VIT:
$query10 = mysqli_query($sqlServ, "SELECT name,ht FROM player ORDER by ht DESC limit 1");
$vit = mysqli_fetch_row($query10);
//INT:
$query11 = mysqli_query($sqlServ, "SELECT name,iq FROM player ORDER by iq DESC limit 1");
$int = mysqli_fetch_row($query11);
//STR:
$query12 = mysqli_query($sqlServ, "SELECT name,st FROM player ORDER by st DESC limit 1");
$str = mysqli_fetch_row($query12);
//DEX:
$query13 = mysqli_query($sqlServ, "SELECT name,dx FROM player ORDER by dx DESC limit 1");
$dex = mysqli_fetch_row($query13);
//Yang:
$query14 = mysqli_query($sqlServ, "SELECT name,gold FROM player ORDER by gold DESC limit 1");
$yang = mysqli_fetch_row($query14);
//Grad:
$query15 = mysqli_query($sqlServ, "SELECT name,alignment FROM player ORDER by alignment DESC limit 1");
$karma = mysqli_fetch_row($query15);
//Cal:
$query16 = mysqli_query($sqlServ, "SELECT name,horse_level FROM player ORDER by horse_level DESC limit 1");
$cavallo = mysqli_fetch_row($query16);

//Statistici Bresle
//Nivel:
$query17 = mysqli_query($sqlServ, "SELECT name,level FROM guild ORDER by level DESC limit 1");
$lv = mysqli_fetch_row($query17);
//Exp:
$query18 = mysqli_query($sqlServ, "SELECT name,exp FROM guild ORDER by exp DESC limit 1");
$ex = mysqli_fetch_row($query18);
//Victorii:
$query19 = mysqli_query($sqlServ, "SELECT name,win FROM guild ORDER by win DESC limit 1");
$vitt = mysqli_fetch_row($query19);
//Egal:
$query20 = mysqli_query($sqlServ, "SELECT name,draw FROM guild ORDER by draw DESC limit 1");
$pare = mysqli_fetch_row($query20);
//infrangeri:
$query21 = mysqli_query($sqlServ, "SELECT name,loss FROM guild ORDER by loss DESC limit 1");
$swithf = mysqli_fetch_row($query21);
//Puncte:
$query22 = mysqli_query($sqlServ, "SELECT name,ladder_point FROM guild ORDER by ladder_point DESC limit 1");
$pnt = mysqli_fetch_row($query22);
//Yang:
$query23 = mysqli_query($sqlServ, "SELECT name,gold FROM guild ORDER by gold DESC limit 1");
$gold = mysqli_fetch_row($query23);
//Membri:
$query24 = mysqli_query($sqlServ, "SELECT id,name FROM guild");
$gilda = mysqli_fetch_row($query24);
$query25 = mysqli_query($sqlServ, "SELECT * FROM guild_member where guild_id='$gilda[0]'");
$membri = mysqli_num_rows($query25);
?>
<ul class="list-group">
			<li class="list-group-item">Total &#238;nregistra&#355;i: <b><?php echo "$iscritti"; ?></b></li>
			<li class="list-group-item">Total juc&#259;tori: <b><?php echo "$player"; ?></b></li>
			<li class="list-group-item">Total bresle: <b><?php echo "$gilde"; ?></b></li>
			<li class="list-group-item">Total juc&#259;tori Shinsoo (Regatul Ro&#351;u): <b><?php echo "$shinsoo"; ?></b></li>
			<li class="list-group-item">Total juc&#259;tori Chunjo (Regatul Galben): <b><?php echo "$chungjo"; ?></b></li>	
			<li class="list-group-item">Total juc&#259;tori Jinno (Regatul Albastru): <b><?php echo "$jinno"; ?></b></li>
<hr>
			<li class="list-group-item">Juc&#259;torul cu cel mai mare PV; <b><?php echo "$hp[0]"; ?></b>, PV: <b><?php echo "$hp[1]"; ?></b></li>
			<li class="list-group-item">Juc&#259;torul cu cel mai mare PM; <b><?php echo "$mp[0]"; ?></b>, PM: <b><?php echo "$mp[1]"; ?></b></li>
			<li class="list-group-item">Juc&#259;torul cu cele mai multe minute: <b><?php echo "$anziano[0]"; ?></b>, Minute: <b><?php echo "$anziano[1]"; ?></b></li>
			<li class="list-group-item">Juc&#259;torul cu cel mai mare Nivel: <b><?php echo "$lvl[0]"; ?></b>, Nivel: <b><?php echo "$lvl[1]"; ?></b></li>
			<li class="list-group-item">Juc&#259;torul cu cel mai mare VIT; <b><?php echo "$vit[0]"; ?></b>, VIT: <b><?php echo "$vit[1]"; ?></b></li>
			<li class="list-group-item">Juc&#259;torul cu cel mai mare INT; <b><?php echo "$int[0]"; ?></b>, INT: <b><?php echo "$int[1]"; ?></b></li>
			<li class="list-group-item">Juc&#259;torul cu cel mai mare STR; <b><?php echo "$str[0]"; ?></b>, STR: <b><?php echo "$str[1]"; ?></b></li>
			<li class="list-group-item">Juc&#259;torul cu cel mai mare DEX; <b><?php echo "$dex[0]"; ?></b>, DEX: <b><?php echo "$dex[1]"; ?></b></li>
			<li class="list-group-item">Juc&#259;torul cu cel mai mult Yang; <b><?php echo "$yang[0]"; ?></b>, Yang: <b><?php echo "$yang[1]"; ?></b></li>
			<li class="list-group-item">Juc&#259;torul cu cel mai mare Grad; <b><?php echo "$karma[0]"; ?></b>, Grad: <b><?php echo "$karma[1]"; ?></b></li>
			<li class="list-group-item">Juc&#259;torul cu cel mai mare nivel la cal: <b><?php echo "$cavallo[0]"; ?></b>, Nivel cal: <b><?php echo "$cavallo[1]"; ?></b></li>
<hr>
			<li class="list-group-item">Breasla cu cel mai mare nivel: <b><?php echo "$lv[0]"; ?></b>, Nivel: <b><?php echo "$lv[1]"; ?></b></li>
			<li class="list-group-item">Breasla cu cea mai mult&#259; experien&#355;&#259;: <b><?php echo "$ex[0]"; ?></b>, Experien&#355;&#259;: <b><?php echo "$ex[1]"; ?></b></li>
			<li class="list-group-item">Breasla cu cele mai multe victorii: <b><?php echo "$vitt[0]"; ?></b>, Victorii: <b><?php echo "$vitt[1]"; ?></b></li>
			<li class="list-group-item">Breasla cu cele mai multe egaluri: <b><?php echo "$pare[0]"; ?></b>, Egaluri: <b><?php echo "$pare[1]"; ?></b></li>
			<li class="list-group-item">Breasla cu cele mai multe &#238;nfr&#226;ngeri: <b><?php echo "$swithf[0]"; ?></b>, &#206;nfr&#226;ngeri: <b><?php echo "$swithf[1]"; ?></b></li>
			<li class="list-group-item">Breasla cu cele mai multe puncte: <b><?php echo "$pnt[0]"; ?></b>, Puncte: <b><?php echo "$pnt[1]"; ?></b></li>
			<li class="list-group-item">Breasla cu cel mai mult Yang: <b><?php echo "$gold[0]"; ?></b>, Yang: <b><?php echo "$gold[1]"; ?></b></li>
			<li class="list-group-item">Breasla cu cei mai mul&#355;i membrii: <b><?php echo "$gilda[1]"; ?></b>, Membrii: <b><?php echo "$membri"; ?></b></li>
</ul></div>
<?PHP
}
  }
  else {
    echo '<div class="alert alert-danger" role="alert">
        Nu ave&#355;i acces la aceast&#259; zon&#259;!
      </div>'; }
  }
  else {
    echo 'Nu ave&#355;i permisiunea s&#259; accesa&#355;i pagina direct!';
	echo "<meta http-equiv='refresh' content='0; URL=../../index.php'>"; }
  }
  else {
    echo 'Nu ave&#355;i permisiunea s&#259; accesa&#355;i pagina direct!';
	echo "<meta http-equiv='refresh' content='0; URL=../../index.php'>"; }
?>
<a href="javascript: history.go(-1)" class="btn btn-warning" role="button">&#171; &Icirc;napoi</a>