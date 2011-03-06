<?

	// this pod creates static pages
	include_once("content_type.php"); // this defines some variables for use within this pod

	$POD->registerPOD(
		"core_pages",											// name
		"Create static pages",									// description
		array("^{$permalink}/(.*)"=> $pod_dir . '/view.php?stub=$1'),	// rewrite rules
		array("{$content_type}_document_path"=>$permalink,
			"page_document_editpath"=>'peoplepods/admin/content/'	
		)		// global variables
	);

?>