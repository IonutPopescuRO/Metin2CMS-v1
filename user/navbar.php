<?php if(!isset($_SESSION)){session_start();} ?>
	<div class="collapse navbar-collapse">
		<ul class="nav navbar-nav">
		<?php if(empty($_SESSION['id'])){ ?>
			<li><a href="?page=register">Înregistrare</a></li>
			<li><a href="?page=login">Logare</a></li>
		<?php } ?>
			<li><a href="?page=download">Descărcare</a></li>
		<?php 	$presentation = mysqli_query($sqlHp, 'SELECT * FROM '.SQL_HP_DB.'.presentation WHERE id="1" ');
				$verify = mysqli_fetch_assoc($presentation);
				if ($verify['title'] == "" or $verify['message'] == "" or $verify['date'] == "") echo '';
				else {				?>
			<li><a href="?page=presentation">Prezentare</a></li>
		<?php } ?>
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Clasament <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="?page=players">Jucători</a></li>
                <li class="divider"></li>
                <li><a href="?page=guilds">Bresle</a></li>
              </ul>
            </li>
			<?php
			$fr = mysqli_query($sqlHp, "SELECT * FROM ".SQL_HP_DB.".settings WHERE id=9");
			$forum = mysqli_fetch_assoc($fr);
			if (!empty($forum['value'])) {
			?>
			<li><a href="<?php echo $forum['value']; ?>">Forum</a></li>
			<?php } ?>
			<?php
			if(!empty($_SESSION['id'])){
			$ch = mysqli_query($sqlHp, "SELECT * FROM ".SQL_HP_DB.".settings WHERE id=10");
			$chat = mysqli_fetch_assoc($ch);
			if ($chat['value'] == "3") {
			?>
			<li><a href="?page=chat">Chat</a></li>
			<?php }} ?>
			<?php
			$fr = mysqli_query($sqlHp, "SELECT * FROM ".SQL_HP_DB.".settings WHERE id=11");
			$forum = mysqli_fetch_assoc($fr);
			if (!empty($forum['value'])) {
			?>
			<li><a href="?page=donate">Donează!</a></li>
			<?php } ?>
		</ul>
		<div class="col-sm-3 col-md-3 pull-right">
          <form class="navbar-form" role="search" action="index.php" method="get">
            <div class="input-group">
				<input type="hidden" value="player" name="page">
                <input type="text" class="form-control" placeholder="Caut&#259; un caracter..." name="char" id="char">
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
          </form>
		</div>
	</div>