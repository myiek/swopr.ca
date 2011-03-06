		<div id="searchoptions" style="display: none;">
			<form method="get" action="<? $POD->podRoot(); ?>/admin/content/search.php">
			<input type="hidden" name="type" value="<? if (isset($_GET['type'])) { echo $_GET['type']; } ?>" />
			<div class="column_3">
				<div class="column_padding">
					<input type="text"  value="Search" onfocus="if(this.value=='Search') { this.value=''; };" class="text" name="q" />
				</div>
			</div>
			<div class="column_3">
				<div class="column_padding">
					 Tag: <input name="tag" id="tag" value="" >
					<div id="tag_complete" class="autocomplete"></div>
				</div>
			</div>
			<div class="column_3">
				<div class="column_padding">
					<select name="status"><option value="">Any</option><option value="new">New (Unmoderated)</option><option value="approved">Approved</option><option value="featured">Featured</option></select>	
				</div>
			</div>	
			<div class="column_1 last">
				<div class="column_padding">
					<input type="submit" value="Search" />
				</div>
			</div>	
			</form>
			<div class="clearer"></div>
			<script type="text/javascript" >
				new Ajax.Autocompleter("tag", "tag_complete", "tagAutocomplete.php", {});	
			</script>	
		</div>

		
		<table class="stack_output <? if ($title) {?>stack_<?  echo $POD->tokenize($title); } ?>" cellspacing="0" cellpadding="0" border="0">
			<tr>
				<th align="left">Headline</th>
				<th align="left">Author</th>
				<th align="left">Comments</th>
				<th align="left">Date</th>
				<th align="left">Status</th>
			</tr>