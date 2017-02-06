<?PHP
  if(!isset($_SESSION)){session_start();}
  if(isset($_GET['page'])) {
  if(isset($_GET['a'])) {
  if (isset($_SESSION['user_admin'])) { 
  if($_SESSION['user_admin']>=$adminRights['web_news']) {
?>
<?php
function clear($message)
{
	if(!get_magic_quotes_gpc())
		$message = addslashes($message);
	$message = strip_tags($message);
	$message = htmlentities($message);
	return trim($message);
}

	if(isset($_POST['submit']))
	{
		$title = clear($_POST['title']); 
		$message = $_POST['message']; 
		$date = date("d/m/Y");
		mysqli_query($sqlHp, "UPDATE ".SQL_HP_DB.".presentation SET title='$title', message='$message', date='$date' WHERE id='1'");
		echo "<div class=\"alert alert-success\" role=\"alert\">
					Articolul a fost <strong>editat</strong> cu succes!
				</div>";
	}
	else
	{
		$query = mysqli_query($sqlHp, "SELECT * FROM ".SQL_HP_DB.".presentation WHERE id='1'");
		$output = mysqli_fetch_assoc($query);
?>
<div class="page-header">
        <h1>Editare <?php echo $output['title']; ?></h1>
      </div>
<div class="well">
<form method="post" action=""> 
<div class="page-header">
        <h3>Titlu:</h3>
      </div>
<input name="title" id="title" type="Text" class="form-control -webkit-transition" value="<?php echo $output['title']; ?>">

<div class="page-header">
        <h3>Conținut:</h3>
      </div>
<textarea class="ckeditor" name="message" id="message"><?php echo $output['message']; ?></textarea>

</br>
<input type="Submit" name="submit" class="btn-big btn-success btn-lg btn" value="Editează">
</form></div>
<?PHP
}}
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