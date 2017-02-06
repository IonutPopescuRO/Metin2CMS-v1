<?PHP

  function calcPages($gesEin,$aktSeite,$eSeite) {
    $output = array();
    $esQuote = ceil(($gesEin/$eSeite));
    if($aktSeite==0) {$aktSeite=1;}
    $startS = ($aktSeite*$eSeite)-$eSeite;
    $output[0]=$esQuote;
    $output[1]=$startS;
    return $output;
  }
  
  function checkAnum($wert) {
    $checkit = preg_match("/^[a-zA-Z0-9]+$/",$wert);
    if($checkit) {
      return true;
    }
    else {
      return false;
    }
  }
  
  function checkIP($wert) {
    $checkit = preg_match("/^[0-9\*]{1,3}+\.[0-9\*]{1,3}+\.[0-9\*]{1,3}+\.[0-9\*]{1,3}+$/",$wert);
    if($checkit) {
      return true;
    }
    else {
      return false;
    }
  }
  
  function checkMail($string) {
    if(preg_match("/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\.-]+\.[a-zA-Z]{2,4}$/", $string)) {
      return true;
    }
    else { return false; }
  }
  
  function checkInt($wert) {
    $checkit = preg_match("/^[0-9]+$/",$wert);
    if($checkit) {
      return true;
    }
    else {
      return false;
    }
  }
  
	function generateRandomString($length) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	function page_name()
	{
		$page = isset($_GET['page']) ? $_GET['page'] : null;
		if($page!=null)
		{
			$list_of_pages = array("admin", "safebox", "chars", "coupon", "download", "guilds", "login", "login_error", "logout", "password", "passwordlost", "player", "players", "presentation", "profil", "register", "reset_char", "rules", "chat", "donate", "email");
			if (in_array($page, $list_of_pages)) {
				echo $page;
			}
			else echo "home";
		} 
		else {
			echo "home";
		}
	}
?>