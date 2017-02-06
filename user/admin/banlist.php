<?PHP
  if(!isset($_SESSION)){session_start();}
  if(isset($_GET['page'])) {
  if(isset($_GET['a'])) {
  if (isset($_SESSION['user_admin'])) { 
  if($_SESSION['user_admin']>=$adminRights['banlist']) {
?>
<h2>Administrare - Listă conturilor blocate</h2>

<div class="well">
  <form action="index.php?page=admin&a=banlist" method="POST">
  <table><th>C&#259;utare (Cont / ID-ul Contului):
    <tr>
      </th>
      <td><input type="text" class="form-control -webkit-transition" name="accsuche" placeholder="Contul...." size="20" maxlength="16"/></td>
      <td><input type="submit" class="btn-big btn-success btn-lg btn" name="submit" value="Caută"/></td>
    </tr>
  </table>
  </form></div>
<div class="well">
<table class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Cont</th>
                <th>Stare</th>
                <th>E-Mail</th>
                <th>Înregistrat</th>
              </tr>
            </thead>
            <tbody>
	
  <?PHP
  
    if(isset($_POST['submit']) AND $_POST['submit']=="Caută") 
    {
      $sqlCmd = "SELECT id,login,email,create_time,status FROM account.account WHERE (login LIKE '%".((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_POST['accsuche']) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."%' OR id='".$_POST['accsuche']."') AND status='BLOCK' ORDER BY login ASC";
    }
    else 
    {
      $sqlCmd = "SELECT id,login,email,create_time,status FROM account.account WHERE status='BLOCK' ORDER BY login ASC";
    }
    
    $sqlQry = mysqli_query($sqlServ, $sqlCmd);
    $x=0;
    while($getAccs=mysqli_fetch_object($sqlQry)) 
    {    
      if($getAccs->status=='OK') { $accZustand="#026113"; }
      elseif($getAccs->status=='BLOCK') { $accZustand="#AA0319"; }
      
      echo"<tr>
      <td>".$getAccs->id."</td>\n
      <td><a href=\"index.php?page=admin&a=users&acc=".$getAccs->id."\">".$getAccs->login."</a></td>\n
      <td style=\"color:$accZustand;\"><b>".$getAccs->status."</b></td>\n
      <td>".$getAccs->email."</td>\n
      <td>".$getAccs->create_time."</td>\n
      </tr>";
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