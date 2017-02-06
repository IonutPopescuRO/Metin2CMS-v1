<?php  
  if(!isset($_SESSION)){session_start();}
  if(isset($_GET['page'])) {
  if (isset($_SESSION['user_admin'])) { 
  if($_SESSION['user_admin']>=9) {

	echo "<div class=\"alert alert-info\" role=\"alert\">
			<span class=\"glyphicon glyphicon-wrench\"></span> Versiunea prezentă pe acest site este Metin2CMS V <strong>$current_version</strong>.
		</div>";
	  
//Verificare versiuni noi

$getVersions = file_get_contents('http://new.metin2cms.cf/last_version.php');
if ($getVersions != '')
{
	$versionList = explode("\n", $getVersions);	
	foreach ($versionList as $aV)
	{
		if ( $getVersions > $current_version) {
			echo "
			<div class=\"alert alert-danger\" data-toggle=\"modal\" data-target=\"#Mt2CMSupdate\" role=\"alert\">
					<span class=\"glyphicon glyphicon-flash\"></span> O nouă versiune a fost găsită: V <strong>$aV</strong>. <strong><a data-toggle=\"modal\" data-target=\"#Mt2CMSupdate\">Click aici</a></strong> pentru a face update!
			</div>";
			
		}
		else echo "
<div class=\"alert alert-success\" role=\"alert\">
        <span class=\"glyphicon glyphicon-ok\"></span> Site-ul este la versiune de zi a <strong>CMS</strong>-ului.
      </div>";
	}

}
else echo "
			<div class=\"alert alert-danger\" role=\"alert\">
					Nu pot gasi ultima versiune.
			</div>";

 ?>
 <?php
 $helloworld = file_get_contents('http://metin2cms.cf/salut.php');
 if ($helloworld != ''){
 echo "<div class=\"alert alert-success\" role=\"alert\">
        $helloworld
      </div>";}
 ?>
 
<!-- Dialog Update -->
<div class="modal fade" id="Mt2CMSupdate" tabindex="-1" role="dialog" aria-labelledby="Mt2CMSupdateLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="Mt2CMSupdateLabel">Metin2 CMS - Update</h4>
      </div>
      <div class="modal-body">

<!-- Instructiuni -->
<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
          Pasul #1
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
        Descărcarea fișierelor care vor trebui înlocuite și a celor noi.<hr>
		<a href="<?php echo 'http://new.metin2cms.cf/UP'.$aV.'.zip';?>" type="button" class="btn btn-primary btn-lg btn-block" target="_blank">Apasă aici!</a>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
          Pasul #2
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
        Dezarhivează arhiva pe un spațiu de lucru. <span class="glyphicon glyphicon-sort-by-alphabet-alt"></span>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
          Pasul #3
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        Loghează-te pe hostul site-ului tau, unde apare indexul de la Metin2 CMS!
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
          Pasul #4
        </a>
      </h4>
    </div>
    <div id="collapseFour" class="panel-collapse collapse">
      <div class="panel-body">
        Selectează toate fișierele din arhivă și copieazăle în fereastra hostului deja deschisă.
      </div>
    </div>
  </div>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Închide</button>
      </div>
    </div>
  </div>
</div>
<!-- /Dialog Update -->
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
?>