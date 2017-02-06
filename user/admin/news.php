<?PHP
  if(!isset($_SESSION)){session_start();}
  if(isset($_GET['page'])) {
  if(isset($_GET['a'])) {
  if (isset($_SESSION['user_admin'])) { 
  if($_SESSION['user_admin']>=$adminRights['web_news']) {
?>
<div class="page-header">
        <h1>&#350;tiri prezentare general&#259;</h1>
		<p>Ad&#259;ugare &#351;tiri</p>
      </div>
	  
<div class="well">
<form method="post" action="#"> 
<div class="page-header">
        <h3>Titlu:</h3>
      </div>
	
	<input name="subject" id="subject" type="Text" class="form-control -webkit-transition" >

<div class="page-header">
        <h3>Conținut:</h3>
      </div>
	<textarea class="ckeditor" id="editor1" name="news" id="news"></textarea>
	</br>
	<input type="Submit" name="submit" id="submit" class="btn-big btn-success btn-lg btn" value="Adaugă">
</form>
<?php
function clear($message)
{
	if(!get_magic_quotes_gpc())
		$message = addslashes($message);
	$message = strip_tags($message);
	$message = htmlentities($message);
	return trim($message);
}
if (isset($_POST['submit']))
{ 
	if (empty($_POST['subject']))
		die('Enter a subject.'); 
	else if (empty($_POST['news']))
		die('Adaugat!'); 
	$subject = clear($_POST['subject']); 
	$news = $_POST['news']; 
	$date = date("d/m/Y");
	if(mysqli_query($sqlHp, "INSERT INTO ".SQL_HP_DB.".news (id , full_content , title , date_added) VALUES ('', '$news', '$subject', '$date')"))
	
echo "
<div class=\"alert alert-success\" role=\"alert\">
        <strong>Noutatea </strong> a fost adăugată!
      </div>";
		
}
?>
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
<a href="javascript: history.go(-1)" class="btn btn-warning" role="button">« Înapoi</a>