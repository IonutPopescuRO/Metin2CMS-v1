<?PHP 
  if(!isset($_SESSION)){session_start();}
  if(isset($_GET['page'])) {
  if(isset($_GET['a'])) {
  if (isset($_SESSION['user_admin'])) { 
  if($_SESSION['user_admin']>=$adminRights['acc_ansicht']) {
  
   echo '<div class="page-header">
        <h1>Administrare - Editare cont</h1>
      </div>';
    
    if(isset($_GET['acc']) && !empty($_GET['acc'])) 
    {
      $sqlCmd = "SELECT login,status FROM account.account WHERE id='".$_GET['acc']."' LIMIT 1";
      $sqlQry = mysqli_query($sqlServ, $sqlCmd);
      if(mysqli_num_rows($sqlQry)>0) 
      {
        $accData = mysqli_fetch_object($sqlQry);
        
        echo'<h3><br/>Editare "'.$accData->login.'"<br/><br/></h3>';
        echo'<div class="list-group">';
        
        echo'<a class="list-group-item" href="index.php?page=admin&a=chars&acc='.$_GET['acc'].'">Profil caractere</a>';
        echo'<a class="list-group-item" href="index.php?page=admin&a=rights&acc='.$_GET['acc'].'">Drepturile utilizatorului</a>';
        echo'<a class="list-group-item" href="index.php?page=admin&a=coins&acc='.$_GET['acc'].'">Schimbare monede</a>';
        echo'<a class="list-group-item" href="index.php?page=admin&a=create_item&acc='.$_GET['acc'].'">Modare item</a>';
        if($accData->status=='OK') 
        {
          echo'<a class="list-group-item" href="index.php?page=admin&a=ban&acc='.$_GET['acc'].'">Blocare cont</a>';
        }
        elseif($accData->status=='BLOCK') 
        {
          echo'<a class="list-group-item" href="index.php?page=admin&a=unban&acc='.$_GET['acc'].'">Deblocare cont</a>';
        }
        echo'</div>';
		//start       
        $sqlBanlog = "SELECT * FROM ".SQL_HP_DB.".ban_log WHERE account_id='".$_GET['acc']."'";
        $qryBanlog = mysqli_query($sqlHp, $sqlBanlog);
        
        echo'<h3><i>Log blocare cont</i></h3>
		<div class="well">
		<table class="table table-condensed">
            <thead>
              <tr>
                <th>Stare</th>
                <th>Data & Ora</th>
                <th>Admin</th>
                <th>Motiv</th>
              </tr>
            </thead>
            <tbody>';
        while($getBanlog = mysqli_fetch_object($qryBanlog)) {
          echo'<tr>';
			if($getBanlog->type=='OK') 
			{
			echo'<td><font color="green"><b>OK</b></font></td>';
			}
			elseif($getBanlog->type=='BLOCK') 
			{
			echo'<td><font color="red"><b>BLOCAT</b></font></td>';
			}
            echo'
            <td>'.$getBanlog->time.'</td>
            <td><a href="index.php?page=admin&a=users&acc='.$getBanlog->admin_id.'">'.$getBanlog->admin_id.'</a></td>
            <td>'.$getBanlog->reason.'</td>
          </tr>';
        }
        echo'</tbody></table></div>';
		//sf
      }
      else
      {
       echo'<div class="alert alert-danger" role="alert">
				ID-ul contului introdus nu exist&#259;.
			</div>';		
      }
    }
    else 
    {
      echo'<div class="alert alert-danger" role="alert">
				Nu a&#355;i introdus niciun ID.
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
?>
<a href="javascript: history.go(-1)" class="btn btn-warning" role="button">« Înapoi</a>