<?php
if($email_server){
if(!isset($_SESSION)){session_start();}
if(isset($_GET['page'])) {
if(isset($_SESSION['user_admin']) && checkInt($_SESSION['user_admin']) && $_SESSION['user_admin']>=0) { ?>
<div class="page-header">
        <h1><?php include("./user/name_sv.php"); ?> - Schimbare adresă email</h1>
      </div>
<div class="well">
 <?PHP
	$x=1;
	$changed=0;
    if(isset($_POST['request']) && $_POST['request']=="Trimite" && isset($_POST['old']) && isset($_POST['new']) && filter_var($_POST['old'], FILTER_VALIDATE_EMAIL) && filter_var($_POST['new'], FILTER_VALIDATE_EMAIL)) {
		$check = "SELECT * from account.account where id='".$_SESSION['user_id']."' and email = '" . $_POST['old'] . "'";
		$query = mysqli_query($sqlServ, $check);
		$num = mysqli_num_rows($query);
		
		$check_email = "SELECT * FROM account.account WHERE email = '".$_POST['new']."'";
		$check_email = $sqlServ->query($check_email);
		$rows_email = $check_email->num_rows;
		
		if($rows_email<1)
		{
			if($num>0){

				$x=0;
				$code = generateRandomString(32);
				$passCmd = "UPDATE account.account SET new_email_change='".$_POST['new']."', new_email_change2='".$code."' WHERE id='".$_SESSION['user_id']."' LIMIT 1;";
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
															
				$mail->msgHTML(file_get_contents('http://'.$dir.'user/email-content.php?name='.$_SESSION['id'].'&action=3&code='.$code), dirname(__FILE__));

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
					Adresă de email incorectă!
				  </div>';
			}
		}
		else {
			echo'<div class="alert alert-danger" role="alert">
				Noua adresă de email este atașată altui cont.
			  </div>';
		}
	}
	if(isset($_GET['code']) && strlen($_GET['code'])==32 && !$changed)
	{
		$code = sanitize(stripInput($_GET['code']));
		
		$check = "SELECT * from account.account where id='".$_SESSION['user_id']."' and new_email_change2 = '" . $code . "'";
		$query = mysqli_query($sqlServ, $check);
		$num = mysqli_num_rows($query);
		
		if($num > 0) {
			$x = 0;
			$passCmd = "UPDATE account.account SET email=new_email_change, new_email_change='1', new_email_change2='0' WHERE id='".$_SESSION['user_id']."' LIMIT 1;";
			$passUpdate = mysqli_query($sqlServ, $passCmd);	
			echo'<div class="alert alert-success" role="alert">
					Adresa de email a fost schimbată!
					 </div>';
			echo "<meta http-equiv='refresh' content='0; URL=index.php?page=logout'>";
		}
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
	<form name="request" id="request" action="index.php?page=email" method="POST">
		<div>
			<label for="email_old">Adres&#259; veche de e-mail: *
			</label>
			<input type="email" name="old" class="form-control input-lg" pattern=".{7,64}" maxlength="64"/>
		</div>
		<div>
			<label for="email_new">Adres&#259; nou&#259; de e-mail: *
			</label>
			<input type="email" name="new" class="form-control input-lg" pattern=".{7,64}" maxlength="64"/>
		</div>
        </br>
		<input type="submit" name="request" value="Trimite" class="btn btn-success btn-lg btn-block"/>
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
	echo "<meta http-equiv='refresh' content='0; URL=index.php?page=home'>";
?>