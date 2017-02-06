<?php
if(!empty($_SESSION['id'])){
$ch = mysqli_query($sqlHp, "SELECT * FROM ".SQL_HP_DB.".settings WHERE id=10");
$chat = mysqli_fetch_assoc($ch);
if ($chat['value'] == "1") {
echo'<div class="well">';
    include("chat/chatroom.php");
echo'</div></br>';
} }

if(empty($_SESSION['id'])){
		echo "
<div class=\"list-group\">
<a href=\"?page=download\" class=\"list-group-item active\">
		<h4 class=\"list-group-item-heading\"><center>Descarcă acum ";
		include("./user/name_sv.php"); echo '</center>';			
		echo "</h4></a></br><center><a role=\"button\" href=\"index.php?page=register\" class=\"btn btn-lg btn-success\">Înregistrează-te!</a></center></div>"; }
		?>

<?php
	$result = $sqlHp->query("SELECT COUNT(*) FROM ".SQL_HP_DB.".news");
	$row = $result->fetch_row();
	if (!$row[0]) { echo'<div class="alert alert-danger" role="alert">
							Momentan nu a fost publicată nicio postare!
						</div>
	'; } 
	$q="select count(*) \"total\"  from ".SQL_HP_DB.".news";
	$ros=mysqli_query($sqlHp, $q);
	$row=mysqli_fetch_array($ros);
	$total=$row['total'];
	
	$howmanydisplay = mysqli_query($sqlHp, "SELECT * FROM ".SQL_HP_DB.".settings WHERE id=2");
	$display = mysqli_fetch_assoc($howmanydisplay);
	$dis = $display['value'];
	
	$total_page=ceil($total/$dis);
	$page_cur=(isset($_GET['nr']))?$_GET['nr']:1;
	$k=($page_cur-1)*$dis;

	$query = mysqli_query($sqlHp, 'SELECT * FROM '.SQL_HP_DB.'.news ORDER BY id DESC LIMIT '.$k.', '.$dis.'');
	while($output = mysqli_fetch_assoc($query))
	{
	echo "<div class=\"panel panel-primary\">";
	echo '<div class="panel-heading"><h3 class="panel-title">'.$output['title'].'</h3></div>';
	echo '<span class="label label-success"><i class="glyphicon glyphicon-time"></i> '.$output['date_added'].'</span>';
	echo '<div class="panel-body">'.$output['full_content'].'</div>';
	echo '</div><hr />'; 
	}
	echo '</table>';
	echo '<br/>';
	if ($row[0] > $dis+1) { 
	if($page_cur>1)
	{
		echo '<a href="index.php?nr='.($page_cur-1).'" style="cursor:pointer;color:green;" ><input class="btn btn-primary btn-lg" type="button" value="« Pagina anterioară "></a>&#32;&#32;';
	}
	else
	{
	  echo '<input class="btn btn-primary btn-lg" type="button" value=" Prima pagină ">&#32;&#32;';
	}
	if($page_cur<$total_page)
	{
		echo '<a href="index.php?nr='.($page_cur+1).'"><input type="button" class="btn btn-primary btn-lg" value=" Următoarea pagină » "></a>';
	}
	else
	{
	 echo '<input type="button" class="btn btn-primary btn-lg" value=" Ultima pagină ">';
	}
	 }
if(!empty($_SESSION['id'])){
if ($chat['value'] == "2") {
echo'<div class="well">';
    include("chat/chatroom.php");
echo'</div>';
} }
?>