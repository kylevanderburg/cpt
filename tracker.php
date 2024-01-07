<?php
/*
NoteForge Hammer
	by Kyle Vanderburg, in Poplar Bluff & Springfield, Missouri, and Norman, OK.
	Hammer Backend Index Page
	Debuted on November 30, 2007, at www.kyledavey.com/blink.  Went live December 2, 2007.
	All code copyright Kyle Vanderburg
*/

$options['vanguard']=TRUE; $options['seths']=1;$options['vanguardAccess']="A";$options['vanguardLogin']="kdv/";
require "/var/www/api.ntfg.net/htdocs/hammer/vanilla.php";
$hammer->setHS(1); $hammer->setHD("/");

$hammer->clientUrlParse();
if($hammer->user['id']!=1){$hammer->prohibited('KV');die();}

$comp = new vio_comp_project($hammer);

$comprow = $comp->getByGUID($_GET['guid']);

$title = $titles[$page];

if(isset($_GET['e'])){ini_set('display_errors',1); error_reporting(E_ALL);$hammer->debug();}
$hammer->head("CPT | Tracker","<link rel=\"stylesheet\" href=\"//liszt.dev/assets/lz-master3.css\" type=\"text/css\" /><link rel=\"shortcut icon\" href=\"//liszt.me/assets/lisztfav.png\"/><script src=\"//liszt.dev/assets/lz-master3.js\"></script>");

if(($hammer->getHS()=="1") && ($hammer->getUserRole()<7)){echo "<div class=\"text-center\"><img src=\"//cdn.ntfg.net/images/hammer/delete.png\" /></div><h1 class=\"text-center\">You are not authorized to view this page.";die();}else{}

function button($action,$icon,$title,$class)
{
	echo "<span class=\"d-grid\"><button type=\"button\" class=\"btn btn-lg mb-1 pt-action ".$class."\" data-action=\"".$action."\"><i class=\"fa-light ".$icon."\"></i> ".$title."</button></span>";
}

// $hammer->debug(); ?>
<body>
<div class="container-fluid">
<center><strong><?php echo $comprow['title'] . " | " . $comprow['inst'] . " | " . $comprow['duedate']; ?></strong></center>
<strong>META</strong>
<div class="row">
	<div class="col-md-4"><?php button("start","fa-pencil","Start Composing Session","btn-success");?></div>
	<div class="col-md-4"><?php button("undo","fa-undo","UNDO LAST ACTION","btn-warning");?></div>
	<div class="col-md-4"><?php button("end","fa-pencil-slash","End Composing Session","btn-danger");?></div>
</div>
<hr>
<strong>PREPARATION</strong>
<div class="row">
	<div class="col-md-4"><?php button("listenwork","fa-volume","Listen to Work","btn-primary");?></div>
	<div class="col-md-4"><?php button("listenresearch","fa-turntable","Listen to Research","btn-primary");?></div>
	<div class="col-md-4"><?php button("scorestudy","fa-book-open","Score Study","btn-primary");?></div>
</div>
<hr>
<strong>INCUBATION</strong>
<div class="row">
	<div class="col-md-4"><?php button("improv","fa-guitar","Improv","btn-primary");?></div>
	<div class="col-md-4"><?php button("distract","fa-gamepad-modern","Begin Distraction","btn-primary");?></div>
	<div class="col-md-4"><?php button("concentrate","fa-brain","Begin Concentration","btn-primary");?></div>
</div>
<hr>
<strong>ILLUMINATION</strong>
<div class="row">
	<div class="col-md-4"><?php button("ideanew","fa-lightbulb-on","Attempt New Idea","btn-primary");?></div>
	<div class="col-md-4"><?php button("ideadev","fa-lightbulb-gear","Develop Current Idea","btn-primary");?></div>
	<div class="col-md-4"><?php button("ideascrap","fa-lightbulb-slash","Scrap Current Idea","btn-primary");?></div>
</div>
<hr>
<strong>FINALIZE</strong>
<div class="row">
	<div class="col-md-4"><?php button("orch","fa-violin","Orchestrate","btn-primary");?></div>
	<div class="col-md-4"><?php button("format","fa-file-dashed-line","Format","btn-primary");?></div>
	<div class="col-md-4"><?php button("scrapall","fa-dumpster","Scrap Entire Project","btn-primary");?></div>
</div>
<hr>
<div class="row">
	<div class="col-md-9">
        <label for="fall"><strong>Confidence</strong></label><input type="range" class="form-range" min="1" max="100" step="1" id="confidencerange">		
	</div><!--col-md-9-->
	<div class="col-md-3"><span class="d-grid"><button type="button" class="btn btn-liszt btn-lg d-block pt-confidence" data-action="confidence">Log Confidence</button></span></div>
</div>
<hr>
<div class="row">
	<div class="col-md-9">
<?php $hr=new vio_comp_action($hammer);
$hr->textinput("Comment","Comment");
?>
</div><!--col-md-4-->
	<div class="col-md-3"><br /><span class="d-grid"><button type="button" class="btn btn-liszt btn-lg pt-comment" data-action="comment">Log Comment</button></span></div>
</div>
<hr>

</div><!--container-fluid-->
<script>

function sendPostRequest(url, data, callback) {
	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	xhr.onreadystatechange = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				callback(xhr.responseText);
			}
		}
	};
	xhr.send(data);
}

function compButton(button, ext="") {
	var data = "page=" + encodeURIComponent("<?php echo get_class($hr); ?>") +
			 "&action=" + encodeURIComponent("compButton") +
			 "&record=" + encodeURIComponent("<?php echo $_GET['guid']; ?>") +
			 "&button=" + encodeURIComponent(button) +
			 "&extended=" + encodeURIComponent(ext) +
			 "&site=" + encodeURIComponent("<?php echo $hammer->getHA(); ?>") +
			 "&user=" + encodeURIComponent("<?php echo $hammer->user['hash']; ?>");

	sendPostRequest("/syscontrol.php", data, function (result) {
		console.log(result);
	});
}
		
//Button Handler
const btns = document.querySelectorAll('.pt-action')
btns.forEach(btn => {
   btn.addEventListener('click', event => {
		//Press Button
			compButton(btn.getAttribute('data-action'));
		//Change button green for feedback
			btn.classList.add("bg-success");
			setTimeout(() => {
				btn.classList.remove("bg-success");
			}, "1000");
		//Extra Handling for End Session
		if(btn.getAttribute('data-action')=="end"){
			window.location = '/pt/projects/';
		}
   });
});

//Confidence Slider Handler
document.querySelector(".pt-confidence").addEventListener("click", (event) => {
	//Specify Button
		const confidenceBtn = document.querySelector(".pt-confidence");
	//Collect value
		const confidence = document.querySelector("#confidencerange").value;
	//Press Button
		compButton(confidenceBtn.getAttribute('data-action'),confidence);
	//Change button green for feedback
		confidenceBtn.classList.add("bg-success");
		setTimeout(() => {
			confidenceBtn.classList.remove("bg-success");
		}, "1000");
});

//Comment Handler
document.querySelector(".pt-comment").addEventListener("click", (event) => {
	//Specify Button
		const commentBtn = document.querySelector(".pt-comment");
	//Collect value
		const comment = document.querySelector("#<?php echo $hr->page;?>-comment-field");
	//Press Button
		compButton(commentBtn.getAttribute('data-action'),comment.value);
	//Reset Value
		comment.value = " ";
	//Change button green for beedback
		commentBtn.classList.add("bg-success");
		setTimeout(() => {
			commentBtn.classList.remove("bg-success");
		}, "1000");
});
</script>
</body>