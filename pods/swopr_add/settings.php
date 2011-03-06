<?

	$POD->registerPOD(
		'swopr_add',									// this is the name of the pod. it should match the folder name.
		'this is add page, it will add items to the users inventory',		// this is the description of the pod. it shows up in the command center.
		array(
			'^add$'=>'swopr_add/addController.php',		// set up the /sample url to handle requets
			'^add/(.*)'=>'swopr_add/addController.php?q=$1',	// set up the /sample/* to handle requets
		),
		array(// if this pod is enabled, value can be accessed via $POD->libOptions('sample_pod_variable');),
		dirname(__FILE__) . "/addMethods.php",				// tells PeoplePods to add custom methods included in the methods.php file
		'addSetup'									// tells PeoplePods to call sampleSetup as the setup function for this pod.
	);