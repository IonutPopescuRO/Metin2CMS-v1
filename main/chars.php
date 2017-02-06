<?php if(isset($_SESSION['user_admin']) && checkInt($_SESSION['user_admin']) && $_SESSION['user_admin']>=0) { ?>
<div class="page-header">
        <h1><?php include("./user/name_sv.php"); ?> - Caracterele tale</h1>
      </div>
<div class="well">	
<table id="dataTable" class="table table-striped">
			<thead>
				<tr>
					<th>Caracter</th>
					<th>Rasă / Sex</th>
					<th>Nivel</th>
					<th>Timp joc</th>
					<th>Breaslă</th>
				</tr>
			</thead>
		<tbody>
	<?PHP
	echo"<br/>";
    $cmdChars = "SELECT player.id,player.name,player.job,player.level,player.playtime,guild.name AS guild_name
    FROM player.player
    LEFT JOIN player.guild_member 
    ON guild_member.pid=player.id 
    LEFT JOIN player.guild 
    ON guild.id=guild_member.guild_id
    WHERE player.account_id='".$_SESSION['user_id']."'";
    $qryChars = mysqli_query($sqlServ, $cmdChars);
    $x=0;

    while($getChars = mysqli_fetch_object($qryChars)) {
    $hours = floor($getChars->playtime / 60);
    $minutes = $getChars->playtime % 60;
        echo'<tr>
          <td><a href="index.php?page=reset_char&char='.$getChars->id.'" title="Deblocare caracter">'.$getChars->name.'</a></td>
          <td><img src="images/chars/misc/'.$getChars->job.'.png" height="30" width="30"></td>
          <td>'.$getChars->level.'</td>
          <td>'.$hours.' ore & '.$minutes.' minute</td>';
		  if ($getChars->guild_name == "") echo '<td>-</td>';
		  else echo '<td>'.$getChars->guild_name.'</td>';
          echo'</tr>';
      $x++;
    }
    echo'</table>';
	echo"</div>";
?>
					
						<div class="alert alert-info" role="alert">
							Pentru a <strong>debloca</strong> un caracter face&#355;i click pe numele lui!
						</div>						
						<div class="alert alert-info" role="alert">
							Caracterul <strong>trebuie</strong> s&#259; fie delogat de cel pu&#355;in 5 minute, ca func&#355;ia "Deblocare caracter" s&#259; func&#355;ioneze!
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