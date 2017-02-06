<?php 
error_reporting(0);
		$page = isset($_GET['page']) ? $_GET['page'] : null;

		switch ($page) {
			case 'admin':
				require 'main/admin.php';
				break;
			case 'safebox':
				require 'main/camp_p.php';
				break;
			case 'chars':
				require 'main/chars.php';
				break;
			case 'coupon':
				require 'main/coupon.php';
				break;
			case 'download':
				require 'main/download.php';
				break;
			case 'guilds':
				require 'main/guilds.php';
				break;
			case 'login':
				require 'main/login.php';
				break;
			case 'login_error':
				require 'main/login_error.php';
				break;
			case 'logout':
				require 'main/logout.php';
				break;
			case 'password':
				require 'main/password.php';
				break;
			case 'passwordlost':
				require 'main/passwordlost.php';
				break;
			case 'player':
				require 'main/player.php';
				break;
			case 'players':
				require 'main/players.php';
				break;
			case 'presentation':
				require 'main/presentation.php';
				break;
			case 'profil':
				require 'main/profil.php';
				break;
			case 'register':
				require 'main/register.php';
				break;
			case 'reset_char':
				require 'main/reset_char.php';
				break;
			case 'rules':
				require 'main/rules.php';
				break;
			case 'chat':
				require 'main/chat.php';
				break;
			case 'donate':
				require 'main/donate.php';
				break;
			case 'email':
				require 'main/email.php';
				break;
			default:
				require 'main/home.php';
				break;
		}
		?>