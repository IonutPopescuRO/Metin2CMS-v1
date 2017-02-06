<?php
	if (empty($_SESSION['id'])) {
		include('login.php'); }
		else {
echo '	<div class="page-header">
        <h1>'; include("./user/name_sv.php"); echo' - Contul t&#259;u</h1>
		<p>Datele utilizatorului</p>

      </div>';
  if(isset($_SESSION['user_admin']) && checkInt($_SESSION['user_admin']) && $_SESSION['user_admin']>=0) {
		$sqlCoins = "SELECT coins FROM account.account WHERE id='".((isset($sqlServ) && is_object($sqlServ)) ? mysqli_real_escape_string($sqlServ, $_SESSION['user_id']) : ((trigger_error("[MT2CMS] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."' LIMIT 1";
        $qryCoins = mysqli_query($sqlServ, $sqlCoins);
        $getCoins = mysqli_fetch_object($qryCoins);
		
echo "	<ul class=\"list-group\">
            <li class=\"list-group-item\">Cont de utilizator: <span class=\"label label-info\"><b>" . $_SESSION['id'] . "</b></span></li>
            <li class=\"list-group-item\">E-mail:  <span class=\"label label-info\"><b>" . $_SESSION['email'] . " </b></span></li>
            <li class=\"list-group-item\">Monede Dragon: <span class=\"label label-warning\"><b> " . $getCoins->coins . " Monezi</b></span></li>
            <li class=\"list-group-item\">Numele real:  <span class=\"label label-info\"><b>" . $_SESSION['real_name'] . "</b></span></li>
            <li class=\"list-group-item\">Cod &#351;tergere caractere:   <span class=\"label label-info\"><b>" . $_SESSION['social_id'] . " </b></span></li>
          </ul>
";
}
?>
<br>
<div class="list-group">
            <a href="index.php?page=password" class="list-group-item">
              <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-pencil"></span> Parol&#259;</h4>
              <p class="list-group-item-text">Schimb&#259; parola contului.</p>
            </a>
            <a href="index.php?page=email" class="list-group-item">
              <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-envelope"></span> Email</h4>
              <p class="list-group-item-text">Schimb&#259; email-ul contului.</p>
            </a>
            <a href="index.php?page=chars" class="list-group-item">
              <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-user"></span> Caractere</h4>
              <p class="list-group-item-text">Lista caracterelor &#351;i deblocarea lor.</p>
            </a>
            <a href="index.php?page=safebox" class="list-group-item">
              <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-shopping-cart"></span> Parol&#259; depozit</h4>
              <p class="list-group-item-text">Schimb&#259; parola depozitului de iteme.</p>
            </a>
          </div>
<?php } ?>