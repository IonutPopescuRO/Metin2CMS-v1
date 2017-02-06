<?php
if(!empty($_SESSION['id'])){
$ch = mysqli_query($sqlHp, "SELECT * FROM ".SQL_HP_DB.".settings WHERE id=10");
$chat = mysqli_fetch_assoc($ch);
if ($chat['value'] == "3") {
?>
  <div class="well">

    <?php include("chat/chatroom.php"); ?>

	</div>
<?php
}
else echo '<div class="alert alert-danger" role="alert">
        <strong>Această pagină este dezactivată.</strong>
      </div>';
}
else echo '<div class="alert alert-danger" role="alert">
        <strong>Trebuie </strong> să fi logat pentru a accesa această zonă.
      </div>';
?>