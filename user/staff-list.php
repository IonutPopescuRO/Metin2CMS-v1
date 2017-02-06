<?php
	if(!isset($_SESSION)){session_start();} ?>
         	<div class="panel-body">
			<table class="table table-striped">
			
<?php 
	$empty = mysqli_query($sqlServ, 'SELECT COUNT(*) FROM common.gmlist'); 
	if (!$empty) { echo'<div class="alert alert-danger" role="alert">
							Mu este nimeni în echipa serverului!
						</div>
	'; }
	else { echo '<thead>
              <tr>
                <th>Nume</th>
                <th>Nivel</th>
                <th>Regat</th>
              </tr>
            </thead>';}
?>
			
            <tbody>

<?php 

$sql = "SELECT * FROM common.gmlist ORDER BY mID limit 10";
$gmlist = mysqli_query($sqlServ, $sql);
while($row = mysqli_fetch_object($gmlist))
   {
	$name = $row->mName;
	echo "<tr>";
    echo "<td><a href=\"index.php?page=player&char=".$name."\">".$name."</a></td>";

	$lvl = mysqli_query($sqlServ, "SELECT * FROM player WHERE name LIKE '$name'");
	$lvl2 = mysqli_fetch_object($lvl);
	
    echo "<td>$lvl2->level</td>";
	$id_membru = $lvl2->account_id;
	
	$emp = mysqli_query($sqlServ, "SELECT * FROM player_index WHERE id LIKE '$id_membru'");
	$emp2 = mysqli_fetch_object($emp);
	
	$empire = $emp2->empire;
	echo "<td><img src=\"images/regat/$empire.jpg\"></td>";
	echo "</tr>";
}
?>
            </tbody>
          </table>
</div>