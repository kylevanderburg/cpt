<?php
$buttons = [
	["action" => "start","icon" => "fa-pencil","text" => "Start Composing Session","displayClass" => "success", "category" => "meta"],
	["action" => "undo","icon" => "fa-undo","text" => "UNDO LAST ACTION","displayClass" => "warning", "category" => "meta"],
	["action" => "break","icon" => "fa-mug-hot","text" => "Break","displayClass" => "success", "category" => "meta"],
	["action" => "end","icon" => "fa-pencil-slash","text" => "End Composing Session","displayClass" => "danger", "category" => "meta"],
	["action" => "tech","icon" => "fa-laptop-medical","text" => "Debug Technology","displayClass" => "warning", "category" => "meta"],
	["action" => "listenwork","icon" => "fa-volume","text" => "Listen to Work","displayClass" => "primary", "category" => "preparation"],
	["action" => "listenresearch","icon" => "fa-turntable","text" => "Listen to Research","displayClass" => "primary", "category" => "preparation"],
	["action" => "scorestudy","icon" => "fa-book-open","text" => "Score Study","displayClass" => "primary", "category" => "preparation"],
	["action" => "improv","icon" => "fa-guitar","text" => "Improv","displayClass" => "primary", "category" => "incubation"],
	["action" => "distract","icon" => "fa-gamepad-modern","text" => "Begin Distraction","displayClass" => "primary", "category" => "incubation"],
	["action" => "concentrate","icon" => "fa-brain","text" => "Begin Concentration","displayClass" => "primary", "category" => "incubation"],
	["action" => "ideanew","icon" => "fa-lightbulb-on","text" => "Attempt New Idea","displayClass" => "primary", "category" => "illumination"],
	["action" => "ideadev","icon" => "fa-lightbulb-gear","text" => "Develop Current Idea","displayClass" => "primary", "category" => "illumination"],
	["action" => "theory","icon" => "fa-lightbulb-exclamation","text" => "Work out Theory","displayClass" => "primary", "category" => "illumination"],
	["action" => "restructure","icon" => "fa-bulldozer","text" => "Restructure","displayClass" => "primary", "category" => "illumination"],
	["action" => "ideascrap","icon" => "fa-lightbulb-slash","text" => "Scrap Current Idea","displayClass" => "primary", "category" => "illumination"],
	["action" => "orch","icon" => "fa-violin","text" => "Orchestrate","displayClass" => "primary", "category" => "finalize"],
	["action" => "format","icon" => "fa-file-dashed-line","text" => "Format","displayClass" => "primary", "category" => "finalize"],
	["action" => "scrapall","icon" => "fa-dumpster","text" => "Scrap Entire Project","displayClass" => "primary", "category" => "finalize"]
];

$buttonsxt=$buttons;
$buttonsxt[] = ["action" => "comment","icon" => "fa-comment","text" => "Comment","displayClass" => "primary", "category" => "finalize"];
$buttonsxt[] = ["action" => "confidence","icon" => "fa-comment","text" => "Confidence Level","displayClass" => "primary", "category" => "finalize"];

$stages = ["meta","preparation","incubation","illumination","finalize"];
?>