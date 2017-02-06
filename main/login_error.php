<?php
if(empty($_SESSION['id'])){
	
?>
<!-- center column -->
				
<div class="page-header">
        <h1><?php include("./user/name_sv.php"); ?> - Logare</h1>
      </div>
		
<div class="alert alert-danger" role="alert">
        <strong>Logare abandonată!</strong> Datele introduse sunt incorecte. Încearcă din nou!
      </div>
					<div class="well">
						<form name="loginForm" id="loginForm" action="index.php?page=login" method="post">
							<div>
								<label for="username">Nume de utilizator: *</label>
								<input AUTOCOMPLETE="off" type="text" class="form-control input-lg" id="username" name="user" maxlength="16" value=""/>
							</div>
							<div>
								<label for="password">Parol&#259;: *</label>
								<input AUTOCOMPLETE="off" type="password" class="form-control input-lg" id="password" name="pw" maxlength="16" value=""/>
							</div>
							<div id="checkerror">
                            <p>Scrie numele &#351;i parola din joc apoi apas&#259; butonul Login pentru a vedea meniurile interne ale siteului!</p>
							</div> 
							
							<input id="submitBtn" class="btn btn-lg btn-success" type="submit" name="login" value="Logare"/>
							<script type="text/javascript">
							</script>
						</form>		
					</div>
						<p id="regLegend">* este necesar</p>
						<div class="trenner"></div>
						<div class="well">
							<h3>&#206;nc&#259; nu ai cont?</h3>
							<p>Crearea unui juc&#259;tor (cont) este rapid&#259;, usoar&#259; &#351;i gratis.</p>
							<a role="button" href="index.php?page=register" class="btn btn-lg btn-success">Înregistrează-te!</a>
						</div>
<?php } 
else { echo "<meta http-equiv='refresh' content='0; URL=index.php?page=home'>";}
?>