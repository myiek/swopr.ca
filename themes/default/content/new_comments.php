<?php
/***********************************************
* This file is part of PeoplePods
* (c) xoxco, inc  
* http://peoplepods.net http://xoxco.com
*
* theme/content/new_comments.php
* Display a summary of the content and any new comments that were posted since
* the last time this user commented
*
* used by dashboard pod
* 
* Documentation for this pod can be found here:
* http://peoplepods.net/readme/themes
/**********************************************/
?>
<div class="content_short content_new_comments content_<? $doc->write('type'); ?> <? if ($doc->get('isOddItem')) {?>content_odd<? } ?> <? if ($doc->get('isEvenItem')) {?>content_even<? } ?> <? if ($doc->get('isLastItem')) {?>content_last<? } ?> <? if ($doc->get('isFirstItem')) {?>content_first<? } ?>" id="document_<? $doc->write('id'); ?>">	
	<? $doc->author()->output('avatar'); ?>
	<div class="column_7 last">
		<div class="content_body column_padding">
			<span class="content_meta">
				<span class="content_author"><? $doc->author()->permalink(); ?></span> posts (<span class="content_time"><? echo $doc->write('timesince'); ?></span>)
			</span>
			<h3><a href="<? $doc->write('permalink'); ?>" title="<? $doc->write('headline'); ?>"><? $doc->write('headline'); ?></a></h3>
	
			<div class="new_comments" id="new_comments_<? $doc->write('id'); ?>">
				<? $doc->goToFirstUnreadComment(); ?>
				<? $count = 0;
				   while ($comment = $doc->comments()->getNext()) { 
						$comment->output();	
						$count++;
					} ?>
			</div>			
			
			<ul class="content_options">
				<li class="option_reply"><a href="<? $doc->write('permalink'); ?>#reply">Reply</a></li>
				<li class="option_mark_as_read" id="option_mark_as_read_<? $doc->write('id'); ?>">
					<? if ($count < 1) { ?>
						<span class="gray">Nothing new. :(</span>
					<? } else { ?>
						<a href="#" onclick="return markAsRead(<? $doc->write('id'); ?>);">Mark as Read</a>
					<? } ?>
				</li>
				<li class="option_watching">
					<a href="#" id="removeWatch_<? $doc->write('id'); ?>" onclick="return removeWatch(<? $doc->write('id'); ?>);" class="stop_watching_link">Stop Tracking</a>
					<a href="#" id="addWatch_<? $doc->write('id'); ?>" onclick="return addWatch(<? $doc->write('id'); ?>);" style="display: none;"  class="start_watching_link">Start Tracking</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="clearer"></div>
</div>