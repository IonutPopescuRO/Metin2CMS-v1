<?php
if($email_server){
if(empty($_SESSION['id'])){ ?>
<div class="page-header">
    <h1><?php include("./user/name_sv.php"); ?> - Recuperare cont</h1>
</div>
<div class="well">
 <?PHP
	$x = 1;
    if(isset($_POST['send']) && $_POST['send']=="Trimite") {
		if(isset($_POST['captcha']) && $_POST['captcha']==$_SESSION['captcha']['code']) {
		  if(checkAnum($_POST['user']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

			((bool)mysqli_query($sqlServ, "USE account"));
			$user = sanitize(stripInput($_POST['user']));
			$email = sanitize(stripInput($_POST['email']));
			
			$check = "SELECT * from account where login = '" . $user . "' and email = '" . $email . "'";
			$query = mysqli_query($sqlServ, $check);
			$num = mysqli_num_rows($query);
			
			if($num > 0) {
				$x = 0;
				$code = generateRandomString(32);
				$passCmd = "UPDATE account.account SET passlost_token='".$code."' WHERE login='".$user."' LIMIT 1;";
				$passUpdate = mysqli_query($sqlServ, $passCmd);	
				echo'<div class="alert alert-success" role="alert">
						Imediat ar trebui s&#259; prime&#351;ti un link de confirmare &#238;n e-mail prin intermediul c&#259;ruia &#238;&#355;i vei putea schimba parola.
					  </div>';
		
				require 'user/mailer/PHPMailerAutoload.php';

				$email_from = 'noreply@'.$_SERVER['SERVER_NAME'];
				$mail = new PHPMailer;
				$mail->isSendmail();
				$mail->setFrom($email_from);
				$mail->addAddress($email);
				$mail->Subject = 'Parol&#259; nouă';
				
				$url = $_SERVER['REQUEST_URI']; //returns the current URL
				$parts = explode('/',$url);
				$dir = $_SERVER['SERVER_NAME'];
				for ($i = 0; $i < count($parts) - 1; $i++) {
					$dir .= $parts[$i] . "/";
				}
														
				$mail->msgHTML(file_get_contents('http://'.$dir.'user/email-content.php?name='.$user.'&action=1&code='.$code), dirname(__FILE__));

				if (!$mail->send()) {
					echo '<div class="alert alert-warning" role="alert">Mailer Error: ' . $mail->ErrorInfo.'</div>';
					$email_config = fopen("inc/email.php", "w");
					$txt = '<?php $email_server=false;';
					fwrite($email_config, $txt);
					fclose($email_config);
				}
			}
			  else {
				echo'<div class="alert alert-danger" role="alert">
						Numele de utilizator &#351;i adresa men&#355;ionat&#259; nu corespund.
					  </div>';
			  }
			  
			}
			else {
				echo'<div class="alert alert-danger" role="alert">
						Nu ai introdus toate informa&#355;iile corect.
					  </div>';
			}
		}
			else {
				echo'<div class="alert alert-danger" role="alert">
						Cod de securitate incorect.
					  </div>';
			}
      }
	  if(isset($_GET['name']) && isset($_GET['code']) && strlen($_GET['code'])==32 && !isset($_POST['change']))
	  {
			$user = sanitize(stripInput($_GET['name']));
			$code = sanitize(stripInput($_GET['code']));
			
			((bool)mysqli_query($sqlServ, "USE account"));
			$check = "SELECT * from account where login = '" . $user . "' and passlost_token = '" . $code . "'";
			$query = mysqli_query($sqlServ, $check);
			$num = mysqli_num_rows($query);
			
			if($num > 0) {
				$x = 0;
?>
    <form name="passwordchange" id="passwordchange" action="" method="post">
        <div>
            <label for="password">Parola nouă: *</label>
			<input type="password" class="form-control input-lg" name="password" pattern=".{8,16}" maxlength="16" placeholder="Parolă nouă" required title="Între 8 și 16 caractere permise.">
        </div>
		</br>
        <input id="submitBtn" class="btn-big btn-success btn-lg btn" name="change" value="Trimite" type="submit">
    </form>
<?php		}
			else
			{
				echo'<div class="alert alert-danger" role="alert">
						Link-ul nu este corect. E&#351;ti sigur c&#259; ai copiat corect link-ul din e-mail?
					  </div>';
			}
	  }
	  else if(isset($_GET['name']) && isset($_GET['code']) && strlen($_GET['code'])==32 && isset($_POST['change']) && $_POST['change']=="Trimite")
	  {
			((bool)mysqli_query($sqlServ, "USE account"));
			$user = sanitize(stripInput($_GET['name']));
			$code = sanitize(stripInput($_GET['code']));
			$password = sanitize(stripInput($_POST['password']));
			
			$check = "SELECT * from account where login = '" . $user . "' and passlost_token = '" . $code . "'";
			$query = mysqli_query($sqlServ, $check);
			$num = mysqli_num_rows($query);

			if($num > 0 && !empty($password) && strlen($password)>=8 && strlen($password)<=16) {
				$x = 0;
				
				$passCmd = "UPDATE account.account SET password=PASSWORD('".$password."') WHERE login = '" . $user . "' LIMIT 1;";
				$passUpdate = mysqli_query($sqlServ, $passCmd);
				
				$passCmd = "UPDATE account.account SET passlost_token='1' WHERE login='".$user."' LIMIT 1;";
				$passUpdate = mysqli_query($sqlServ, $passCmd);	
			  
				echo'<div class="alert alert-success" role="alert">
						Parola a fost schimbat&#259; cu succes!
					  </div>';
			}
			else
			{
				echo'<div class="alert alert-danger" role="alert">
						Date incorecte. Te rug&#259;m s&#259; &#238;ncerci dn nou.
					  </div>';
			}
	  }
	  else if(isset($_GET['code']) && strlen($_GET['code'])!=32)
	  {
			echo'<div class="alert alert-danger" role="alert">
					Link-ul nu este corect. E&#351;ti sigur c&#259; ai copiat corect link-ul din e-mail?
				  </div>';
	  }
	require 'captcha/simple-php-captcha.php';
	$_SESSION['captcha'] = simple_php_captcha();
	
	if($x) {
  ?>

    <form name="passwordlost" id="passwordlost" action="index.php?page=passwordlost" method="post">
        <div>
            <label for="username">Nume de utilizator: *</label>
            <input class="form-control input-lg" name="user" placeholder="Nume utilizator" maxlength="16" required="" type="text">
        </div>
        <div>
            <label for="password">Email: *</label>
			<input class="form-control input-lg" name="email" pattern=".{7,64}" maxlength="64" placeholder="Email" required="" type="email">
        </div>
        <div>
			<label for="password">Cod de securitate: *</label>
			<table class="table table-striped">
				<tbody>
					<tr>
						<td><?php print '<img src='.$_SESSION['captcha']['image_src'].'>'; ?></td>
						<td><input type="text" style='height:70px; font-size: 30px;' class="form-control" name="captcha" pattern=".{4,6}" maxlength="5" placeholder="Cod securitate" required title="Maxim 15 caractere."></td>
					</tr>
				</tbody>
			</table>
        </div>
		</br>
        <input id="submitBtn" class="btn-big btn-success btn-lg btn" name="send" value="Trimite" type="submit">
    </form>
	
	  <?php } ?>
</div>
<?php } 
else { echo "<meta http-equiv='refresh' content='0; URL=index.php?page=home'>";}
}
else
	echo "<meta http-equiv='refresh' content='0; URL=index.php?page=home'>";
?>