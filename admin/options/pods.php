<?

	include_once("../../PeoplePods.php");	
	$POD = new PeoplePod(array('lockdown'=>'adminUser','authSecret'=>@$_COOKIE['pp_auth']));

	error_reporting(1);
	
	$htaccessPath = realpath("../../../");


	// find all the PODS that are installed on this server.
	// each POD has a settings.php that calls $POD->registerPOD with options.
	$podInstallDir = opendir($POD->libOptions('installDir') . "/pods/");
	while ($pod = readdir($podInstallDir)) {
		if (file_exists($POD->libOptions('installDir') . "/pods/$pod/settings.php")) { 
			require($POD->libOptions('installDir') . "/pods/$pod/settings.php");
		}
	}	 
	
	if ($_GET || $_POST) {
		if ($_GET) { $form = $_GET; } else { $form = $_POST; }
	}
		
	// if there is a POST coming in, this means I'm updating my pod preferences.
	if ($form) { 
		
		$REWRITE_RULES = '';

		ksort($POD->PODS);

		// iterate through each pod we know about.
	 	foreach ($POD->PODS as $name => $podling) {
	
			// if it was checked, enable it.  if not, disable it.
			if ($form[$name]) { 
				$POD->setLibOptions('enable_' . $name,'true'); // tell the library this is turned on
				
				// has this pod requested an additional include file?
				if ($podling['include']) {
					$POD->setLibOptions('include_' . $name,$podling['include']);
				}

				// has this pod specified 
				if ($podling['settings']) {
					$POD->setLibOptions('settings_' . $name,$podling['settings']);
				}
				
		 		// add any variables that were requested by any enabled plugins
				foreach ($podling['libOptions'] as $option => $value) {
					$POD->setLibOptions($option,$value);
				}

				foreach ($podling['rules'] as $pattern => $rewrite) {
					$REWRITE_RULES .= "\n# $name\n";			
					$rewrite = $POD->libOptions('siteRoot') . $POD->libOptions('podRoot') . "/pods/" . $rewrite;
					$REWRITE_RULES .= "RewriteRule $pattern\t$rewrite\t[QSA,L]\n";
				} 

			} else {
				$POD->setLibOptions('enable_' . $name,null);
				// if this pod is not turned on, purge its variables from our system.
				foreach ($podling['libOptions'] as $option => $value) {
					$POD->setLibOptions($option,null);
				}		
			}
		}

		// save everything to lib/etc/options.php
		$POD->saveLibOptions();
		if (!$POD->success()) { 
			$message = $POD->error();
		} else {

			$POD->processIncludes();

			// create the .htaccess file
			$handle = fopen("$htaccessPath/.htaccess","r");
			if ($handle) {
				// if an .htaccess file already exists, find the current peopelpods rules and get rid of them.
				$htaccess = fread($handle,100000);
				fclose($handle);
				
				// find peoplepods chunk				
				preg_match("/(# BEGIN PEOPLEPODS RULES.*?# END PEOPLEPODS RULES)/is",$htaccess,$matches);
				if ($matches[1]) {
					$peoplepods_rules = $matches[1];
					$htaccess = preg_replace("/# BEGIN PEOPLEPODS RULES.*?# END PEOPLEPODS RULES/is","",$htaccess);			
				}
			}
					
			$REWRITE_RULES = "# BEGIN PEOPLEPODS RULES\n#####################################\n" .
						 "# turn the RewriteEngine on so that these fancy rewrite rules work\nRewriteEngine On\n" .
						 $REWRITE_RULES .
						 "\n#####################################\n# END PEOPLEPODS RULES";

			$handle = fopen("$htaccessPath/.htaccess","w");
			if (!fwrite($handle,$REWRITE_RULES . $htaccess )) {
				$message =  "COULD NOT WRITE .htaccess FILE! You will have to do it manually, or fix the permissions by executing this command on the command line:<Br />chmod 666 $htaccessPath/.htaccess";
			} else {
				$message = "Successfully wrote to .htaccess";
			}
		
		}
	}



	$POD->changeTheme('admin');
	$POD->header();		
	$current_tab="pods";

	?>	
	<? include_once("option_nav.php"); ?>
	<? if ($message) { ?>
		<div class="info">
		
			<? echo $message ?>
			
		</div>
	
	<? } ?>
	<div class="panel">
	<h1>Plugin Pods</h1>

	<p>
		Plugin Pods are sets of PeoplePods functionality that can be easily turned on and off.
		Choose Pods from the list below to customize the features present on your site.
	</p>
	
	<p>
		New Pods should be placed in <i><? echo $POD->libOptions('installDir'); ?>/pods</i>
	</p>
	
	<form method="post" action="<? $POD->podRoot(); ?>/admin/options/pods.php">
	<input name="go" type="hidden" value="foo" />
	<table cellspacing="0" cellpadding="0" class="stack_output">
		<tr>
			<th align="left">
				POD Name
			</th>
			<th align="left">
				Description
			</th>
			<th>&nbsp;</th>
			<th align="right">
				<input type="checkbox" onchange="selectAll(this);" />
			</th>
		</tr>
		<? 
			$count = 0;
			ksort($POD->PODS);

			foreach ($POD->PODS as $name => $podling) { $count++; ?>
			<tr  class="<? if ($count % 2 ==0) {?>even<? } else { ?>odd<? } ?>">
				<td valign="top" align="left">			
					<B><? echo $name; ?></B>
				</td>
				<td valign="top" align="left">
					<? echo $podling['description'] ?>
				</td>
				<td valign="top">
					<? if ($POD->libOptions('enable_'.$name) && $POD->libOptions('settings_'.$name)) { ?>
						<a href="podsettings.php?pod=<?= $name; ?>">settings</a>
					<? } ?>
				</td>
				<td valign="top" align="right">
					<input type="checkbox" class="enabler" name="<?= $podling['name']; ?>" <? if ($POD->libOptions('enable_'.$name)) {?>checked<? } ?> />				
				</td>				
			</tr>
		<? } ?>
		<tr>
			<td colspan="3" align="right">
				<input type="submit" value="Update" />
			</td>
		</tr>
	</table>
	</form>

	<? if ($newrules) { ?>
		<p>The following lines should appear in <i><? echo $htaccessPath; ?>/.htaccess</i></p>
		<textarea rows="15" cols="100"><? echo $newrules ?></textarea>
	<? } ?>			
	</div>
	
	<? $POD->footer();	?>