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
if(!isset($_GET['id']))
{
	$query = mysqli_query($sqlHp, "SELECT * FROM ".SQL_HP_DB.".ishop_categorii ORDER BY id");
	echo '<div class="page-header">
        <h1>Editare categorii Item-Shop</h1>
		<p>Selectează numele categoriei pe care vrei să o editezi.</p>
      </div>
	';
		echo "<div class=\"well\">";
	while($output = mysqli_fetch_assoc($query)){
		echo $output['nume'].' &raquo; <a href="index.php?page=admin&a=edit_cat&id='.$output['id'].'">Editare</a><br />';}
	echo "</div>";
		}
		

else
{
	if(isset($_POST['submit']))
	{
		$id = $_GET['id']; 
		$nume = clear($_POST['numenow']); 
		mysqli_query($sqlHp, "UPDATE ".SQL_HP_DB.".ishop_categorii SET nume='$nume' WHERE id='$id'");
		echo "<div class=\"alert alert-success\" role=\"alert\">
					Numele categoriei a fost <strong>editat</strong> cu succes!
				</div>";
	}
	else
	{
		$id = $_GET['id']; 
		$query = mysqli_query($sqlHp, "SELECT * FROM ".SQL_HP_DB.".ishop_categorii WHERE id='$id'");
		$output = mysqli_fetch_assoc($query);
?>
<div class="page-header">
        <h1>Editarea categoriei <?php echo $output['nume']; ?></h1>
      </div>
<div class="well">
<form method="post" action="index.php?page=admin&a=edit_cat&id=<?php echo $output['id']; ?>"> 
<div class="page-header">
        <h3>Noul nume:</h3>
      </div>
<input name="numenow" id="numenow" type="text" class="form-control -webkit-transition" placeholder="<?php echo $output['nume']; ?>">

</br>
<input type="Submit" name="submit" class="btn-big btn-success btn-lg btn" value="Editează">
</form></div>
<?PHP
}} }
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