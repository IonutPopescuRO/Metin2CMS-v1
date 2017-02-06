<?PHP
  if(!isset($_SESSION)){session_start();}
  if(isset($_GET['page'])) {
  if(isset($_GET['a'])) {
  if (isset($_SESSION['user_admin'])) { 
  if($_SESSION['user_admin']>=$adminRights['char_suche']) {

    if(!isset($_GET['filter']) && empty($_GET['filter'])) {
      $_GET['filter']='';
      $url_extension = '';
    }
    else {
      $url_extension = '&amp;filter='.$_GET['filter'];
    }
?>
<div class="page-header">
        <h1>Administrare - lista caracterelor</h1>
		<p>Pe aceast&#259; pagin&#259; pute&#355;i c&#259;uta un anumit caracter.</p>
      </div>


<div class="well">
  <form action="index.php" method="GET">
  <input type="hidden" name="page" value="admin"/>
  <input type="hidden" name="a" value="charlist"/>
  <table><th>C&#259;utare (Caracter sau ID-ul caracterului):
    <tr>
      </th>
      <td><input type="text" class="form-control -webkit-transition" name="filter" value="<?PHP if(isset($_GET['filter'])) echo $_GET["filter"]; ?>" size="20" maxlength="16"/></td>
      <td><input type="submit" class="btn-big btn-success btn-lg btn" name="submit" value="Caută"/></td>
    </tr>
  </table>
  </form></div>	  
 
 <div class="well">
<table class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Caracter</th>
                <th>ID cont</th>
                <th>Cont</th>
                <th>IP</th>
              </tr>
            </thead>
            <tbody>
   <?PHP
    
    $sqlCmd="SELECT COUNT(*) AS anzEintr 
    FROM player.player 
    LEFT JOIN account.account 
    ON account.id=player.account_id
    WHERE player.id='".((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_GET['filter']) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."'
    OR player.name LIKE '%".((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_GET['filter']) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."%'
    ORDER BY player.name ASC";
    
    $sqlQry = mysqli_query($sqlServ, $sqlCmd);
    $getAnz = mysqli_fetch_object($sqlQry);
    $cntEintraege = $getAnz->anzEintr;
    if(isset($_GET['p'])) {
      $aktSeite = (!checkInt($_GET['p'])) ? 0 : $_GET['p'];
    }
    else {
      $aktSeite=0;
    }
    
    if($aktSeite==0) $aktSeite=1;
    $test = calcPages($cntEintraege,$aktSeite,$serverSettings['page_entries']);
    
    $sqlCmd="SELECT player.name,player.id,player.ip,account.id AS account_id, account.login, account.status
    FROM player.player 
    LEFT JOIN account.account 
    ON account.id=player.account_id
    WHERE player.id='".((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_GET['filter']) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."'
    OR player.name LIKE '%".((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_GET['filter']) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."%'
    ORDER BY player.name ASC 
    LIMIT ".$test[1].",".$serverSettings['page_entries'];
      
    $sqlQry = mysqli_query($sqlServ, $sqlCmd);
    echo'&nbsp;&nbsp;Filtru curent: &laquo;<b>'.$_GET['filter'].'</b>&raquo;';
    echo'<p>&nbsp;&nbsp;Pagina: ';
    for($i=1;$i<=$test[0];$i++) {
    
      echo'<a href="index.php?page=admin&a=charlist'.$url_extension.'&p='.$i.'">';
      if($aktSeite==$i) { echo'<u>'.$i.'</u>'; }
      else { echo $i; }
      echo'</a> ';
    
    }
    echo'</p>';
    $x=0;
    while($getAccs=mysqli_fetch_object($sqlQry)) 
    {
      
      if(isset($getAccs->status)) {
        if($getAccs->status=='OK') { $accZustand="#026113"; }
        elseif($getAccs->status=='BLOCK') { $accZustand="#AA0319"; }
      }
      else {
        $accZustand="#000000";
      }
      
      if(empty($getAccs->login)) {
        $accountInfo = 'Niciun cont.';
      }
      else {
        $accountInfo = "<a href=\"index.php?page=admin&a=users&acc=".$getAccs->account_id."\" style=\"color:$accZustand;\"><b>".$getAccs->login."</b></a>";
      }
      
      echo"<tr>
      <td>".$getAccs->id."</td>
      <td><a href=\"index.php?page=player&char=".$getAccs->name."\">".$getAccs->name."</a></td>
      <td>".$getAccs->account_id."</td>\n
      <td>".$accountInfo."</td>
      <td>".$getAccs->ip."</td>
      </tr>";
      $x++;
    }
  ?>
  </tbody></table></div>
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