<?php
	if(!isset($_SESSION)){session_start();} ?>
           <ul class="list-group">
            <li class="list-group-item">
				Modul serverului:
				<span class="label label-success">
	<?php
	$query = mysqli_query($sqlHp, "SELECT * FROM ".SQL_HP_DB.".settings WHERE id=3");
	$output = mysqli_fetch_assoc($query);
	echo $output['value']; ?>
				</span>
			</li>
            <li class="list-group-item">
				Conturi create: 
				<?php
					((bool)mysqli_query($sqlServ, "USE account"));
					$test = "SELECT * from account";
					$testquery = mysqli_query($sqlServ, $test);
					$num2 = mysqli_num_rows($testquery);
					echo "<span class=\"badge\"><b>$num2</b></span>";
				?>
			</li>
            <li class="list-group-item">
				Caractere create: 
				<?php
					((bool)mysqli_query($sqlServ, "USE player"));
					$cont = "SELECT * from player";          
					$contquery = mysqli_query($sqlServ, $cont);            
					$num = mysqli_num_rows($contquery);    
		echo "<span class=\"badge\"><b>$num</b></span>";  
				?>
			</li>
            <li class="list-group-item">
				Jucători online: 
				<?php
					((bool)mysqli_query($sqlServ, "USE player")); 
					$exe = mysqli_query($sqlServ, "SELECT COUNT(*) as count FROM player WHERE DATE_SUB(NOW(), INTERVAL 5 MINUTE) < last_play;"); 
					$player_online = mysqli_fetch_object($exe)->count;
					echo "<span class=\"badge\"><b>$player_online</b></span>"; 
				?>
			</li>
          </ul>