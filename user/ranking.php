<?php
	if(!isset($_SESSION)){session_start();} ?>
        <div class="panel panel-default">
         	<div class="panel-heading">Clasament</div>
         	<div class="panel-body">

<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
  <li class="active"><a href="#players" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-user"></span>Jucători</a></li>
  <li><a href="#guilds" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-tower"></span>Bresle</a></li>
  <li><a href="#yang" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-star"></span>Yang</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="players">
			<table class="table table-striped">
            <thead>
              <tr>
                <th>Nr.</th>
                <th>#</th>
                <th>Nume</th>
                <th>Nivel</th>
              </tr>
            </thead>
            <tbody>
<?php
	$players = "SELECT * from player";
		$playersquery = mysqli_query($sqlServ, $players);

	$rank = "SELECT * from player WHERE name NOT LIKE '[%]%' order by level desc limit 5";
		$query = mysqli_query($sqlServ, $rank);
			$i = 0;
			while($array = mysqli_fetch_array($query)) {
				$i = $i + 1;
		echo"<tr>
                <td><span class=\"badge\">". $i ."</span></td>
				<td><a href=\"index.php?page=player&char=".$array["name"]."\"><img src=\"images/chars/misc/".$array["job"].".png\" height=\"30\" width=\"30\"></a></td>
                <td><a href=\"index.php?page=player&char=".$array["name"]."\">".$array["name"]."</a></td>
                <td>".$array["level"]."</td>
              </tr>"; }
?>	

            </tbody>
          </table>
	<center><a class="btn btn-primary btn-xs" href="?page=players">Clasament jucători complet &#187;</a></center>
  </div>
  <div class="tab-pane" id="guilds">
			<table class="table table-striped">
            <thead>
              <tr>
                <th>Nr.</th>
                <th>Nume</th>
                <th>Nivel</th>
              </tr>
            </thead>
            <tbody>
<?php

	$guilds = "SELECT * from guild order by level desc limit 5";
		$guildsquery = mysqli_query($sqlServ, $guilds);
	$i = 0;
	while($array = mysqli_fetch_array($guildsquery)) {
				$i = $i + 1;			
		echo"<tr>
                <td><span class=\"badge\">".$i."</span></td>
                <td><a href=\"index.php?page=guilds\" class=\"first\">".$array["name"]."</a></td>
                <td>".$array["level"]."</td>
              </tr>";
			}
?>	
            </tbody>
          </table>
		<center><a class="btn btn-primary btn-xs" href="?page=players">Clasament bresle complet &#187;</a></center>
  </div>
  <div class="tab-pane" id="yang">
			<table class="table table-striped">
            <thead>
              <tr>
                <th>Nr.</th>
                <th>#</th>
                <th>Nume</th>
                <th>Nivel</th>
              </tr>
            </thead>
            <tbody>
<?php
	$yangrank = "SELECT * from player WHERE name NOT LIKE '[%]%' order by gold desc limit 5";
		$yangquery = mysqli_query($sqlServ, $yangrank);
			$i = 0;
			while($array = mysqli_fetch_array($yangquery)) {
				$i = $i + 1;
			echo"<tr>
                <td><span class=\"badge\">". $i ."</span></td>
				<td><a href=\"index.php?page=player&char=".$array["name"]."\"><img src=\"images/chars/misc/".$array["job"].".png\" height=\"30\" width=\"30\"></a></td>
                <td><a href=\"index.php?page=player&char=".$array["name"]."\">".$array["name"]."</a></td>
                <td>".$array["level"]."</td>
					</tr>";
			}?>	

            </tbody>
          </table>
  </div>
</div>


</div>
        </div>