<?php
	$query = mysqli_query($sqlHp, 'SELECT * FROM '.SQL_HP_DB.'.presentation WHERE id="1" ');
	$output = mysqli_fetch_assoc($query);
	if ($output['title'] == "" or $output['message'] == "" or $output['date'] == "")
	{ echo'<div class="alert alert-danger" role="alert">
							Momentan nu a fost creată o prezentare!
						</div>'; }
	else {
	echo '<div class="page-header">
			<h1>'.$output['title'].'</h1>
			<p><span class="label label-success"><i class="glyphicon glyphicon-time"></i> Data ultimei modificări : '.$output['date'].'</span></p>
      </div>';
	echo "<div class=\"well\">";
	echo '<div class="panel-body">'.$output['message'].'</div>';
	echo '</div>'; 

	echo '<br/>'; }
?>