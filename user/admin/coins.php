<?PHP
  if(!isset($_SESSION)){session_start();}
  if(isset($_GET['page'])) {
  if(isset($_GET['a'])) {
  if (isset($_SESSION['user_admin'])) { 
  if($_SESSION['user_admin']>=$adminRights['coins']) {

   echo '<div class="page-header">
        <h1>Administrare - Editare monede</h1>
      </div>';
    if(isset($_POST['submit']) && $_POST['submit']=="Schimbă") {
      if(checkInt($_POST['accID']) && checkInt($_POST['aktCoins']) && checkInt($_POST['coins']) && ($_POST['art']==1 OR $_POST['art']==0)) {
        if($_POST['art']==1) $newCoins=$_POST['aktCoins']+$_POST['coins'];
        else $newCoins=$_POST['aktCoins']-$_POST['coins'];
        if($newCoins<0) $newCoins=0;
       
        $sqlCmd = "UPDATE account.account SET coins='".$newCoins."' WHERE id='".$_POST['accID']."' LIMIT 1";
        $sqlQry = mysqli_query($sqlServ, $sqlCmd);
        if($sqlQry) {
          echo'<div class="alert alert-success" role="alert">
					Monedele au fost schimbate cu succes. Noua valoare este de <strong>'.$newCoins.'</strong> de monede.
				</div>';
        }
      }
      else {
        echo'<div class="alert alert-danger" role="alert">
					A fost incorect sau eronat. &#206;ncerca&#355;i din nou.
				</div>';
      }
    }
    if(isset($_GET['acc']) && !empty($_GET['acc'])) 
    {
      $sqlCmd = "SELECT id,login,coins FROM account.account WHERE id='".$_GET['acc']."' LIMIT 1";
      $sqlQry = mysqli_query($sqlServ, $sqlCmd);
      if(mysqli_num_rows($sqlQry)>0) 
      {
        $accData = mysqli_fetch_object($sqlQry);
        echo'<h3><br>Utilizator : "'.$accData->login.'"</h3>';
        ?>
        <p>Soldul curent al contului : <b><span class="label label-info"><?PHP echo $accData->coins; ?></span></b></p>
        <div class="user">
          <form action="index.php?page=admin&a=coins&acc=<?PHP echo $accData->id; ?>" method="POST">
            <input type="hidden" name="aktCoins" value="<?PHP echo $accData->coins; ?>"/>
            <input type="hidden" name="accID" value="<?PHP echo $accData->id; ?>"/>
			<div class="well">
			<table class="table table-bordered">
            <thead>
              <tr>
                <th>Info</th>
                <th>Număr</th>
                <th>Acțiuni</th>
                <th>Setează</th>
              </tr>
            </thead>
            <tbody>
                <td>Schimb&#259; monedele:</td>
                <td>
                  <input class="form-control" type="text" size="11" maxlength="11" name="coins"/></td>
                  <td><select class="form-control" name="art">
                    <option value="1">Adaug&#259;</option>
                    <option value="0">Șterge</option>
                  </select>
                </td>
                <td><input class="btn btn-success" role="button" type="submit" name="submit" value="Schimbă"/></td>
              </tr>
            </tbody></table></div>
          </form>
        </div>
        
        <?PHP
      }
      else
      {
      echo'<div class="alert alert-danger" role="alert">
				ID-ul contului care l-a&#355;i introdus nu exist&#259;!
			</div>';
      }
    }
    else 
    {
      echo'<div class="alert alert-danger" role="alert">
				Nu a&#355;i introdus nici un ID!
			</div>';
    }
    
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