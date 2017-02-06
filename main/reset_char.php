 <div class="page-header">
<?php if(isset($_SESSION['user_admin']) && checkInt($_SESSION['user_admin']) && $_SESSION['user_admin']>=0) { ?>
 <h1><?php include("./user/name_sv.php"); ?> - Resetare caractere</h1>
      </div>
 
 
 <?PHP   
    if(isset($_GET['char']) && checkInt($_GET['char'])) {
      $sqlCmd = "SELECT player.name, player_index.empire, UNIX_TIMESTAMP(player.last_play) AS timeStamp 
        FROM player.player
        INNER JOIN player.player_index ON player.account_id = player_index.id
        WHERE player.id = '".$_GET['char']."'
        AND player.account_id = '".$_SESSION['user_id']."'
        LIMIT 1";
      $sqlQry = mysqli_query($sqlServ, $sqlCmd);
    
      if(mysqli_num_rows($sqlQry)>0) {
        $getChar = mysqli_fetch_object($sqlQry);
        $difSpielzeit = time()-$getChar->timeStamp;
        $toGoTime = (5*60)-($difSpielzeit);
        $toGoMin = floor(($toGoTime)/60);
        $toGoSek = ($toGoTime)%60;
        if(($difSpielzeit/60)>=5) {
        		
		if($getChar->empire=='1') { $mapindex = "0"; $x = "459770"; $y = "953980";} //regat rosu
		elseif($getChar->empire=='2') { $mapindex = "21"; $x = "52043"; $y = "166304";} //regat galben
		elseif($getChar->empire=='3') { $mapindex = "41"; $x = "957291"; $y = "255221";} //regat albastru

		
          $sqlUpdate = "UPDATE player.player SET map_index='".$mapindex."', x='".$x."', y='".$y."', exit_x='0', exit_y='0', exit_map_index='".$mapindex."', horse_riding='0' WHERE id='".$_GET['char']."' LIMIT 1";
          $updatePos = mysqli_query($sqlServ, $sqlUpdate);
          if($updatePos) {
            echo '
			
	   <div class="alert alert-info" role="alert">
        <strong> Caracterul &laquo;</strong>'.$getChar->name.'</strong>&raquo; a fost teleportat cu succes &#238;n prima hart&#259;. </br>Dac&#259; nu merge, da&#355;i ie&#351;ire joc &#351;i a&#351;tepta&#355;i pu&#355;in apoi &#238;ncerca&#355;i din nou.
      </div>
	  
			';
          }
          else { echo'
	   <div class="alert alert-danger" role="alert">
        O <strong> eroare</strong> a aparut, v&#259; rug&#259;m contacta&#355;i un Administrator.
      </div>
		  '; }
          
        }
        else {
          echo'
	   <div class="alert alert-info" role="alert">
        <strong>Trebuie </strong> s&#259; fi delogat de cel pu&#355;in 5 minute. Trebuie sa a&#351;tep&#355;i '.$toGoMin.' minute &#351;i '.$toGoSek.' secunde.
      </div>
		  ';
        }
        
      }
      else {
        echo'
	   <div class="alert alert-danger" role="alert">
        Caracterul specificat nu <strong>exist&#259;</strong>.
      </div>
		';
      }
    
    }
    echo'<a href="javascript: history.go(-1)" class="btn btn-warning" role="button">&#171; &#206;napoi</a>';
  }
  else {
    echo'
	  <div class="alert alert-danger" role="alert">
        <strong>Trebuie </strong> să fi logat pentru a accesa aceast&#259; zon&#259;.
      </div>
	';
  }
?>