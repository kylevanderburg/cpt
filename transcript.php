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

$hr->calcDurations($_GET['guid']);

//Debug line
// $hammer->debug();
?>
<body>
<div class="container-fluid">
	<?php
	echo "<ul class=\"milestones milestones-bordered-bottom\">";
	echo "<li><i class=\"milestone\"></i> <h6>Transcript of <u>".$comprow['title']."</u></h6></li>";
	
	foreach($hr->getByProjectReverse($_GET['guid']) as $a){
		$key = array_search($a['action'], array_column($buttonsxt, 'action'));
		// var_dump($a);
		echo "<li>";
		echo "<i class=\"fa fa-light milestone-".$buttonsxt[$key]['displayClass']." ".$buttonsxt[$key]['icon']."\"></i>";
		echo "<div class=\"card ".$displayClass."\">";
		echo "<div class=\"card-header\">";
		echo $buttonsxt[$key]['text'];
		echo "</div>";
		
		echo "<div class=\"card-body\" id=\"".$a['guid']."-card\">";
		$time = $hammer->u2l($a['created_time']);
		echo "<code style=\"color:#777;\">" . $time->format('Y-m-d H:i:s') . "</code>";
		// $duration = $hammer->splittime($a['duration']);
		if($a['duration']){echo "<br /><code style=\"color:#777;\">".sprintf('%02d:%02d:%02d', ($a['duration']/3600),($a['duration']/60%60), $a['duration']%60)."</code>";}
		
		if($a['extended']){echo "<br />".$a['extended'];}
		echo "</div>";
		echo "</li>";
	}
	echo "</ul>";
	
	?>

</div><!--container-fluid-->
</body>
</html>