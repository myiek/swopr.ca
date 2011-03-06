<div class="column_padding sidebar" id="tag_cloud_sidebar">
<? 
	$tags = $POD->getTagCount();
	
	while ($tag = $tags->getNext()) { 
	
		$tag->output('tag.cloud');
	}

?>
</div>