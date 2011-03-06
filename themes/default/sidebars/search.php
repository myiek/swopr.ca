<?php
/***********************************************
* This file is part of PeoplePods
* (c) xoxco, inc  
* http://peoplepods.net http://xoxco.com
*
* theme/sidebars/search.php
* Simple search sidebar with content and person search
*
* Use this in other templates:
* $POD->output('sidebars/search');
*
* Documentation for this pod can be found here:
* http://peoplepods.net/readme/person-object
/**********************************************/
?>
<div class="column_padding sidebar" id="search_sidebar">
	<h3>Search</h3>
	<form method="get" action="<? $POD->siteRoot(); ?>/search">
		<input name="q" id="sidebar_search_q" onfocus="repairField('sidebar_search_q','search content');" onblur="repairField('sidebar_search_q','search content');" value="search content" class="repairField text" />&nbsp;<input type="submit" value="Search" />
	</form>
	<form method="get" action="<? $POD->siteRoot(); ?>/search">	
		<input name="p" id="sidebar_search_p" onfocus="repairField('sidebar_search_p','search people');" onblur="repairField('sidebar_search_p','search people');" value="search people" class="repairField text" />&nbsp;<input type="submit" value="Search" />
	</form>
</div>