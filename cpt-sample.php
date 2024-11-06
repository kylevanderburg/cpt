<?php
/*
NoteForge Hammer
	by Kyle Vanderburg, in Poplar Bluff & Springfield, Missouri, and Norman, OK.
	Hammer Backend Index Page
	Debuted on November 30, 2007, at www.kyledavey.com/blink.  Went live December 2, 2007.
	All code copyright Kyle Vanderburg
*/

// $options['vanguard']=TRUE; $options['seths']=1;$options['vanguardAccess']="A";$options['vanguardLogin']="kdv/";
require "/var/www/api.ntfg.net/htdocs/hammer/vanilla.php";
$hammer->setHS(1); $hammer->setHD("/");

$hammer->clientUrlParse();
// if($hammer->user['id']!=1){$hammer->prohibited('KV');die();}

if(!empty($hammer->location[1])){$hammer->location['page']=$hammer->location[1];}
if(!empty($hammer->location[2])){$hammer->location['action']=$hammer->location[2];}
if(!empty($hammer->location[3])){$hammer->location['item']=$hammer->location[3];}

if(isset($hammer->location[1])){$page=$hammer->location[1];}else{$page="pt-index";}
if(isset($hammer->location[2])){$action=$hammer->location[2];}else{$action="";}

if(isset($_GET['e'])){ini_set('display_errors',1); error_reporting(E_ALL);$hammer->debug();}
$hammer->head("CPT | Sample","<link rel=\"stylesheet\" href=\"//liszt.dev/assets/lz-master3.css\" type=\"text/css\" /><link rel=\"shortcut icon\" href=\"//liszt.me/assets/lisztfav.png\"/><script src=\"//liszt.dev/assets/lz-master3.js\"></script>");

// var_dump($hammer);
// if(!isset($hammer->permissions['noteforge/hammer'])){$hammer->permissions['noteforge/hammer']=0;}
// if(($hammer->getHS()=="1") && ($hammer->getUserRole()<7)){echo "<div class=\"text-center\"><img src=\"//acdn.ntfg.net/images/hammer/delete.png\" /></div><h1 class=\"text-center\">You are not authorized to view this page.";die();}else{}

function button()
{
	
}

// $hammer->debug(); ?>
<body>
<div class="container-fluid">
<div class="alert alert-info">This interface will be used as a self-reporting system for composing. When complete, Process Tracker will output a transcript of the composition process.</div>
<br />
<strong>META</strong>
<div class="row">
	<div class="col-md-4"><a href="#" class="btn btn-success btn-lg d-block mb-1 pt-action" data-action="start"><i class="fa-light fa-pencil"></i> Start Composing Session</a></div>
	<div class="col-md-4"><a href="#" class="btn btn-warning btn-lg d-block mb-1 pt-action" data-action="undo"><i class="fa-light fa-undo"></i> UNDO LAST ACTION</a></div>
	<div class="col-md-4"><a href="#" class="btn btn-danger btn-lg d-block mb-1 pt-action" data-action="end"><i class="fa-light fa-pencil-slash"></i> End Composing Session</a></div>
</div>
<hr>
<strong>PREPARATION</strong>
<div class="row">
	<div class="col-md-4"><a href="#" class="btn btn-primary btn-lg d-block mb-1 pt-action" data-action="listenwork"><i class="fa-light fa-volume"></i> Listen to Work</a></div>
	<div class="col-md-4"><a href="#" class="btn btn-primary btn-lg d-block mb-1 pt-action" data-action="listenresearch"><i class="fa-light fa-turntable"></i> Listen to Research</a></div>
	<div class="col-md-4"><a href="#" class="btn btn-primary btn-lg d-block mb-1 pt-action" data-action="scorestudy"><i class="fa-light fa-book-open"></i> Score Study</a></div>
