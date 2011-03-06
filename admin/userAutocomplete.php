<? 
	include_once("../lib/Core.php");	
	$POD = new PeoplePod(array('lockdown'=>'adminUser','authSecret'=>@$_COOKIE['pp_auth']));

	$v = $_POST['q'];
	$v = mysql_real_escape_string($v);
	$sql = "SELECT distinct id,nick FROM users WHERE nick like '$q%' limit 10;";
	$res = mysql_query($sql,$POD->DATABASE);
	while ($r = mysql_fetch_assoc($res)) { 
		echo "{$r['nick']}|{$r['id']}\n";
	}
	