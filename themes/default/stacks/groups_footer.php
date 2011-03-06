<?php
/***********************************************
* This file is part of PeoplePods
* (c) xoxco, inc  
* http://peoplepods.net http://xoxco.com
*
* theme/stacks/groups_footer.php
* Header used in core_groups to create the /groups page
*
* Documentation for this pod can be found here:
* http://peoplepods.net/readme/stack-output
/**********************************************/
?>	
	<? if ($this->count() == 0) { ?>
		<div class="empty_list">
			No groups found!
		</div>
	<? } ?>
	<div class="stack_footer">
		<? if ($this->hasPreviousPage()) { echo '<a href="?offset=' . $this->previousPage() . '" class="stack_previous_link">Previous</a>'; } ?>
		<? if ($this->hasNextPage()) { echo '<a href="?offset=' . $this->nextPage() . '" class="stack_next_link">Next</a>'; }	?>
	</div>