<?php  
  if(!isset($_SESSION)){session_start();}
  if(isset($_GET['page'])) {
  if(isset($_GET['a'])) {
  if (isset($_SESSION['user_admin'])) { 
  if($_SESSION['user_admin']>=7) {
?>
<div class="page-header">
        <h1>Administrare - Log Comenzi GM</h1>
		<p>Pe aceast&#259; pagin&#259; pute&#355;i urm&#259;ri ultimele 10 comenzi ale unui GM.</p>
      </div>
<div class="well">
<table class="table table-striped">
            <thead>
              <tr>
                <th>Nume</th>
                <th>Comand&#259;</th>
                <th>IP</th>
                <th>Data & Ora</th>
              </tr>
            </thead>
            <tbody>
<?PHP
	$sqlCmd = "SELECT COUNT(*) AS cnt FROM log.command_log LIMIT 100";
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
	
	$ergebnis = mysqli_query($sqlServ, "SELECT username,command,ip,date from log.command_log ORDER BY date DESC LIMIT ".$test[1].",".$serverSettings['page_entries']);

	 echo'<p><br/>Pagin&#259;: ';
    for($i=1;$i<=$test[0];$i++) {
    
	if($i<=50) {
	
      echo'<a href="index.php?page=admin&a=gmlog&p='.$i.'">';
      if($aktSeite==$i) { echo'<u>'.$i.'</u>'; }
      else { echo $i; }
      echo'</a> ';
    }
    }
    echo'</p>';
	
	
	while($row = mysqli_fetch_object($ergebnis))
{


    echo "<tr>";
    echo '<td>'.$row->username.'</td>';
    echo '<td>'.$row->command.'</td>';
    echo '<td>'.$row->ip.'</td>';
	echo '<td>'.$row->date.'</td>';
    echo "</tr>";
}
echo'</tbody></table></div>';

if(isset($_POST['submit'])){
$ip = $_POST['ip'];
$delete = "DELETE FROM log.command_log WHERE ip = '".$ip."'";
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
<td><input class="form-control input-lg" placeholder="IP-ul jucătorului…" name="ip" type="text" id="ip"></td>
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