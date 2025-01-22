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
$hammer->head("CPT | Sessions","<link rel=\"stylesheet\" href=\"//liszt.dev/assets/lz-master3.css\" type=\"text/css\" /><link rel=\"shortcut icon\" href=\"//liszt.me/assets/lisztfav.png\"/><script src=\"//liszt.dev/assets/lz-master3.js\"></script>");

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

<?php $actions = $hr->getByProject($_GET['guid']);
$i=0;
$actionArray = [];
    foreach($actions as $a){
        if($a['action']==="start"){
            $i++;
        }
        $actionArray[$i][]=$a;
    }

    $j=1;
	$sessTotal[$j] = 0;
	//Calc Duration
	while ($j <= $i) {
        foreach($actionArray[$j] as $a){
			$sessTotal[$j]+=$a['duration'];
		}
        $j++;
        }

    $j=1;
	$hammer->debug();
    while ($j <= $i) {
        echo "<strong>Session ".$j." - " .$sessTotal[$j]."</strong><br />";
		foreach($actionArray[$j] as $a){
			echo $a['action'] . "-" . $a['duration']." - ".$a['duration']/$sessTotal[$j]."<br />";
		}

		echo "<div class=\"progress-stacked\">";
		
		foreach($actionArray[$j] as $a){
			$pct = $a['duration']/$sessTotal[$j]*100;
			echo "<div class=\"progress\" role=\"progressbar\" aria-label=\"Segment one\" aria-valuenow=\"". $pct ."\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: ".$pct."%\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" data-bs-title=\"".$pct."\">";
    		echo "<div class=\"progress-bar\">".$a['action']."</div>";
			echo "</div>";
		}
			echo "</div>";
        // var_dump($actionArray[$j]);
        echo "<hr>";
        $j++;
    }

    // echo "<pre>";
    // print_r($actionArray);
    // echo "</pre>";
?>

</div>
</body>
</html>