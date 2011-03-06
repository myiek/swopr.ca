<?php
/***********************************************
* This file is part of PeoplePods
* (c) xoxco, inc  
* http://peoplepods.net http://xoxco.com
*
* theme/messages/thread.php
* Default output template for a thread page
*
*
* Documentation for this pod can be found here:
* http://peoplepods.net/readme/messaging
/**********************************************/
?>
<div class="column_7" id="thread">
	<h1 class="column_padding"><a href="<? $thread->POD->siteRoot(); ?>/inbox">Inbox</a> &#187; Conversation with <? $thread->recipient()->permalink(); ?></h1>
	<div class="message">
		<div class="column_1">
			&nbsp;
		</div>
		<div class="column_6 last">
			<form method="post" action="<? $thread->write('permalink'); ?>" class="valid column_padding" id="send_message">
				<input name="thread" type="hidden" value="<? $thread->write('id'); ?>" />
				<textarea name="message" id="message" class="required"></textarea>	
				<input type="Submit" value="Send" />
			</form>
		</div>
		<div class="clearer"></div>
	</div>
	<? $thread->messages()->output('message','header','pager',null,'Write the first message, and it will appear here.'); ?>
</div>
<div class="column_3">
	<? $thread->recipient()->output('member_info'); ?>
	<h3 style="text-align:center;">vs</h3>
	<? $POD->currentUser()->output('member_info'); ?>
	<div class="column_padding">
		<a href="?clear=<? $thread->write('id'); ?>" onclick="return confirm('Clearing this conversation will delete all the messages so far.  Do you really want to delete these messages?');">Clear this conversation</a>
	</div>
</div>