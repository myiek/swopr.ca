<?php
/***********************************************
* This file is part of PeoplePods
* (c) xoxco, inc  
* http://peoplepods.net http://xoxco.com
*
* theme/content/output.php
* Default output template for a piece of content
* Use this file as a basis for your custom content templates
*
* Documentation for this pod can be found here:
* http://peoplepods.net/readme/themes
/**********************************************/
?>
<div class="column_8">
	<div id="post_output">
			<h1><a href="<? $doc->write('permalink'); ?>" title="<? $doc->write('headline'); ?>"><? $doc->write('headline'); ?></a></h1>
			<? if ($POD->isAuthenticated()) {  ?>
				<ul class="post_actions">

				
					<?	if ($POD->currentUser()->isFavorite($doc)) { ?>
						<li>
							<a href="#" id="removeFavorite_<? $doc->write('id'); ?>" onclick="return removeFavorite(<? $doc->write('id'); ?>);" title="Remove from Favorites" class="favorite_button active_button">Fave</a>
							<a href="#" id="addFavorite_<? $doc->write('id'); ?>" onclick="return addFavorite(<? $doc->write('id'); ?>);"  title="Add to Favorites" class="favorite_button" style="display: none;">Fave</a>
						</li>
					<? } else { ?>
						<li>
							<a href="#" id="removeFavorite_<? $doc->write('id'); ?>" onclick="return removeFavorite(<? $doc->write('id'); ?>);" title="Remove from Favorites" class="favorite_button active_button" style="display: none;">Fave</a>
							<a href="#" id="addFavorite_<? $doc->write('id'); ?>" onclick="return addFavorite(<? $doc->write('id'); ?>);" title="Add to Favorites" class="favorite_button">Fave</a>				
						</li>
					<? } ?>			
					<?	if ($POD->currentUser()->isWatched($doc)) { ?>
						<li>
							<a href="#" id="removeWatch_<? $doc->write('id'); ?>" onclick="return removeWatch(<? $doc->write('id'); ?>);" title="Stop tracking new comments" class="watch_button active_button">Track</a>
							<a href="#" id="addWatch_<? $doc->write('id'); ?>" onclick="return addWatch(<? $doc->write('id'); ?>);" title="Track new comments" class="watch_button" style="display: none;">Track</a>
						</li>
					<? } else { ?>
						<li>
							<a href="#" id="removeWatch_<? $doc->write('id'); ?>" onclick="return removeWatch(<? $doc->write('id'); ?>);"  title="Stop tracking new comments" class="watch_button active_button" style="display: none;">Track</a>
							<a href="#" id="addWatch_<? $doc->write('id'); ?>" onclick="return addWatch(<? $doc->write('id'); ?>);" title="Track new comments"  class="watch_button">Track</a>				
						</li>
					<? } ?>
					<? if ($doc->isEditable()) { ?>
						<li>
							<a href="<? $doc->write('editlink'); ?>" title="Edit this post" class="edit_button">Edit</a>
						</li>
					<? } ?>
					<? if ($doc->get('privacy')=="friends_only") { ?>
						<li class="friends_only_option">Friends Only</li>
					<? } else if ($doc->get('privacy')=="group_only") { ?>
						<li class="group_only_option">Group Members Only</li>
					<? } else if ($doc->get('privacy')=="owner_only") { ?>
						<li class="owner_only_option">Only you can see this.</li>
					<? } ?>
				</ul>
			<? } ?>
			
			<? if ($doc->get('link')) { ?>
				<p>View Link: <a href="<? $doc->write('link'); ?>"><? $doc->write('link'); ?></a></p>
			<? } ?>		

			<? if ($doc->get('video')) {
				if ($embed = $POD->GetVideoEmbedCode($doc->get('video'),600,460,'true','always')) { 
					echo $embed; 
				} else { ?>
					<p>Watch Video: <a href="<? $doc->write('video'); ?>"><? $doc->write('video'); ?></a></p>
				<? }
			} ?>
			<? if ($img = $doc->files()->contains('file_name','img')) { ?>
				<p class="post_image"><img src="<? $img->write('resized'); ?>" /></p>
			<? } ?>	
			<? if ($doc->get('body')) { 
				$doc->write('body');
			} ?>
						
			<? if ($doc->tags()->count() > 0){ ?>
				<p>
					<img src="<? $POD->templateDir(); ?>/img/tag_pink.png" alt="Tags" align="absmiddle" />
					<? $doc->tags()->output('tag',null,null); ?>
				</p>
			<? } ?>	
	</div>	
	<div id="comments">
		<!-- COMMENTS -->	
		<? 
		   	while ($comment = $doc->comments()->getNext()) { 
				$comment->output();	
			} 
		?>
		<!-- END COMMENTS -->
	</div>	
	<? if ($this->POD->isAuthenticated()) { ?>
		<div id="comment_form">
			<a name="reply"></a>
			<div class="column_1">
				<div class="column_padding" style="font-size: 18px; font-weight: bold; text-align: center;" id="spinner">
					FEED BACK
				</div>
			</div>
			<div class="column_6 last">
				<form method="post" id="add_comment" onsubmit="return addComment(<? $doc->write('id'); ?>,$('#comment').val());">
					<textarea name="comment" id="comment"></textarea>	
					<input type="submit" value="Post" />
				</form>
			</div>
			<div class="clearer"></div>		
			<script type="text/javascript">
				getComments(<? $doc->write('id'); ?>);
			</script>
		</div>
	<? } ?>	
