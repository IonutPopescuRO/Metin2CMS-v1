<?PHP
  if(!isset($_SESSION)){session_start();}
  if(isset($_GET['page'])) {
  if(isset($_GET['a'])) {
  if (isset($_SESSION['user_admin'])) { 
  if($_SESSION['user_admin']>=$adminRights['ip_suche']) {

    if(!isset($_GET['filter']) && empty($_GET['filter'])) {
      $_GET['filter']='';
      $url_extension = '';
    }
    else {
      $url_extension = '&amp;filter='.$_GET['filter'];
    }
?>
<div class="page-header">
        <h1>Admin - lista IP-urilor</h1>
		<p>Aceast&#259; pagin&#259; con&#355;ine IP-urile cele mai recente autentificate de c&#259;tre caractere / conturi.</p>
      </div>
<div class="well">
  <form action="index.php?page=admin&a=iplist" method="GET">
  <input type="hidden" name="page" value="admin"/>
  <input type="hidden" name="a" value="iplist"/>
  <table><th>C&#259;utare (IP, sau o parte din IP):
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
    
    $sqlCmd = "SELECT COUNT(*) AS anzEintr 
    FROM player.player 
    INNER JOIN account.account 
    ON account.id=player.account_id
    WHERE player.ip LIKE '%".((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_GET['filter']) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."%'
    ORDER BY account.login ASC";
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
    
    $sqlCmd = "SELECT player.name,player.id,account.id AS account_id,account.login,player.ip
    FROM player.player 
    INNER JOIN account.account 
    ON account.id=player.account_id
    WHERE player.ip LIKE '%".((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_GET['filter']) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."%'
    ORDER BY account.login ASC
    LIMIT ".$test[1].",".$serverSettings['page_entries'];
      
    $sqlQry = mysqli_query($sqlServ, $sqlCmd);
    echo'Filtru curent: &laquo;<b>'.$_GET['filter'].'</b>&raquo;';
    echo'<p>Pagina: ';
    for($i=1;$i<=$test[0];$i++) {
    
      echo'<a href="index.php?page=admin&a=iplist'.$url_extension.'&p='.$i.'">';
      if($aktSeite==$i) { echo'<u>'.$i.'</u>'; }
      else { echo $i; }
      echo'</a> ';
    
    }
    echo'</p><br/>';
    $x=0;
    while($getAccs=mysqli_fetch_object($sqlQry)) 
    {
      echo"<tr>
      <td>".$getAccs->account_id."</td>\n
      <td><a href=\"index.php?page=admin&a=users&acc=".$getAccs->account_id."\">".$getAccs->login."</a></td>\n
      <td>".$getAccs->id."</td>\n
      <td><a href=\"index.php?page=player&char=".$getAccs->name."\">".$getAccs->name."</a>&nbsp;&nbsp;&nbsp;</td>\n
      <td><a href=\"index.php?page=admin&a=iplist&filter=".$getAccs->ip."\">".$getAccs->ip."</a> <a href=\"index.php?page=admin&a=ipban&ip=".$getAccs->ip."\">[baneaz&#259;]</a></td>
      </tr>\n";
      $x++;
    }
  ?>
            </tbody>
          </table>
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