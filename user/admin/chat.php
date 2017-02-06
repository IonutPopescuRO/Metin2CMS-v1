<?PHP
  if(!isset($_SESSION)){session_start();}
  if(isset($_GET['page'])) {
  if(isset($_GET['a'])) {
  if (isset($_SESSION['user_admin'])) { 
  if($_SESSION['user_admin']>=$adminRights['web_news']) {
?>
<?php
	if(isset($_POST['submit']))
	{
		$value = $_POST['value']; 
		$date = date("d/m/Y");
		mysqli_query($sqlHp, "UPDATE ".SQL_HP_DB.".settings SET value='$value' WHERE id='10'");
		echo "<div class=\"alert alert-success\" role=\"alert\">
					Poziția a fost <strong>editată</strong>!
				</div>";
	}
	else
	{
		$query = mysqli_query($sqlHp, "SELECT * FROM ".SQL_HP_DB.".settings WHERE id='10'");
		$output = mysqli_fetch_assoc($query);
?>
<div class="page-header">
        <h1>Editare Poziție chat</h1>
      </div>
<div class="well">

	
<form method="post" action="index.php?page=admin&a=chat"> 
<div class="page-header">
        <h3>Unde să apară?</h3>
      </div>
<select name="value" id="value" class="form-control">
				<option selected="selected" value="0">Dezactivat</option>
				<option value="1">Prima pagină - SUS</option>
				<option value="2">Prima pagină - JOS</option>
				<option value="3">Pe pagina de chat</option>
			  </select>
</br>
<input type="Submit" name="submit" class="btn-big btn-success btn-lg btn" value="Editează">
</form>

</div>
<?PHP
} }
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
<a href="javascript: history.go(-1)" class="btn btn-warning" role="button">« Înapoi</a>