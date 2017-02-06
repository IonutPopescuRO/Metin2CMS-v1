<?PHP
  if(!isset($_SESSION)){session_start();}
  if(isset($_GET['page'])) {
  if(isset($_GET['a'])) {
  if (isset($_SESSION['user_admin'])) { 
  if($_SESSION['user_admin']>=$adminRights['game_admins']) {
  $gmRechte = array(
    'SGA' => 'IMPLEMENTOR',
    'GA' => 'HIGH_WIZARD',
    'GM' => 'GOD',
    'TGM' => 'LOW_WIZARD',
    'PLAYER' => 'PLAYER'
  );
?>
<h2>Administrare - Editare administratorii jocului</h2>
<div class="well">
<?PHP

  // IPs aktualisieren
  if(isset($_POST['ips']) && $_POST['ips']=="Actualizare") {
    $anzIPs = count($_POST['ipalt']);
    for($i=0;$i<$anzIPs;$i++) {
      if(checkIP($_POST['ipaddr'][$i]) && checkIP($_POST['ipalt'][$i])) {
        $sqlIp = "UPDATE common.gmhost SET mIP='".((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_POST['ipaddr'][$i]) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."' WHERE mIP='".((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_POST['ipalt'][$i]) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."' LIMIT 1;";
        $qryIp = mysqli_query($sqlServ, $sqlIp);
      }
    }
    
    if(is_array($_POST['delip'])) {
      foreach($_POST['delip'] AS $delID) {
        $cmdDelete = "DELETE FROM common.gmhost WHERE mIP='".$delID."' LIMIT 1";
        $qryDelete = mysqli_query($sqlServ, $cmdDelete);
      }
    }
    
    echo'<div class="alert alert-success" role="alert">IP-ul a fost updatat cu succes.</div>';
  }

  // IP hinzuf&uuml;gen
  if(isset($_POST['addip']) && $_POST['addip']=="Adauga") {
    if(checkIP($_POST['ip'])) {
      $sqlIp = "INSERT INTO common.gmhost VALUES ('".((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_POST['ip']) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."');";
      $qryIp = mysqli_query($sqlServ, $sqlIp);
      if($qryIp) {
        echo'<div class="alert alert-success" role="alert">Ip-ul a fost ad&#259;ugat cu succes.</div>';
      }
      else { echo'<div class="alert alert-danger" role="alert">Adãugarea IP-ului a e&#351;uat.</div>'; }
    }
  }

  // Admins aktualisieren
  if(isset($_POST['admins']) && $_POST['admins']=="Actualizare") {
    $anzAdmins = count($_POST['mID']);
    for($i=0;$i<$anzAdmins;$i++) {
      if(checkInt($_POST['mID'][$i]) && !empty($_POST['account'][$i]) && !empty($_POST['charakter'][$i]) && checkIP($_POST['adminip'][$i]) && !empty($_POST['rechte'][$i])) {
        $sqlAdmins="UPDATE common.gmlist SET mAccount='".((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_POST['account'][$i]) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."',mName='".((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_POST['charakter'][$i]) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."',mContactIp='".((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_POST['adminip'][$i]) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."',mAuthority='".((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_POST['rechte'][$i]) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."' WHERE mID='".$_POST['mID'][$i]."' LIMIT 1;";
        $qryAdmins=mysqli_query($sqlServ, $sqlAdmins);
      }
    }
    
    if(is_array($_POST['del'])) {
      foreach($_POST['del'] AS $delID) {
        $cmdDelete = "DELETE FROM common.gmlist WHERE mID='".$delID."' LIMIT 1";
        $qryDelete = mysqli_query($sqlServ, $cmdDelete);
      }
    }
    
    echo'<div class="alert alert-success" role="alert">Admini au fost updata&#355;i cu succes.</div>';
  }
  
  // Admin hinzufügen
  if(isset($_POST['add']) && $_POST['add']=="Adauga") {
    if(!empty($_POST['account']) && !empty($_POST['charakter']) && checkIP($_POST['ip']) && !empty($_POST['rechte'])) {
      $sqlIns = "INSERT INTO common.gmlist VALUES (NULL,'".((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_POST['account']) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_POST['charakter']) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".$_POST['ip']."','ALL','".((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_POST['rechte']) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."');";
      $qryIns = mysqli_query($sqlServ, $sqlIns);
      if($qryIns) {
        echo'<div class="alert alert-success" role="alert">Adminul a fost ad&#259;ugat cu succes.</div>';
      }
      else {
        echo'<div class="alert alert-danger" role="alert">Adaugarea adminului a e&#351;uat.</div>';
      }
    
    }
    else {
      echo'<div class="alert alert-danger" role="alert">Nu ati introdus toate datele corect. V&#259;rugam re&#226;ncerca&#355;i.</div>';
    }
  }
?>
<div class="splitLeft">
  <h3>Lista IP-urilor</h3>
  <form action="index.php?page=admin&a=gadmins" method="POST">
    <table class="table table-striped">
      <tr>
        <td>
          <div class="ipListBox">
            <table>
              <tr>
                <th class="topLine">Lista IP-urilor</th>
                <th class="topLine">&#350;tergere</th>
              </tr>
            <?PHP
              $sqlIps = "SELECT mIP FROM common.gmhost";
              $resIps = mysqli_query($sqlServ, $sqlIps);
              
              $x=0;
              while($getIps = mysqli_fetch_object($resIps)) {
                $zS = ($x%2==0) ? "tdunkel" : "thell";
                echo'<tr>
                  <td class="'.$zS.'">
                    <input type="hidden" name="ipalt[]" value="'.$getIps->mIP.'"/>
                    <input class="form-control" type="text" name="ipaddr[]" size="16" maxlength="16" value="'.$getIps->mIP.'"/>
                  </td>
                  <td class="'.$zS.'" style="text-align:center">
                    <input type="checkbox" name="delip[]" value="'.$getIps->mIP.'"/>
                  </td>
                </tr>';
                $x++;
              }
            ?>
            </table>
          </div>
        </td>
      </tr>
      <tr>
        <td class="topLine" style="text-align:center;"><input class="btn btn-success" role="button" type="submit" name="ips" value="Actualizare"/></th>
      </tr>
    </table>
  </form>
</div>
<div class="splitRight">
  <h3>Ad&#259;ugare admin</h3>
  <form action="index.php?page=admin&a=gadmins" method="POST">
  <table class="table table-striped">
    <tr>
      <th class="topLine">Cont</th>
      <th class="topLine">Caracter</th>
    </tr>
    <tr>
      <td class="tdunkel"><input class="form-control" type="text" name="account" size="10" maxlength="16"/></td>
      <td class="tdunkel"><input class="form-control" type="text" name="charakter" size="10" maxlength="16"/></td>
    </tr>
    <tr>
      <th class="topLine">Adresa IP</th>
      <th class="topLine">Drepturile</th>
    </tr>
    <tr>
      <td class="thell">
        <select class="form-control" name="ip">
        <?PHP  
          $sqlIps = "SELECT mIP FROM common.gmhost";
          $resIps = mysqli_query($sqlServ, $sqlIps);
          
          while($getIps = mysqli_fetch_object($resIps)) {
            echo'<option value="'.$getIps->mIP.'">'.$getIps->mIP.'</option>';
          }
        ?>  
        </select>
      </td>
      <td class="thell">
        <select class="form-control" name="rechte">
        <?PHP  
        foreach($gmRechte AS $gKey => $gValue) {
          echo'<option value="'.$gValue.'">'.$gKey.'</option>';
        }  
        ?>  
        </select>
      </td>
    </tr>
    <tr>
      <th class="topLine" colspan="2" style="text-align:center;"><input class="btn btn-success" role="button" type="submit" name="add" value="Adauga"/></th>
    </tr>
  </table>
  </form>
  <form action="index.php?page=admin&a=gadmins" method="POST">
    <table class="table table-striped">
      <tr>
        <th class="topLine" colspan="3">Ad&#259;ugare IP</th>
      </tr>
      <tr>
        <th class="topLine">IP:</th>
        <td class="tdunkel"><input class="form-control" type="text" name="ip" value="" size="16" maxlength="16"/></td>
        <th class="topLine" style="text-align:center;"><input class="btn btn-success" role="button" type="submit" name="addip" value="Adauga"/></th>
      </tr>
    </table>
  </form>
</div>
<h3>Admini joc - prezentare general&#259;</h3>
<form action="index.php?page=admin&a=gadmins" method="POST">
  <table class="table table-striped">
    <tr>
      <th class="topLine">Cont</th>
      <th class="topLine">Caracter</th>
      <th class="topLine">IP</th>
      <th class="topLine">Drepturi</th>
      <th class="topLine">&#350;tergere</th>
    </tr>
    <?PHP
    
      $sqlCmd="SELECT mID,mAccount,mName,mContactIp,mAuthority FROM common.gmlist";
      $sqlQry=mysqli_query($sqlServ, $sqlCmd);
      
      $x=0;
      while($getAdmins=mysqli_fetch_object($sqlQry)) {
        echo'<input type="hidden" name="mID[]" value="'.$getAdmins->mID.'"/>
        <tr>
          <td><input class="form-control" type="text" name="account[]" size="10" maxlength="16" value="'.$getAdmins->mAccount.'" />&nbsp;&nbsp;&nbsp;&nbsp;</td>
          <td><input class="form-control" type="text" name="charakter[]" size="10" maxlength="16" value="'.$getAdmins->mName.'" />&nbsp;&nbsp;&nbsp;&nbsp;</td>
          <td>
            <select class="form-control" name="adminip[]">';
        
        $sqlIps = "SELECT mIP FROM common.gmhost";
        $resIps = mysqli_query($sqlServ, $sqlIps);
        
        while($getIps = mysqli_fetch_object($resIps)) {
          $selected =  ($getIps->mIP==$getAdmins->mContactIp) ? 'selected="selected"' : '';
          echo'<option '.$selected.' value="'.$getIps->mIP.'">'.$getIps->mIP.'</option>';
        }
          
        echo'</select>
        </td>
          <td class="'.$zS.'">
            <select class="form-control" name="rechte[]">';
          
        foreach($gmRechte AS $gKey => $gValue) {
          $selected =  ($gValue==$getAdmins->mAuthority) ? 'selected="selected"' : '';
          echo'<option '.$selected.' value="'.$gValue.'">'.$gKey.'</option>';
        }  
          
        echo'</select>
          </td>
          <td class="'.$zS.'" style="text-align:center;">
            <input type="checkbox" name="del[]" value="'.$getAdmins->mID.'"/>
          </td>
        </tr>';
        $x++;
      }
    
    ?>
    <tr>
      <th class="topLine" style="text-align:center;" colspan="5"><input class="btn btn-success" role="button" type="submit" name="admins" value="Actualizare"/></th>
    </tr>
  </table>
</form></div>
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