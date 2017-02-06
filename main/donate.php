<?php
	$query = mysqli_query($sqlHp, 'SELECT * FROM '.SQL_HP_DB.'.settings WHERE id="11" ');
	$output = mysqli_fetch_assoc($query);
	if ($output['value'] == "")
	{ echo'<div class="alert alert-danger" role="alert">
							Momentan nu a fost creată o pagină pentru donații!
						</div>'; }
	else {
	echo '<div class="page-header">
			<h1>Informații despre cum poți dona.</h1>
      </div>';
	echo "<div class=\"well\">";
	echo '<div class="panel-body">'.$output['value'].'</div>';
	echo '</div>'; 

	echo '<br/>'; }
?>