<?PHP
  $CPSeite = 10;
  $markierteZeile=0;
  if(isset($_GET['p'])) {
    if(!checkInt($_GET['p']) || !($_GET['p']>0)) $aSeite = 1;
    else $aSeite = $_GET['p'];
  }
  else { $aSeite = 1; }
   if(isset($_POST['suche']) && $_POST['suche']=='Caută') {
    if(!empty($_POST['charakter'])) {
      $sqlCmd="SELECT id, name, level, exp, empire, guild_name, rang
      FROM (
      
        SELECT id, name, level, exp, empire, guild_name, @num := @num +1 AS rang
        FROM (
        
          SELECT player.id, player.name, player.level, player.exp, player_index.empire, guild.name AS guild_name, @num :=0
          FROM player.player
          LEFT JOIN player.player_index ON player_index.id = player.account_id
          LEFT JOIN player.guild_member ON guild_member.pid = player.id
          LEFT JOIN player.guild ON guild.id = guild_member.guild_id
          INNER JOIN account.account ON account.id=player.account_id
          WHERE player.name NOT LIKE '[%]%' AND account.status!='BLOCK'
          ORDER BY player.level DESC , player.exp DESC
          
        ) AS t1
        
      ) AS t2
      
      WHERE name LIKE '".((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_POST['charakter']) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."' LIMIT 1";
      $sqlQry=mysqli_query($sqlServ, $sqlCmd);
      if(mysqli_num_rows($sqlQry)>0) {
      
        $getRang = mysqli_fetch_object($sqlQry);
        $aSeite = ceil($getRang->rang/$CPSeite);
        $markierteZeile = $getRang->rang;
      }
      
    }
    
  } 
  $sqlCmd = "SELECT COUNT(*) as summeChars  
  FROM player.player 
  LEFT JOIN player.player_index 
  ON player_index.id=player.account_id 
  LEFT JOIN player.guild_member 
  ON guild_member.pid=player.id 
  LEFT JOIN player.guild 
  ON guild.id=guild_member.guild_id
  INNER JOIN account.account 
  ON account.id=player.account_id
  WHERE player.name NOT LIKE '[%]%' AND account.status!='BLOCK'
  ORDER BY player.level DESC, player.exp DESC";
  
  $sqlQry = mysqli_query($sqlServ, $sqlCmd);
  
  $getSum = mysqli_fetch_object($sqlQry);
  $cSeite = calcPages($getSum->summeChars,$aSeite,$CPSeite);
  
?>
<div class="page-header">
        <h1><?php include("./user/name_sv.php"); ?> - Clasament Jucători</h1>
      </div>
<div class="well">					
<?PHP
  $maxRange = 2;
  $maxStep = 1;
  if(($aSeite-$maxRange)>0) $sStart = $aSeite-$maxRange;
  else $sStart = 1;
  if(($aSeite+$maxRange)<=$cSeite[0]) $sEnde = $aSeite+$maxRange;
  else $sEnde = $cSeite[0];
  
  echo '<div class="text-left">';
  if(($aSeite-$maxStep)>0) echo '<a class="btn btn-warning" role="button" href="index.php?page=players&p='.($aSeite-$maxStep).'">&laquo;&nbsp;Anterioarele 10 ranguri</a>';
  else echo '<a href="index.php?page=players&p=1"></a>';
  echo'</div>';
  echo' <div class="text-right">';
  if(($aSeite+$maxStep)<=$cSeite[0]) echo ' <a class="btn btn-success" role="button" href="index.php?page=players&p='.($aSeite+$maxStep).'">Urm&#259;toarele 10 ranguri&nbsp;&raquo;</a>';
  else echo '<a href="index.php?page=players&p='.$cSeite[0].'"></a>'; 
  echo'</div>';
?>                
<table id="dataTable" class="table table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Nume jucător</th>
					<th>Regat</th>
					<th>Breaslă</th>
					<th>Nivel</th>
					<th>Experiență</th>
				</tr>
			</thead>
		<tbody>
<?PHP
  $sqlCmd = "SELECT player.id,player.name,player.level,player.exp,player_index.empire,guild.name AS guild_name 
  FROM player.player 
  LEFT JOIN player.player_index 
  ON player_index.id=player.account_id 
  LEFT JOIN player.guild_member 
  ON guild_member.pid=player.id 
  LEFT JOIN player.guild 
  ON guild.id=guild_member.guild_id
  INNER JOIN account.account 
  ON account.id=player.account_id
  WHERE player.name NOT LIKE '[%]%' AND account.status!='BLOCK'
  ORDER BY player.level DESC, player.exp DESC 
  LIMIT ".$cSeite[1].",".$CPSeite;
  //echo $sqlCmd;
  $sqlQry = mysqli_query($sqlServ, $sqlCmd);
  $x=$cSeite[1]+1;
  while($getPlayers = mysqli_fetch_object($sqlQry)) {
    echo "<tr>";
    echo "<td><span class=\"badge\">".$x."</span></td>";
    echo "<td><a href=\"index.php?page=player&char=".$getPlayers->name."\">".$getPlayers->name."</td>";
	echo "<td><center>";if(!empty($getPlayers->empire)) {
    echo '<img src="images/regat/'.$getPlayers->empire.'.jpg" height="20"/></center></td>';
    }
	if ($getPlayers->guild_name == "") echo '<td>-</td>';
	else echo '<td>'.$getPlayers->guild_name.'</td>';
    echo "<td>".$getPlayers->level."</td>";
	echo "<td>".$getPlayers->exp."</td>";
    echo "</tr>";
    $x++;
  }
?>
	</tbody>
		</table>
<?PHP
  $maxRange = 2;
  $maxStep = 1;
  if(($aSeite-$maxRange)>0) $sStart = $aSeite-$maxRange;
  else $sStart = 1;
  if(($aSeite+$maxRange)<=$cSeite[0]) $sEnde = $aSeite+$maxRange;
  else $sEnde = $cSeite[0];
  echo'<div class="text-right">';
  if(($aSeite+$maxStep)<=$cSeite[0]) echo ' <a class="btn btn-success" role="button" href="index.php?page=players&p='.($aSeite+$maxStep).'">Urm&#259;toarele 10 ranguri&nbsp;&raquo;</a>';
  else echo '<a href="index.php?page=players&p='.$cSeite[0].'"></a>';
  echo'</div>';
  echo '<div class="text-left">';
  if(($aSeite-$maxStep)>0) echo '<a class="btn btn-warning" role="button" href="index.php?page=players&p='.($aSeite-$maxStep).'">&laquo;&nbsp;Anterioarele 10 ranguri</a>';
  else echo '<a href="index.php?page=players&p=1"></a>';
  echo'</div>';

?>

</div>

<div class="well">	
<form method="post" action="<?php $_PHP_SELF ?>">
<table id="dataTable" class="table table-striped">
<tr>
<td width="200">Căutare jucător</td>
<td><input class="form-control input-lg" placeholder="Numele jucătorului…" name="charakter" type="text" id="charakter"></td>
</tr>
<tr>
<td width="50"> </td>
<td> </td>
</tr>
<tr>
<td width="100"> </td>
<td>
<input name="suche" type="submit" id="suche" class="btn-big btn-success btn-lg btn" value="Caută">
</td>
</tr>
</table>
</form>
</div>