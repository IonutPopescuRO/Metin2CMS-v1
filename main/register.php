		<div class="page-header">
			<h1>Înregistrare</h1>
		</div>
<?php
if(isset($_SESSION['id'])) {
?>
		<div class="alert alert-warning" role="alert">
			Ca să-ți creezi un cont nou trebuie să te <a href="index.php?page=logout">deconectezi</a>.
		</div>
<?php
} else {

?>
<?php
//Verificare daca inregistrarea e dezactivata.
$rg = mysqli_query($sqlHp, "SELECT * FROM ".SQL_HP_DB.".settings WHERE id=8");
$reg = mysqli_fetch_assoc($rg);
if ($reg['value'] == 'nu') {
echo '<div class="alert alert-danger" role="alert">
			Înregistrarea este momentan <strong>dezactivată</strong>!
		</div>'; }

else {
if(!isset($_POST['register'])) {
	?>
		<div class="alert alert-info" role="alert">
			<strong>ATENȚIE!</strong> Toate câmpurile sunt obligatorii.<br> <strong>ATENȚIE!</strong>
			Adresa de e-mail trebuie să fie validă!
		</div>
		<div class="alert alert-danger" role="alert">
			<strong>ATENȚIE!</strong> Prin înregistrarea pe acest server, ești de
			acord cu <a href="index.php?page=rules">regulamentul intern</a>.
		</div>
<?php } ?>


<?php
	if(isset($_POST['register']) && !isset($_POST['agreed'])) {
		echo '<div class="alert alert-danger" role="alert">
				Trebuie să fii de acord cu regulamentul jocului.
		</div>';
	}

	if(isset($_POST['register']) && !isset($_POST['captcha'])) {
		echo '<div class="alert alert-danger" role="alert">
				Trebuie să completezi codul de securitate.
		</div>';
	}

	if(isset($_POST['register']) && isset($_POST['captcha'])) {
		if($_POST['captcha']!=$_SESSION['captcha']['code'])
			echo '<div class="alert alert-danger" role="alert">
					Codul de securitate introdus este incorect.
			</div>';
	}

	if(isset($_POST['register']) && isset($_POST['agreed']) && isset($_POST['captcha']) && $_POST['captcha']==$_SESSION['captcha']['code']) {
		
		$actions = array(
				'username' => sanitize(stripInput($_POST['username'])),
				'password' => sanitize(stripInput($_POST['password'])),
				'usermail' => sanitize(stripInput($_POST['usermail'])),
				'realname' => sanitize(stripInput($_POST['realname'])),
				'socialid' => sanitize(stripInput($_POST['socialid'])),
		);
		$errors = array();
		
		$check_login = "SELECT * FROM account.account WHERE login = '{$actions['username']}'";
		$check_login = $sqlServ->query($check_login);
		$rows_login = $check_login->num_rows;

		$check_email = "SELECT * FROM account.account WHERE email = '{$actions['usermail']}'";
		$check_email = $sqlServ->query($check_email);
		$rows_email = $check_email->num_rows;
		if($rows_login >= 1) {
			echo '<div class="alert alert-danger" role="alert">';
			echo '	Acest cont este deja înregistrat!';
			echo '</div>';
		} else if($rows_email >= 1) {
			echo '<div class="alert alert-danger" role="alert">';
			echo '	Acest e-mail este folosit deja de un alt cont!';
			echo '</div>';
		} else {
			if(filter_var($actions['usermail'], FILTER_VALIDATE_EMAIL)) {
				if($_POST['password'] == $_POST['rpassword']) {
					$query = "INSERT INTO account.account (login, password, real_name, social_id, email, create_time)
							VALUES (?, PASSWORD(?), ?, ?, ?, NOW())";
					$sanitize = array(
							':user' => $actions['username'],
							':pass' => $actions['password'],
							':mail' => $actions['usermail'],
							':name' => $actions['realname'],
							':soid' => $actions['socialid'],
					);
					$insert = $sqlServ->prepare($query);
					$insert->bind_param('sssss', $sanitize[':user'], $sanitize[':pass'], $sanitize[':name'], $sanitize[':soid'], $sanitize[':mail']);
					$insert->execute();
					echo '<div class="alert alert-success" role="alert">';
					echo '	Contul <strong>' . $actions['username'] . '</strong> a fost înregistrat cu succes!';
					echo '</div>';
				} else {
					echo '<div class="alert alert-danger" role="alert">';
					echo '	Parolele nu corespund!';
					echo '</div>';
				}
			} else {
				echo '<div class="alert alert-success" role="alert">';
				echo '	Adresa de e-mail este invalidă!';
				echo '</div>';
			}
		}
	}
	
	require 'captcha/simple-php-captcha.php';
	$_SESSION['captcha'] = simple_php_captcha();
?>
	<div class="well">
		<div class="table-responsive">
			<form action="<?= $_SERVER['PHP_SELF'] ?>?page=register" method="post">
				<table class="table table-striped">
					<tbody>
						<tr>
							<td>Nume de utilizator:</td>
							<td><input type="text" class="form-control" name="username" pattern=".{5,16}" maxlength="16" placeholder="Numele dorit..." required title="Între 5 și 16 caractere permise."></td>
						</tr>
						<tr>
							<td>Parolă:</td>
							<td><input type="password" class="form-control" name="password" pattern=".{5,16}" maxlength="16" placeholder="Parolă" required title="Între 5 și 16 caractere permise."></td>
						</tr>
						<tr>
							<td>Repetă parola:</td>
							<td><input type="password" class="form-control" name="rpassword" pattern=".{5,16}" maxlength="16" placeholder="Repetare parolă" required title="Între 5 și 16 caractere permise."></td>
						</tr>
						<tr>
							<td>Adresă de e-mail:</td>
							<td><input type="email" class="form-control" name="usermail" pattern=".{7,64}" maxlength="64" placeholder="exemplu@domeniu.ro" required title="Maxim 64 caractere."></td>
						</tr>
						<tr>
							<td>Cod ștergere caracter:</td>
							<td><input type="text" AUTOCOMPLETE="off" maxlength="7" class="form-control" name="socialid" placeholder="Ștergere caracter în joc" required></td>
						</tr>
						<tr>
							<td>Nume real:</td>
							<td><input type="text" class="form-control" name="realname" pattern=".{3,15}" maxlength="15" placeholder="Numele tău" required title="Maxim 15 caractere."></td>
						</tr>
						<tr>
							<td><?php print '<img src='.$_SESSION['captcha']['image_src'].'>'; ?></td>
							<td><input type="text" style='height:70px; width:230px; font-size: 30px;' class="form-control" name="captcha" pattern=".{4,6}" maxlength="5" placeholder="Cod securitate" required title="Maxim 15 caractere."></td>
						</tr>
						<tr>
							<td>Sunt de acord cu <a href="index.php?page=rules">regulamentul
									jocului</a> <input type="checkbox" name="agreed" checked></td>
							</td>
							<td><input type="submit" class="btn btn-s btn-success" name="register" value="Înregistrare"></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
<?php }} ?>