<?php
	if(!isset($_SESSION)){session_start();} ?>
  <div class="col-sm-3">
    	<div class="panel panel-default">
         	<div class="panel-heading"><?php if(empty($_SESSION['id'])){echo "Logare";} else{echo "Panoul utilizatorului";} ?></div>
         	<div class="panel-body">
         	<?php include("user-panel.php"); ?>
			</div>
        </div>
        <hr>
		
    	<div class="panel panel-default">
         	<div class="panel-heading">Magazin de obiecte</div>
         	<div class="panel-body">
				<center><a class="btn btn-primary btn-xlarge" href="" data-toggle="modal" data-target=".bs-example-modal-lg"> Magazin de obiecte</a></center>
<!-- Large modal -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
	      <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title" id="myModalLabel">Magazin obiecte - <?php include("./user/name_sv.php"); ?></h4>
      </div>
	        <div class="modal-body shop">
			<center><iframe src="shop" width="740" height="550"></iframe></center>
    </div>
    </div>
  </div>
</div>

			</div>
        </div>
        <hr>
		
      <?php
      include("ranking.php");
      ?>
  </div>