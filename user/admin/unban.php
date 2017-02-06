<?PHP
  if(!isset($_SESSION)){session_start();}
  if(isset($_GET['page'])) {
  if(isset($_GET['a'])) {
  if (isset($_SESSION['user_admin'])) { 
  if($_SESSION['user_admin']>=$adminRights['unban_account']) {
  
    echo '<h2>Administrare - Deblocare cont</h2>';
    
    if(isset($_GET['acc']) && !empty($_GET['acc'])) 
    {
      
      if(isset($_POST['submit']) && $_POST['submit']=='Deblocare') {
        
          if(!empty($_POST['banEingabe'])) {
          
            $sqlCmd = "SELECT login FROM account.account WHERE id='".$_GET['acc']."' LIMIT 1";
            $sqlQry = mysqli_query($sqlServ, $sqlCmd);
            
            if(mysqli_num_rows($sqlQry)>0) 
            {
              $accData = mysqli_fetch_object($sqlQry);
              $sqlCmd = "UPDATE account.account SET status='OK' WHERE id='".$_GET['acc']."' LIMIT 1";
              if(mysqli_query($sqlServ, $sqlCmd)) {
				echo'<div class="alert alert-success" role="alert">
							Contul '.$accData->login.' a fost deblocat.
						</div>'; 
						
                echo'<p><a class="btn btn-warning" role="button" href="index.php?page=admin&a=users&acc='.$_GET['acc'].'">&#206;napoi la list&#259;</a></p>';
              }
              
              $begruendung = $_POST['banEingabe'];
              
              $sqlLog = "INSERT INTO ".SQL_HP_DB.".ban_log (admin_id,account_id,time,reason,type) VALUES ('".$_SESSION['user_id']."','".$_GET['acc']."',NOW(),'".$begruendung."','OK')";
              $qryLog = mysqli_query($sqlHp, $sqlLog);
            }
            else
            {
				echo'<div class="alert alert-danger" role="alert">
							ID-ul contului care l-a&#355;i introdus nu exist&#259;!
						</div>';        
            }
            
          }
          else {
			echo'<div class="alert alert-danger" role="alert">
							Nu ai introdus niciun motiv detaliat.
					</div>';    
          }

      }
      
      $sqlLogin = "SELECT login FROM account.account WHERE id='".$_GET['acc']."' LIMIT 1";
      $qryLogin = mysqli_query($sqlServ, $sqlLogin);
      $getLogin = mysqli_fetch_object($qryLogin);
      
      ?>
      <form action="index.php?page=admin&a=unban&acc=<?PHP echo $_GET['acc']; ?>" method="POST">
	  <div class="well">
			<table class="table table-bordered">
            <thead>
              <tr>
                <th>Cont</th>
                <th>Motiv</th>
                <th>Acțiune</th>
              </tr>
            </thead>
            <tbody>
              <tr>
				<td><?PHP echo $getLogin->login ?></td>
				<td><input type="text" name="banEingabe" class="form-control" placeholder="Motiv..."></td>
				<td><input class="btn btn-success" role="button" type="submit" name="submit" value="Deblocare"/></td>
              </tr>
            </tbody></table></div>
      <?PHP
    }
    else 
    {
      echo'<div class="alert alert-danger" role="alert">
				Nu a&#355;i introdus nici un ID!
			</div>
	  ';
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
?>
<a href="javascript: history.go(-1)" class="btn btn-warning" role="button">&#171; &Icirc;napoi</a>