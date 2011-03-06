<?

	
	// return an array of variables that should be captured in the settings screen
	function sampleSetup() {
		return array(
			'sampleSetting1'=>'Setting 1',
			'sampleSetting2'=>'Setting 2',
		);
	}

	function sampleContentMethod($content) { 
		echo 'This is output from $sampleContentMethod() called on a piece of content with the title "' . $content->headline . '"';
	}

	function samplePersonMethod($person) { 
		echo "samplePersonMethod() called on " . $person->nick;	
	}
	
		
	Content::registerMethod('sampleContentMethod');
	Person::registerMethod('samplePersonMethod');
	
