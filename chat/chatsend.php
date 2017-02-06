<?php
error_reporting(0);
  if(!isset($_SESSION)){session_start();}
  require 'chatconfig.php';

// Check for a valid username and message
$valid_data = true;
if(!isset($_POST['username']) || !isset($_POST['message']) || preg_match('/^[a-z0-9_\-\.\s]{3,12}$/i',$_POST['username'])===false || strlen($_POST['message'])<1 || strlen($_POST['message'])>$chat_maxline)
{
	$valid_data = false;
}
else
{
	
	$username = $_SESSION['chat'];
	$avatar = $_SESSION['avatar'];
	$admin = $_SESSION['user_admin'];
	$message = htmlspecialchars($_POST['message']);
}

if($valid_data)
{
	// Check the last post by this user
	$fp = @fopen($chat_datafile, "r");
	if($fp)
	{
		$can_post = true;
		
		while($line = @fgets($fp))
		{
			$line = explode("&&", $line);
			if($line[4]==$_SERVER['REMOTE_ADDR'] && $line[0]>=(time()-$chat_timelimit))
			{
				$can_post = false;
				break;
			}
		}
		
		// If the user can post, check there aren't too many saved
		// entries then push onto the end of the stack
		if($can_post)
		{
			rewind($fp);
			$output = array();
			
			$linecount = 0;
			
			while($line = @fgets($fp))
			{
				$linecount++;
				array_push($output, $line);
				if($linecount>=$chat_postlimit)
				{
					array_shift($output);
					$linecount--;
				}
			}
			
			array_push($output, time()."&&{$username}&&{$message}&&{$_SERVER['REMOTE_ADDR']}&&{$avatar}&&{$admin}\n");
			
			fclose($fp);
			$fp = fopen($chat_datafile, "w");
			fwrite($fp, join("", $output));
			fclose($fp);
			
			// Success
			die("success");
		}
	}
}

// Failure
die("failed");
?>