<?php
/***********************************************
* This file is part of PeoplePods
* (c) xoxco, inc  
* http://peoplepods.net http://xoxco.com
*
* theme/groups/short.php
* Default short output template for group objects
* Used in lists of groups
*
* Documentation for this pod can be found here:
* http://peoplepods.net/readme/group-object
/**********************************************/
?>
<div class="group">
	<div class="column_2">
		<div class="column_padding">
			<h3><? $group->permalink(); ?></h3>
		</div>
	</div>
	<div class="column_4">
		<div class="column_padding">
			<? $group->writeFormatted('description'); ?>	
		</div>	
	</div>
	<div class="column_2 last">
		<div class="column_padding">
			<? echo $group->members()->totalCount(); ?>	
		</div>	
	</div>

	<div class="clearer"></div>
</div>