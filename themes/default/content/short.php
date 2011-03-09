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
		<!-- <? $doc->author()->output('avatar'); ?> -->
		<div class="person_avatar">
			<div class="column_padding" >
				<img src = " <? $doc->write('imageLink') ?>" alt="no image"/>
			</div>
		</div>
		<? $doc->output('short_body'); ?>
		<div class="clearer"></div>
	</div>
