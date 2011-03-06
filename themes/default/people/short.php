<?php
/***********************************************
* This file is part of PeoplePods
* (c) xoxco, inc  
* http://peoplepods.net http://xoxco.com
*
* theme/people/short.php
* Default tempalte for short output of person object
* Used to create lists of people
*
* Documentation for this pod can be found here:
* http://peoplepods.net/readme/person-object
/**********************************************/
?>
<div class="person_short">
	
	<? if ($img = $user->files()->contains('file_name','img')) { ?>
		<a href="<? $user->write('permalink'); ?>"><img src="<? $img->write('thumbnail'); ?>" border="0" align="absmiddle" /></a>
	<? } else { ?>
		<a href="<? $user->write('permalink'); ?>"><img src="<? $user->POD->templateDir(); ?>/img/noimage.png" border="0" align="absmiddle" /></a>
	<? } ?>	

	<? $user->permalink(); ?>
	<? if ($POD->isAuthenticated()) { ?>
		<a href="#" id="removeFriend_<? $user->write('id'); ?>" <? if ($POD->currentUser()->isFriendsWith($user)) { ?>style="display: block;"<? } else { ?>style="display: none;"<? } ?> onclick="return removeFriend(<? $user->write('id'); ?>);" class="person_short_follow_button person_short_follow_button_stop">Stop Following</a>
		<a href="#" id="addFriend_<? $user->write('id'); ?>" <? if (!$POD->currentUser()->isFriendsWith($user)) { ?>style="display: block;"<? } else { ?>style="display: none;"<? } ?> onclick="return addFriend(<? $user->write('id'); ?>);" class="person_short_follow_button person_short_follow_button_start">Follow</a>
	<? } ?>

</div>
