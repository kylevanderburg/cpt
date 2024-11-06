<?php
/*
NoteForge Hammer | Kyle Vanderburg CPT
	by Kyle Vanderburg, in Poplar Bluff, Springfield, Norman, and Fargo.
	All code copyright Kyle Vanderburg
*/

//CPT is built on Hammer. Let's set some options.
$options = [
	'vanguard'=>TRUE, //Require Login
	"seths"=>1, //Hard-code HammerSite
	"vanguardAccess"=>"A", //User-level access
	//"vanguardLogin"=>"", //Special Login Screen
	"vanguardMessage"=>"kdv", //Login Message
	//"vanguardLoginURL"=>"https://vanguard.kylevanderburg.net/" //Use a different login endpoint than Liszt
	];
	
//Load the Vanilla Hammer core, Set HammerSite, HammerDirectory, and parse the URL
require "/var/www/api.ntfg.net/htdocs/hammer/vanilla.php";
$hammer->setHS(1); $hammer->setHD("/");
$hammer->clientUrlParse();

//Exceptional code for user restriction
if($hammer->user['id']!=1){$hammer->prohibited('KV');die();}

//Declare the project variable and load it from the database
$comp = new vio_comp_project($hammer);
$comprow = $comp->getByGUID($_GET['guid']);

$hr = new vio_comp_action($hammer);

//Error Handling
if(isset($_GET['e'])){ini_set('display_errors',1); error_reporting(E_ALL);$hammer->debug();}

//Write <head> to the page
$hammer->head("CPT | Transcript","<link rel=\"stylesheet\" href=\"//liszt.dev/assets/lz-master3.css\" type=\"text/css\" /><link rel=\"shortcut icon\" href=\"//liszt.me/assets/lisztfav.png\"/><script src=\"//liszt.dev/assets/lz-master3.js\"></script>");

//Secondary exceptional code for user restriction.
if(($hammer->getHS()=="1") && ($hammer->getUserRole()<7)){echo "<div class=\"text-center\"><img src=\"//cdn.ntfg.net/images/hammer/delete.png\" /></div><h1 class=\"text-center\">You are not authorized to view this page.";die();}else{}

//Load Standards
include "cpt-standards.php";

//Debug line
// $hammer->debug();
?>
<body>
<nav class="navbar navbar-expand-lg navbar-dark d-print-none" id="ntfgnav" role="navigation" style="background-color:#000;">
	<div class="container">
		<a class="navbar-brand" href="/"><img src="/kvcpt.png" class="" alt="CPT" border="0" style="" /></a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-content" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbar-content">
			<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
			<li class="nav-item"><a class="nav-link<?php if(!empty($hammer->location[0])){if($hammer->location[0]=="projects"){echo " active";}}?>" aria-current="page" href="/projects/">Projects</a></li>
			</ul>
		</div><!-- nav-collapse -->
	</div><!-- contianer --> 
</nav><!--navbar-->
<div class="container">
<center><strong>Composition Process Tracker | <?php echo $comprow['title'] . " | " . $comprow['inst'] . " | " . $comprow['duedate']; ?></strong></center>
<?php

$hr->calcDurations($_GET['guid']);
$timetotal=0;
$actiontotal=0;
$actionarray=[];
$timearray=[];
foreach($hr->getByProject($_GET['guid']) as $a){
	if($a['duration']){
		$timetotal+=$a['duration'];
		$timearray[$a['action']]+=$a['duration'];
		$actionarray[$a['action']]++;
		$actiontotal++;
	}
}
$firstlast = $hr->firstLast($_GET['guid']);
$datetime1 = new DateTime($firstlast[1]['created_time']); // start time
$datetime2 = new DateTime($firstlast[0]['created_time']); // end time
$elapsed = $datetime1->format('U') - $datetime2->format('U');
					
echo "First Action: <strong>".$firstlast[0]['created_time']."</strong>, Latest Action: <strong>".$firstlast[1]['created_time']."</strong><br />";
echo "Elapsed Time: <strong>".sprintf('%02d:%02d:%02d', ($elapsed/3600),($elapsed/60%60), $elapsed%60)."</strong><br />";
echo "Recorded Time: <strong>".sprintf('%02d:%02d:%02d', ($timetotal/3600),($timetotal/60%60), $timetotal%60)."</strong><br />";
echo "Composing Ratio: <strong>".round(($timetotal/$elapsed)*100,2)."%</strong>";

echo "<br />";
echo "<table class=\"table\"><thead><th>Action</th><th>Activations</th><th>Duration</th><th>Percentage</th></thead><tbody>";
foreach($buttons as $b){
	$total = round(($timearray[$b['action']]/$timetotal)*100,2);
	echo "<tr><td>".$b['text']."</td><td>".$actionarray[$b['action']]."</td><td>".sprintf('%02d:%02d:%02d', ($timearray[$b['action']]/3600),($timearray[$b['action']]/60%60), $timearray[$b['action']]%60)."</td><td>".$total."%</td></tr>";
}
echo "</tbody></table>";
// var_dump($timearray);
$actionseconds = round($timetotal/$actiontotal,6);
echo $actiontotal . " total actions, with an average duration of ".$actionseconds." seconds (".sprintf('%02d:%02d:%02d', ($actionseconds/3600),($actionseconds/60%60), $actionseconds%60).")";

?>
</div>
</body>
</html>