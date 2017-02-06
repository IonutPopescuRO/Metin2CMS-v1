<?PHP
  if(!isset($_SESSION)){session_start();}
  if(isset($_GET['page'])) {
  if(isset($_GET['a'])) {
  if (isset($_SESSION['user_admin'])) { 
  if($_SESSION['user_admin']>=$adminRights['acc_ansicht']) {
  
   echo '<div class="page-header">
        <h1>Administrare - Profil caractere</h1>
      </div>';
    if(isset($_GET['acc']) && !empty($_GET['acc'])) 
    {
      $sqlCmd = "SELECT login FROM account.account WHERE id='".$_GET['acc']."' LIMIT 3";
      $sqlQry = mysqli_query($sqlServ, $sqlCmd);
      if(mysqli_num_rows($sqlQry)>0) 
      {
        $accData = mysqli_fetch_object($sqlQry);
        echo'<h3><br/>Caracterele lui "'.$accData->login.'"</h3><br/>';
        echo'<div class="well"><table class="table table-condensed">
            <thead>
              <tr>
                <th>ID caracter</th>
                <th>Nume</th>
                <th>Nivel</th>
                <th>Ultimul IP</th>
              </tr>
            </thead>
            <tbody>';
        $sqlCmd = "SELECT player.id,player.name,player.level,player.ip 
        FROM player.player_index 
        INNER JOIN player.player 
        ON player_index.pid1=player.id 
        OR player_index.pid2=player.id 
        OR player_index.pid3=player.id 
        OR player_index.pid4=player.id 
        WHERE player_index.id='".$_GET['acc']."'";
        $sqlQry = mysqli_query($sqlServ, $sqlCmd);
        while($getChars=mysqli_fetch_object($sqlQry)) 
        {
          echo '<tr><td>'.$getChars->id.'</td>';
          echo '<td><a href="index.php?page=admin&a=char&id='.$getChars->id.'">'.$getChars->name.'</a></td>';
          echo '<td>'.$getChars->level.'</td>';
          echo '<td><a href="index.php?page=admin&a=iplist&filter='.$getChars->ip.'">'.$getChars->ip.'</a></td></tr>';
        }
        echo'</tbody></table></div>';
      }
      else
      {
		echo "<div class=\"alert alert-danger\" role=\"alert\">
				ID-ul contului care l-a&#355;i introdus nu exist&#259;!
				</div>";
      }
    }
    else 
    {
	  echo "<div class=\"alert alert-danger\" role=\"alert\">
				Nu a&#355;i introdus nici un ID!
				</div>";
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