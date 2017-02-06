<?PHP
  if(!isset($_SESSION)){session_start();}
  if(isset($_GET['page'])) {
  if(isset($_GET['a'])) {
  if (isset($_SESSION['user_admin'])) { 
  if($_SESSION['user_admin']>=$adminRights['acc_suche']) {
  
    if(!isset($_GET['filter']) && empty($_GET['filter'])) {
      $_GET['filter']='';
      $url_extension = '';
    }
    else {
      $url_extension = '&amp;filter='.$_GET['filter'];
    }
?>
<h2>Administrare - Lista conturilor</h2>
<div class="well">
  <form action="index.php" method="GET">
  <input type="hidden" name="page" value="admin"/>
  <input type="hidden" name="a" value="user"/>
  <table><th>C&#259;utare (Cont / ID):
    <tr>
      </th>
      <td><input type="text" class="form-control -webkit-transition" name="filter" value="<?PHP if(isset($_GET['filter'])) echo $_GET["filter"]; ?>" size="20" maxlength="16"/></td>
      <td><input type="submit" class="btn-big btn-success btn-lg btn" name="submit" value="Caută"/></td>
    </tr>
  </table>
  </form></div>
  <?PHP
    
    $sqlCmd = "SELECT COUNT(*) AS anzEintr FROM account.account WHERE login LIKE '%".((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_GET['filter']) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."%' OR id='".((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_GET['filter']) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."' ORDER BY login ASC";
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
    
    $sqlCmd = "SELECT id,login,email,create_time,status FROM account.account WHERE login LIKE '%".((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_GET['filter']) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."%' OR id='".((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_GET['filter']) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."' ORDER BY login ASC LIMIT ".$test[1].",".$serverSettings['page_entries'];
    
    $sqlQry = mysqli_query($sqlServ, $sqlCmd);
    echo'<br/>Filtru curent: &laquo;<b>'.$_GET['filter'].'</b>&raquo;';
    echo'<p>Pagina: ';
    for($i=1;$i<=$test[0];$i++) {
    
      echo'<a href="index.php?page=admin&a=user'.$url_extension.'&p='.$i.'">';
      if($aktSeite==$i) { echo'<u>'.$i.'</u>'; }
      else { echo $i; }
      echo'</a> ';
    
    }
    echo'</p><br/>';
    
  ?>
  <div class="well">
<table class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Cont</th>
                <th>Stare</th>
                <th>E-mail</th>
                <th>&#206;nregistrat</th>
              </tr>
            </thead>
            <tbody>
  <?PHP    
    $x=0;
    while($getAccs=mysqli_fetch_object($sqlQry)) 
    {
    
      if($getAccs->status=='OK') { $accZustand="#026113"; }
      elseif($getAccs->status=='BLOCK') { $accZustand="#AA0319"; }
      
      echo"<tr>
      <td>".$getAccs->id."</td>\n
      <td><a href=\"index.php?page=admin&a=users&acc=".$getAccs->id."\">".$getAccs->login."</a></td>\n
      <td style=\"color:$accZustand\"><b>".$getAccs->status."</b></td>\n
      <td>".$getAccs->email."&nbsp;&nbsp;&nbsp;&nbsp;</td>\n
      <td>".$getAccs->create_time."&nbsp;&nbsp;&nbsp;&nbsp;</td>\n
      </tr>\n";
      $x++;
    }
  ?>
            </tbody>
          </table></div>
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
?><br/>
<a href="javascript: history.go(-1)" class="btn btn-warning" role="button">« Înapoi</a>