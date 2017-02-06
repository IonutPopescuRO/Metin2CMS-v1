<?php
error_reporting(0);
 if(!$sqlHp){
  require '../inc/config.php';
	$sqlHp = new mysqli(SQL_HP_HOST,  SQL_HP_USER,  SQL_HP_PASS);

 };
$ch = mysqli_query($sqlHp, "SELECT * FROM ".SQL_HP_DB.".settings WHERE id=10");
$chat = mysqli_fetch_assoc($ch);
if (!$chat['value'] == "0") { 

require('chat/chatconfig.php');
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>

<script language="Javascript" type="text/Javascript" src="chat/jquery.js"></script>
<script language="Javascript" type="text/Javascript">
<!--
var chat_username = "";
var chat_refresh = 0;
var last_update = 0;
var last_post = 0;
var post_delay = <?php echo $chat_timelimit; ?>;
var post_delay_comment = 0;

function chat_delay_update() {
	tmp = (new Date().getTime()/1000);
	if((last_post+post_delay)<tmp) {
		$("#id_chat_delay").css("display","none");
		$("#id_chat_send").removeAttr('disabled');
		clearInterval(post_delay_comment);
		return;
	}
	
	$("#id_chat_delay").html("Po&#355;i scrie din nou &icirc;n "+Math.round((last_post+post_delay)-tmp)+" secunde...").addClass("alert alert-info");;
}

function chat_update() {
	last_update = new Date().getTime();
	
	$.get("chat/chatview.php", { lastfetch : last_update }, function(data) {
		$("#chat_text").html(data);
		$("#chat_text").scrollTop($("#chat_text").height()+$("#chat_text").scrollTop());
	});
}

function post_message() {
	if((last_post+post_delay)>=(new Date().getTime()/1000)) { return; }
	
	var chat_message = $("#id_chat_message").val();
	if(chat_message.length) {
		$.post("chat/chatsend.php",{ username : chat_username, message : chat_message });
		$("#id_chat_message").val("");
	}
	
	$("#id_chat_send").attr('disabled','disabled');
	last_post = (new Date().getTime()/1000);
	post_delay_comment = window.setInterval('chat_delay_update();', 1000);
	chat_delay_update();
	$("#id_chat_delay").css("display","block");
}

$(function() {
	$("#chat_container").css("display","block");
	
	$("#start_chat").click(function() {
		var tmp = $("#start_chat").val();

			$("#chat_form_username").css("display","none");
			$("#chat_form_message").css("display","block");
			chat_username = tmp;
			
			chat_refresh = window.setInterval('chat_update();', <?php echo $chat_refresh*1000; ?>);
			
			$("#id_chat_send").click(function() {
				post_message();
			});
			$("#id_chat_message").keypress(function(event) {
				if(event.which==13) {
					post_message();
				}
			});
		
	});
});
// -->
</script>

</head>

<body>

<div id="chat_container">
	<div id="chat_text"></div>
	<div id="chat_form">
		<div id="chat_form_username">
			<input type="button" class="btn btn-info" value="Start chat" id="start_chat">
			</p>
		</div>
		<div id="chat_form_message">
			<input type="text" id="id_chat_message" placeholder="Scrie mesajul aici..." class="form-control send-message" maxlength="<?php echo $chat_maxline; ?>">
			</br><input type="button" class="btn btn-success" id="id_chat_send" value="Trimite">
		</div></br>
			<div role="alert" id="id_chat_delay">
			</div>
	</div>
</div>

</body>
</html>
<?php } ?>