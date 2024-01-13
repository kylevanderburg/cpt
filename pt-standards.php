<?php
	$stages = [
		["name" => "meta", "buttons" => 
			[
				["action" => "start","icon" => "fa-pencil","text" => "Start Composing Session","displayClass" => "btn-success"],
				["action" => "undo","icon" => "fa-undo","text" => "UNDO LAST ACTION","displayClass" => "btn-warning"],
				["action" => "end","icon" => "fa-pencil-slash","text" => "End Composing Session","displayClass" => "btn-danger"]
			]
		],
		["name" => "preparation", "buttons" => 
			[
				["action" => "listenwork","icon" => "fa-volume","text" => "Listen to Work","displayClass" => "btn-primary"],
				["action" => "listenresearch","icon" => "fa-turntable","text" => "Listen to Research","displayClass" => "btn-primary"],
				["action" => "scorestudy","icon" => "fa-book-open","text" => "Score Study","displayClass" => "btn-primary"]
			]
		],
		["name" => "incubation", "buttons" => 
			[
				["action" => "improv","icon" => "fa-guitar","text" => "Improv","displayClass" => "btn-primary"],
				["action" => "distract","icon" => "fa-gamepad-modern","text" => "Begin Distraction","displayClass" => "btn-primary"],
				["action" => "concentrate","icon" => "fa-brain","text" => "Begin Concentration","displayClass" => "btn-primary"]
			]
		],
		["name" => "illumination", "buttons" => 
			[
				["action" => "ideanew","icon" => "fa-lightbulb-on","text" => "Attempt New Idea","displayClass" => "btn-primary"],
				["action" => "ideadev","icon" => "fa-lightbulb-gear","text" => "Develop Current Idea","displayClass" => "btn-primary"],
				["action" => "ideascrap","icon" => "fa-lightbulb-slash","text" => "Scrap Current Idea","displayClass" => "btn-primary"]
			]
		],
		["name" => "finalize", "buttons" => 
			[
				["action" => "orch","icon" => "fa-violin","text" => "Orchestrate","displayClass" => "btn-primary"],
				["action" => "format","icon" => "fa-file-dashed-line","text" => "Format","displayClass" => "btn-primary"],
				["action" => "scrapall","icon" => "fa-dumpster","text" => "Scrap Entire Project","displayClass" => "btn-primary"]
			]
		]
	]
?>