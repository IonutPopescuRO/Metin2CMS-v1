<?PHP
  if(!isset($_SESSION)){session_start();}
  if(isset($_GET['page'])) {
  if(isset($_GET['a'])) {
  if (isset($_SESSION['user_admin'])) { 
  if($_SESSION['user_admin']>=$adminRights['ban_account']) {
?>
<div class="page-header">
        <h1>Administrare - blocarea conturilor pe IP</h1>
      </div>
<?PHP
  $banGruende = array(
    0 => 'Hacking',
    1 => 'Buguri',
    2 => 'Insulte',
    3 => 'Altele'
  );
    if(isset($_GET['ip']) && !empty($_GET['ip'])) {
      
      if(isset($_POST['submit']) && $_POST['submit']=="Baneaza") {
      
        if(!empty($_POST['banGrund']) && !empty($_POST['banEingabe'])) {
          $begruendung = $_POST['banGrund'].': '.$_POST['banEingabe'];
          $sqlCmd = "SELECT DISTINCT account.id 
            FROM player.player 
            INNER JOIN account.account 
            ON account.id = player.account_id 
            WHERE player.ip='".$_GET['ip']."'";
          $sqlQry=mysqli_query($sqlServ, $sqlCmd);
          $idArray=array();
          while($getIDs=mysqli_fetch_object($sqlQry)) {
            $idArray[]=$getIDs->id;
          }
          foreach($idArray AS $banID) {
            $sqlCmd2="UPDATE account.account SET status='BLOCK' WHERE id='".$banID."' LIMIT 1";
            $sqlQry2=mysqli_query($sqlServ, $sqlCmd2);
                
            $sqlLog = "INSERT INTO ".SQL_HP_DB.".ban_log (admin_id,account_id,time,reason,type) VALUES ('".$_SESSION['user_id']."','".$banID."',NOW(),'".$begruendung."','BLOCK')";
            $qryLog = mysqli_query($sqlHp, $sqlLog);
          }
          echo'<div class="alert alert-success" role="alert">
					Conturile au fost blocate cu succes.
				</div>';
        }
        else {
          echo'<div class="alert alert-danger" role="alert">
					Nu a&#355;i introdus nici un motiv detaliat.
				</div>';
        }
      }
      
      
      $sqlCmd = "SELECT account.id,account.login,player.name 
        FROM player.player 
        INNER JOIN account.account 
        ON account.id = player.account_id 
        WHERE player.ip='".$_GET['ip']."'";
      $sqlQry=mysqli_query($sqlServ, $sqlCmd);
      if(mysqli_num_rows($sqlQry)>0) {
        echo'<p>Urm&#259;toarele conturi au fost gasite : </p>';
        ?>
        <form method="POST" action="index.php?page=admin&a=ipban&ip=<?PHP echo $_GET['ip']; ?>">
		<div class="well">
		<table class="table table-striped">
            <thead>
              <tr>
                <th>ID-ul contului</th>
                <th>Cont</th>
                <th>Caracter</th>
              </tr>
            </thead>
            <tbody>
            <?PHP
              $x=0;
              while($getAccs=mysqli_fetch_object($sqlQry)) {
                echo'<tr>
                  <td>'.$getAccs->id.'</td>
                  <td>'.$getAccs->login.'</td>
                  <td>'.$getAccs->name.'</td>
                </tr>';
                $x++;
              }
            ?>
            <tr>
              <td>
                <select class="form-control" name="banGrund">
                  <?PHP
                  
                    foreach($banGruende AS $gruende) {
                      echo'<option value="'.$gruende.'">'.$gruende.'</option>';
                    }
                    
                  ?>
                </select></td>
                <td>Motiv</td>
                <td><input type="text" class="form-control" name="banEingabe" size="50" maxlength="150" />
              </td>
            </tr>
            <tr>
              <th class="topLine" style="text-align:center;" colspan="3"><input class="btn btn-danger" role="button" type="submit" name="submit" value="Baneaza"/></th>
            </tr>
          </tbody></table></div>
        </form>
        <?PHP
      }
      else {
          echo'<div class="alert alert-info" role="alert">
					Pe IP-ul acesta nu s-au g&#259;sit conturi.
				</div>';
      }
    }
    else {
          echo'<div class="alert alert-danger" role="alert">
					Nu a&#355;i introdus nici un IP.
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