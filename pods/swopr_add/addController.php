<?

	include_once("../../PeoplePods.php");
	$POD = new PeoplePod(array(
  		'authSecret'=>$_COOKIE['pp_auth'],
  		'lockdown'=>'verify',
  		'debug'=>0
	));

	$POD->header('Add items to your inventory');
	
	
	$POD->footer();

?>