<div class="page-header">
        <h1><?php include("./user/name_sv.php"); ?> - Clasament Bresle</h1>
      </div>
<div class="well">
					<table id="dataTable" class="table table-striped">
                      <thead>
                          <tr>
                              <th>Rang</th>
                              <th>Breasl&#259;</th>
                              <th>C&#226;&#351;tiguri</th>
                              <th>Regat</th>
                              <th>Nivel</th>
                              <th>Puncte</th>
                          </tr>
                      </thead>
 
<?php 
$sql = "SELECT * FROM guild ORDER BY ladder_point desc, exp desc, name asc limit 0,20";
      $i = "0" ;
 $ergebnis = mysqli_query($sqlServ, $sql);
while($row = mysqli_fetch_object($ergebnis))
   {
   $i = $i + 1 ;
   $leader = $row->master;
    echo"<td>$i</td>";
    echo"<td>$row->name</td>";
	echo"<td>$row->win</td>";


	$result = $sqlServ->query("SELECT empire from player_index where pid1 = '$leader' OR pid2 = '$leader' OR pid3 = '$leader' OR pid4 = '$leader'");
	$rowE = $result->fetch_row();
	$empire = $rowE[0];
	

				echo"<td><img src=\"images/regat/$empire.jpg\"></td>";

    echo"<td>$row->level</td>";
	echo"<td>$row->ladder_point</td></tr>";
}
echo "</table>";
?>
</div>