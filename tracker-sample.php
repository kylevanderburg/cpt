<?php
/*
NoteForge Hammer | Kyle Vanderburg CPT
	by Kyle Vanderburg, in Poplar Bluff, Springfield, Norman, and Fargo.
	All code copyright Kyle Vanderburg
*/

//CPT is built on Hammer. Let's set some options.
	
//Load the Vanilla Hammer core, Set HammerSite, HammerDirectory, and parse the URL
require "/var/www/api.ntfg.net/htdocs/hammer/vanilla.php";
$hammer->setHS(1); $hammer->setHD("/");
$hammer->clientUrlParse();

//Declare the project variable and load it from the database
$comp = new vio_comp_project($hammer);
$comprow = $comp->getByGUID($_GET['guid']);

//Error Handling
if(isset($_GET['e'])){ini_set('display_errors',1); error_reporting(E_ALL);$hammer->debug();}

//Write <head> to the page
$hammer->head("ScoreMod | Tracker","<link rel=\"stylesheet\" href=\"//liszt.dev/assets/lz-master3.css\" type=\"text/css\" /><link rel=\"shortcut icon\" href=\"//liszt.me/assets/lisztfav.png\"/><script src=\"//liszt.dev/assets/lz-master3.js\"></script>");

//Load Standards
$buttons = [
	["action" => "start","icon" => "","text" => "Action","displayClass" => "success", "category" => "meta"],
	["action" => "start","icon" => "","text" => "Action","displayClass" => "success", "category" => "meta"],
	["action" => "start","icon" => "","text" => "Action","displayClass" => "success", "category" => "meta"],
	["action" => "start","icon" => "","text" => "Action","displayClass" => "success", "category" => "preparation"],
	["action" => "start","icon" => "","text" => "Action","displayClass" => "success", "category" => "preparation"],
	["action" => "start","icon" => "","text" => "Action","displayClass" => "success", "category" => "preparation"],
	["action" => "start","icon" => "","text" => "Action","displayClass" => "success", "category" => "incubation"],
	["action" => "start","icon" => "","text" => "Action","displayClass" => "success", "category" => "incubation"],
	["action" => "start","icon" => "","text" => "Action","displayClass" => "success", "category" => "incubation"],
	["action" => "start","icon" => "","text" => "Action","displayClass" => "success", "category" => "illumination"],
	["action" => "start","icon" => "","text" => "Action","displayClass" => "success", "category" => "illumination"],
	["action" => "start","icon" => "","text" => "Action","displayClass" => "success", "category" => "illumination"],
	["action" => "start","icon" => "","text" => "Action","displayClass" => "success", "category" => "finalize"],
	["action" => "start","icon" => "","text" => "Action","displayClass" => "success", "category" => "finalize"],
	["action" => "start","icon" => "","text" => "Action","displayClass" => "success", "category" => "finalize"],
];

$buttonsxt=$buttons;
$buttonsxt[] = ["action" => "comment","icon" => "fa-comment","text" => "Comment","displayClass" => "primary", "category" => "finalize"];
$buttonsxt[] = ["action" => "confidence","icon" => "fa-comment","text" => "Confidence Level","displayClass" => "primary", "category" => "finalize"];

$stages = ["meta","preparation","incubation","illumination","finalize"];

//Declare function for writing buttons
function button($action,$icon,$title,$class){
	echo "<span class=\"d-grid\"><button type=\"button\" class=\"btn btn-lg mb-2 cpt-action btn-".$class."\" data-action=\"".$action."\"><i class=\"fa-light ".$icon."\"></i> ".$title."</button></span>";
}

//Declare function for writing groups of buttons
function showButtons($category,$buttons){
	foreach($buttons as $button){
		switch ($button['category']){
			case $category:
				echo "<div class=\"col-md-4\">";
				echo button($button['action'],$button['icon'],$button['text'],$button['displayClass'])."</div>";
			break;
		}
	}
}

//Declare function for writing stages
function stage($stage,$buttons){
	echo "<strong>".ucwords($stage)."</strong>";
	echo "<div class=\"row\">";
	showButtons($stage,$buttons);
	echo "</div>";
	echo "<hr>";
}
?>
<body>
<div class="container-fluid">

	<center><strong>CPT | <em>Title of Work</em> | Instrumentation | Due Date</strong></center>
	<?php
	foreach($stages as $stage){
		stage($stage,$buttons);
	}
	?>
	<div class="row">
		<div class="col-md-9">
			<label for="fall"><strong>Confidence</strong></label><input type="range" class="form-range" min="1" max="100" step="1" id="confidencerange">		
		</div><!--col-md-9-->
		<div class="col-md-3"><span class="d-grid"><button type="button" class="btn btn-success btn-lg d-block cpt-confidence" data-action="confidence">Log Confidence</button></span></div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-9">
			<?php $hr=new vio_comp_action($hammer);
			$hr->textinput("Comment","Comment");
			?>
		</div><!--col-md-4-->
		<div class="col-md-3"><br /><span class="d-grid"><button type="button" class="btn btn-success btn-lg cpt-comment" data-action="comment">Log Comment</button></span></div>
	</div>
	<hr>
</div>
</body>