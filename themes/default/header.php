<?php
/***********************************************
* This file is part of PeoplePods
* (c) xoxco, inc  
* http://peoplepods.net http://xoxco.com
*
* theme/header.php
* Defines what is in the header of every page, used by $POD->header()
*
* Special variables in this file are:
* $pagetitle
* $feedurl
*
* Documentation for this pod can be found here:
* http://peoplepods.net/readme/themes
/**********************************************/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><? if ($pagetitle) { echo $pagetitle . " - " . $POD->siteName(false); } else { echo $POD->siteName(false); } ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<script src="<? $POD->templateDir(); ?>/js/jquery-1.4.2.min.js"></script>
	<script src="<? $POD->templateDir(); ?>/js/jquery.validate.min.js"></script>

	<link rel="stylesheet" type="text/css" href="<? $POD->templateDir(); ?>/styles.css" media="screen" charset="utf-8" />
	
	<? if ($feedurl) { ?>
		<link rel="alternate" type="application/rss+xml" title="RSS: <? if ($pagetitle) { echo $pagetitle . " - " . $POD->siteName(false); } else { echo $POD->siteName(false); } ?>" href="<? echo $feedurl; ?>" />
	<? } else if ($POD->libOptions('enable_core_feeds')) { ?>	
		<link rel="alternate" type="application/rss+xml" title="RSS: <? $POD->siteName();  ?>" href="<? $POD->siteRoot(); ?>/feeds" />
	<? } ?>		

	<script type="text/javascript">
		var siteRoot = "<? $POD->siteRoot(); ?>";
		var podRoot = "<? $POD->podRoot(); ?>";
		var themeRoot = "<? $POD->templateDir(); ?>";
		var API = siteRoot + "/api";		
	</script>
	
	<script type="text/javascript" src="<? $POD->templateDir(); ?>/javascript.js"></script>
	
</head>

<body id="body">
<? if ($fb_api = $POD->libOptions('fb_connect_api')) { ?>
	<script type="text/javascript" src="http://connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php"></script> 
	<script type="text/javascript">FB.init('<?= $fb_api; ?>','/xd_receiver.htm');</script>	
<? } ?>

	<!-- begin header -->
	<div id="header">

		<!-- begin login status -->
		<div id="login_status" class="grid">
			<div class="column_8">
				<div id="siteName">
					<? $POD->siteName(); ?>
				</div>
			</div>
			<div class="column_4 last">
				<div class="column_padding">
				<? if ($POD->isAuthenticated()) { ?>
					Welcome, <a href="<? $POD->currentUser()->write('permalink'); ?>" title="View My Profile"><? $POD->currentUser()->write('nick'); ?></a> |
					<? if ($POD->libOptions('enable_core_private_messaging')) { ?>
						<a href="<? $POD->siteRoot(); ?>/inbox"><? $i = $POD->getInbox(); if ($i->unreadCount() > 0) { echo $i->unreadCount(); ?> Unread <? } else { ?>Inbox<? } ?></a> |
					<? } ?>
					<a href="<? $POD->siteRoot(); ?>/logout" title="Logout">Logout</a>
				<? } else { ?>
					Returning? <a href="<? $POD->siteRoot(); ?>/login">Login</a>
				<? } ?>
				</div>
			</div>
			<div class="clearer"></div>
		</div>
		<!-- end login status -->
		
		<!-- begin main navigation -->		
		<div id="nav" class="grid">
				<? if ($POD->libOptions('enable_core_search')) { ?>
					<form method="get" action="<? $POD->siteRoot(); ?>/search">
						Search <input name="q" id="nav_search_q" class="repairField" default="this site" />
					</form>
				<? } ?>
				
				<ul><li><a href="<? $POD->siteRoot(); ?>">Home</a></li>
					<? if ($POD->libOptions('enable_contenttype_document_list')) { ?><li><a href="<? $POD->siteRoot(); ?>/show">What's New?</a></li><? } ?>
					<? if ($POD->libOptions('enable_core_groups')) { ?><li><a href="<? $POD->siteRoot(); ?>/groups">Groups</a></li><? } ?>
					<? if ($POD->isAuthenticated()) { ?>
						<? if ($POD->currentUser()->get('adminUser')) { ?>
							<li><a href="<? $POD->podRoot(); ?>/admin">Command Center</a></li>
						<? } ?>
					<? } else { ?>
						<? if ($POD->libOptions('enable_core_authentication_creation')) {?><li><a href="<? $POD->siteRoot(); ?>/join">Join</a></li><? } ?>
					<? } ?>						
				</ul>
		</div>
		<!-- end main navigation -->
		
	</div>
	<!-- end header -->
	
	<div id="main" class="content grid">
