<?PHP
  if(!isset($_SESSION)){session_start();}
  if(isset($_GET['page'])) {
  if(isset($_GET['a'])) {
  if (isset($_SESSION['user_admin'])) { 
  if($_SESSION['user_admin']>=$adminRights['web_news']) {
?>
<div class="page-header">
        <h1>Ștergere articole</h1>
      </div>
<html>
<head>
<title>Delete</title>
<script type="text/javascript">
function check(id){
	if (confirm("Ești sigur că vrei să ștergi acest aricol?"))
		this.location.href = "index.php?page=admin&a=delete_item&id="+id;
}</script>
</head>
<body>

<?php
if(!isset($_GET['id']))
{
echo '<div class="well">
	<table class="table">
            <thead>
              <tr>
                <th>Obiect</th>
                <th>Categorie</th>
                <th>Acțiuni</th>
              </tr>
            </thead>
            <tbody>';
	$query = mysqli_query($sqlHp, 'SELECT * FROM '.SQL_HP_DB.'.item_ishop ORDER BY id DESC');
	while($output = mysqli_fetch_assoc($query)) {
		$query2 = mysqli_query($sqlHp, "SELECT * FROM ".SQL_HP_DB.".ishop_categorii WHERE id=".$output['categorie']."");
		$cat = mysqli_fetch_assoc($query2);
		echo'<tr>
                <td>'.$output['nume_item'].'</td>
                <td>'.$cat['nume'].'</td>
                <td><a href="#" onclick="check('.$output['id'].'); return false;">Șterge</a></td>
              </tr>';}
		echo '</tbody></table></div>';
}
else
{
	$id = $_GET['id']; 
	mysqli_query($sqlHp, "DELETE FROM ".SQL_HP_DB.".item_ishop WHERE id = $id LIMIT 1"); 
echo "
<div class=\"alert alert-success\" role=\"alert\">
        Obiectul a fost <strong>șters</strong> definitiv!
      </div>";
}
?> 
</body>
</html>
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