<?PHP
  if(!isset($_SESSION)){session_start();}
  if(isset($_GET['page'])) {
  if(isset($_GET['a'])) {
  if (isset($_SESSION['user_admin'])) { 
  if($_SESSION['user_admin']>=$adminRights['coupons_add']) {
?>
<div class="page-header">
        <h1>Crează un cupon</h1>
		<p>Adaugă valoare în monede!</p>

      </div>
	  
<div class="well">
<form method="post" action="<?php $_PHP_SELF ?>">
<table id="dataTable" class="table table-striped">
<tr>
<td width="100">Valoare Monede</td>
<td><input class="form-control input-lg" name="value" type="number" id="value"></td>
</tr>
<tr>
<td width="100"> </td>
<td> </td>
</tr>
<tr>
<td width="100"> </td>
<td>
<input name="add" type="submit" id="add" class="btn-big btn-success btn-lg btn" value="Crează cupon!">
</td>
</tr>
</table>
</form>
	  
	  
<?php
if(isset($_POST['add']))
{
if(! get_magic_quotes_gpc() )
{
   $value = addslashes ($_POST['value']);
}
else
{
   $value = $_POST['value'];
}
$coupon_name = rand(100000, 999999);
$sql = mysqli_query($sqlHp, "INSERT INTO ".SQL_HP_DB.".coupons
			(id, value, coupon)
			VALUES('', '$value', 'MT2$coupon_name')");

echo "
<div class=\"alert alert-success\" role=\"alert\">
        <strong>Cuponul </strong> a fost creat cu succes!
      </div>
<div class=\"alert alert-info\" role=\"alert\">
        Cuponul creat este: <strong>MT2$coupon_name</strong>.
      </div>";
}
else
{
?>

<?php
}
?>
	  
</div>

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