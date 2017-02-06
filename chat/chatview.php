<?php
error_reporting(0);
require('chatconfig.php');

if(isset($_GET['lastfetch']) && is_numeric($_GET['lastfetch']) && $_GET['lastfetch']>0)
{
	$lastfetch = 0;//round($_GET['lastfetch']);
}
else
{
	$lastfetch = 0;
}

$fp = @fopen($chat_datafile, "r");
if($fp)
{ echo '<div class="media msg">';
	while($line = fgets($fp))
	{
		$line = explode("&&", $line);
		if(count($line)<4) continue;
		if($line[0]>=$lastfetch)
		{
$time = date('d-m-Y H:i:s', $line[0]);
if ($line[4] == "user") {
echo <<<ENDHTML

                    <a class="pull-left">
                        <img class="media-object" data-src="holder.js/64x64" alt="64x64" style="width: 32px; height: 32px;" src="images/chars/misc/{$line[4]}.png">
                    </a>
ENDHTML;
}
else {
echo <<<ENDHTML

                    <a class="pull-left" href="?page=player&char={$line[1]}">
                        <img class="media-object" data-src="holder.js/64x64" alt="64x64" style="width: 32px; height: 32px;" src="images/chars/misc/{$line[4]}.png">
                    </a>
ENDHTML;
}
echo <<<ENDHTML
                    <div class="media-body">
                        <small class="pull-right time"><i class="glyphicon glyphicon-time"></i> $time</small>
ENDHTML;

if ($line[5] == 0) {
if ($line[4] == "user") {

echo <<<ENDHTML

                        <h5 class="media-heading"><span class="label label-info">{$line[1]}</span></h5>
ENDHTML;

}
else {
echo <<<ENDHTML

                        <h5 class="media-heading"><a class="pull-left" href="?page=player&char={$line[1]}"><span class="label label-info">{$line[1]}</span></a></h5>
ENDHTML;
}
}
else {
if ($line[4] == "user") {
echo <<<ENDHTML

                        <h5 class="media-heading"><span class="label label-danger">{$line[1]}</span></h5>
ENDHTML;

}
else {
echo <<<ENDHTML

                        <h5 class="media-heading"><a class="pull-left" href="?page=player&char={$line[1]}"><span class="label label-danger">{$line[1]}</span></a></h5>
ENDHTML;
}

}
echo <<<ENDHTML
                        <small class="col-lg-10">{$line[2]}</small>
                    </div>
<hr>
ENDHTML;

		}
	}
	echo '</div>';
	fclose($fp);
}

?>