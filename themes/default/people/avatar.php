<?php
/***********************************************
* This file is part of PeoplePods
* (c) xoxco, inc  
* http://peoplepods.net http://xoxco.com
*
* theme/people/avatar.php
* Default avatar template for a person
* Used in various places where only the user's picture is needed
*
*
* Documentation for this pod can be found here:
* http://peoplepods.net/readme/person-object
/**********************************************/
?>
<div class="person_avatar">
	<div class="column_padding" >
		<? if ($img = $user->files()->contains('file_name','img')) { ?>
			<a href="<? $user->write('permalink'); ?>"><img src="<? $img->write('thumbnail'); ?>" border="0" /></a>
		<? } else { ?>
			<a href="<? $user->write('permalink'); ?>"><img src="<? $user->POD->templateDir(); ?>/img/noimage.png" border="0" /></a>
		<? } ?>	
	</div>
</div>
