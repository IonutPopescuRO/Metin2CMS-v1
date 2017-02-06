<?PHP
  if(!isset($_SESSION)){session_start();}
  if(isset($_GET['page'])) {
  if(isset($_GET['a'])) {
  if (isset($_SESSION['user_admin'])) { 
  if($_SESSION['user_admin']>=$adminRights['web_news']) {
?>

<div class="page-header">
        <h1>Setări - Generale</h1>
      </div>
<div class="well">
<?php
function clear($message)
{
	if(!get_magic_quotes_gpc())
		$message = addslashes($message);
	$message = strip_tags($message);
	$message = htmlentities($message);
	return trim($message);
}

if(!isset($_GET['id']))
{
	$query = mysqli_query($sqlHp, "SELECT * FROM ".SQL_HP_DB.".settings ORDER BY id limit 9");
	echo 'Editează<hr />';
	echo"<div class=\"alert alert-info\" role=\"alert\">
        Dacă ți se cer linkuri te rog să scrii la început cu <strong>http://</strong> și la sfârșit cu <strong>/</strong> !
      </div><hr>";
	echo"<div class=\"alert alert-info\" role=\"alert\">
        Dacă linkurile vor fi goale ele nu vor <strong>apărea</strong> !
      </div><hr>";
	echo"<div class=\"alert alert-info\" role=\"alert\">
        La codul youtube scrieți doar codul. EX: <strong>https://www.youtube.com/watch?v=R74nodp320w</strong> Cod: <strong>R74nodp320w</strong> !
      </div><hr>";
	echo"<div class=\"alert alert-info\" role=\"alert\">
                La pagina de facebook postați numai ce urmează după <strong>http://facebook.com/</strong> ex: http://facebook.com/IonutPopescu.RO, punem: <strong>IonutPopescu.RO</strong>.
      </div><hr>";
	echo"<div class=\"alert alert-info\" role=\"alert\">
        Dacă vreți să dezactivați înregistrarea, scrieți <code><b>nu</b></code>.
      </div><hr>";
	while($output = mysqli_fetch_assoc($query))
		echo '<a href="index.php?page=admin&a=settings&id='.$output['id'].'">Editează</a> &raquo; '.$output['name'].'</br>';
}
else
{
	if (isset($_POST['submit']))
	{
		$id = $_GET['id']; 
		$value = ($_POST['value']); 
		mysqli_query($sqlHp, "UPDATE ".SQL_HP_DB.".settings SET value='$value' WHERE id='$id'");
		echo 'Editat.';
	}
	else
	{
		$id = $_GET['id']; 
		$query = mysqli_query($sqlHp, "SELECT * FROM ".SQL_HP_DB.".settings WHERE id='$id'");
		$output = mysqli_fetch_assoc($query);
?>

Editare <?php echo $output['name']; ?><hr />

<form method="post" action="#"> 
<input class="form-control" name="value" id="value" type="Text" value="<?php echo $output['value']; ?>">
<hr>
<input class="btn btn-success" role="button" type="Submit" name="submit" value="Schimbă">
</form>
<?PHP
}}
echo '</div>';
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
<a href="javascript: history.go(-1)" class="btn btn-warning" role="button">&#171; &#206;napoi</a>