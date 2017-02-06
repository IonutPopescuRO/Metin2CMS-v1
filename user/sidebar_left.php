<?php
	if(!isset($_SESSION)){session_start();} ?>
  <div class="col-sm-3">
        <div class="panel panel-default">
         	<div class="panel-heading">Statistici</div>
				<?php include("statistics.php"); ?>
        </div>
        <hr>
        <div class="panel panel-default">
         	<div class="panel-heading">Echipa Serverului</div>
				<?php include("staff-list.php"); ?>
        </div>
			<?php
			$fb = mysqli_query($sqlHp, "SELECT * FROM ".SQL_HP_DB.".settings WHERE id=6");
			$facebook = mysqli_fetch_assoc($fb);
			if (!empty($facebook['value'])) {
			?>
        <hr>
        <div class="panel panel-default">
         	<div class="panel-heading">Facebook - Fii sociabil!</div>
         	<div class="panel-body">
         	<div class="facebook">
         	    <iframe src="//www.facebook.com/plugins/likebox.php?href=http://facebook.com/<?php echo $facebook['value']; ?>&amp;width=700&amp;height=250&amp;colorscheme=light&amp;show_faces=true&amp;border_color=%23ffffff&amp;stream=false&amp;header=false" style="overflow:hidden; width:700px; height:250px;"></iframe>
         	</div>
			</div>
        </div><?php } ?>
			<?php
			$yt = mysqli_query($sqlHp, "SELECT * FROM ".SQL_HP_DB.".settings WHERE id=7");
			$youtube = mysqli_fetch_assoc($yt);
			if (!empty($youtube['value'])) {
			?>
        <hr>
        <div class="panel panel-default">
         	<div class="panel-heading">Prezentare server</div>
         	<div class="panel-body">
         	<div class="facebook">
         	    <div class="video-container"><iframe src="http://www.youtube.com/embed/<?php echo $youtube['value']; ?>" frameborder="0" width="560" height="315"></iframe></div>
         	</div>
			</div>
        </div><?php } ?>
  </div>