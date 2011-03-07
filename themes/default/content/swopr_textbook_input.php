<?php
/***********************************************
* This file is part of PeoplePods
* (c) xoxco, inc  
* http://peoplepods.net http://xoxco.com
*
* theme/content/editform.php
* Default content add/edit form used by the core_usercontent module
* Customizing the fields in this form will alter the information stored!
* Use this file as the basis for new content type forms
*
* Documentation for this pod can be found here:
* http://peoplepods.net/readme/new-content-type
/**********************************************/
?>
<div id="swopr_editform">
	<form class="valid" action="<? $doc->write('editpath'); ?>" method="post" id="post_something"  enctype="multipart/form-data">
		<? if ($doc->get('id')) { ?>
				<input type="hidden" name="id" value="<? $doc->write('id'); ?>" />
				<input type="hidden" name="redirect" value="<? $doc->write('permalink'); ?>" />
		<? } else if ($doc->get('groupId')) { ?>
				<input type="hidden" name="redirect" value="<? $this->group()->write('permalink'); ?>" />
		<? } ?>
		<? if ($doc->get('groupId')) { ?>
				<input type="hidden" name="groupId" value="<? $doc->write('groupId'); ?>" />		
		<? } ?>
		
		<? if ($doc->get('type')) { ?>
				<input type="hidden" name="type" value="<? $doc->write('type'); ?>" />		
		<? } ?>
		
		<label for="headline" id="edit_form_title">ADD A TEXTBOOK TO YOUR INVENTORY:</label>
		<input type="text" name="headline" value="Enter ISBN, Title, Author or Keyword(s)" id="inputItem">	
		<input type="submit" id="swopr_editform_save" value="Add to inventory" />
			
			
		<div class="clearer"></div>

		<p>
			<?
				// if this is a new post, we need to give the option to set it friend only or group only
				if (!$doc->get('id')) { 
					if ($doc->group()) {
						if ($doc->group()->get('type')=="private") { ?>
							<input type="hidden" name="group_only" value="group_only" />
							Posts in this group will only be available to other members.
						<? } else { ?>
							<input type="checkbox" name="group_only" value="group_only" />
							<label for="group_only">Group Only</label>&nbsp;&nbsp;&nbsp;
						<? } 
					} else { ?>
						<input type="checkbox" name="friends_only" value="friends_only" />
						<label for="friends_only">Friends Only</label>&nbsp;&nbsp;&nbsp;
					<? } 
				} else { 
					if ($doc->get('privacy')=="friends_only") { ?>
						This post is visible to friends only.
					<? } else if ($doc->get('privacy')=="group_only") { ?>
						This post is only visible to other members of this group.
					<? } 
				} ?>
		</p>
		<div class="clearer"></div>
	</form>		
	<div class="clearer"></div>
</div> <!-- end editform -->

