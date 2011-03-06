<?php
/***********************************************
* This file is part of PeoplePods
* (c) xoxco, inc  
* http://peoplepods.net http://xoxco.com
*
* theme/people/welcome.php
* Used by the dashboard pod to create the homepage of the site for non-members
*
* Documentation for this pod can be found here:
* http://peoplepods.net/readme/person-object
/**********************************************/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><? if ($pagetitle) { echo $pagetitle . " - " . $POD->siteName(false); } else { echo $POD->siteName(false); } ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


	<link rel="stylesheet" type="text/css" href="<? $POD->templateDir(); ?>/styles.css" media="screen" charset="utf-8" />
	

	
	
</head>

<body id="body">
	<div id="main" class="content grid">
		<div class="column_4">
			<?	
				$POD->output('sidebars/login');			
				$POD->output('sidebars/recent_visitors');	
			?>
		</div>
		<div id="start_join_form">
			<!--layer an image underneath the form-->
			<form method="get" action="">	
				<p>
					<label for="school">Enter your university name to get started:</label>
					<input type="text" name="school" value=""/>
					<input type="submit" name="" value="Go!" />
				
				</p>
			</form>
		</div>
		
	</div>
</body>	