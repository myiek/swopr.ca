<?php
/***********************************************
* This file is part of PeoplePods
* (c) xoxco, inc  
* http://peoplepods.net http://xoxco.com
*
* theme/content/editform.php
* Default content add/edit form used by the core_usercontent module
* Customizing the fields in this form will alter the information stored!
* Use this file as the basis for new content type forms
*
* Documentation for this pod can be found here:
* http://peoplepods.net/readme/new-content-type
/**********************************************/

	require_once("../../_include/amazon.php");

?>
<div id="editform">
	
	<form action="" method="get" accept-charset="utf-8">		
		<label>Type an ISBN and click the button to get the information</label>
		<input type="text" name="query" />
		<input type="submit" value="Continue &rarr;">
	</form>
	
	<?
		//the query item is on amazon
		if(isset($_GET['query'])){

			$Amazon = new Amazon();

			$txtbookParam=array(
				"region"=>"com",
				"AssociateTag"=>'affiliateTag',
				"Operation"=>"ItemSearch",
				"ResponseGroup"=>'Images,ItemAttributes',
				"SearchIndex"=>"Books",
				"Keywords"=>$_GET['query']
			);

			$txtBookUrl=$Amazon->getSignedUrl($txtbookParam);
			$txtbook=simplexml_load_file($txtBookUrl);

			if($txtbook->Items->TotalResults > 0){
				// we have at least one response			
				foreach($txtbook->Items->Item as $book){ 
					$src = $book->SmallImage->URL;
					$alt = "No Image";
					$title = $book->ItemAttributes->Title;
					$author = $book->ItemAttributes->Author;			
					?>

					<form class="valid" action="<? $doc->write('editpath'); ?>" method="post"
						id="post_something" enctype="multipart/form-data">
						
						<!-- thumbnail of the book -->
						<div class="person_avatar">
							<img src= "<? echo $src; ?> " alt= "<? echo $alt; ?>"/>
						</div>
						
						<!-- labels for each book -->
						<label>Title: <?echo $title ?> </label><br>
						<label>Author: <?echo $author ?> </label><br>

						<input type="hidden" name="headline" value="<? echo $title; ?>" />
						<input type="hidden" name="meta_author" value="<? echo $author; ?>" />
						<input type="hidden" name="meta_imageLink" value="<? echo $src; ?>" />
						
						<!-- invisible fields -->
						<? if ($doc->get('id')) { ?>
								<input type="hidden" name="id" value="<? $doc->write('id'); ?>" />
								<input type="hidden" name="redirect" value="<? $doc->write('permalink'); ?>" />
						<? } else if ($doc->get('groupId')) { ?>
								<input type="hidden" name="redirect" value="<? $this->group()->write('permalink'); ?>" />
						<? } ?>
						<? if ($doc->get('groupId')) { ?>
								<input type="hidden" name="groupId" value="<? $doc->write('groupId'); ?>" />		
						<? } ?>

						<? if ($doc->get('type')) { ?>
								<input type="hidden" name="type" value="<? $doc->write('type'); ?>" />		
						<? } ?>
						
						<p><input type="submit" id="textbook_form_save" value="Continue &rarr;"></p>
					</form>

				<?}

			} else {
				// no response
				echo "<label>Item cannot be found in the database</label>";
			}		
		}	
	?>	
	
</div>		

<script type="text/javascript">
	// display the appropriate fields in the edit form.
	<? if ($doc->get('video')) { ?>
		togglePostOption('video');
	<? } ?>
	<? if ($doc->get('body')) { ?>
		togglePostOption('body');
	<? } ?>
	<? if ($doc->get('link')) { ?>
		togglePostOption('link');
	<? } ?>
	<? if ($doc->get('id') && $doc->files()->contains('file_name','img')) { ?>
		togglePostOption('photo');
	<? } ?>
	<? if ($doc->get('id') && $doc->tags()->count() > 0) { ?>
		togglePostOption('tags');
	<? } ?>
	<? if ($doc->get('option1')) { ?>
		togglePostOption('poll');
	<? } ?> 

</script>