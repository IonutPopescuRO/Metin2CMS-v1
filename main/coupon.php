<?php if(isset($_SESSION['user_admin']) && checkInt($_SESSION['user_admin']) && $_SESSION['user_admin']>=0) { ?>
<div class="page-header">
        <h1>Validare cupoane</h1>
      </div>
	  
<div class="well">
<form method="post" action="<?php $_PHP_SELF ?>">
<table id="dataTable" class="table table-striped">
<tr>
<td width="100">Cupon</td>
<td><input class="form-control input-lg" name="coupon" type="text" id="coupon"></td>
</tr>
<tr>
<td width="100"> </td>
<td> </td>
</tr>
<tr>
<td width="100"> </td>
<td>
<input name="check" type="submit" id="check" class="btn-big btn-success btn-lg btn" value="Valideză!">
</td>
</tr>
</table>
</form>
	  
<?php     
if(isset($_POST['check'])){
    $coupon = $_POST['coupon'];     

$checkCoupon = mysqli_query($sqlHp, "SELECT id, value, coupon FROM ".SQL_HP_DB.".coupons WHERE coupon = '$coupon'");
$result = mysqli_fetch_array($checkCoupon);
$sql = mysqli_num_rows($checkCoupon);

$date = date("d/m/Y");
$value_coupon = $result['1'];
$name_session = $_SESSION['id'];
$id_session = $_SESSION['user_id'];

if ($sql > 0) {
		mysqli_query($sqlServ, "UPDATE account.account SET coins = coins + ".$value_coupon." WHERE id='".$id_session."' LIMIT 1"); //adaugare monede
		
		mysqli_query($sqlHp, "INSERT INTO ".SQL_HP_DB.".coupons_validated (id , value , by_name , coupon, date) VALUES ('', '$value_coupon', '$name_session', '$coupon', '$date')"); //log
	
		mysqli_query($sqlHp, "DELETE FROM ".SQL_HP_DB.".coupons WHERE coupon = '$coupon'"); //stergere cupon
		
		echo "<div class=\"alert alert-success\" role=\"alert\">
				Ai validat cu succes cuponul <strong>".$coupon."</strong> în valoare de <strong>".$result['1']."</strong> monede dragon! 
			</div>";
			}
else {
		echo "<div class=\"alert alert-danger\" role=\"alert\">
				Cuponul pe care l-ai folosit <strong>nu există</strong> sau <strong>a fost deja validat</strong>! 
			</div>";  
			}

}
?>
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
?>