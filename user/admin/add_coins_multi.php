<?PHP
  if(!isset($_SESSION)){session_start();}
  if(isset($_GET['page'])) {
  if(isset($_GET['a'])) {
  if (isset($_SESSION['user_admin'])) { 
  if($_SESSION['user_admin']>=$adminRights['multi_coins']) {
   
  echo'<div class="page-header">
        <h1>Administrare - ad&#259;ugare monede(multi utilizator)</h1>
      </div>';
	  
  echo'<div class="alert alert-info" role="alert">&#206;n aceast&#259; zon&#259; pute&#355;i ad&#259;uga Monede la mai mul&#355;i utilizatori. Aceast&#259; func&#355;ie necesit&#259; un anumit format:<br/>
  <b>ID-ul Contului||Monedele</b> Exemplu: (ExCont||1000)</div>';
  
  if(isset($_POST['aufladen']) && $_POST['aufladen']=="Adauga") {
    echo'<h3>Rezultat</h3>';
    $zeilen=explode("\n",$_POST['inputCoins']);
    $mengeZeilen = count($zeilen);
    $fehlerZeilen=array();
    for($x=0;$x<$mengeZeilen;$x++) {
      $aktZeile=$zeilen[$x];
      $rowData = explode("||",$zeilen[$x]);
      $userLogin = (isset($rowData[0])) ? trim($rowData[0]) : "";
      $userCoins = (isset($rowData[1])) ? trim($rowData[1]) : "";
      if(checkAnum($userLogin) && checkInt($userCoins)) {
      
        $sqlUser = "SELECT id FROM account.account WHERE login='".$userLogin."' LIMIT 1";      
        $qryUser = mysqli_query($sqlServ, $sqlUser);
        if(mysqli_num_rows($qryUser)>0) {
          $sqlCoins = "UPDATE account.account SET coins=coins+".$userCoins." WHERE login='".$userLogin."' LIMIT 1";
          $qryCoins = mysqli_query($sqlServ, $sqlCoins);
          
          if($qryCoins) 
          {
            echo'<div class="alert alert-success" role="alert">
					<b>Linia '.($x+1).' <span class="glyphicon glyphicon-ok"></span>: La monedele contului <u>'.$userLogin.'</u> au fost ad&#259;ugate <u>'.$userCoins.'</u> monede!</b>
				</div>';
          }
          else 
          {
            $fehlerZeilen[]=$x;
			echo'<div class="alert alert-danger" role="alert">
					<b>Linia '.($x+1).' <span class="glyphicon glyphicon-remove"></span>: '.$aktZeile.'</b> (SQL-Qry)
				</div>';
          }
          
        }
        else 
        {
          $fehlerZeilen[]=$x;
          echo'<div class="alert alert-danger" role="alert">
					<b>Linia '.($x+1).' <span class="glyphicon glyphicon-remove"></span> '.$aktZeile.'</b> Nu exist&#259;!
				</div>';
        }
      
      }
      else {
        $fehlerZeilen[]=$x;
        echo'<div class="alert alert-danger" role="alert">
					<b>Linia '.($x+1).' <span class="glyphicon glyphicon-remove"></span>: '.$aktZeile.'</b> Formatul e incorect!
				</div>';
      }
    }
    
    if(!(count($fehlerZeilen)==0)) 
    {
      echo'<h3>Liniile gresite</h3>';
      echo'<div class="alert alert-info" role="alert">
					Urmatoarele linii ar trebui s&#259; fie verificate pentru prezen&#355;a erorilor si apoi s&#259; fie trimise din nou.
				</div>';
      echo'<p>';
      foreach($fehlerZeilen AS $aktFehler) 
      {
        $fehlerZeile = trim($zeilen[$aktFehler]);
        if(!empty($fehlerZeile)) 
        {
          echo $fehlerZeile.'<br/>';
        }
      }
      echo'</p>';
    }  
    
  }
  
?>
<div class="well">
<form method="POST" action="index.php?page=admin&a=add_coins_multi">
<table class="table table-bordered">
            <thead>
              <tr>
                <th>Introduce&#355;i datele:</th>
                <th>First Name</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
				<div class="alert alert-success" role="alert">
				ID-ul contului||monedele
			</div>
				<div class="alert alert-info" role="alert">
				Exemplu: "Ionut||10"
			</div>
				 </td>
                <td><textarea class="form-control" cols="35" rows="5" name="inputCoins"></textarea></td>
              </tr>
            </tbody>
          </table>

<input class="btn btn-success" role="button" type="submit" name="aufladen" value="Adauga"/>

</form>
</div>
<?PHP
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