<?php if(isset($_SESSION['user_admin']) && checkInt($_SESSION['user_admin']) && $_SESSION['user_admin']>=0) { ?>
				<div class="page-header">
					<h1><?php include("./user/name_sv.php"); ?> - Schimbare parolă depozit</h1>
				</div>
	
 <?PHP
 if(isset($_POST['submit']) && $_POST['submit']=="Schimba") {
      if(checkAnum($_POST['lnpass']) && strlen($_POST['lnpass'])>=1 && strlen($_POST['lnpass'])<=6 && $_POST['lnpass']==$_POST['lnpass2']) {
        $oldPass = ((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_POST['lopass']) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
        $newPass = ((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_POST['lnpass']) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
        $sqlCmd = "SELECT password FROM player.safebox WHERE password='".$oldPass."' AND account_id='".$_SESSION['user_id']."' LIMIT 1";
        $sqlQry = mysqli_query($sqlServ, $sqlCmd);
        if(mysqli_num_rows($sqlQry)==1) {
          $passCmd = "UPDATE player.safebox SET password='".$newPass."' WHERE account_id='".$_SESSION['user_id']."' LIMIT 1;";
          $passUpdate = mysqli_query($sqlServ, $passCmd);
          if($passUpdate) {
            echo'<div class="alert alert-success" role="alert">
					A&#355;i schimbat cu succes parola depozitului.
				</div>';
          }
          else {
            echo'<div class="alert alert-danger" role="alert">
					Schimbarea parolei depozitului a e&#351;uat.
				</div>';
          }
        }
        else {
            echo'<div class="alert alert-danger" role="alert">
					Parola depozitului introdus&#259; este incorect&#259;.
				</div>';
        }
        
      }
      else {
            echo'<div class="alert alert-danger" role="alert">
					Nu a&#355;i introdus toate datele corect.
				</div>';
      }
    }
  ?>
<div class="well">
          <form name="registerForm" id="registerForm" action="index.php?page=safebox" method="POST">
          <div>  
		  					<div>
							<label for="password">Parola veche:*
								</label>
								<input
								type="password"
								class="form-control input-lg validate[required,custom[noSpecialCharacters],length[1,6]]"
								id="password"
								name="lopass"
								maxlength="6"
								value=""
								AUTOCOMPLETE="off"
								/>
							</div>
									  										<div>
							<label for="password">Parola nou&#259;:*
								</label>
								<input
								type="password"
								class="form-control input-lg validate[required,custom[noSpecialCharacters],length[1,6]]"
								id="password"
								name="lnpass"
								maxlength="6"
								value=""
								AUTOCOMPLETE="off"
								/>
							</div>
							<div>
								<label for="password">Repet&#259; parola nou&#259;:*
								</label>
								<input
								type="password"
								class="form-control input-lg validate[required,custom[noSpecialCharacters],length[1,6]]"
								id="password"
								name="lnpass2"
								maxlength="6"
								value=""
								AUTOCOMPLETE="off"
								/>
							</div></div>
              <br/><input id="submitBtn" type="submit" name="submit" value="Schimba" class="btn btn-lg btn-success" role="button"/>
        </form>
						<p id="regLegend">* este necesar</p></div>
  <?PHP
  }
  else {
    echo'
	  <div class="alert alert-danger" role="alert">
        <strong>Trebuie </strong> să fi logat pentru a accesa aceast&#259; zon&#259;.
      </div>
	';
  }
?>