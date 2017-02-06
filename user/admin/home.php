<?PHP
  if(!isset($_SESSION)){session_start();}
  if(isset($_GET['page'])) {
  if (isset($_SESSION['user_admin'])) { 
  if($_SESSION['user_admin']>0) {
?>
<div class="page-header">
        <h1>Administrare - prezentare general&#259;</h1>
      </div>
	<?php include('update.php'); ?>
		<div class="list-group">
		<?php if($_SESSION['user_admin']>=$adminRights['web_news']) { ?>
            <a href="index.php?page=admin&a=settings" class="list-group-item active">
              <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-pencil"></span> Gestionare site</h4>
              <p class="list-group-item-text">Editează diferite elemente de pe site și altele. (ex: linkuri descărcare).</p>
            </a><?php } ?>
		<?php if($_SESSION['user_admin']>=$adminRights['stats']) { ?>
            <a href="index.php?page=admin&a=stat" class="list-group-item">
              <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-stats"></span> Statistici generale ale serverului</h4>
              <p class="list-group-item-text">Statistici generale jucători / bresle.</p>
            </a><?php } ?>
		<?php if($_SESSION['user_admin']>=$adminRights['presentation']) { ?>
            <a href="index.php?page=admin&a=presentation" class="list-group-item">
              <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-asterisk"></span> Prezentarea generală a serverului</h4>
              <p class="list-group-item-text">Crează o pagina de prezentare a serverului.</p>
            </a>
            <a href="index.php?page=admin&a=donate" class="list-group-item">
              <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-euro"></span> Pagina de donații</h4>
              <p class="list-group-item-text">Crează o pagina de donații în magazinul de obiecte.</p>
            </a><?php } ?>
            <a href="index.php?page=admin&a=chat" class="list-group-item">
              <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-envelope"></span> Poziție chat</h4>
              <p class="list-group-item-text">Setează dacă chat-ul să apară sau nu.</p>
            </a></br>
			
		<?php if($_SESSION['user_admin']>=$adminRights['web_news']) { ?>
            <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Gestionare &#351;tiri & noutăți</h3>
            </div>
            <div class="panel-body">
            <a href="index.php?page=admin&a=news" class="list-group-item">
              <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-book"></span> Adaugă articole</h4>
            </a>
            <a href="index.php?page=admin&a=news_edit" class="list-group-item">
              <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-edit"></span> Editează articole</h4>
            </a>
            <a href="index.php?page=admin&a=news_delete" class="list-group-item">
              <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-remove"></span> Șterge articole</h4>
            </a>
          </div>
          </div>
		  
			<div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Gestionare magazin de obiecte (Item-Shop)</h3>
            </div>
            <div class="panel-body">
            <a href="index.php?page=admin&amp;a=edit_cat" class="list-group-item">
              <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-refresh"></span> Editează categoriile</h4>
            </a>
            <a href="index.php?page=admin&amp;a=add_shop" class="list-group-item">
              <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-gift"></span> Adaugă obiecte</h4>
            </a>
            <a href="index.php?page=admin&amp;a=delete_item" class="list-group-item">
              <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-trash"></span> Șterge obiecte</h4>
            </a>
          </div>
          </div><?php } ?>
			
            <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Gestionare Administratori</h3>
            </div>
            <div class="panel-body">
			<?php if($_SESSION['user_admin']>=$adminRights['web_admins']) { ?>
            <a href="index.php?page=admin&a=admins" class="list-group-item">
              <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-star"></span> Gestionare Administratori - Site</h4>
            </a><?php } ?>
			<?php if($_SESSION['user_admin']>=$adminRights['game_admins']) { ?>
            <a href="index.php?page=admin&a=gadmins" class="list-group-item">
              <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-star-empty"></span> Gestionare Administratori - Joc</h4>
            </a><?php } ?>
          </div>
          </div>
            <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Gestionare Cupoane</h3>
            </div>
            <div class="panel-body">
			<?php if($_SESSION['user_admin']>=$adminRights['coupons_add']) { ?>
            <a href="index.php?page=admin&a=coupons" class="list-group-item">
              <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-plus"></span> Adaugă cupoane</h4>
            </a><?php } ?>
			<?php if($_SESSION['user_admin']>=$adminRights['coupons_add']) { ?>
            <a href="index.php?page=admin&a=coupons_valid" class="list-group-item">
              <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-eye-open"></span> Cupoane nefolosite</h4>
            </a><?php } ?>
			<?php if($_SESSION['user_admin']>=$adminRights['coupons_log']) { ?>
            <a href="index.php?page=admin&a=coupons_log" class="list-group-item">
              <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-file"></span> Log cupoane</h4>
            </a><?php } ?>
          </div>
          </div>
            <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Gestionare jucatori</h3>
            </div>
            <div class="panel-body">
			<?php if($_SESSION['user_admin']>=$adminRights['acc_suche']) { ?>
            <a href="index.php?page=admin&a=user" class="list-group-item">
              <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-search"></span> C&#259;utare cont</h4>
            </a><?php } ?>
			<?php if($_SESSION['user_admin']>=$adminRights['ip_suche']) { ?>
            <a href="index.php?page=admin&a=iplist" class="list-group-item">
              <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-zoom-in"></span> C&#259;utare IP-uri</h4>
            </a><?php } ?>
			<?php if($_SESSION['user_admin']>=$adminRights['banlist']) { ?>
            <a href="index.php?page=admin&a=banlist" class="list-group-item">
              <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-remove"></span> Conturi blocate</h4>
            </a><?php } ?>
			<?php if($_SESSION['user_admin']>=$adminRights['char_suche']) { ?>
            <a href="index.php?page=admin&a=charlist" class="list-group-item">
              <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-zoom-out"></span> C&#259;utare caractere</h4>
            </a><?php } ?>
			<?php if($_SESSION['user_admin']>=$adminRights['multi_coins']) { ?>
            <a href="index.php?page=admin&a=add_coins_multi" class="list-group-item">
              <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-euro"></span> Ad&#259;ugare monede (multi utilizator)</h4>
            </a><?php } ?>
			<?php if($_SESSION['user_admin']=9) { ?>
            <a href="index.php?page=admin&a=create_item" class="list-group-item">
              <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-fire"></span> Creare item modat</h4>
            </a><?php } ?>
            </div>
          </div>
			<?php if($_SESSION['user_admin']>=7) { ?>
            <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Logs</h3>
            </div>
            <div class="panel-body">
            <a href="index.php?page=admin&a=gmlog" class="list-group-item">
              <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-th-list"></span> Log GM</h4>
            </a>
            <a href="index.php?page=admin&a=hacklog" class="list-group-item">
              <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-th"></span> Log Hack</h4>
            </a>
            <a href="index.php?page=admin&a=moneylog" class="list-group-item">
              <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-euro"></span> Log Yang</h4>
            </a>
            <a href="index.php?page=admin&a=loginlog" class="list-group-item">
              <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-repeat"></span> Log Login</h4>
            </a>
            <a href="index.php?page=admin&a=levellog" class="list-group-item">
              <h4 class="list-group-item-heading"><span class="glyphicon glyphicon-list-alt"></span> Log Level</h4>
            </a>
            </div>
          </div><?php } ?>
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
?>