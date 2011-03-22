<?php
/***********************************************
* This file is part of PeoplePods used for custom shortlist outputs
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
