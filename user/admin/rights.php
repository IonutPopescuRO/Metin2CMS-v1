<?PHP
  if(!isset($_SESSION)){session_start();}
  if(isset($_GET['page'])) {
  if(isset($_GET['a'])) {
  if (isset($_SESSION['user_admin'])) { 
  if($_SESSION['user_admin']>=$adminRights['web_admins']) {
 
    echo '<div class="page-header">
        <h1>Administrare - drepturile utilizatorilor</h1>
      </div>';
    if(isset($_POST['submit']) && $_POST['submit']=="Adaugă" && !empty($_POST['id']) && $_POST['rechte']>=0) {
      $sqlCmd = "UPDATE account.account SET web_admin='".$_POST['rechte']."' WHERE id='".$_POST['id']."' LIMIT 1";
      $sqlQry = mysqli_query($sqlServ, $sqlCmd);
      if($sqlQry) {
		echo '<div class="alert alert-success" role="alert">
			<p>Drepturile au fost ad&#259;ugate cu succes.</p>
		</div>';
      }
    }
    if(isset($_GET['acc']) && !empty($_GET['acc'])) 
    {
      $sqlCmd = "SELECT id,login,web_admin FROM account.account WHERE id='".$_GET['acc']."' LIMIT 1";
      $sqlQry = mysqli_query($sqlServ, $sqlCmd);
      if(mysqli_num_rows($sqlQry)>0) 
      {
        $accData = mysqli_fetch_object($sqlQry);
        ?>
<div class="well">
          <form action="index.php?page=admin&a=rights&acc=<?PHP echo $_GET['acc']; ?>" method="POST">
          <input type="hidden" name="id" value="<?PHP echo $_GET['acc']; ?>"/>
			<table class="table table-bordered">
            <tbody>
              <tr>
				<?php echo'<td><h2>'.$accData->login.'</h2></td>'; ?>
                <td>
                  <select class="form-control" name="rechte">
                    <?PHP
                      for($i=0;$i<10;$i++) {
                        if($i==$accData->web_admin) { $selected = "selected "; }
                        else { $selected=""; }
                        if($i==0) { echo '<option '.$selected.'value="0">Normal</option>'; }
                        else { echo '<option '.$selected.'value="'.$i.'">Nivel '.$i.'</option>'; }
                      }
                    ?>
                  </select>
                </td>
               <td><input type="submit" name="submit" class="btn-big btn-success btn-lg btn" value="Adaugă" /></td>
              </tr>
			  </tbody>
            </table>
          </form></div>
        <?PHP
      }
      else
      {
		echo '<div class="alert alert-danger" role="alert">
			<p>ID-ul contului introdus nu exist&#259;!</p>
		</div>';
      }
    }
    else 
    {
	  echo '<div class="alert alert-danger" role="alert">
			<p>Nu a fost introdus niciun ID!</p>
		</div>';
    }
    
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
?><br/>
<a href="javascript: history.go(-1)" class="btn btn-warning" role="button">« Înapoi</a>