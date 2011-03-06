<?php
/***********************************************
* This file is part of PeoplePods
* (c) xoxco, inc  
* http://peoplepods.net http://xoxco.com
*
* theme/stacks/groups_header.php
* Header used in core_groups to create the /groups page
*
* Documentation for this pod can be found here:
* http://peoplepods.net/readme/stack-output
/**********************************************/
?>	
		<? if ($this->count() > 0) { ?>
			<div class="column_2">
				<div class="column_padding">
					<b>Group</b>	
				</div>
			</div>
			<div class="column_4">
				<div class="column_padding">
					<b>Description</b>
				</div>	
			</div>
			<div class="column_2 last">
				<div class="column_padding">
					<b>Members</b>
				</div>	
			</div>
		
			<div class="clearer"></div>
		<? } ?>
