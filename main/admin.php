<?PHP
	if(isset($_SESSION['user_admin'])) {
	if($_SESSION['user_admin']>0)
	{
		
		$a = isset($_GET['a']) ? $_GET['a'] : null;

		switch ($a) {
			case 'add_coins_multi':
				require 'user/admin/add_coins_multi.php';
				break;
			case 'admins':
				require 'user/admin/admins.php';
				break;
			case 'ban':
				require 'user/admin/ban.php';
				break;
			case 'banlist':
				require 'user/admin/banlist.php';
				break;
			case 'charlist':
				require 'user/admin/charlist.php';
				break;
			case 'chars':
				require 'user/admin/chars.php';
				break;
			case 'coins':
				require 'user/admin/coins.php';
				break;
			case 'coupons':
				require 'user/admin/coupons.php';
				break;
			case 'coupons_log':
				require 'user/admin/coupons_log.php';
				break;
			case 'gadmins':
				require 'user/admin/gadmins.php';
				break;
			case 'gmlog':
				require 'user/admin/gmlog.php';
				break;
			case 'hacklog':
				require 'user/admin/hacklog.php';
				break;
			case 'ipban':
				require 'user/admin/ipban.php';
				break;
			case 'iplist':
				require 'user/admin/iplist.php';
				break;
			case 'levellog':
				require 'user/admin/levellog.php';
				break;
			case 'loginlog':
				require 'user/admin/loginlog.php';
				break;
			case 'moneylog':
				require 'user/admin/moneylog.php';
				break;
			case 'news':
				require 'user/admin/news.php';
				break;
			case 'news_delete':
				require 'user/admin/news_delete.php';
				break;
			case 'news_edit':
				require 'user/admin/news_edit.php';
				break;
			case 'presentation':
				require 'user/admin/presentation.php';
				break;
			case 'rights':
				require 'user/admin/rights.php';
				break;
			case 'settings':
				require 'user/admin/settings.php';
				break;
			case 'stat':
				require 'user/admin/stat.php';
				break;
			case 'unban':
				require 'user/admin/unban.php';
				break;
			case 'user':
				require 'user/admin/user.php';
				break;
			case 'users':
				require 'user/admin/users.php';
				break;
			case 'chat':
				require 'user/admin/chat.php';
				break;
			case 'add_shop':
				require 'user/admin/add_shop.php';
				break;
			case 'edit_cat':
				require 'user/admin/edit_cat.php';
				break;
			case 'delete_item':
				require 'user/admin/delete_item.php';
				break;
			case 'coupons_valid':
				require 'user/admin/coupons_valid.php';
				break;
			case 'create_item':
				require 'user/admin/create_item.php';
				break;
			case 'donate':
				require 'user/admin/donation.php';
				break;
			default:
				require 'user/admin/home.php';
				break;
		}
	} 
	
	else
	{
    echo'
<div class="alert alert-danger" role="alert">
        Nu ave&#355;i acces la aceast&#259; zon&#259;!
      </div>
	';
	} } else echo '<div class="alert alert-danger" role="alert">
        Nu ave&#355;i acces la aceast&#259; zon&#259;!
      </div>';
?>