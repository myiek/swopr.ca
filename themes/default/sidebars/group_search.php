<?php
/***********************************************
* This file is part of PeoplePods
* (c) xoxco, inc  
* http://peoplepods.net http://xoxco.com
*
* theme/sidebars/group_search.php
* Sidebar box to create a group
* Used in core_groups/index.php
*
*
* Documentation for this pod can be found here:
* http://peoplepods.net/readme/person-object
/**********************************************/
?>
<div class="sidebar column_padding" id="group_search_sidebar">
	<h3>Find a Group</h3>
	<form method="get" id="group_search">
		<input name="q" class="text repairField" id="search_groups_q" onfocus="repairField('search_groups_q','search groups');"  onblur="repairField('search_groups_q','search groups');" value="search groups"  />
	</form>	
</div>