</div>
<hr>
<strong>INCUBATION</strong>
<div class="row">
	<div class="col-md-4"><a href="#" class="btn btn-primary btn-lg d-block mb-1 pt-action" data-action="improv"><i class="fa-light fa-guitar"></i> Improv</a></div>
	<div class="col-md-4"><a href="#" class="btn btn-primary btn-lg d-block mb-1 pt-action" data-action="distract"><i class="fa-light fa-gamepad-modern"></i> Begin Distraction</a></div>
	<div class="col-md-4"><a href="#" class="btn btn-primary btn-lg d-block mb-1 pt-action" data-action="concentrate"><i class="fa-light fa-brain"></i> Begin Concentration</a></div>
</div>
<hr>
<strong>ILLUMINATION</strong>
<div class="row">
	<div class="col-md-4"><a href="#" class="btn btn-primary btn-lg d-block mb-1 pt-action" data-action="ideanew"><i class="fa-light fa-lightbulb-on"></i> Attempt New Idea</a></div>
	<div class="col-md-4"><a href="#" class="btn btn-primary btn-lg d-block mb-1 pt-action" data-action="ideadev"><i class="fa-light fa-lightbulb-gear"></i> Develop Current Idea</a></div>
	<div class="col-md-4"><a href="#" class="btn btn-primary btn-lg d-block mb-1 pt-action" data-action="ideascrap"><i class="fa-light fa-lightbulb-slash"></i> Scrap Current Idea</a></div>
</div>
<hr>
<strong>FINALIZE</strong>
<div class="row">
	<div class="col-md-4"><a href="#" class="btn btn-primary btn-lg d-block mb-1 pt-action" data-action="orch"><i class="fa-light fa-violin"></i> Orchestrate</a></div>
	<div class="col-md-4"><a href="#" class="btn btn-primary btn-lg d-block mb-1 pt-action" data-action="format"><i class="fa-light fa-file-dashed-line"></i> Format</a></div>
	<div class="col-md-4"><a href="#" class="btn btn-primary btn-lg d-block mb-1 pt-action" data-action="scrapall"><i class="fa-light fa-dumpster"></i> Scrap Entire Project</a></div>
</div>
<hr>
<div class="row">
	<div class="col-md-9">
        <label for="fall"><strong>Confidence</strong></label><input type="range" class="form-range" min="1" max="100" step="1" id="confidencerange">		
	</div><!--col-md-4-->
	<div class="col-md-3"><a href="#" class="btn btn-liszt btn-lg d-block pt-confidence" data-action="confidence">Log Confidence</a></div>
</div>
<hr>
<div class="row">
	<div class="col-md-9">
<?php $hr=new hammer_composition($hammer);
$hr->textinput("Comment","Comment");
?>
</div><!--col-md-4-->
	<div class="col-md-3"><br /><a href="#" class="btn btn-liszt btn-lg d-block pt-comment" data-action="comment">Log Comment</a></div>
</div>
<hr>

</div><!--container-fluid-->
<script>
const btns = document.querySelectorAll('.pt-action')
btns.forEach(btn => {
   btn.addEventListener('click', event => {
        // alert('hi');
        alert(btn.getAttribute('data-action'));
		// console.log(event);
		btn.classList.add("bg-success");
		setTimeout(() => {
			btn.classList.remove("bg-success");
		}, "1000");
   });
});

document.querySelector(".pt-confidence").addEventListener("click", (event) => {
	// console.log(document.querySelector("#confidencerange").value);
	const btn = document.querySelector(".pt-confidence");
	const confidence = document.querySelector("#confidencerange").value;
	alert(confidence);
		btn.classList.add("bg-success");
		setTimeout(() => {
			btn.classList.remove("bg-success");
		}, "1000");
});

document.querySelector(".pt-comment").addEventListener("click", (event) => {
	// console.log(document.querySelector("#confidencerange").value);
	const btn = document.querySelector(".pt-comment");
	const comment = document.querySelector("#compositions-comment-field");
	alert(comment.value);
	comment.value = " ";
	btn.classList.add("bg-success");
	setTimeout(() => {
		btn.classList.remove("bg-success");
	}, "1000");
});
</script>
</body>