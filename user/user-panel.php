<?PHP
if(!isset($_SESSION)){session_start();}
	
  if(isset($_SESSION['user_admin']) && checkInt($_SESSION['user_admin']) && $_SESSION['user_admin']>=0) {
		$sqlCoins = "SELECT coins FROM account.account WHERE id='".((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_SESSION['user_id']) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."' LIMIT 1";
        $qryCoins = mysqli_query($sqlServ, $sqlCoins);
        $getCoins = mysqli_fetch_object($qryCoins);
?>
	<center><h4>Salutare, <font color="#428bca"><b><?php echo $_SESSION['real_name']; ?></b></font>!</h4> <hr>
     Monede de&#355;inute: <b>
	<?PHP 
	echo $getCoins->coins;
	?></b> <img src="./images/icons/coins.png" width="16" height="16" /></center>
	<br>
    <div class="list-group">
    <?PHP
        if($_SESSION['user_admin']>0) { echo'<a class="list-group-item active" href="?page=admin"><img src="./images/icons/user_red.png" width="16" height="16" /> Administrare</a>'; }
      ?>
      <a class="list-group-item" href="?page=profil"><img src="./images/icons/user_suit.png" width="16" height="16" /> Administrează Cont</a>
			<?php
			$ch = mysqli_query($sqlHp, "SELECT * FROM ".SQL_HP_DB.".settings WHERE id=10");
			$chat = mysqli_fetch_assoc($ch);
			if ($chat['value'] == "3") {
			?>
			<a class="list-group-item" href="?page=chat"><span class="glyphicon glyphicon-envelope"></span> Chat cu ceilalți jucători</a>
			<?php } ?>
      <a class="list-group-item" href="?page=password"><img src="./images/icons/user_edit.png" width="16" height="16" /> Schimbă parola</a>
	  <?php if($email_server) { ?>
      <a class="list-group-item" href="?page=email"><img src="./images/icons/user_email_edit.png" width="16" height="16" /> Schimbă email</a>
	  <?php } ?>
      <a class="list-group-item" href="?page=coupon"><img src="./images/icons/coupon.png" width="16" height="16" /> Validează un cupon</a>
      <a class="list-group-item" href="?page=logout"><img src="./images/icons/delogare.png" width="16" height="16" /> Ieșire</a>
      </div>
    <?PHP
  }
  else {
  ?><center>
		   
			   
						<form name="loginForm" id="loginForm" action="index.php?page=login" method="post">
							<div>
								<label for="username">Nume de utilizator: *</label>
								<input AUTOCOMPLETE="off" type="text" class="validate[required,custom[noSpecialCharacters],length[3,16]] form-control -webkit-transition" id="username" name="user" maxlength="16" value=""/>
							</div>
							<div>
								<label for="password">Parol&#259;: *</label>
								<input AUTOCOMPLETE="off" type="password" class="validate[required,length[5,16]] form-control -webkit-transition" id="password" name="pw" maxlength="16" value=""/>
							</div>

							</br>
							<input id="submitBtn" class="btn btn-success" type="submit" name="login" value="Logare"/>
							<?php if($email_server) { ?>
							<hr>
							<a href="index.php?page=passwordlost">Ai uitat parola?</a>
							<?php } ?>
						</form>		
	</center>
  <?PHP
  } 
?>