</div>

<div class="column_4 last" id="post_info">

	<? $doc->author()->output('member_info'); ?>
	
	<div id="post_stream_navigation">
		<p id="post_date">
			Posted on <? echo date_format(date_create($doc->get('date')),'l, M jS'); ?>
			(<? $doc->write('timesince'); ?>)
		</p>	

		<?
			$previous = $POD->getContents(array('userId'=>$doc->author('id'),'id:lt'=>$doc->get('id')),'d.id DESC',1);
			if ($previous->success() && $previous->count() > 0) { 
				$previous = $previous->getNext();
				?>
				<a href="<? $previous->write('permalink');?>" class="post_previous"><strong>&#171;&nbsp;Previous</strong>&nbsp;&nbsp;&nbsp;<? echo $POD->shorten($previous->get('headline'),100); ?></a>
		<? } 				

			$next = $POD->getContents(array('userId'=>$doc->author('id'),'id:gt'=>$doc->get('id')),'d.id ASC',1);	
			if ($next->success() && $next->count() > 0) {
				$next = $next->getNext(); 
			?>
				<a href="<? $next->write('permalink');?>" class="post_next"><strong>&#187;&nbsp;Next</strong>&nbsp;&nbsp;&nbsp;<?  echo $POD->shorten($next->get('headline'),80); ?></a>
		<? }  else { ?>
			<strong>&#187;&nbsp;Next</strong>&nbsp;&nbsp;&nbsp;This is <? echo $doc->author('nick'); ?>'s most recent post
		<? } ?>
	</div>

	<? if ($doc->group()) {
		if ($POD->isAuthenticated()) {
			$member = $doc->group()->isMember($POD->currentUser());
		}

		?>
		<div class="column_padding" id="post_group_navigation">
			<p>This is part of <? $doc->group()->permalink(); ?>.</p>

			<?
				$previous = $POD->getContents(array('groupId'=>$doc->group('id'),'id:lt'=>$doc->get('id')),'d.id DESC',1);
				if ($previous->success() && $previous->count() > 0) { 
					$previous = $previous->getNext();
					?>
					<a href="<? $previous->write('permalink');?>"  class="post_previous"><strong>&#171;&nbsp;Previous</strong>&nbsp;&nbsp;&nbsp;<? echo $POD->shorten($previous->get('headline'),100); ?></a>
			<? } ?>
			<?
				$next = $POD->getContents(array('groupId'=>$doc->group('id'),'id:gt'=>$doc->get('id')),'d.id ASC',1);	
				if ($next->success() && $next->count() > 0) {
					$next = $next->getNext(); 
				?>
					<a href="<? $next->write('permalink');?>" class="post_next"><strong>&#187;&nbsp;Next</strong>&nbsp;&nbsp;&nbsp;<?  echo $POD->shorten($next->get('headline'),80); ?></a>
			<? }  else { ?>
				<strong>&#187;&nbsp;Next</strong>&nbsp;&nbsp;&nbsp;This is the most recent post in <? $doc->group()->write('groupname'); ?>.
			<? } ?>
	

			<? if ($member == "manager" || $member=="owner") { ?>
				<p class="highlight">
					<strong>You are a manager of this group.</strong><br />
					<a href="<? $doc->group()->write('permalink'); ?>/remove?docId=<? $doc->write('id'); ?>">Remove this post from the group</a></p>
			<? } ?>
		</div>
	<? } ?>
	
			
	<div id="watchers">
			<?  
				$watching = $POD->getPeopleByWatching($doc); 
				if ($watching->totalCount() > 0) {
					$watching->output('short','header','footer',$watching->totalCount() . $POD->pluralize($watching->totalCount(),' Person Tracking',' People Tracking')); 
				}
			?>
	</div>

</div>


