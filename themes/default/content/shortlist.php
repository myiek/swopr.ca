<?php
/***********************************************
* This file is part of PeoplePods
* (c) xoxco, inc  
* http://peoplepods.net http://xoxco.com
*
* theme/content/short.php
* Default short template for content.
* Used by core_usercontent/list.php
*
* Documentation for this pod can be found here:
* http://peoplepods.net/readme/themes
/**********************************************/
?>	<div class="content_short content_<? $doc->write('type'); ?> <? if ($doc->get('isOddItem')) {?>content_odd<? } ?> <? if ($doc->get('isEvenItem')) {?>content_even<? } ?> <? if ($doc->get('isLastItem')) {?>content_last<? } ?> <? if ($doc->get('isFirstItem')) {?>content_first<? } ?>" id="document_<? $doc->write('id'); ?>">	
	
			<div class="column_8 last">
				<div class="content_body column_padding">
					<span class="content_meta">
						<span class="content_author"><? $doc->author()->permalink(); ?></span> has this item. Listed<span class="content_time">
							<? echo $doc->write('timesince'); ?></span>
							
						<!-- list users based on proximity location -->
						
						
						
						<? if ($doc->isEditable()) { ?>				
								<a href="#" onclick="return deleteDocument(<? $doc->write('id'); ?>);">Delete</a>					
						<? } ?>		
					</span>

					<ul class="content_options">							
						<? if ($doc->get('privacy')=="friends_only") { ?>
							<li class="friends_only_option">Friends Only</li>
						<? } else if ($doc->get('privacy')=="group_only") { ?>
							<li class="group_only_option">Group Members Only</li>
						<? } else if ($doc->get('privacy')=="owner_only") { ?>
							<li class="owner_only_option">Only you can see this.</li>
						<? } ?>
					</ul>
				</div>
			</div>
		<div class="clearer"></div>
	</div>
