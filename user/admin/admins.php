<?PHP
  if(!isset($_SESSION)){session_start();}
  if(isset($_GET['page'])) {
  if(isset($_GET['a'])) {
  if (isset($_SESSION['user_admin'])) { 
  if($_SESSION['user_admin']>=$adminRights['web_admins']) {
?>

<div class="page-header">
        <h1>Administrare - dreptul de administrare pe site</h1>
		<p>&#206;n aceast&#259; zon&#259; pute&#355;i edita drepturile administratorilor pe site.</p>
      </div>

      <?PHP
        $sqlCmd = "SELECT id,login,web_admin FROM account.account WHERE web_admin>0 ORDER BY login ASC";
        $sqlQry = mysqli_query($sqlServ, $sqlCmd);
        $x=0;;
        while($getAdmins = mysqli_fetch_object($sqlQry)) {
          $zF = ($x%2==0) ? "tdunkel" : "thell";
          echo'<table class="table table-striped">
            <thead>              <tr>
                <th>ID</th>
                <th>Contul</th>
                <th>Drepturi</th>
                <th>Editare</th>
              </tr>
            </thead>
              <tr>';
          echo'<td>'.$getAdmins->id.'</td>';
          echo'<td><a href="index.php?page=admin&a=users&acc='.$getAdmins->id.'">'.$getAdmins->login.'</a></td>';
          echo'<td>'.$getAdmins->web_admin.'</td>';
          echo'<td><a href="index.php?page=admin&a=rights&acc='.$getAdmins->id.'">Schimb&#259; drepturile</a></td>';
          echo'              </tr>
            </tbody>
          </table>';
          $x++;
		  
		  


        }
      ?>
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