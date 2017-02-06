		<div class="page-header">
			<h1>Descărcare client</h1>
		</div>

		<div class="page-header">
			<h3>Important!</h3>
		</div>
		<div class="well">
			<p>Memoria insuficientă a plăcii grafice de memorie poate duce la
				pierderea FPS. Configurează-ți setările jocului pentru a evita
				această problemă. În cazul în care descărcarea are loc de către mai
				multi utilizatori în același timp, aceasta poate fi mai scăzută, de aceea
				te rugăm să ai răbdare.</p>
		</div>
		<div class="page-header">
			<h3>Notă legală</h3>
		</div>
		<div class="alert alert-danger" role="alert">
			<strong>ATENȚIE!</strong> Prin descărcarea client-ului ești de acord
			cu <a href="index.php?page=rules">regulamentul jocului</a>.
		</div>
		<div class="page-header">
			<h3>Adrese descărcare</h3>
		</div>
		<div class="well"><center>
			<?php
			$wb = mysqli_query($sqlHp, "SELECT * FROM ".SQL_HP_DB.".settings WHERE id=4");
			$web = mysqli_fetch_assoc($wb);
			if (!empty($web['value'])) {
			?>
		<a href="<?php echo $web['value']; ?>"><img src="images/download/web.png"></a>
			<?php } 
			$tr = mysqli_query($sqlHp, "SELECT * FROM ".SQL_HP_DB.".settings WHERE id=5");
			$torrent = mysqli_fetch_assoc($tr);
			if (!empty($torrent['value'])) {
			?>
		<a href="<?php echo $torrent['value']; ?>"><img src="images/download/torrent.png"></a>
		<?php } 
		if (empty($web['value']) && empty($torrent['value'])) 
		echo '<div class="alert alert-info" role="alert">
				Momentan clientul nu este disponibil <strong>descărcării</strong>!
			  </div>';
		?>
		</center></div>
		<div class="page-header">
			<h3>Cerințe de sistem</h3>
		</div>
		<div class="well">
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>&nbsp;</th>
						<th>Minime</th>
						<th>Recomandate</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Procesor</td>
						<td>Pentium 3 1 GHz</td>
						<td>Pentium 4 1.8 GHz</td>
					</tr>
					<tr>
						<td>Memorie RAM</td>
						<td>512 MB</td>
						<td>1 GB</td>
					</tr>
					<tr>
						<td>Spațiu disc</td>
						<td>2 GB</td>
						<td>3 GB</td>
					</tr>
					<tr>
						<td>Memorie RAM GPU</td>
						<td>32 MB</td>
						<td>64 MB</td>
					</tr>
					<tr>
						<td>Sistem de operare</td>
						<td colspan="2">Windows Vista, 7, 8, 8.1</td>
					</tr>
					<tr>
						<td>Sunet</td>
						<td colspan="2">DirectX 9.0 sau mai nou</td>
					</tr>
					<tr>
						<td>Periferice</td>
						<td colspan="2">Mouse, tastatură</td>
					</tr>
				</tbody>
			</table>
		</div>
		</div>