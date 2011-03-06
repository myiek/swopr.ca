<? $recent = $POD->getPeople(array('1'=>'1'),'u.lastVisit DESC',5); ?>
<div class="sidebar column_padding" id="recent_visitors_sidebar">
	<h3>Recent Visitors</h3>
	<? $recent->output('list_item','ul_header','ul_footer'); ?>
</div>