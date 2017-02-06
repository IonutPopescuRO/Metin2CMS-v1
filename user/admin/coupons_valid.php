<?PHP
  if(!isset($_SESSION)){session_start();}
  if(isset($_GET['page'])) {
  if(isset($_GET['a'])) {
  if (isset($_SESSION['user_admin'])) { 
  if($_SESSION['user_admin']>=$adminRights['coupons_log']) {
?>
<div class="page-header">
        <h1>Cupoane încă nevalidate</h1>
		<p>Vezi cupoanele nevalidate!</p>
      </div>
	  
<div class="well">
<table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Valoare (Monede)</th>
                <th>Cuponul</th>
              </tr>
            </thead>

<?php
	$query = mysqli_query($sqlHp, 'SELECT * FROM '.SQL_HP_DB.'.coupons ORDER BY id');
	while($output = mysqli_fetch_assoc($query))
	{
	echo '<tbody><tr>';
	echo '<td>'.$output['id'].'</td>';
	echo '<td>'.$output['value'].'</td>';
	echo '<td>'.$output['coupon'].'</td>';
	echo '</tr></tbody>'; 
	}
	echo '</table>';
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