<?php
if($email_server){
if(!isset($_SESSION)){session_start();}
if(isset($_GET['page'])) {
if(isset($_SESSION['user_admin']) && checkInt($_SESSION['user_admin']) && $_SESSION['user_admin']>=0) { ?>
<div class="page-header">
        <h1><?php include("./user/name_sv.php"); ?> - Schimbare parolă</h1>
      </div>
<div class="well">
 <?PHP
	$x=1;
	$changed=0;
    if(isset($_POST['submit']) && $_POST['submit']=="Schimbă!" && isset($_GET['code']) && strlen($_GET['code'])==32) {
		
		$code = sanitize(stripInput($_GET['code']));
		
		$check = "SELECT * from account.account where id='".$_SESSION['user_id']."' and passchange_token = '" . $code . "'";
		$query = mysqli_query($sqlServ, $check);
		$num = mysqli_num_rows($query);
		
		if($num>0){
		  if(checkAnum($_POST['npass']) && !empty($_POST['opass']) && (!empty($_POST['npass']) && strlen($_POST['npass'])>=8 && strlen($_POST['npass'])<=16) && $_POST['npass']==$_POST['npass2']) {
			
			$oldPass = ((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_POST['opass']) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
			$newPass = ((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_POST['npass']) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
			
			$sqlCmd = "SELECT id,login FROM account.account WHERE password=PASSWORD('".$oldPass."') AND id='".$_SESSION['user_id']."' LIMIT 1";
			$sqlQry = mysqli_query($sqlServ, $sqlCmd);
			
			if(mysqli_num_rows($sqlQry)==1) {
			
			  $passCmd = "UPDATE account.account SET password=PASSWORD('".$newPass."') WHERE id='".$_SESSION['user_id']."' LIMIT 1;";
			  $passUpdate = mysqli_query($sqlServ, $passCmd);
			  
			  if($passUpdate) {
				$x=0;
				$changed=1;
				$passCmd = "UPDATE account.account SET passchange_token='1' WHERE id='".$_SESSION['user_id']."' LIMIT 1;";
				$passUpdate = mysqli_query($sqlServ, $passCmd);	
				echo'<div class="alert alert-success" role="alert">
						Parola a fost schimbat&#259; cu succes.
					  </div>';
				echo "<meta http-equiv='refresh' content='0; URL=index.php?page=logout'>";
			  }
			  else {
				echo'
		  <div class="alert alert-danger" role="alert">
			Schimbarea parolei a e&#351;uat.
		  </div>';
			  }
			  
			}
			else {
			  echo'
		  <div class="alert alert-danger" role="alert">
			Parola care a&#355;i introdus-o este incorect&#259;.
		  </div>';
			}
			
		  }
      else {
			echo'
		  <div class="alert alert-danger" role="alert">
			Nu ai introdus toate informa&#355;iile corect.
		  </div>';
		  }
      
		}
	else echo'<div class="alert alert-danger" role="alert">
				Link-ul nu este corect. E&#351;ti sigur c&#259; ai copiat corect link-ul din e-mail?
			  </div>';
	  
    }
    if(isset($_POST['request']) && $_POST['request']=="Trimite") {
		$x=0;
		$code = generateRandomString(32);
		$passCmd = "UPDATE account.account SET passchange_token='".$code."' WHERE id='".$_SESSION['user_id']."' LIMIT 1;";
		$passUpdate = mysqli_query($sqlServ, $passCmd);	
		echo '<div class="alert alert-success" role="alert">Un email ce conține un link va fi trimis către dumneavoastra curând, cu acesta puteți să vă schimbați parola.</div>';

		require 'user/mailer/PHPMailerAutoload.php';

		$email_from = 'noreply@'.$_SERVER['SERVER_NAME'];
		$mail = new PHPMailer;
		$mail->isSendmail();
		$mail->setFrom($email_from);
		$mail->addAddress($_SESSION['email']);
		$mail->Subject = 'Parol&#259; nouă';
			
		$url = $_SERVER['REQUEST_URI']; //returns the current URL
		$parts = explode('/',$url);
		$dir = $_SERVER['SERVER_NAME'];
		for ($i = 0; $i < count($parts) - 1; $i++) {
			$dir .= $parts[$i] . "/";
		}
													
		$mail->msgHTML(file_get_contents('http://'.$dir.'user/email-content.php?name='.$_SESSION['id'].'&action=2&code='.$code), dirname(__FILE__));

		if (!$mail->send()) {
			echo '<div class="alert alert-warning" role="alert">Mailer Error: ' . $mail->ErrorInfo.'</div>';
			$email_config = fopen("inc/email.php", "w");
			$txt = '<?php $email_server=false;';
			fwrite($email_config, $txt);
			fclose($email_config);
		}
		
	}
	if(isset($_GET['code']) && strlen($_GET['code'])==32 && !$changed)
	{
		$code = sanitize(stripInput($_GET['code']));
		
		$check = "SELECT * from account.account where id='".$_SESSION['user_id']."' and passchange_token = '" . $code . "'";
		$query = mysqli_query($sqlServ, $check);
		$num = mysqli_num_rows($query);
		
		if($num > 0) {
			$x = 0;
?>
<form name="registerForm" id="registerForm" action="" method="POST">
    <div>
        <label for="password">Parola veche:*
        </label>
        <input type="password" class="form-control input-lg validate[required,custom[noSpecialCharacters],length[8,16]]" id="password" name="opass" maxlength="16" value="" AUTOCOMPLETE="off" />
    </div>
    <div>
        <label for="password">Parola nou&#259;:*
        </label>
        <input type="password" class="form-control input-lg validate[required,custom[noSpecialCharacters],length[8,16]]" id="password" name="npass" maxlength="16" value="" AUTOCOMPLETE="off" />
    </div>
    <div>
        <label for="password">Repet&#259; parola nou&#259;:*
        </label>
        <input type="password" class="form-control input-lg validate[required,custom[noSpecialCharacters],length[8,16]]" id="password" name="npass2" maxlength="16" value="" AUTOCOMPLETE="off" />
    </div>
    <br/>
    <input id="submitBtn" type="submit" name="submit" value="Schimbă!" class="btn btn-lg btn-success role=" button ""/>
</form>
<?php	}
		else
		{
			echo'<div class="alert alert-danger" role="alert">
					Link-ul nu este corect. E&#351;ti sigur c&#259; ai copiat corect link-ul din e-mail?
				  </div>';
		}
	}
	else if(isset($_GET['code']) && strlen($_GET['code'])!=32)
	{
		echo'<div class="alert alert-danger" role="alert">
				Link-ul nu este corect. E&#351;ti sigur c&#259; ai copiat corect link-ul din e-mail?
			  </div>';
	}
	if($x)
	{
  ?>
	<div class="alert alert-info" role="alert">Vei primi un link de schimbare al parolei, accesează-l și urmărește instrucțiunile pentru a crea o noua parolă.</div>
	<form name="request" id="request" action="index.php?page=password" method="POST">        
              <br/><input type="submit" name="request" value="Trimite" class="btn btn-success btn-lg btn-block"/>
    </form>
<?php } ?>
</div>
  <?PHP
  }
  else {
    echo'
	  <div class="alert alert-danger" role="alert">
        <strong>Trebuie </strong> să fi logat pentru a accesa aceast&#259; zon&#259;.
      </div>
	';
  }
  }
  else {
    echo 'Nu ave&#355;i permisiunea s&#259; accesa&#355;i pagina direct!';
	echo "<meta http-equiv='refresh' content='0; URL=../index.php'>"; }
}
else
{
?>

<?php
if(!isset($_SESSION)){session_start();}
if(isset($_GET['page'])) {
if(isset($_SESSION['user_admin']) && checkInt($_SESSION['user_admin']) && $_SESSION['user_admin']>=0) { ?>
<div class="page-header">
        <h1><?php include("./user/name_sv.php"); ?> - Schimbare parolă</h1>
      </div>
 <?PHP
   
    if(isset($_POST['submit']) && $_POST['submit']=="Schimbă!") {
    
      if(checkAnum($_POST['npass']) && !empty($_POST['opass']) && (!empty($_POST['npass']) && strlen($_POST['npass'])>=8 && strlen($_POST['npass'])<=16) && $_POST['npass']==$_POST['npass2']) {
        
        $oldPass = ((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_POST['opass']) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
        $newPass = ((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_POST['npass']) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
        
        $sqlCmd = "SELECT id,login FROM account.account WHERE password=PASSWORD('".$oldPass."') AND id='".$_SESSION['user_id']."' LIMIT 1";
        $sqlQry = mysqli_query($sqlServ, $sqlCmd);
        
        if(mysqli_num_rows($sqlQry)==1) {
        
          $passCmd = "UPDATE account.account SET password=PASSWORD('".$newPass."') WHERE id='".$_SESSION['user_id']."' LIMIT 1;";
          $passUpdate = mysqli_query($sqlServ, $passCmd);
          
          if($passUpdate) {
            echo'
	  <div class="alert alert-success" role="alert">
        Parola a fost schimbat&#259; cu succes.
      </div>';
          }
          else {
            echo'
	  <div class="alert alert-danger" role="alert">
        Schimbarea parolei a e&#351;uat.
      </div>';
          }
          
        }
        else {
          echo'
	  <div class="alert alert-danger" role="alert">
        Parola care a&#355;i introdus-o este incorect&#259;.
      </div>';
        }
        
      }
      else {
        echo'
	  <div class="alert alert-danger" role="alert">
        Nu ai introdus toate informa&#355;iile corect.
      </div>';
      }
      
    }
  ?>

<div class="well">
        <form name="registerForm" id="registerForm" action="index.php?page=password" method="POST">
					         <div>
							<label for="password">Parola veche:*
								</label>
								<input
								type="password"
								class="form-control input-lg validate[required,custom[noSpecialCharacters],length[8,16]]"
								id="password"
								name="opass"
								maxlength="16"
								value=""
								AUTOCOMPLETE="off"
								/>
							</div>
							<div>
							<label for="password">Parola nou&#259;:*
								</label>
								<input
								type="password"
								class="form-control input-lg validate[required,custom[noSpecialCharacters],length[8,16]]"
								id="password"
								name="npass"
								maxlength="16"
								value=""
								AUTOCOMPLETE="off"
								/>
							</div>
							<div>
								<label for="password">Repet&#259; parola nou&#259;:*
								</label>
								<input
								type="password"
								class="form-control input-lg validate[required,custom[noSpecialCharacters],length[8,16]]"
								id="password"
								name="npass2"
								maxlength="16"
								value=""
								AUTOCOMPLETE="off"
								/>
							</div>	
              <br/><input id="submitBtn" type="submit" name="submit" value="Schimbă!" class="btn btn-lg btn-success role="button""/>
        </form>
</div>
  <?PHP
  }
  else {
    echo'
	  <div class="alert alert-danger" role="alert">
        <strong>Trebuie </strong> să fi logat pentru a accesa aceast&#259; zon&#259;.
      </div>
	';
  }
  }
  else {
    echo 'Nu ave&#355;i permisiunea s&#259; accesa&#355;i pagina direct!';
	echo "<meta http-equiv='refresh' content='0; URL=../index.php'>"; }
?>

<?php 
}
?>