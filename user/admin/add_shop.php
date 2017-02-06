<?PHP
  if(!isset($_SESSION)){session_start();}
  if(isset($_GET['page'])) {
  if(isset($_GET['a'])) {
  if (isset($_SESSION['user_admin'])) { 
  if($_SESSION['user_admin']>=$adminRights['web_news']) {
?>
<div class="well">

<?php
echo "
<div class=\"alert alert-info\" role=\"alert\">
        Asigrați-vă că directorul /shop/images/items are permisiunea <strong>777</strong>!
      </div>";
if(isset($_POST['done']))
{
//IMG
$uploaddir = 'shop/img/items/';
$name = rand(100000, 999999);
$uploadfile = $uploaddir . basename($name.'.png');

echo "<p>";

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {} else {
   echo "Imagine invalidă";
}

echo "</p>";
//IMG

$nume_item = $_POST['nume_item'];
$categorie = $_POST['categorie'];
$descriere = $_POST['descriere'];
$pret = $_POST['pret'];
$vnum = $_POST['vnum'];

$sql = mysqli_query($sqlHp, "INSERT INTO ".SQL_HP_DB.".item_ishop
			(nume_item, categorie, descriere, pret, vnum, img)
			VALUES('{$nume_item}', '{$categorie}', '{$descriere}', '{$pret}', '{$vnum}', '{$name}')");

echo "
<div class=\"alert alert-success\" role=\"alert\">
        Obiectul a fost adăugat cu <strong>succes</strong>!
      </div>";
}
//socket = piatra
//att = bonus
?> 
            <form enctype="multipart/form-data" action="" method="POST">
			<h4>Nume obiect</h4>
<hr>
                <div class="form-group">
					<input class="form-control input-lg" name="nume_item" type="text" id="nume_item">
                </div>
			<h4>Imagine obiect</h4>
<hr>
                <div class="form-group">
                    <input name="userfile" type="file" class="file">
                </div>
				
			<h4>Categorie</h4>
<hr>
                <div class="form-group">
					<select name="categorie" id="categorie" class="form-control">

							<?php 
								$query = mysqli_query($sqlHp, "SELECT * FROM ".SQL_HP_DB.".ishop_categorii");
									while($array = mysqli_fetch_array($query)) {
										echo"<option value=".$array["id"].">".$array["nume"]."</option>";
									}?>
					</select>
                </div>
				
			<h4>Descriere</h4>
<hr>
                <div class="form-group">
					<textarea class="form-control" id="descriere" name="descriere"></textarea>
                </div>
				
			<h4>vNum</h4>
<hr>
                <div class="form-group">
					<input class="form-control input-lg" name="vnum" type="number" id="vnum">
                </div>
				
			<h4>Preț (în MD)</h4>
<hr>
                <div class="form-group">
					<input class="form-control input-lg" name="pret" type="number" id="pret">
                </div>
				
                <div class="form-group">
                    <button class="btn btn-primary" name="done" id="done">Adaugă</button>
                    <button class="btn btn-default" type="reset">Resetează</button>
                </div>
            </form>

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