<?PHP
  if(!isset($_SESSION)){session_start();}
  if(isset($_GET['page'])) {
  if(isset($_GET['a'])) {
  if (isset($_SESSION['user_admin'])) { 
  if($_SESSION['user_admin']>6) {
?>
<div class="page-header">
        <h1>Administrare - Log Login</h1>
		<p>Pe aceast&#259; pagin&#259; pute&#355;i urm&#259;ri ultimele 10 activit&#259;&#355;i de autentificare.</p>
      </div>
<div class="well">
<table class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>CH</th>
                <th>Job</th>
                <th>Nivel</th>
                <th>Timp de joc</th>
                <th>Tip</th>
                <th>Ora</th>
              </tr>
            </thead>
            <tbody>
<?PHP
 if(isset($_SESSION['user_admin']) && checkInt($_SESSION['user_admin']) && $_SESSION['user_admin']>=0) {
 
	$sqlCmd = "SELECT COUNT(*) AS cnt FROM log.loginlog LIMIT 100";
    $sqlQry = mysqli_query($sqlServ, $sqlCmd);
    $anza = mysqli_fetch_object($sqlQry);
    $cntEintraege = $anza->cnt;
    if(isset($_GET['p'])) {
      $aktSeite = (!checkInt($_GET['p'])) ? 0 : $_GET['p'];
    }
    else {
      $aktSeite=0;
    }
    if($aktSeite==0) $aktSeite=1;
    $test = calcPages($cntEintraege,$aktSeite,$serverSettings['page_entries']);
	
	$ergebnis = mysqli_query($sqlServ, "SELECT account_id,channel,job,level,playtime,type,time from log.loginlog ORDER BY time DESC LIMIT ".$test[1].",".$serverSettings['page_entries']);

	 echo'<p>Pagin&#259;: ';
    for($i=1;$i<=$test[0];$i++) {
    
	if($i<=50) {
	
      echo'<a href="index.php?page=admin&a=loginlog&p='.$i.'">';
      if($aktSeite==$i) { echo'<u>'.$i.'</u>'; }
      else { echo $i; }
      echo'</a> ';
    }
    }
    echo'</p>';
	
	
	while($row = mysqli_fetch_object($ergebnis))
{


    echo "<tr>";
    echo '<td>'.$row->account_id.'</td>';
    echo '<td>'.$row->channel.'</td>';
    echo '<td>'.$row->job.'</td>';
	echo '<td>'.$row->level.'</td>';
    echo '<td>'.$row->playtime.'</td>';
    echo '<td>'.$row->type.'</td>';
	echo '<td>'.$row->time.'</td>';
    echo "</tr>";
}
echo'</tbody></table></div>';

  
  }
    else {
    echo'<p class="meldung">&nbsp;&nbsp;&nbsp;&nbsp;Nu ave&#355;i acces la aceast&#259; zon&#259;!</p>';
  }

if(isset($_POST['submit'])){
$ID = $_POST['ID'];
$delete = "DELETE FROM log.command_log WHERE ID = '".$ID."'";
$query  = mysqli_query($sqlServ, $delete);
if(!$query) {
    echo '<div class="alert alert-danger" role="alert">
        Log-urile adresei IP introduse nu pot fi &#351;terse!
      </div>';}
     else { 
    echo '<div class="alert alert-success" role="alert">
        Log-urile adresei IP introduse au fost &#351;terse!
      </div>';	} }
?>

<div class="well">	
<form method="post" action="<?php $_PHP_SELF ?>">
<table id="dataTable" class="table table-striped">
<tr>
<td width="200">Introduce&#355;i adresa IP:</td>
<td><input class="form-control input-lg" placeholder="IP-ul jucătorului…" name="ID" type="text" id="ID"></td>
</tr>
<tr>
<td width="50"> </td>
<td> </td>
</tr>
<tr>
<td width="100"> </td>
<td>
<input name="submit" type="submit" id="submit" class="btn-big btn-success btn-lg btn" value="&#350;terge">
</td>
</tr>
</table>
</form>
</div>
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