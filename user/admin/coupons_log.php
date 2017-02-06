<?PHP
  if(!isset($_SESSION)){session_start();}
  if(isset($_GET['page'])) {
  if(isset($_GET['a'])) {
  if (isset($_SESSION['user_admin'])) { 
  if($_SESSION['user_admin']>=$adminRights['coupons_log']) {
?>
<div class="page-header">
        <h1>Log-uri cupoane</h1>
		<p>Vezi de cine au fost validate cupoanele!</p>
      </div>
	  
<div class="well">
<table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Valoare (Monede)</th>
                <th>Nume Cont</th>
                <th>Cuponul</th>
                <th>Data</th>
              </tr>
            </thead>

<?php
if (isset($_POST['delete'])){
    mysqli_query($sqlHp, 'TRUNCATE TABLE '.SQL_HP_DB.'.coupons_validated');
}

	$query = mysqli_query($sqlHp, 'SELECT * FROM '.SQL_HP_DB.'.coupons_validated ORDER BY id');
	while($output = mysqli_fetch_assoc($query))
	{
	echo '<tbody><tr>';
	echo '<td>'.$output['id'].'</td>';
	echo '<td>'.$output['value'].'</td>';
	echo '<td>'.$output['by_name'].'</td>';
	echo '<td>'.$output['coupon'].'</td>';
	echo '<td>'.$output['date'].'</td>';
	echo '</tr></tbody>'; 
	}
	echo '</table>';
	echo '<form action="" method="post"><input class = "btn-big btn-success btn-lg btn" type="submit" name="delete" value="Golește Log-ul!"></form>
';
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