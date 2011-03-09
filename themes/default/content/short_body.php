<?php
/***********************************************
* This file is part of PeoplePods
* (c) xoxco, inc  
* http://peoplepods.net http://xoxco.com
*
* theme/content/short_body.php
* Defines the body output as included by short.php
*
* Documentation for this pod can be found here:
* http://peoplepods.net/readme/themes
/**********************************************/
?>
		<div class="column_7 last">
			<div class="content_body column_padding">
				<span class="content_meta">
					<span class="content_author"><? $doc->author()->permalink(); ?></span> listed (<span class="content_time"><? echo $doc->write('timesince'); ?></span>)
				</span>
				<h3><a href="<? $doc->write('permalink'); ?>" title="<? $doc->write('headline'); ?>"><? $doc->write('headline'); ?></a></h3>
				<? if ($doc->get('video')) {
					if ($embed = $POD->GetVideoEmbedCode($doc->get('video'),520,400,'true','always')) { 
						echo $embed; 
					} else { ?>
						<p>Watch Video: <a href="<? $doc->write('video'); ?>"><? $doc->write('video'); ?></a></p>
					<? }
				} ?>	

				<? if ($img = $doc->files()->contains('file_name','img')) { ?>
					<p class="content_image"><a href="<? $doc->write('permalink'); ?>"><img src="<? $img->write('thumbnail') ?>" border="0" /></a></p>
				<? } ?>			


				<? if ($doc->get('link')) { ?>
					<p>View Link: <a href="<? $doc->write('link'); ?>"><? $doc->write('link'); ?></a></p>
				<? } ?>		

				<? if ($doc->get('body')) { 
					$doc->writeFormatted('body');
				} ?>
				<div class="clearer"></div>

				<ul class="content_options">
					<li class="comments_option">
						<a href="<? $doc->write('permalink'); ?>"><?  if ($doc->comments()->totalCount() > 0) {  echo $doc->comments()->totalCount() . " comments"; } else { echo "No comments"; } ?></a>
					</li>
					<? if ($doc->POD->isAuthenticated()) { ?>
						<li class="watching_option">
							<? if ($doc->POD->currentUser()->isWatched($doc)) { ?>
								<a href="#" id="removeWatch_<? $doc->write('id'); ?>" onclick="return removeWatch(<? $doc->write('id'); ?>);" class="stop_watching_link">Stop Tracking</a>
								<a href="#" id="addWatch_<? $doc->write('id'); ?>" onclick="return addWatch(<? $doc->write('id'); ?>);" style="display: none;" class="start_watching_link">Start Tracking</a>
							<? } else { ?>
								<a href="#" id="removeWatch_<? $doc->write('id'); ?>" onclick="return removeWatch(<? $doc->write('id'); ?>);"  style="display: none;" class="stop_watching_link">Stop Tracking</a>
								<a href="#" id="addWatch_<? $doc->write('id'); ?>" onclick="return addWatch(<? $doc->write('id'); ?>);" class="start_watching_link">Start Tracking</a>				
							<? } ?>
						</li>
					<? } ?>				
					<? if ($doc->get('privacy')=="friends_only") { ?>
						<li class="friends_only_option">Friends Only</li>
					<? } else if ($doc->get('privacy')=="group_only") { ?>
						<li class="group_only_option">Group Members Only</li>
					<? } else if ($doc->get('privacy')=="owner_only") { ?>
						<li class="owner_only_option">Only you can see this.</li>
					<? } ?>
					<? if ($doc->isEditable()) { ?>
						<li class="delete_option">
							<a href="#" onclick="return deleteDocument(<? $doc->write('id'); ?>);">Delete</a>
						</li>
					<? } ?>
				</ul>
			</div>
		</div>
